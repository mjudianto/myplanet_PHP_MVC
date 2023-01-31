<?php 

include_once '../app/core/Database.php';
include_once '../app/core/Ldap.php';

class Admin_model{
  private $ldap;

  public function __construct() {
    $this->ldap = new Ldap;
  }

  public function userAuth($nik, $password){
    $ldap = $this->ldap->getUserByUsername($nik, $password) ?? false;

    return $ldap;
  }

}