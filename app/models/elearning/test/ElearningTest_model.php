<?php 

include_once '../app/core/Database.php';

class ElearningTest_model {
  private $table = 'elearningTest';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getTestBy($testId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningTestId=:testId');
    $this->db->bind('testId', $testId);
    return $this->db->single();
  }

}