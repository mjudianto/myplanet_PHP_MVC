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
    return $this->db->single();
  }

  public function setOrganization($orgName) {
   $organization = $this->getOrganizationId($orgName);
   is_bool($organization) ?  $this->db->query("insert into organization values(null, :orgName)") : '';

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

  public function getAllUser() {
    $this->db->query("select * from user");
    return $this->db->resultSet();
  }

  public function createUser($nik, $pass, $nama, $email, $deptId, $locId, $time) {
    $this->db->query('INSERT INTO ' . $this->table . ' 
    VALUES(null, :nik, :pass, :nama, null, :email, :deptId, :locId, null, default, default, :time)');

    $this->db->bind('nik', $nik);
    $this->db->bind('pass', $pass);
    $this->db->bind('nama', $nama);
    $this->db->bind('email', $email);
    $this->db->bind('deptId', $deptId);
    $this->db->bind('locId', $locId);
    $this->db->bind('time', $time);

    $this->db->execute();
  }

  public function setDepartment($departmentName) {
    $department = $this->checkDepartment($departmentName) ?? null;

    $department == null ? $this->db->query('INSERT INTO department VALUES(null, :departmentName, null)') : '';

    $this->db->bind('departmentName', $departmentName);
    $this->db->execute();
  }

  public function checkDepartment($departmentName) {
    $this->db->query('SELECT * FROM department WHERE departmentName=:departmentName');

    $this->db->bind('departmentName', $departmentName);
    return $this->db->single();
  }

  public function updateUserOrganization($nik, $departmentName) {
    $department = $this->checkDepartment($departmentName);

    if (!is_bool($department)) {
      $this->db->query('UPDATE user SET departmentId=(select departmentId from department where departmentName=:departmentName) WHERE nik=:nik');
      $this->db->bind('departmentName', $departmentName);
      $this->db->bind('nik', $nik);
      $this->db->execute();
    }
    
  }

  public function setDepartmentOrganization($orgName, $departmentName) {
    $organization = $this->getOrganizationId($orgName);
    $department = $this->checkDepartment($departmentName);
    !is_bool($organization) && !is_bool($department) ?  $this->db->query("update department set organizationId=" . $organization['organizationId'] . ' where departmentId=' . $department['departmentId']) : '';
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

// $user = $userModel->getAllUser();

// foreach($user as $u) {
//   $userModel->updateUserOrganization($u['userId'], $u['departmentId']);
// }
// $data = [];

while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";
  // $row[1] = "delete";
  // $row[5] = "delete";
  // fputcsv($outputFile, $row);
  
  // $orgName[] = $row[4];
  // $locName[] = $row[5];

  // $row[4] != 'null' &&  $row[4] != '' ? (isset(explode('-', $row[4])[1]) ? $userModel->setDepartment(explode('-', $row[4])[1]) : $userModel->setDepartment(explode('-', $row[4])[0])) : "";
  // $row[4] != 'null' &&  $row[4] != '' ? (isset(explode('-', $row[4])[0]) ? $userModel->setOrganization(explode('-', $row[4])[0]) : "") : "";
  // $row[4] != 'null' &&  $row[4] != '' ? $organization=explode('-', $row[4]) : $organization = "";
  // $organization != "" ?  (isset($organization[0]) && isset($organization[1]) ? $userModel->setDepartmentOrganization($organization[0], $organization[1]) : "") : "";
  
  // $row[4] != 'null' &&  $row[4] != '' ? (isset(explode('-', $row[4])[1]) ? $dept = $userModel->checkDepartment(explode('-', $row[4])[1]) : $dept =  $userModel->checkDepartment(explode('-', $row[4])[0])) : "";
  // $locId = $userModel->getLocationId($row[5]) ?? "";
  // $userModel->createUser($row[0], sha1($row[1]), $row[2], $row[3], $dept['departmentId'], $locId, $row[6]);

  // $row[4] != 'null' &&  $row[4] != '' ? (isset(explode('-', $row[4])[1]) ? $userModel->updateUserOrganization($row[0], explode('-', $row[4])[1]) : "") : "";

  // $userModel->updateUserOrganization($row[0], );
}

// print_r(($data));

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


