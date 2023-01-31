<?php 

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

