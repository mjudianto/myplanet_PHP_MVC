<?php 

include_once '../app/core/Database.php';

class UserLessonRecord_model {
  private $table = 'userLessonRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createUserRecord($lessonId, $userNik) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :lessonId, :userNik, DEFAULT, DEFAULT)');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userNik', $userNik);
    $this->db->execute();
  }

  public function updateUserAttempt($lessonId, $userNik, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt, finished=default WHERE elearningLessonId=:lessonId AND userNik=:userNik');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }
  
  public function getUserLessonRecord($lessonId, $userNik) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningLessonId=:lessonId AND userNik=:userNik');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userNik', $userNik);
    return $this->db->single();
  }

  public function getCourseRecord($userNik){
    $this->db->query("SELECT userLessonRecord.userNik, userLessonRecord.attempt, elearningLesson.judul as 'judul lesson', elearningCourse.judul as 'judul course',
                      userLessonRecord.finished
                      FROM userLessonRecord 
                      left join elearningLesson 
                      on userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId
                      left join elearningModule
                      on elearningLesson.elearningModuleId = elearningModule.elearningModuleId
                      left join elearningCourse
                      on elearningModule.elearningCourseId = elearningCourse.elearningCourseId
                      where userLessonRecord.userNik=:userNik
                      order by userLessonRecord.finished DESC");
    $this->db->bind('userNik', $userNik);
    return $this->db->resultSet();
  }

  public function userLessonRecord($userNik, $orgId, $companyId, $locId) {
    $query = 'SELECT DISTINCT
                elearningKategori.nama AS "nama kategori", 
                elearningCourse.judul AS "judul course", 
                elearningCourse.elearningCourseId AS "courseId", 
                (SELECT COUNT(*) FROM elearningLesson) AS total_lessons, 
                SUM(CASE WHEN userLessonRecord.elearningLessonId IS NOT NULL THEN 1 ELSE 0 END) AS attempted_lessons
              FROM 
                elearningKategori 
                INNER JOIN elearningCourse 
                  ON elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
                LEFT JOIN elearningModule
                  ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId
                LEFT JOIN elearningLesson
                  ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN userLessonRecord 
                  ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId
                  AND userLessonRecord.userNik=:userNik
              WHERE
                (elearningCourse.access_type = 0 OR
                (elearningCourse.access_type = 2 AND 
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM companyCourseAkses
                    WHERE companyId=:companyId
                    )
                  OR
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM organizationCourseAkses
                    WHERE organizationId = :orgId
                    )
                  OR
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM locationCourseAkses
                    WHERE locationId = :locId
                    )
                  OR
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM userCourseAkses
                    WHERE userNik = :userNik
                    )
                )
                )
              GROUP BY 
                elearningKategori.nama,
                elearningCourse.judul,
                elearningCourse.elearningCourseId';

    $this->db->query($query);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('orgId', $orgId);
    $this->db->bind('companyId', $companyId);
    $this->db->bind('locId', $locId);

    return $this->db->resultSet();
  }

  public function userSertificate($userNik) {
    $query = 'SELECT DISTINCT 
                elearningKategori.nama AS "nama kategori", 
                elearningCourse.judul AS "judul course", 
                elearningCourse.elearningCourseId as "courseId", 
                COUNT(elearningLesson.elearningLessonId) AS total_lessons,
                COUNT(userLessonRecord.userLessonRecordId) as attempted_lessons
              FROM 
                elearningKategori 
                INNER JOIN elearningCourse 
                  ON elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
                LEFT JOIN elearningModule
                  ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId
                LEFT JOIN elearningLesson
                  ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN companyCourseAkses ON elearningCourse.elearningCourseId = companyCourseAkses.elearningCourseId
                LEFT JOIN organizationCourseAkses ON elearningCourse.elearningCourseId = organizationCourseAkses.elearningCourseId
                LEFT JOIN locationCourseAkses ON elearningCourse.elearningCourseId = locationCourseAkses.elearningCourseId
                LEFT JOIN jobCourseAkses ON elearningCourse.elearningCourseId = jobCourseAkses.elearningCourseId
                LEFT JOIN userLessonRecord 
                  ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId
              WHERE elearningCourse.access_type = 0
                AND elearningCourse.elearningCourseId != 19 
                AND elearningCourse.state=1
                AND userLessonRecord.userNik=:userNik
                OR elearningCourse.access_type = 2 
                AND elearningCourse.elearningCourseId != 19 
                AND elearningCourse.state=1
                AND userLessonRecord.userNik=:userNik
              GROUP BY 
                elearningKategori.elearningKategoriId,
                elearningCourse.elearningCourseId
            ORDER BY
              elearningCourse.elearningCourseId';

    $this->db->query($query);
    $this->db->bind('userNik', $userNik);
    return $this->db->resultSet();
  }

  public function userLessonRecordDetail($userNik, $courseId) {
    $query = 'SELECT
                elearningLesson.judul AS "judul lesson",
                COALESCE(userLessonRecord.attempt, 0) AS attempt,
                COALESCE(userLessonRecord.finished, 0) AS finished
              FROM
                elearningCourse
                INNER JOIN elearningModule ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId AND elearningCourse.elearningCourseId = :courseId
                INNER JOIN elearningLesson ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN userLessonRecord
                ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId AND userLessonRecord.userNik = :userNik
              GROUP BY
                elearningLesson.judul,
                COALESCE(userLessonRecord.attempt, 0),
                COALESCE(userLessonRecord.finished, 0)';

    $this->db->query($query);
    $this->db->bind('courseId', $courseId);
    $this->db->bind('userNik', $userNik);

    return $this->db->resultSet();
  }

  public function getAllRecord() {
    $query = 'select elearningLesson.judul, 
                userLessonRecord.userNik, 
                user.userNik,
                user.nama,
                organization.organizationName,
                location.locationName,
                userLessonRecord.attempt,
                userLessonRecord.finished
              from elearningLesson
                left join elearningModule on elearningLesson.elearningModuleId = elearningModule.elearningModuleId
                right join userLessonRecord on elearningLesson.elearningLessonId = userLessonRecord.elearningLessonId
                left join user on userLessonRecord.userNik = user.userNik
                left join location on user.locationId = location.locationId
                left join organization on user.organizationId = organization.organizationId
              where elearningModule.elearningCourseId != 19
              group by 
                userLessonRecord.userNik,
                userLessonRecord.attempt,
				        userLessonRecord.finished,
                elearningLesson.judul,
                user.userNik';

    $this->db->query($query);

    return $this->db->resultSet();
  }

  public function getSopikLessonRecord() {
    $query = 'select elearningLesson.judul, 
                userLessonRecord.userNik, 
                user.userNik,
                user.nama,
                organization.organizationName,
                location.locationName,
                userLessonRecord.attempt,
                userLessonRecord.finished
              from elearningLesson
                left join elearningModule on elearningLesson.elearningModuleId = elearningModule.elearningModuleId
                right join userLessonRecord on elearningLesson.elearningLessonId = userLessonRecord.elearningLessonId
                left join user on userLessonRecord.userNik = user.userNik
                left join location on user.locationId = location.locationId
                left join organization on user.organizationId = organization.organizationId
              where elearningModule.elearningCourseId = 19
              group by 
                userLessonRecord.userNik,
                userLessonRecord.attempt,
				        userLessonRecord.finished,
                elearningLesson.judul,
                user.userNik';

    $this->db->query($query);

    return $this->db->resultSet();
  }

}