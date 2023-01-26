<?php 

include_once '../app/core/Database.php';

class Question_model {
  private $table = 'question';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getQuestionBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

  public function countQuestion($column, $value) {
    $this->db->query('SELECT COUNT(questionId) as numberOfQuestion FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

}