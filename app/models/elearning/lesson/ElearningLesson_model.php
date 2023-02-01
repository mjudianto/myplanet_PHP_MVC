<?php 

include_once '../app/core/Database.php';

class ElearningLesson_model {
  private $table = 'elearningLesson';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getSpesificLesson($value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningLessonId=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function getLessonBy($value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningModuleId=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}