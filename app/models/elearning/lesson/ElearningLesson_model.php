<?php 

include_once '../app/core/Database.php';

class ElearningLesson_model {
  private $table = 'elearningLesson';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getSpesificLesson($value) {
    $this->db->query('SELECT * FROM ' . $this->table . '
    left join elearningLessonKonten on elearningLesson.elearningLessonKontenId=elearningLessonKonten.elearningLessonKontenId
    WHERE elearningLessonId=:value'); 
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function getLessonBy($value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE elearningModuleId=:value');
    $this->db->bind('value', $value);
    return $this->db->resultSet();
  }

  public function addLessonKonten($konten) {
    $this->db->query('INSERT INTO elearningLessonKonten VALUES(null, :konten)');
    $this->db->bind('konten', $konten);
    $this->db->execute();
  }

  public function addLesson($moduleId, $judul, $konten) {
    $this->addLessonKonten($konten);

    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :moduleId, :judul, (SELECT elearningLessonKontenId from elearningLessonKonten where konten=:konten), default, default)');
    $this->db->bind('moduleId', $moduleId);
    $this->db->bind('judul', $judul);
    $this->db->bind('konten', $konten);
    $this->db->execute();
  }

  

}