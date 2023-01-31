<?php 

include_once '../app/core/Database.php';

class Notification_model {
  private $table = 'notification';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllNotification() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getUserNotification($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

  

}