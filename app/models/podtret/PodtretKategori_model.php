<?php 

include_once '../app/core/Database.php';

class PodtretKategori_model {
  private $table = 'podtretKategori';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllKategori() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getKategoriBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

}