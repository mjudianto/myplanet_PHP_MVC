<?php 

include_once '../app/core/Database.php';

class Answer_model {
  private $table = 'answer';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getQuestionAnswer($questionId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE questionId=:questionId');
    $this->db->bind('questionId', $questionId);
    return $this->db->single();
  }

  public function createAnswer($questionId, $answer) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :questionId, :answer)');
    $this->db->bind('questionId', $questionId);
    $this->db->bind('answer', $answer);
    $this->db->execute();
  }

}