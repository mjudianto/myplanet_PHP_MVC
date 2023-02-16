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

  public function createChoice($questionId, $answer, $answerId) {
    if ($answerId == 'null') {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :questionId, :answer, null)');
      $this->db->bind('questionId', $questionId);
      $this->db->bind('answer', $answer);
    } else {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :questionId, :answer, :answerId)');
      $this->db->bind('questionId', $questionId);
      $this->db->bind('answer', $answer);
      $this->db->bind('answerId', $answerId);
    }
    
    $this->db->execute();
  }

}