<?php 

include_once '../app/core/Database.php';

class Organization_Model {
  private $table = 'organization';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllOrganization() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function createOrganization($organizationName) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :organizationName)');
    $this->db->bind('organizationName', $organizationName);
    $this->db->execute();
  }

  public function getSpesificOrganization($organizationName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE organizationName=:organizationName');
    $this->db->bind('organizationName', $organizationName);

    if (is_bool($this->db->single())) {
      return null;
    }
    return $this->db->single()['organizationId'];
  }

}