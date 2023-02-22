<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class ElearningCourse_model {
  private $table = 'elearningCourse';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createCourse($kategoriId, $judul, $thumbnail, $time) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :kategoriId, :judul, :thumbnail, default, default, default, :time)');

    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('judul', $judul);
    $this->db->bind('thumbnail', $thumbnail);
    $this->db->bind('time', $time);

    $this->db->execute();
  }

}

$file = 'cleanElearningCourse.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanElearningCourse.csv', 'w');

$course = new ElearningCourse_model;

$data=[];
while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";
  // $row[1] = "delete";
  // $row[3] = "delete";
  // $row[4] = "delete";
  // $row[7] = "delete";
  // $row[9] = "delete";
  // $row[10] = "delete";
  // $row[11] = "delete";
  // $row[12] = "delete";
  // $row[13] = "delete";
  // $row[14] = "delete";
  // $row[15] = "delete";
  // $row[16] = "delete";
  // $row[17] = "delete";
  // fputcsv($outputFile, $row);
  $img = "https://myplanet.enseval.com/home/img/" . $row[3];
  $course->createCourse((int)$row[1], $row[2], $img, $row[0]);
}
echo ' /n success';

fclose($fp);


