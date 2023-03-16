<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class Ensight_model {
  private $table = 'ensight';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createEnsight($judul, $thumbnail, $video, $uploadDate) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :judul, default, :thumbnail, :video, default, :uploadDate, default, null)');

    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('video', $video);
    $this->db->bind('uploadDate', $uploadDate);

    $this->db->execute();
  }

  public function updateView($ensightId, $views) {
    $this->db->query('UPDATE ' . $this->table . ' SET views=:views WHERE ensightId=:ensightId');

    $this->db->bind('ensightId', $ensightId);
    $this->db->bind('views', $views);

    $this->db->execute();
  }

  public function createEnsightRecord($ensightId, $userNik, $lastVisit) {
    $this->db->query('select * from user where userNik=:userNik');
    $this->db->bind('userNik', $userNik);
    $data2 = $this->db->single() ?? null;

    if ($data2 != null){
      $this->db->query('SELECT * FROM userEnsightRecord WHERE ensightId=:ensightId AND userNik=:userNik');
      $this->db->bind('ensightId', $ensightId);
      $this->db->bind('userNik', $data2['userNik']);
      $data = $this->db->single() ?? null;

      if($data != null){
        $this->db->query('UPDATE userEnsightRecord SET views=:views, lastVisit=:lastVisit WHERE ensightId=:ensightId AND userNik=:userNik');
        $this->db->bind('ensightId', $ensightId);
        $this->db->bind('userNik', $data2['userNik']);
        $this->db->bind('views', $data['views']+1);
        $this->db->bind('lastVisit', $lastVisit);
        $this->db->execute();
      } else {
        $this->db->query('INSERT INTO userEnsightRecord VALUES(null, :ensightId, :userNik, 1, :lastVisit)');
        $this->db->bind('ensightId', $ensightId);
        $this->db->bind('userNik', $data2['userNik']);
        $this->db->bind('lastVisit', $lastVisit);
        $this->db->execute();
      }
    }
  }

}

$file = 'ensightView.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanEnsight.csv', 'w');

$ensight = new Ensight_model;

$data=[];
while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";
  // $row[1] = "delete";
  // $row[3] = "delete";
  // $row[2] = "delete";
  // $row[4] = "delete";
  // $row[5] = "delete";
  // $row[6] = "delete";
  // $row[7] = "delete";
  // $row[8] = "delete";
  // $row[9] = "delete";
  // $row[10] = "delete";
  // $row[11] = "delete";
  // fputcsv($outputFile, $row);
  // $thumbnail = 'https://myplanet.enseval.com/ensight/poster/' . $row[1] ?? null;
  // $video = 'https://myplanet.enseval.com/ensight/video/' . $row[2] ?? null;
  // $ensight->createEnsight($row[0], $thumbnail, $video, $row[3]);

  // $ensight->updateView((int)$row[0], $row[1]);

  $ensight->createEnsightRecord($row[1], $row[2], $row[4]);
}
echo ' /n success';

fclose($fp);


