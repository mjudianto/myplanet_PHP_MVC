<?php 

include_once '../app/core/Database.php';

class PodtretComment_model {
  private $table = 'podtretComment';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createComment($podtretId, $userNik, $comment) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :podtretId, :userNik, :comment, DEFAULT)');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('comment', $comment);
    $this->db->execute();
  }

  public function getAllComment($podtretId) {
    $this->db->query('SELECT podtretComment.podtretCommentId, podtretComment.comment, podtretComment.uploadDate, user.nama
        FROM ' . $this->table . ' 
        LEFT JOIN user 
        ON ' . $this->table . '.userNik = user.userNik
        WHERE podtretId=:podtretId 
        ORDER BY ' . $this->table . '.uploadDate DESC');

    $this->db->bind('podtretId', $podtretId);
    return $this->db->resultSet();
  }

}