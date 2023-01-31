<?php 

include_once '../app/core/Database.php';

class Location_model {
  private $table = 'location';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllLocation() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

}