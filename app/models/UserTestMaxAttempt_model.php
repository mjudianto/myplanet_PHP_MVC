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
    $this->db->bind('testId', $testRecordId);
    $this->db->execute();
  }

  public function getTestMaxAttempt($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function updateMaxAttempt($column, $column2, $value, $value2, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }

}