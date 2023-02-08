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

  public function getUserCommentRecord() {
    $this->db->query('select user.nik, user.nama, podtretComment.comment, podtret.judul, podtretComment.uploadDate
                      from podtretComment 
                      left join podtret on podtretComment.podtretId = podtret.podtretId
                      left join user on podtretComment.userId = user.userId
                      order by podtretComment.uploadDate desc');
    return $this->db->resultSet();
  }

  public function getUserReplyRecord() {
    $this->db->query('select user.nik, user.nama, commentReply.comment, podtret.judul, commentReply.uploadDate
                      from commentReply
                      left join podtretComment on commentReply.podtretCommentId=podtretComment.podtretCommentId
                      left join podtret on podtretComment.podtretId = podtret.podtretId
                      left join user on commentReply.userId = user.userId
                      order by commentReply.uploadDate desc');
    return $this->db->resultSet();
  }



}