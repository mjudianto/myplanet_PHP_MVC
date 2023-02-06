<?php 

include_once '../app/core/Database.php';

class UserElearningCourseAkses_Model {
  private $table = 'userElearningCourseAkses';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function createUserPermission($courseId, $userId) {
    $query = ('INSERT INTO ' . $this->table . ' VALUES(null, :courseId, :userId)');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    $this->db->bind('userId', $userId);
    $this->db->execute();
  }

}