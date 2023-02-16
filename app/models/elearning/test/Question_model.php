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

  public function createQuestion($testId, $question, $score) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :testId, :question, :score)');
    $this->db->bind('testId', $testId);
    $this->db->bind('question', $question);
    $this->db->bind('score', $score);
    $this->db->execute();
  }

  public function getSingelQuestion($testId, $question) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningTestId=:testId AND question=:question');
    $this->db->bind('testId', $testId);
    $this->db->bind('question', $question);
    return $this->db->single();
  }

}