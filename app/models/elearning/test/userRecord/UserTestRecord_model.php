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

}