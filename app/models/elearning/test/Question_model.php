<?php 

include_once '../app/core/Database.php';

class Question_model {
  private $table = 'question';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getQuestionBy($testId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningTestId=:testId');
    $this->db->bind('testId', $testId);
    return $this->db->resultSet();
  }

  public function countQuestion($testId) {
    $this->db->query('SELECT COUNT(questionId) as numberOfQuestion FROM ' . $this->table . ' WHERE elearningTestId=:testId');
    $this->db->bind('testId', $testId);
    return $this->db->single();
  }

}