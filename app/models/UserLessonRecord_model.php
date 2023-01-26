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

  public function updateUserAttempt($column, $column2, $value, $value2, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }
  
  public function getUserLessonRecord($column, $column2, $value, $value2) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    return $this->db->single();
  }

  public function getCourseRecord($column, $value){
    $this->db->query("SELECT userLessonRecord.userId, userLessonRecord.attempt, elearningLesson.judul as 'judul lesson', elearningCourse.judul as 'judul course'
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

}