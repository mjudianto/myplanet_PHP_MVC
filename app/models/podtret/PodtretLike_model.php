<?php 

include_once '../app/core/Database.php';

class PodtretLike_model {
  private $table = 'podtretLike';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createLike($podtretId, $userNik) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :podtretId, :userNik, DEFAULT)');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userNik', $userNik);
    $this->db->execute();
  }

  public function checkUserLike($column, $column2, $value, $value2) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ' . $column . '=:value AND ' . $column2 . '=:value2');
    $this->db->bind('value', $value);
    $this->db->bind('value2', $value2);
    return $this->db->single();
  }

  public function updateLike($column, $value, $newLike) {
    $this->db->query('UPDATE ' . $this->table . ' SET likeState=:newLike WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    $this->db->bind('newLike', $newLike);
    $this->db->execute();
  }

  public function countLike($podtretId, $state) {
    $this->db->query('SELECT COUNT(podtretLikeId) as "likes" FROM ' . $this->table . ' WHERE podtretId=:podtretId AND likeState=:state');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('state', $state);
    return $this->db->single();
  }

}