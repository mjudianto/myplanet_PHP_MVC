<?php 

include_once '../app/core/Database.php';

class UserTestRecordDetail_model {
  private $table = 'userTestRecordDetail';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createTestRecordDetail($testRecord, $attemptNumber, $status, $score) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :testRecord, :attemptNumber, :score, :status, DEFAULT)');
    $this->db->bind('testRecord', $testRecord);
    $this->db->bind('attemptNumber', $attemptNumber);
    $this->db->bind('score', $score);
    $this->db->bind('status', $status);
    $this->db->execute();
  }

  public function getUserTestRecord($column, $column2, $value, $value2) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    return $this->db->single();
  }
  

  public function getCourseRecord($column, $value){
    $this->db->query("SELECT userTestRecordDetail.attemptNumber, elearningTest.judul as 'judul test', elearningCourse.judul as 'judul course', userTestRecordDetail.score, userTestRecordDetail.status
    FROM userTestRecordDetail
    left join userTestRecord 
    on userTestRecordDetail.userTestRecordId = userTestRecord.userTestRecordId
    left join elearningTest 
    on userTestRecord.elearningTestId = elearningTest.elearningTestId
    left join elearningModule
    on elearningTest.elearningModuleId = elearningModule.elearningModuleId
    left join elearningCourse
    on elearningModule.elearningCourseId = elearningCourse.elearningCourseId
    where userTestRecord." . $column . "=:value
    order by userTestRecordDetail.finished DESC");
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}