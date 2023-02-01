<?php 

include_once '../app/core/Database.php';

class Choice_model {
  private $table = 'choice';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getChoiceBy($questionId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE questionId=:questionId');
    $this->db->bind('questionId', $questionId);
    return $this->db->resultSet();
  }

}