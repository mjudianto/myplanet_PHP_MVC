<?php 

include_once '../app/core/Database.php';

class UserEnsightRecord_model {
  private $table = 'userEnsightRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAll() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getEnsightRecord($ensightId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ensightId=:ensightId');
    $this->db->bind('ensightId', $ensightId);
    return $this->db->resultSet();
  }
  
  public function getUserRecord($ensightId, $userId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ensightId=:ensightId AND userId=:userId');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userId', $userId);
    return $this->db->single();
  }

  public function createUserRecord($ensightId, $userId) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :ensightId, :userId, default, default)');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userId', $userId);
    $this->db->execute();
  }

  public function updateUserRecordViews($ensightId, $userId, $views) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:views WHERE ensightId=:ensightId AND userId=:userId');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userId', $userId);
    $this->db->bind('views', $views);
    $this->db->execute();
  }

}