<?php 

include_once '../app/core/Database.php';

class Answer_model {
  private $table = 'answer';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getQuestionAnswer($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

}