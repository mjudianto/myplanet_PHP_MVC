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
                      order by userPodtretRecord.views asc');
    $this->db->bind('podtretId', $podtretId);
    return $this->db->resultSet();
  }

}