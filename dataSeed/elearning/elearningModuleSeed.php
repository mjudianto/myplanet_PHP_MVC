<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class ElearningModule_model {
  private $table = 'elearningModule';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createModule($id, $courseId, $judul) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(:id, :courseId, :judul, default)');

    $this->db->bind('id', $id);
    $this->db->bind('courseId', $courseId);
    $this->db->bind('judul', $judul);

    $this->db->execute();
  }

}

$file = 'cleanElearningModule.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');

$module = new ElearningModule_model;

while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";  
  // $row[1] = "delete";  
  // $row[2] = "delete";  
  // $row[5] = "delete";  
  // fputcsv($outputFile, $row);


  $module->createModule($row[0], $row[2], $row[1]);
}
echo ' /n success';

fclose($fp);


