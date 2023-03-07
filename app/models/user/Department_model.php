<?php 

include_once '../app/core/Database.php';

class Department_Model {
  private $table = 'organization';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllDepartment() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function createDepartment($deptName) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :deptName)');
    $this->db->bind('deptName', $deptName);
    $this->db->execute();
  }

}