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
    $sql = 'SELECT * FROM ' . $this->table . ' 
    left join organization on organization.organizationId=user.organizationId
    left join location on location.locationId=user.locationId
    left join company on organization.companyId=company.companyId';
    $this->db->query($sql);

    $user = $this->db->resultSet();
    return $user;
  }

  public function getHrisUser($userNik) {
    $user = file_get_contents('https://guard.enseval.com/for_api/read.php?nik=' . $userNik);

    $user = json_decode($user, true);
    return $user;
  }

  public function getPlanetUser($userNik) {
    $sql = 'SELECT * FROM ' . $this->table . '
    left join organization on organization.organizationId=user.organizationId
    left join location on location.locationId=user.locationId
    left join company on organization.companyId=company.companyId
    WHERE userNik=:userNik';
    $this->db->query($sql);

    $this->db->bind('userNik', $userNik);
    $user = $this->db->single();
    if (!is_bool($user)) {
      return $user;
    } else {
      return null;
    }
  }

  public function userAuth($userNik, $password){
    $user = $this->getPlanetUser($userNik);
    if ($user != null) {
      if ($user['password'] == sha1($password)) {
        $user = $this->getHrisUser(trim($userNik));
        if ($user['empnik'] != "") { return $user; }
        else { 
          $user = $this->getPlanetUser($userNik); 
          return $user; 
        }
      } else {
        return null;
      }
    }

    $ldapUser = $this->ldap->getUserByUsername($userNik, $password);
    if ($ldapUser != null) {
      $user = $this->getPlanetUser($ldapUser['userNik']);

      if ($user === null) {
        $this->createPlanetUser($ldapUser['userNik']);
      }

      $user = $this->getHrisUser(trim($ldapUser['userNik']));
      return $user;
    } else {      
      $user = $this->getHrisUser($userNik);

      if ($user['empnik'] == "") {
        return null;
      } else {
        return $user;
      }
    }

    return null;
  }

  public function createPlanetUser($userNik) {
    $sql = 'INSERT INTO ' . $this->table . ' VALUES(:userNik, :password, null, default, default, default)';

    $this->db->query($sql);

    $this->db->bind('userNik', $userNik);
    $this->db->bind('password', sha1($userNik));

    $this->db->execute();
  }

  public function updateUserPassword($password){
    $query = "UPDATE " . $this->table . " SET password=:password where userNik=:userNik";
    $this->db->query($query);

    isset($_SESSION['user']['empnik']) ? $userNik = trim($_SESSION['user']['empnik']) : $userNik = $_SESSION['user']['userNik'];

    // $this->db->bind('column', $column);
    $this->db->bind('password', sha1($password));
    $this->db->bind('userNik', $userNik);


    $this->db->execute();
  }

  public function updateLastVisit($user) {
    $query = "UPDATE " . $this->table . " SET lastVisit=CURRENT_TIMESTAMP() where userNik=:userNik";
    $this->db->query($query);
    
    $userNik = $user['empnik'] ?? $user['nik'];

    $this->db->bind('userNik', $user['empnik']);
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

  public function setResetPasswordToken($token, $userNik, $email, $time) {
    $this->db->query('insert into passwordResetToken values(:token, :userNik, :email, :time)');

    $this->db->bind('token', $token);
    $this->db->bind('userNik', $userNik);
    $this->db->bind('email', $email);
    $this->db->bind('time', $time);
    $this->db->execute();
  }

  public function getTokenDetail($token) {
    $this->db->query('select * from passwordResetToken where token=:token');
    $this->db->bind('token', $token);
    return $this->db->single();
  }

  public function deleteResetPasswordToken($token) {
    $this->db->query('delete from passwordResetToken where token=:token');
    $this->db->bind('token', $token);
    $this->db->execute();
  }

  

}