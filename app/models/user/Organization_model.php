<?php 

include_once '../app/core/Database.php';

class Organization_model {
  private $table = 'organization';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllOrganization() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

}