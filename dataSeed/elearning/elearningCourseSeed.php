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

  public function createDummy($modName, $folderId) {
    $this->db->query('INSERT INTO dummysop VALUES(null, :modName, :folderId)');
    $this->db->bind('modName', $modName);
    $this->db->bind('folderId', $folderId);
    $this->db->execute();
  }

  public function createSopAkses($userNik, $folderId) {
    $this->db->query('SELECT * from user where userNik=' . $userNik);
    $user = $this->db->single();
    // return $user;

    if (!is_bool($user)) {
      $this->db->query('SELECT * from dummysop where folderId=' . $folderId);
      $sop = $this->db->single();
      // return $sop;

      if (!is_bool($sop)) {
        $moduleName = $sop['moduleName'];
        $this->db->query('SELECT * from elearningModule where judul=:moduleName');
        $this->db->bind('moduleName', $moduleName);
        $module = $this->db->single();
        // return $module;

        if (!is_bool($module)) {
          $userNik = $user['userNik'];
          $moduleId = $module['elearningModuleId'];
          $this->db->query('INSERT INTO userModuleAkses VALUES(null, :userNik, :moduleId)');
          $this->db->bind('userNik', $userNik);
          $this->db->bind('moduleId', $moduleId);
          $this->db->execute();
        }

      }
    } else {
      return;
    }

  }

}

$start_time = microtime(true);

$file = 'sopikAkses.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleansopikAkses.csv', 'w');

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
  // $img = "https://myplanet.enseval.com/home/img/" . $row[3];
  // $course->createCourse((int)$row[1], $row[2], $img, $row[0]);

  // $row[5] != 0 ? $course->createDummy($row[3], $row[5]) : "";

  $course->createSopAkses($row[2], $row[5]);
  // print_r($sop);
}

echo 'success !! ';
$end_time = microtime(true);

$execution_time = $end_time - $start_time;
echo "Program executed in " . number_format($execution_time, 2) . " seconds.";

fclose($fp);


