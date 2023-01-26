<?php 

include_once '../app/core/Database.php';

class ElearningCourse_model {
  private $table = 'elearningCourse';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllCourse() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getCourseBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}