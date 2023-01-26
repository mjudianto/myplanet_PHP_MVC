<?php 

include_once '../app/core/Database.php';

class Choice_model {
  private $table = 'choice';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getChoiceBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}