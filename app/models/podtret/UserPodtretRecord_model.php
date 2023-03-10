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
  
  public function createPodtretRecord($podtretId, $userNik) {
    $this->db->query('INSERT INTO ' . $this->table . 
                    ' VALUES (null, :podtretId, :userNik, default, default)');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userNik', $userNik);
    $this->db->execute();
  }

  public function updatePodtretRecord($podtretId, $userNik, $views){
    $this->db->query('UPDATE ' . $this->table . 
                    ' SET views=:views WHERE podtretId=:podtretId AND userNik=:userNik');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('views', $views);
    $this->db->execute();
  }

  public function checkUserRecord($podtretId, $userNik) {
    $this->db->query('SELECT * FROM ' . $this->table . 
                    ' WHERE podtretId=:podtretId AND userNik=:userNik');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('userNik', $userNik);
    return $this->db->single();
  }

  public function getUserCommentRecord() {
    $this->db->query('select user.nik, user.nama, podtretComment.comment, podtret.judul, podtretComment.uploadDate
                      from podtretComment 
                      left join podtret on podtretComment.podtretId = podtret.podtretId
                      left join user on podtretComment.userNik = user.userNik
                      order by podtretComment.uploadDate desc');
    return $this->db->resultSet();
  }

  public function getUserReplyRecord() {
    $this->db->query('select user.nik, user.nama, commentReply.comment, podtret.judul, commentReply.uploadDate
                      from commentReply
                      left join podtretComment on commentReply.podtretCommentId=podtretComment.podtretCommentId
                      left join podtret on podtretComment.podtretId = podtret.podtretId
                      left join user on commentReply.userNik = user.userNik
                      order by commentReply.uploadDate desc');
    return $this->db->resultSet();
  }



}