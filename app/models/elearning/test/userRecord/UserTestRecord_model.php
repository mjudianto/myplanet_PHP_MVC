<?php 

include_once '../app/core/Database.php';

class UserTestRecord_model {
  private $table = 'userTestRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createUserRecord($testId, $userNik) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :testId, :userNik, DEFAULT)');
    $this->db->bind('testId', $testId);
    $this->db->bind('userNik', $userNik);
    $this->db->execute();

    $this->getUserTestRecord($testId, $userNik);
  }

  public function getUserTestRecord($testId, $userNik) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningTestId=:testId AND userNik=:userNik');
    $this->db->bind('testId', $testId);
    $this->db->bind('userNik', $userNik);
    return $this->db->single();
  }

  public function updateUserAttempt($testId, $userNik, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt WHERE elearningTestId=:testId AND userNik=:userNik');
    $this->db->bind('testId', $testId);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }

  public function userTestRecord($userNik, $orgId) {
    $query = 'SELECT DISTINCT
                elearningKategori.nama AS "nama kategori", 
                elearningCourse.judul AS "judul course", 
                (SELECT COUNT(*) FROM elearningTest) AS total_tests, 
                SUM(CASE WHEN userTestRecord.elearningTestId IS NOT NULL THEN 1 ELSE 0 END) AS attempted_tests
              FROM 
                elearningKategori 
                INNER JOIN elearningCourse 
                  ON elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
                LEFT JOIN elearningModule
                  ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId
                LEFT JOIN elearningTest
                  ON elearningModule.elearningModuleId = elearningTest.elearningModuleId
                LEFT JOIN userTestRecord 
                  ON userTestRecord.elearningTestId = elearningTest.elearningTestId
                  AND userTestRecord.userNik=:userNik
              WHERE
                (elearningCourse.access_type = 0 OR
                (elearningCourse.access_type = 2 AND 
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM organizationCourseAkses
                    WHERE organizationId = :orgId
                    )
                )
                )
              GROUP BY 
                elearningKategori.nama,
                elearningCourse.judul;';

    $this->db->query($query);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('orgId', $orgId);

    return $this->db->resultSet();
  }

  public function userTestRecordDetail($userNik, $courseId) {
    $query = 'SELECT 
                userTestRecord.userTestRecordId,
                elearningTest.judul AS "judul test", 
                COALESCE(userTestRecord.attempt, 0) AS attempt, 
                MAX(userTestRecordDetail.finished) AS finished,
                MAX(userTestRecordDetail.score) AS score, 
                (
                    SELECT userTestRecordDetail.status 
                    FROM userTestRecordDetail
                    RIGHT JOIN userTestRecord ON userTestRecordDetail.userTestRecordID=userTestRecord.userTestRecordId
                    WHERE score = ( SELECT MAX(score) FROM userTestRecordDetail WHERE userTestRecordId=userTestRecord.userTestRecordId)
                    AND userTestRecord.userNik = :userNik
                    LIMIT 1
                ) AS status
              FROM 
                elearningCourse
                INNER JOIN elearningModule ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId AND elearningCourse.elearningCourseId = :courseId
                INNER JOIN elearningTest ON elearningModule.elearningModuleId = elearningTest.elearningModuleId
                LEFT JOIN userTestRecord
                ON userTestRecord.elearningTestId = elearningTest.elearningTestId AND userTestRecord.userNik = :userNik
                LEFT JOIN userTestRecordDetail
                ON userTestRecordDetail.userTestRecordId = userTestRecord.userTestRecordId
              GROUP BY 
                elearningTest.judul, 
                userTestRecord.userTestRecordId, 
                userTestRecord.attempt';

    $this->db->query($query);
    $this->db->bind('courseId', $courseId);
    $this->db->bind('userNik', $userNik);

    return $this->db->resultSet();
  }

  public function getAllUserRecord($courseId) {
    $query = 'select elearningTest.judul, 
                userTestRecord.userNik, 
                max(userTestRecordDetail.attemptNumber) as "totalAttempt",
                max(userTestRecordDetail.score) as "score",
                max(userTestRecordDetail.status) as "status",
                max(userTestRecordDetail.finished) as "time",
                user.userNik,
                user.nama,
                organization.organizationName,
                location.locationName
              from elearningTest
                left join elearningModule on elearningTest.elearningModuleId = elearningModule.elearningModuleId
                right join elearningCourse on elearningModule.elearningCourseId = elearningCourse.elearningCourseId
                left join userTestRecord on elearningTest.elearningTestId = userTestRecord.elearningTestId
                left join userTestRecordDetail on userTestRecord.userTestRecordId = userTestRecordDetail.userTestRecordId
                left join user on userTestRecord.userNik = user.userNik
                left join location on user.locationId = location.locationId
                left join organization on user.organizationId = organization.organizationId
              where elearningCourse.elearningCourseId=:courseId
              group by 
                userTestRecord.userNik,
                elearningTest.judul,
                user.userNik';

    $this->db->query($query);
    $this->db->bind('courseId', $courseId);

    return $this->db->resultSet();
  }

  public function getAllRecord() {
    $query = 'select elearningTest.judul, 
                userTestRecord.userNik, 
                max(userTestRecordDetail.attemptNumber) as "totalAttempt",
                max(userTestRecordDetail.score) as "score",
                max(userTestRecordDetail.status) as "status",
                max(userTestRecordDetail.finished) as "time",
                user.userNik,
                user.nama,
                organization.organizationName,
                location.locationName
              from elearningTest
                left join elearningModule on elearningTest.elearningModuleId = elearningModule.elearningModuleId
                left join userTestRecord on elearningTest.elearningTestId = userTestRecord.elearningTestId
                left join userTestRecordDetail on userTestRecord.userTestRecordId = userTestRecordDetail.userTestRecordId
                left join user on userTestRecord.userNik = user.userNik
                left join location on user.locationId = location.locationId
                left join organization on user.organizationId = organization.organizationId
              where elearningModule.elearningCourseId != 19
              group by 
                userTestRecord.userNik,
                elearningTest.judul,
                user.userNik';

    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getTestRecord($userNik, $moduleId) {
    $query = 'select max(userTestRecordDetail.score) as "score", max(userTestRecordDetail.status) as "status", 
              max(userTestRecordDetail.attemptNumber) as "attempt", max(userTestRecordDetail.finished) as "finished"
              from elearningTest
              left join userTestRecord on elearningTest.elearningTestId=userTestRecord.elearningTestId
              left join userTestRecordDetail on userTestRecord.userTestRecordId=userTestRecordDetail.userTestRecordId
              where userTestRecord.userNik=:userNik and elearningTest.elearningModuleId=:moduleId
              group by
              elearningTest.elearningTestId;';

    $this->db->query($query);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('moduleId', $moduleId);

    return $this->db->resultSet();
  }

}