<?php 

include_once '../app/core/Database.php';

class UserLessonRecord_model {
  private $table = 'userLessonRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createUserRecord($lessonId, $userId) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :lessonId, :userId, DEFAULT, DEFAULT)');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userId', $userId);
    $this->db->execute();
  }

  public function updateUserAttempt($lessonId, $userId, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt, finished=default WHERE elearningLessonId=:lessonId AND userId=:userId');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userId', $userId);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }
  
  public function getUserLessonRecord($lessonId, $userId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningLessonId=:lessonId AND userId=:userId');
    $this->db->bind('lessonId', $lessonId);
    $this->db->bind('userId', $userId);
    return $this->db->single();
  }

  public function getCourseRecord($column, $value){
    $this->db->query("SELECT userLessonRecord.userId, userLessonRecord.attempt, elearningLesson.judul as 'judul lesson', elearningCourse.judul as 'judul course',
    userLessonRecord.finished
    FROM userLessonRecord 
    left join elearningLesson 
    on userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId
    left join elearningModule
    on elearningLesson.elearningModuleId = elearningModule.elearningModuleId
    left join elearningCourse
    on elearningModule.elearningCourseId = elearningCourse.elearningCourseId
    where userLessonRecord." . $column . "=:value
    order by userLessonRecord.finished DESC");
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

  public function userLessonRecord($userId, $orgId) {
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
                  AND userLessonRecord.userId=:userId
              WHERE
                (elearningCourse.access_type = 0 OR
                (elearningCourse.access_type = 2 AND 
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM elearningCourseAkses
                    WHERE departmentId=:orgId
                    )
                  OR
                  elearningCourse.elearningCourseId IN 
                    (SELECT elearningCourseId
                    FROM userElearningCourseAkses
                    WHERE userId = :userId
                    )
                )
                )
              GROUP BY 
                elearningKategori.nama,
                elearningCourse.judul,
                elearningCourse.elearningCourseId';

    $this->db->query($query);
    $this->db->bind('userId', $userId);
    $this->db->bind('orgId', $orgId);

    return $this->db->resultSet();
  }

  public function userLessonRecordDetail($userId, $courseId) {
    $query = 'SELECT
                elearningLesson.judul AS "judul lesson",
                COALESCE(userLessonRecord.attempt, 0) AS attempt,
                COALESCE(userLessonRecord.finished, 0) AS finished
              FROM
                elearningCourse
                INNER JOIN elearningModule ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId AND elearningCourse.elearningCourseId = :courseId
                INNER JOIN elearningLesson ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN userLessonRecord
                ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId AND userLessonRecord.userId = :userId
              GROUP BY
                elearningLesson.judul,
                COALESCE(userLessonRecord.attempt, 0),
                COALESCE(userLessonRecord.finished, 0)';

    $this->db->query($query);
    $this->db->bind('courseId', $courseId);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

  public function getAllRecord() {
    $query = 'select elearningLesson.judul, 
                userLessonRecord.userId, 
                user.nik,
                user.nama,
                department.departmentName,
                location.locationName,
                userLessonRecord.attempt,
                userLessonRecord.finished
              from elearningLesson
                left join elearningModule on elearningLesson.elearningModuleId = elearningModule.elearningModuleId AND elearningModule.elearningCourseId != 19
                right join userLessonRecord on elearningLesson.elearningLessonId = userLessonRecord.elearningLessonId
                left join user on userLessonRecord.userId = user.userId
                left join location on user.locationId = location.locationId
                left join department on user.departmentId = department.departmentId
              group by 
                userLessonRecord.userId,
                userLessonRecord.attempt,
				        userLessonRecord.finished,
                elearningLesson.judul,
                user.nik';

    $this->db->query($query);

    return $this->db->resultSet();
  }

}