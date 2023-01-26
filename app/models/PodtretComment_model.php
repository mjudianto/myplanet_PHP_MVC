<?php 

include_once '../app/core/Database.php';

class PodtretComment_model {
  private $table = 'podtretComment';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createComment($podtretId, $userId, $comment) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :podtretId, :userId, :comment, DEFAULT)');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userId', $userId);
    $this->db->bind('comment', $comment);
    $this->db->execute();
  }

  public function getAllComment($column, $value) {
    $this->db->query('SELECT podtretComment.podtretCommentId, podtretComment.comment, podtretComment.uploadDate, user.nama 
        FROM ' . $this->table . ' 
        LEFT JOIN user 
        ON ' . $this->table . '.userId = user.userId
        WHERE ' . $column . '=:value 
        ORDER BY ' . $this->table . '.uploadDate DESC');

    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}