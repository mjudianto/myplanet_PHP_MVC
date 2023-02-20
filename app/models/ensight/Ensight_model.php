<?php 

include_once '../app/core/Database.php';

class Ensight_model {
  private $table = 'ensight';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAll() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function getActiveEnsight() {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE state=1');
    return $this->db->resultSet();
  }

  public function getSpesificEnsigth($ensightId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ensightId=:ensightId');
    $this->db->bind('ensightId', $ensightId);
    return $this->db->single();
  }

  public function createEnsight($judul, $thumbnail, $video, $state, $deskripsi) {
    if ($state == 1) {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :judul, default, :thumbnail, :video, :deskripsi, default, :state, default)');
    } else {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :judul, default, :thumbnail, :video, :deskripsi, default, :state, null)');
    }
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('deskripsi', $deskripsi);
    $this->db->bind('video', $video);
    $this->db->bind('state', $state);
    $this->db->execute();
  }

  public function deleteEnsight($ensightId) {
    $this->db->query('UPDATE ' . $this->table . ' SET state=0 WHERE ensightId=:ensightId');
    $this->db->bind('ensightId', $ensightId);
    $this->db->execute();
  }

  public function updateEnsight($ensightId, $judul, $thumbnail, $video, $state ) {
    if ($state != 1) {
      $this->db->query('UPDATE ' . $this->table . ' SET judul=:judul, thumbnail=:thumbnail, video=:video, state=:state WHERE ensightId=:ensightId');
    } else {
      $this->db->query('UPDATE ' . $this->table . ' SET judul=:judul, thumbnail=:thumbnail, video=:video, state=:state, publishDate=default WHERE ensightId=:ensightId');
    }
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('video', $video);
    $this->db->bind('state', $state);
    $this->db->execute();
  }

  public function updateEnsightViews($ensightId, $views) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:views WHERE ensightId=:ensightId');
    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('views', $views);
    $this->db->execute();
  }

}