<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class Organization_model {
  private $table = 'organization';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllOrganization() {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }

  public function createOrganization($orgName) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(NULL, :orgName)');
    $this->db->bind('orgName', $orgName);
    $this->db->execute();
  }

}

class organizationSeed {

  public function dataSeed() {
    $model = new Organization_model;
    $file = fopen('organization.csv', 'r', 'UTF-8');

    while (($data = fgetcsv($file)) !== false) {
      // $data is an array that contains a row of data from the CSV file
      // you can access the values using indices (e.g., $data[0] for the first column)
      // or by header names (if you have header row in your CSV file)

      // perform any processing or operations with the data
      foreach($data as $d) {
        $model->createOrganization($d);
        // echo $d;
      }
    }

    fclose($file);
  }
}

$orgSeed = new organizationSeed;
$orgSeed->dataSeed();

?>