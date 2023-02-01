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

  public function getCourseBy($kategoriId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningKategoriId=:kategoriId');
    $this->db->bind('kategoriId', $kategoriId);
    return $this->db->resultSet();
  }

}