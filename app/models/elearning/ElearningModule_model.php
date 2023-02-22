<?php 

include_once '../app/core/Database.php';

class ElearningModule_model {
  private $table = 'elearningModule';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllModule() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getSpesificModule($moduleId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningModuleId=:moduleId and state=1');
    $this->db->bind('moduleId', $moduleId);
    return $this->db->resultSet();
  }

  public function getModuleBy($courseId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningCourseId=:courseId and state=1');
    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }

  public function createNewModule($courseId, $judul) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :courseId, :judul, default)');
    $this->db->bind('courseId', $courseId);
    $this->db->bind('judul', $judul);
    $this->db->execute();
  }

  public function updateModule($judul, $moduleId) {
    $this->db->query('UPDATE ' . $this->table . ' SET judul=:judul WHERE elearningModuleId=:moduleId');
    $this->db->bind('judul', $judul);
    $this->db->bind('moduleId', $moduleId);
    $this->db->execute();
  }

  public function deleteModule($moduleId) {
    $this->db->query('UPDATE ' . $this->table . ' SET state=0 WHERE (elearningModuleId = :moduleId)');
    $this->db->bind('moduleId', $moduleId);
    $this->db->execute();
  }

}