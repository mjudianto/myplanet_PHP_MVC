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

  public function createTest($moduleId, $judul, $passingScore, $timeLimit, $endDate) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :moduleId, :judul, :passingScore, :timeLimit, :default, :endDate, :default)');
    $this->db->bind('moduleId', $moduleId);
    $this->db->bind('judul', $judul);
    $this->db->bind('passingScore', $passingScore);
    $this->db->bind('timeLimit', $timeLimit);
    $this->db->bind('endDate', $endDate);

    $this->db->execute();
  }

}