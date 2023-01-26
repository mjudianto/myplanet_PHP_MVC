<?php 

include_once '../app/core/Database.php';

class ElearningTest_model {
  private $table = 'elearningTest';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getTestBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

}