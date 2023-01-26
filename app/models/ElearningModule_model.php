<?php 

include_once '../app/core/Database.php';

class ElearningModule_model {
  private $table = 'elearningModule';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllModule() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getModuleBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}