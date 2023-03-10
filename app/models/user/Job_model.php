<?php 

include_once '../app/core/Database.php';

class Job_model {
  private $table = 'job';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllJob() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function createJob($jobName) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :jobName)');
    $this->db->bind('jobName', $jobName);
    $this->db->execute();
  }

  public function getSpesificJob($jobName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE jobName=:jobName');
    $this->db->bind('jobName', $jobName);

    if (is_bool($this->db->single())) {
      return null;
    }
    return $this->db->single()['jobId'];
  }

}