<?php 

include_once '../app/core/Database.php';

class ElearningKategori_model {
  private $table = 'elearningKategori';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllKategori() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getKategoriDetail() {
    $this->db->query('select elearningKategori.elearningKategoriId, elearningKategori.nama, count(elearningCourse.elearningCourseId) as "course", elearningKategori.state
                      from elearningKategori
                      join elearningCourse on elearningKategori.elearningKategoriId=elearningCourse.elearningKategoriId
                      group by elearningKategori.elearningKategoriId');
    
    return $this->db->resultSet();
  }

}