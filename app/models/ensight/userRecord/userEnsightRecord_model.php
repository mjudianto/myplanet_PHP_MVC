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
  
  public function getUserRecord($ensightId, $userNik) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ensightId=:ensightId AND userNik=:userNik');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userNik', $userNik);
    return $this->db->single();
  }

  public function createUserRecord($ensightId, $userNik) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :ensightId, :userNik, default, default)');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userNik', $userNik);
    $this->db->execute();
  }

  public function updateUserRecordViews($ensightId, $userNik, $views) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:views WHERE ensightId=:ensightId AND userNik=:userNik');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('views', $views);
    $this->db->execute();
  }

}