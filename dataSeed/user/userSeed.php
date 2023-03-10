<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

function timerStart() {
  $start_time = microtime(true);
  return $start_time;
}

function timerEnd($start_time) {
  $end_time = microtime(true);

  $execution_time = $end_time - $start_time;
  echo "Program successfully executed in " . number_format($execution_time, 2) . " seconds.";
}



class Company_model {
  private $table = 'company';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function checkCompanyExist($companyName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE companyName=:companyName');
    $this->db->bind('companyName', $companyName);
    $company = $this->db->single();

    if (!is_bool($company)) {
      return $company['companyId'];
    } else {
      return null;
    }
  }

  public function createCompany($companyName) {
    if ($this->checkCompanyExist($companyName) == null) {
      $this->db->query('INSERT INTO ' . $this->table . ' VALUES(null, :companyName)');
      $this->db->bind('companyName', $companyName);
      $this->db->execute();
    } else {
      return false;
    }
  }
}

function companySeed() {
  $start_time = timerStart();

  $file = 'HRIS_user.csv';
  $fp = fopen($file, 'r', 'UTF-8');
  $companyModel = new Company_model;

  while ($row = fgetcsv($fp)) {
    $organization = explode('-', $row[3]);
    count($organization) > 1 ? $company = $organization[0] : $company = null;
    // echo count($organization);

    if ($company != null) {
      $companyModel->createCompany($company);
    }
  }

  fclose($fp);

  timerEnd($start_time);
}



class Location_model {
  private $table = 'location';
  private $db;
  private $company;

  public function __construct() {
    $this->db = new Database;
    $this->company = new Company_model;
  }

  private function checkLocationExist($locationName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE locationName=:locationName');
    $this->db->bind('locationName', $locationName);
    $location = $this->db->single();

    if (!is_bool($location)) {
      return $location['locationName'];
    } else {
      return null;
    }
  }

  public function createLocation($locationName, $companyName) {
    $companyId = $this->company->checkCompanyExist($companyName);

    if ($this->checkLocationExist($locationName) !== null) {
      return false;
    }
    
    $sql = 'INSERT INTO ' . $this->table . ' VALUES(null, :locationName, :companyId)';
    $params = array('locationName' => $locationName);
    
    if ($companyId === null) {
      $params['companyId'] = null;
    } else {
      $params['companyId'] = $companyId;
    }

    $this->db->query($sql);

    $this->db->bind('locationName', $params['locationName']);
    $this->db->bind('companyId', $params['companyId']);

    $this->db->execute();
  }

}

function locationSeed() {
  $start_time = timerStart();

  $file = 'HRIS_user.csv';
  $fp = fopen($file, 'r', 'UTF-8');
  $locationModel = new Location_model;

  while ($row = fgetcsv($fp)) {
    $location = explode('-', $row[3]);
    if (count($location) > 1) {
      $companyName = $location[0];
      $locationName = trim($location[1]);
    } else {
      $companyName = null;
      $locationName = trim($location[0]);
    }

    if ($location != null) {
      $locationModel->createLocation($locationName, $companyName);
    }
  }

  fclose($fp);

  timerEnd($start_time);
}



class Organization_model {
  private $table = 'organization';
  private $db;
  private $company;

  public function __construct() {
    $this->db = new Database;
    $this->company = new Company_model;
  }

  private function checkorganizationExist($organizationName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE organizationName=:organizationName');
    $this->db->bind('organizationName', $organizationName);
    $organization = $this->db->single();

    if (!is_bool($organization)) {
      return $organization['organizationId'];
    } else {
      return null;
    }
  }

  public function createorganization($organizationName, $companyName) {
    $companyId = $this->company->checkCompanyExist($companyName);

    if ($this->checkorganizationExist($organizationName) !== null) {
      return false;
    }
    
    $sql = 'INSERT INTO ' . $this->table . ' VALUES(null, :organizationName, :companyId)';
    $params = array('organizationName' => $organizationName);
    
    if ($companyId === null) {
      $params['companyId'] = null;
    } else {
      $params['companyId'] = $companyId;
    }

    $this->db->query($sql);

    $this->db->bind('organizationName', $params['organizationName']);
    $this->db->bind('companyId', $params['companyId']);

    $this->db->execute();
  }
}

function organizationSeed() {
  $start_time = timerStart();

  $file = 'HRIS_user.csv';
  $fp = fopen($file, 'r', 'UTF-8');
  $organizationModel = new Organization_model;

  while ($row = fgetcsv($fp)) {
    $location = explode('-', $row[3]);
    if (count($location) > 1) {
      $locationName = trim($location[1]);
    } else {
      $locationName = trim($location[0]);
    }

    $organization = explode('-', $row[4]);
    if (count($organization) > 1) {
      $companyName = $organization[0];
      $organizationName = trim($organization[1]);
    } else {
      $companyName = null;
      $organizationName = trim($organization[0]);
    }

    $organizationName = trim(str_replace($locationName, '', $organizationName));


    if ($organization != null) {
      if (strpos($organizationName, "@") === false) {
        $organizationModel->createOrganization($organizationName, $companyName);
      }
    }
  }

  fclose($fp);

  timerEnd($start_time);
}



class Job_model {
  private $table = 'job';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  private function checkJobExist($jobName) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE jobName=:jobName');
    $this->db->bind('jobName', $jobName);
    $job = $this->db->single();

    if (!is_bool($job)) {
      return $job['jobId'];
    } else {
      return null;
    }
  }

  public function createJob($jobName) {
    if ($this->checkJobExist($jobName) !== null) {
      return false;
    }
    
    $sql = 'INSERT INTO ' . $this->table . ' VALUES(null, :jobName)';
    $params = array('jobName' => $jobName);

    $this->db->query($sql);

    $this->db->bind('jobName', $params['jobName']);

    $this->db->execute();
  }
}

function jobSeed() {
  $start_time = timerStart();

  $file = 'job.csv';
  $fp = fopen($file, 'r', 'UTF-8');
  $jobModel = new job_model;

  while ($row = fgetcsv($fp)) {

    $jobName = $row[0];

    if ($jobName != null) {
      $jobModel->createJob($jobName);
    }
  }

  fclose($fp);

  timerEnd($start_time);
}



class User_model {
  private $table = 'user';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  private function checkuserExist($userNik) {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE userNik=:userNik');
    $this->db->bind('userNik', $userNik);
    $user = $this->db->single();

    if (!is_bool($user)) {
      return $user['userNik'];
    } else {
      return null;
    }
  }

  public function createuser($userNik, $nama, $password, $createdDate) {
    if ($this->checkuserExist($userNik) !== null) {
      return false;
    }
    
    $sql = 'INSERT INTO ' . $this->table . ' VALUES(:userNik, :nama, :password, null, default, default, :createdDate)';

    $this->db->query($sql);

    $this->db->bind('userNik', $userNik);
    $this->db->bind('nama', $nama);
    $this->db->bind('password', sha1($password));
    $this->db->bind('createdDate', $createdDate);

    $this->db->execute();
  }
}

function userSeed() {
  $start_time = timerStart();

  $file = 'cleanUser.csv';
  $fp = fopen($file, 'r', 'UTF-8');
  $userModel = new User_model;

  while ($row = fgetcsv($fp)) {

    $userNik = $row[0];
    $password = $row[1];
    $nama = $row[2];
    $createdDate = $row[6];

    if ($userNik != null) {
      $userModel->createUser($userNik, $nama, $password, $createdDate);
    }
  }

  fclose($fp);

  timerEnd($start_time);
}

// companySeed();
// locationSeed();
// organizationSeed();
// jobSeed();
userSeed();



