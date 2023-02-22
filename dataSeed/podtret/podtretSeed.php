<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class Podtret_model {
  private $table = 'podtret';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createPodtret($kategori, $judul, $thumbnail, $video, $audio, $uploadDate, $publishDate) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, (SELECT podtretKategoriId from podtretKategori where nama=:kategori), :judul, :thumbnail, :video, :audio, default, :uploadDate, default, :publishDate)');

    $this->db->bind('kategori', $kategori);
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('video', $video);
    $this->db->bind('audio', $audio);
    $this->db->bind('uploadDate', $uploadDate);
    $this->db->bind('publishDate', $publishDate);

    $this->db->execute();
  }

  public function createPodtretKategori($kategori) {
    $this->db->query('INSERT INTO podtretKategori VALUES(null, :kategori)');
    $this->db->bind('kategori', $kategori);
    $this->db->execute();
  }

  public function checkKategori($kategori) {
    $this->db->query('SELECT * FROM podtretKategori WHERE nama=:kategori');
    $this->db->bind('kategori', $kategori);
    return $this->db->single();
  }

  public function updatePodtretViews($podtretId, $views) {
    $this->db->query('SELECT * FROM podtret where podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    $data = $this->db->single() ?? null;

    if($data != null) {
      $this->db->query('UPDATE podtret SET views=:views where podtretId=:podtretId');
      $this->db->bind('views', $views);
      $this->db->bind('podtretId', $podtretId);
      $this->db->execute();
    }
    
  }

  public function createPodtretRecord() {
    
  }

}

$file = 'cleanPodtretViewTotal.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanPodtretViewTotal.csv', 'w');

$podtret = new Podtret_model;

$data=[];
while ($row = fgetcsv($fp)) {
  $row[2] = "delete";
  // $row[6] = "delete";
  // $row[7] = "delete";
  // $row[9] = "delete";
  // fputcsv($outputFile, $row);

  // $podtret->checkKategori($row[4]) ? "" : $podtret->createPodtretKategori($row[4]);

  // $thumbnail = "https://myplanet.enseval.com/podcast/poster/" . $row[1];
  // $video = "https://myplanet.enseval.com/podcast/video/" . $row[2];
  // $audio = "https://myplanet.enseval.com/podcast/audio/" . $row[3];
  // $row[5] = date('Y-m-d H:i:s', strtotime($row[5]));
  // $podtret->createPodtret($row[4], $row[0], $thumbnail, $video, $audio, $row[6], $row[5]);

  // $podtret->updatePodtretViews($row[0], $row[1]);
}
echo ' /n success';

fclose($fp);


