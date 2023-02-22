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

  public function getOrganizationId($orgName) {
    $this->db->query("select organizationId from organization where organizationName=:orgName");
    $this->db->bind('orgName', $orgName);
    $data = $this->db->single();
    return $data['organizationId'];
  }

  public function setOrganization($orgName) {
    $this->db->query("insert into organization values(null, :orgName)");
    $this->db->bind('orgName', $orgName);
    $this->db->execute();
  }

  public function getLocationId($locName) {
    $this->db->query("select locationId from location where locationName=:locName");
    $this->db->bind('locName', $locName);
    $data = $this->db->single();
    return $data['locationId'];
  }

  public function setLocation($locName) {
    $this->db->query("insert into location values(null, :locName)");
    $this->db->bind('locName', $locName);
    $this->db->execute();
  }

  public function createUser($nik, $pass, $nama, $email, $orgId, $locId, $time) {
    $this->db->query('INSERT INTO ' . $this->table . ' 
    VALUES(null, :nik, :pass, :nama, null, :email, :orgId, :locId, null, default, default, :time)');

    $this->db->bind('nik', $nik);
    $this->db->bind('pass', $pass);
    $this->db->bind('nama', $nama);
    $this->db->bind('email', $email);
    $this->db->bind('orgId', $orgId);
    $this->db->bind('locId', $locId);
    $this->db->bind('time', $time);

    $this->db->execute();
  }

}

$file = 'cleanUser.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanUser.csv', 'w');

$userModel = new User_model;



// Read the contents of the file into an array
$data = [];

// $orgId = [];
// $orgName = [];

// $locName = [];
// $locId = [];

while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";
  // $row[1] = "delete";
  // $row[5] = "delete";
  // fputcsv($outputFile, $row);
  
  // $orgName[] = $row[4];
  // $locName[] = $row[5];

  $orgId = $userModel->getOrganizationId($row[4] ?? null);
  $locId = $userModel->getLocationId($row[5] ?? null);
  $userModel->createUser($row[0], sha1($row[1]), $row[2], $row[3], $orgId, $locId, $row[6]);
}

// $uniqeOrg = (array_unique($orgName));
// foreach ($uniqeOrg as $orgName) {
//   $userModel->setOrganization($orgName);
// }

// $uniqueLoc = (array_unique($locName));
// foreach ($uniqueLoc as $locName) {
//   $userModel->setLocation($locName);
// }

// print_r($locId);
echo ' /n success';

// print_r($data);


// Close the file
fclose($fp);


