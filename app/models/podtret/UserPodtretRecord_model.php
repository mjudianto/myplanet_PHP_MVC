<?php 

include_once '../app/core/Database.php';

class UserPodtretRecord_model {
  private $table = 'userPodtretRecord';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getPodtretRecord($podtretId) {
    $this->db->query('SELECT * FROM ' . $this->table . 
                    ' WHERE podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    return $this->db->single();
  }
  
  public function createPodtretRecord($podtretId, $userId) {
    $this->db->query('INSERT INTO ' . $this->table . 
                    ' VALUES (null, :podtretId, :userId, default, default)');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userId', $userId);
    $this->db->execute();
  }

  public function updatePodtretRecord($podtretId, $userId, $views){
    $this->db->query('UPDATE ' . $this->table . 
                    ' SET views=:views WHERE podtretId=:podtretId AND userId=:userId');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userId', $userId);
    $this->db->bind('views', $views);
    $this->db->execute();
  }

  public function checkUserRecord($podtretId, $userId) {
    $this->db->query('SELECT * FROM ' . $this->table . 
                    ' WHERE podtretId=:podtretId AND userId=:userId');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userId', $userId);
    return $this->db->single();
  }

}