<?php

include_once '../app/core/Database.php';
// include_once '../app/core/Ldap.php';

class Ldap {

  private $connection;
  private $ldap_dn;
  private $ldap_pass;
  private $ldap_user;

  public function connect() {
    $this->ldap_dn = 'ENSEVAL' . "\\" . $this->ldap_user;

    $this->connection = ldap_connect("10.102.4.4");
    ldap_set_option($this->connection, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($this->connection, LDAP_OPT_REFERRALS, 0);;
  }

  public function getUserByUsername($username, $password) {
    $this->ldap_user = $username;
    $this->ldap_pass = $password;
    $this->connect();

    if ( !ldap_bind($this->connection, $this->ldap_dn, $this->ldap_pass) ) {
      return false;
    }

    $filter = "(sAMAccountName=" . $this->ldap_user . ")";
    $result = ldap_search($this->connection, "dc=ENSEVAL,dc=COM", $filter) or exit("Unable to search");
    $entry = ldap_get_entries($this->connection, $result);

    for ($i=0; $i<$entry["count"]; $i++) {
      $user_detail = [
          "nik" => $entry[$i]['employeenumber'][0],
          "username" => $entry[$i]['samaccountname'][0],
          "nama"  => $entry[$i]['displayname'][0],
          "email"  => $entry[$i]['userprincipalname'][0],
          "mobile"  => $entry[$i]['mobile'][0],
          "department"  => $entry[$i]['department'][0],
          "cabang"  => strtoupper($entry[$i]['physicaldeliveryofficename'][0]),
      ];
    }

    return $user_detail;
  }


}

class User_model{
  private $table = 'user';
  private $db;
  // private $ldap;

  public function __construct() {
    $this->db = new Database;
    // $this->ldap = new Ldap;
  }
  
  public function getAllUsers() {
    $this->db->query('SELECT * FROM ' . $this->table . 
    ' LEFT JOIN location ON ' . $this->table . '.locationId=location.locationId 
    LEFT JOIN organization ON ' . $this->table . '.organizationId=organization.organizationId');
    return $this->db->resultSet();
  }

  public function getUserBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . 
    ' LEFT JOIN location ON ' . $this->table . '.locationId=location.locationId
    LEFT JOIN organization ON ' . $this->table . '.organizationId=organization.organizationId 
    WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function addUserLdap($data) {
    $query = "INSERT INTO " . $this->table . 
    " VALUES (null, :nik, :pass, :nama, :telp, :email, 
    (SELECT organizationId from organization where organizationName=:orgname), 
    (SELECT locationId from location where locationName=:locationname), CURRENT_TIMESTAMP(), default)";
    $this->db->query($query);

    $this->db->bind('nik', $data['nik']);
    $this->db->bind('pass', sha1( $data['nik'] ));
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('telp', $data['mobile']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('orgname', $data['department']);
    $this->db->bind('locationname', $data['cabang']);

    $this->db->execute();
  }

  public function userAuth($nik, $password){
    $user = $this->getUserBy('nik', $nik);
    if ($user['password'] == sha1($password)) {
      return $user;
    }

    $ldap = new Ldap;
    $ldap = $ldap->getUserByUsername($nik, $password);
    if ($ldap != false) {
      $user = $this->getUserBy('nik', $ldap['nik']);
      if (!$user) {
        $this->addUserLdap($ldap);
        $user = $this->getUserBy('nik', $nik);
        return $user;
      }
      return $user;
    }


    return $user;
    
  }

  public function updateUserPassword($value){
    $query = "UPDATE " . $this->table . " SET password=:value where nik=:nik";
    $this->db->query($query);

    // $this->db->bind('column', $column);
    $this->db->bind('value', sha1($value));
    $this->db->bind('nik', $_SESSION['user']['nik']);


    $this->db->execute();
  }

  public function updateLastVisit($user) {
    $query = "UPDATE " . $this->table . " SET lastVisit=CURRENT_TIMESTAMP() where nik=:nik";
    $this->db->query($query);

    $this->db->bind('nik', $user['nik']);
    $this->db->execute();
  }

  public function addUser($data) {
    $query = "INSERT INTO " . $this->table . " VALUES (null, :nik, :pass, :nama, null, :email, :orgId, :locationId, CURRENT_TIMESTAMP(), default)";
    $this->db->query($query);

    $this->db->bind('nik', $data['nik']);
    $this->db->bind('pass', sha1( $data['nik'] ));
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('orgId', $data['department']);
    $this->db->bind('locationId', $data['locationId']);

    $this->db->execute();
  }

  public function countAllUser() {
    $this->db->query('select count(*) as "totalUser" from user');

    return $this->db->single();
  }

  public function countUserInOrganization($organizationId) {
    $this->db->query('select count(*) as "totalUser" from user where organizationId=:organizationId');

    $this->db->bind('organizationId', $organizationId);
    return $this->db->single();
  }

  

}