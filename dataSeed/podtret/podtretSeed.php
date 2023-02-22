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

  public function createPodtret($id, $kategori, $judul, $thumbnail, $video, $audio, $uploadDate, $publishDate) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(:id, (SELECT podtretKategoriId from podtretKategori where nama=:kategori), :judul, :thumbnail, :video, :audio, default, :uploadDate, default, :publishDate)');

    $this->db->bind('id', $id);
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

  public function createPodtretRecord($podtretId, $nik, $lastVisit) {
    $this->db->query('select * from user where nik=:nik');
    $this->db->bind('nik', $nik);
    $data2 = $this->db->single() ?? null;

    if ($data2 != null){
      $this->db->query('SELECT * FROM userPodtretRecord WHERE podtretId=:podtretId AND userId=:userId');
      $this->db->bind('podtretId', $podtretId);
      $this->db->bind('userId', $data2['userId']);
      $data = $this->db->single() ?? null;

      if($data != null){
        $this->db->query('UPDATE userPodtretRecord SET views=:views, lastVisit=:lastVisit WHERE podtretId=:podtretId AND userId=:userId');
        $this->db->bind('podtretId', $podtretId);
        $this->db->bind('userId', $data2['userId']);
        $this->db->bind('views', $data['views']+1);
        $this->db->bind('lastVisit', $lastVisit);
        $this->db->execute();
      } else {
        $this->db->query('INSERT INTO userPodtretRecord VALUES(null, :podtretId, :userId, 1, :lastVisit)');
        $this->db->bind('podtretId', $podtretId);
        $this->db->bind('userId', $data2['userId']);
        $this->db->bind('lastVisit', $lastVisit);
        $this->db->execute();
      }
    }
  }

  public function createPodtretLike($podtretId, $nik, $likeState) {
    $this->db->query('SELECT * FROM podtret WHERE podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    $data = $this->db->single() ?? null;

    $this->db->query('select * from user where nik=:nik');
    $this->db->bind('nik', $nik);
    $data2 = $this->db->single() ?? null;

    if ($data != null && $data2 != null) {
      $this->db->query('INSERT INTO podtretLike VALUES(null, :podtretId, (select userId from user where nik=:nik), :likeState)');
      $this->db->bind('podtretId', $podtretId);
      $this->db->bind('nik', $nik);
      $this->db->bind('likeState', $likeState);
      $this->db->execute();
    }
  }

  public function createPodtretComment($id, $podtretId, $nik, $comment, $uploadDate) {
    $this->db->query('SELECT * FROM podtret WHERE podtretId=:podtretId');
    $this->db->bind('podtretId', $podtretId);
    $data = $this->db->single() ?? null;

    $this->db->query('select * from user where nik=:nik');
    $this->db->bind('nik', $nik);
    $data2 = $this->db->single() ?? null;

    if ($data != null && $data2 != null) {
      $this->db->query('INSERT INTO podtretComment VALUES(:id, :podtretId, (select userId from user where nik=:nik), :comment, :uploadDate)');
      $this->db->bind('id', $id);
      $this->db->bind('podtretId', $podtretId);
      $this->db->bind('nik', $nik);
      $this->db->bind('comment', $comment);
      $this->db->bind('uploadDate', $uploadDate);
      $this->db->execute();
    }
  }

  public function createCommentReply($commentId, $nik, $comment, $uploadDate) {
    $this->db->query('SELECT * FROM podtretComment WHERE podtretCommentId=:commentId');
    $this->db->bind('commentId', $commentId);
    $data = $this->db->single() ?? null;

    $this->db->query('select * from user where nik=:nik');
    $this->db->bind('nik', $nik);
    $data2 = $this->db->single() ?? null;

    if ($data != null && $data2 != null) {
      $this->db->query('INSERT INTO commentReply VALUES(null, :commentId, (select userId from user where nik=:nik), :comment, :uploadDate)');
      $this->db->bind('commentId', $commentId);
      $this->db->bind('nik', $nik);
      $this->db->bind('comment', $comment);
      $this->db->bind('uploadDate', $uploadDate);
      $this->db->execute();
    }
  }

}

$file = 'podtretView.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanPodtretComment.csv', 'w');

$podtret = new Podtret_model;

$data=[];
while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";
  // $row[3] = "delete";
  // $row[2] = "delete";
  // $row[4] = "delete";
  // $row[6] = "delete";
  // $row[7] = "delete";
  // $row[9] = "delete";
  // fputcsv($outputFile, $row);

  // $podtret->checkKategori($row[4]) ? "" : $podtret->createPodtretKategori($row[4]);

  // $thumbnail = "https://myplanet.enseval.com/podcast/poster/" . $row[2];
  // $video = "https://myplanet.enseval.com/podcast/video/" . $row[3];
  // $audio = "https://myplanet.enseval.com/podcast/audio/" . $row[4];
  // $row[6] = date('Y-m-d H:i:s', strtotime($row[6]));
  // $podtret->createPodtret((int)$row[0], $row[5], $row[1], $thumbnail, $video, $audio, $row[7], $row[6]);

  // $podtret->updatePodtretViews($row[0], $row[1]);

  $row[1] != "" ? $podtret->createPodtretRecord($row[1], $row[2], $row[4]) : "";

  // $podtret->createPodtretLike($row[0], $row[1], $row[2]);

  // if ($row[0] == $row[2]) {
  //   $podtret->createPodtretComment($row[0], $row[1], $row[3], $row[4], $row[5]);
  // }

  // if ($row[0] != $row[2]) {
  //   $podtret->createCommentReply($row[2], $row[3], $row[4], $row[5]);
  // }
}
echo ' /n success';

fclose($fp);


