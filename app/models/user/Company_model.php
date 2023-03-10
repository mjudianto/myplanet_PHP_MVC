<?php 

include_once '../app/core/Database.php';

class Company_model {
  private $table = 'company';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllCompany() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function createCompany($companyName) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :companyName)');
    $this->db->bind('companyName', $companyName);
    $this->db->execute();
  }

  public function getSpesificCompany($companyName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE companyName=:companyName');
    $this->db->bind('companyName', $companyName);

    if (is_bool($this->db->single())) {
      return null;
    }
    return $this->db->single()['companyId'];
  }

}