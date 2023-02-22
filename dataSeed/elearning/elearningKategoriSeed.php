<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class ElearningKategori_model {
  private $table = 'elearningKategori';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createKategori($kategoriName, $time) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :kategoriName, default, :time)');

    $this->db->bind('kategoriName', $kategoriName);
    $this->db->bind('time', $time);

    $this->db->execute();
  }

}

$file = 'elearningKategori.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanUser.csv', 'w');

$kategori = new ElearningKategori_model;

while ($row = fgetcsv($fp)) {
  $kategori->createKategori($row[0], $row[1]);
}
echo ' /n success';

fclose($fp);


