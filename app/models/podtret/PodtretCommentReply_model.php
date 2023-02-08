<?php 

include_once '../app/core/Database.php';

class PodtretCommentReply_model {
  private $table = 'commentReply';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createComment($podtreCommentId, $userId, $comment) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :podtreCommentId, :userId :comment, DEFAULT)');
    $this->db->bind('podtreCommentId', $podtreCommentId);
    $this->db->bind('userId', $userId);
    $this->db->bind('comment', $comment);
    $this->db->execute();
  }

  public function getAllComment($column, $value) {
    $this->db->query('SELECT 
        commentReply.comment, commentReply.uploadDate, user.nama
        FROM ' . $this->table . ' 
        LEFT JOIN podtretComment 
        ON ' . $this->table . '.podtretCommentId = podtretComment.podtretCommentId
        LEFT JOIN user 
        ON podtretComment.userId = user.userId
        WHERE ' . $this->table . '.' . $column . '=:value 
        ORDER BY ' . $this->table . '.uploadDate ASC');

    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}