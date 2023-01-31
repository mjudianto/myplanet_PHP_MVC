<?php 

include_once '../app/core/Database.php';
include_once '../app/core/Ldap.php';

class User_model{
  private $table = 'user';
  private $db;
  private $ldap;

  public function __construct() {
    $this->db = new Database;
    $this->ldap = new Ldap;
  }
  
  public function getAllUsers() {
    $this->db->query('SELECT * FROM ' . $this->table . ' LEFT JOIN location ON ' . $this->table . '.locationId=location.locationId');
    return $this->db->resultSet();
  }

  public function getUserBy($column, $value) {
    $this->db->query('SELECT * FROM ' . $this->table . ' LEFT JOIN location ON ' . $this->table . '.locationId=location.locationId WHERE ' . $column . '=:value');
    $this->db->bind('value', $value);
    return $this->db->single();
  }

  public function addUserLdap($data) {
    $query = "INSERT INTO " . $this->table . " VALUES (null, :nik, :pass, :nama,, :telp, :akses, :email, :orgname, :locationname, CURRENT_TIMESTAMP())";
    $this->db->query($query);

    $this->db->bind('nik', $data['nik']);
    $this->db->bind('pass', sha1( $data['nik'] ));
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('telp', $data['mobile']);
    $this->db->bind('akses', 0);
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

    $ldap = $this->ldap->getUserByUsername($nik, $password) ?? false;
    if ($ldap != false) {
      $this->addUserLdap($ldap);
    }
    return $ldap;
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

  public function addUser() {
    
  }

}