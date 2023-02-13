<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class User_model {
  private $table = 'user';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createUser($nik, $pass, $nama, $email, $orgName, $locName, $time) {
    $this->db->query('INSERT INTO ' . $this->table . ' 
    VALUES(null, :nik, :pass, :nama, null, :email, 
    (select organizationId from organization where organizationName=:orgName), 
    (select locationId from location where locationName=:locName), :time, default)');

    $this->db->bind('nik', $nik);
    $this->db->bind('pass', $pass);
    $this->db->bind('nama', $nama);
    $this->db->bind('email', $email);
    $this->db->bind('orgName', $orgName);
    $this->db->bind('locName', $locName);
    $this->db->bind('time', $time);

    $this->db->execute();
  }

}

$file = 'user.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');

// Read the contents of the file into an array
$data = [];
while ($row = fgetcsv($fp)) {
    $data[] = $row;
}

// Close the file
fclose($fp);

$userModel = new User_model;

foreach($data as $d) {
  $userModel->createUser($d[0], $d[1], $d[2], $d[3], $d[4], $d[5], $d[6]);
}

echo 'success';