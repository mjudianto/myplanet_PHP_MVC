<?php 

include_once '../app/core/Database.php';

class Podtret_model {
  private $table = 'podtret';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAll() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getPodtretBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function filterPodtret($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

  public function updatePodtretViews($column, $value, $newViews) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:newViews WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    $this->db->bind('newViews', $newViews);
    $this->db->execute();
  }

}