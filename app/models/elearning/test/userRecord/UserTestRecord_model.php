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
  }

  public function getUserTestRecord($column, $column2, $value, $value2) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    return $this->db->single();
  }

  public function updateUserAttempt($column, $column2, $value, $value2, $attempt) {
    $this->db->query('UPDATE ' . $this->table . ' SET attempt=:attempt WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    $this->db->bind('attempt', $attempt);
    $this->db->execute();
  }

}