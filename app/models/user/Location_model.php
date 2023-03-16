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

  public function getSpesificLocation($locationName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE locationName=:locationName');
    $this->db->bind('locationName', $locationName);

    if (is_bool($this->db->single())) {
      return null;
    }
    return $this->db->single()['locationId'];
  }

  

}