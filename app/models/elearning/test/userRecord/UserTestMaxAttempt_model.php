<?php 

include_once '../app/core/Database.php';

class UserTestMaxAttempt_model {
  private $table = 'userTestMaxAttempt';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createTestMaxAttempt($testRecordId) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :testRecordId, DEFAULT)');
    $this->db->bind('testRecordId', $testRecordId);
    $this->db->execute();
  }

  public function getTestMaxAttempt($testRecordId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE userTestRecordId=:testRecordId');
    $this->db->bind('testRecordId', $testRecordId);
    return $this->db->single();
  }

  public function updateMaxAttempt($userTestRecordId, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET maxAttempt=:attempt WHERE userTestRecordId=:userTestRecordId');
    $this->db->bind('userTestRecordId', $userTestRecordId);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }

}