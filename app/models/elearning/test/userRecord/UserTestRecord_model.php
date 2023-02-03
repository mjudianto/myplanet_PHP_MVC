<?php 

include_once '../app/core/Database.php';

class UserTestRecord_model {
  private $table = 'userTestRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createUserRecord($testId, $userId) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :testId, :userId, DEFAULT)');
    $this->db->bind('testId', $testId);
    $this->db->bind('userId', $userId);
    $this->db->execute();

    $this->getUserTestRecord($testId, $userId);
  }

  public function getUserTestRecord($testId, $userId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningTestId=:testId AND userId=:userId');
    $this->db->bind('testId', $testId);
    $this->db->bind('userId', $userId);
    return $this->db->single();
  }

  public function updateUserAttempt($testId, $userId, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt WHERE elearningTestId=:testId AND userId=:userId');
    $this->db->bind('testId', $testId);
    $this->db->bind('userId', $userId);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }

  public function userTestRecord($userId, $orgId) {
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
                  AND userTestRecord.userId=:userId
              WHERE
                (elearningCourse.access_type = 0 OR
                (elearningCourse.access_type = 2 AND 
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM elearningCourseAkses
                    WHERE organizationId = :orgId
                    )
                )
                )
              GROUP BY 
                elearningKategori.nama,
                elearningCourse.judul;';

    $this->db->query($query);
    $this->db->bind('userId', $userId);
    $this->db->bind('orgId', $orgId);

    return $this->db->resultSet();
  }

  public function userTestRecordDetail($userId, $courseId) {
    $query = 'SELECT 
                elearningTest.judul AS "judul test", 
                COALESCE(userTestRecord.attempt, 0) AS attempt, 
                MAX(userTestRecordDetail.finished) AS finished,
                MAX(userTestRecordDetail.score) AS score, 
                (
                    SELECT userTestRecordDetail.status 
                    FROM userTestRecordDetail
                    RIGHT JOIN userTestRecord ON userTestRecordDetail.userTestRecordID=userTestRecord.userTestRecordId
                    WHERE score = ( SELECT MAX(score) FROM userTestRecordDetail WHERE userTestRecordId=userTestRecord.userTestRecordId)
                    AND userTestRecord.userID = :userId
                    LIMIT 1
                ) AS status
              FROM 
                elearningCourse
                INNER JOIN elearningModule ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId AND elearningCourse.elearningCourseId = :courseId
                INNER JOIN elearningTest ON elearningModule.elearningModuleId = elearningTest.elearningModuleId
                LEFT JOIN userTestRecord
                ON userTestRecord.elearningTestId = elearningTest.elearningTestId AND userTestRecord.userId = :userId
                LEFT JOIN userTestRecordDetail
                ON userTestRecordDetail.userTestRecordId = userTestRecord.userTestRecordId
              GROUP BY 
                elearningTest.judul, 
                userTestRecord.attempt';

    $this->db->query($query);
    $this->db->bind('courseId', $courseId);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

}