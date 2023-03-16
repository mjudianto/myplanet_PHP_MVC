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
                      left join elearningCourse on elearningKategori.elearningKategoriId=elearningCourse.elearningKategoriId
                      group by elearningKategori.elearningKategoriId');
    
    return $this->db->resultSet();
  }

  public function addKategori($kategori) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :kategori, default, default)');
    $this->db->bind('kategori', $kategori);
    $this->db->execute();
  }

  public function updateKategori($kategoriId, $nama) {
    $this->db->query('UPDATE ' . $this->table . ' SET nama=:nama where elearningKategoriId=:kategoriId');
    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('nama', $nama);
    $this->db->execute();
  }

}