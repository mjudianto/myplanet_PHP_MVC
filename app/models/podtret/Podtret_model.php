<?php 

include_once '../app/core/Database.php';

class Podtret_model {
  private $table = 'podtret';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAll() {
    $this->db->query('SELECT * FROM ' . $this->table . ' LEFT JOIN podtretKategori ON ' . $this->table . '.podtretKategoriId = podtretKategori.podtretKategoriId
                      ORDER BY ' . $this->table . '.uploadDate DESC');
    return $this->db->resultSet();
  }

  public function getAllActivePodtret() {
    $this->db->query('SELECT * FROM ' . $this->table . ' LEFT JOIN podtretKategori ON ' . $this->table . '.podtretKategoriId = podtretKategori.podtretKategoriId WHERE state=1
                      ORDER BY ' . $this->table . '.uploadDate DESC');
    return $this->db->resultSet();
  }

  public function getPodtretBy($podtretId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    return $this->db->single();
  }

  public function filterPodtret($podtretKategoriId) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE podtretKategoriId=:podtretKategoriId');
    $this->db->bind('podtretKategoriId', $podtretKategoriId);
    return $this->db->resultSet();
  }

  public function updatePodtretViews($podtretId, $newViews) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:newViews WHERE podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('newViews', $newViews);
    $this->db->execute();
  }

  public function getPodtretDetail($podtretId) {
    $this->db->query('select podtret.judul, podtret.thumbnail as "thumbnail", user.nama, userPodtretRecord.views as "visit", userPodtretRecord.lastVisit as "lastVisit"
                      from podtret
                      right join userPodtretRecord on podtret.podtretId = userPodtretRecord.podtretId
                      join user on userPodtretRecord.userId = user.userId
                      where podtret.podtretId=:podtretId
                      order by userPodtretRecord.lastVisit desc');
    $this->db->bind('podtretId', $podtretId);
    return $this->db->resultSet();
  }

  public function newPodtret($kategoriId, $judul, $thumbnail, $video, $audio, $state) {
    if ($state == 1){
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :kategoriId, :judul, :thumbnail, :video, :audio, default, default, :state, default)');
    } else {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :kategoriId, :judul, :thumbnail, :video, :audio, default, default, :state, null)');
    }
    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('video', $video);
    $this->db->bind('audio', $audio);
    $this->db->bind('state', $state);
    $this->db->execute();
  }

  public function updatePodtret($podtretId, $kategoriId, $judul, $thumbnail, $video, $audio, $state) {
    if ($state == 1){
      $this->db->query('UPDATE ' . $this->table . ' SET podtretKategoriId=:kategoriId, judul=:judul, thumbnail=:thumbnail, video=:video, audio=:audio, state=:state, publishDate=default WHERE podtretId=:podtretId');
    } else {  
      $this->db->query('UPDATE ' . $this->table . ' SET podtretKategoriId=:kategoriId, judul=:judul, thumbnail=:thumbnail, video=:video, audio=:audio, state=:state, publishDate=null WHERE podtretId=:podtretId');
    }
    $this->db->bind('podtretId', $podtretId);
    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('video', $video);
    $this->db->bind('audio', $audio);
    $this->db->bind('state', $state);
    $this->db->execute();
  }

}