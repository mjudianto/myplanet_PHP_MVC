<?php 

include_once '../app/core/Database.php';

class PodtretCommentReply_model {
  private $table = 'commentReply';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createComment($podtreCommentId, $userNik, $comment) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :podtreCommentId, :userNik, :comment, default)');
    $this->db->bind('podtreCommentId', $podtreCommentId);
    $this->db->bind('userNik', $userNik);
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
        ON ' . $this->table . '.userNik = user.userNik
        WHERE ' . $this->table . '.' . $column . '=:value 
        ORDER BY ' . $this->table . '.uploadDate ASC');

    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

}