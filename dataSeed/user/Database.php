<?php 

class Database {
  // Database detail 
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;

  private $dbHandler; // menangani koneksi ke database
  private $statement; // menangani query

  // function yang akan dipanggil saat class database berjalan 
  // berisi connection yang dibuat kedalam database
  // menggunakan database mysql local 
  public function __construct() {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $option);
    } catch(PDOException $err) {
      die ($err->getMessage());
    }
  }

  // function yang menerima query 
  public function query($query) {
    $this->statement = $this->dbHandler->prepare($query);
  }

  // function untuk membersihkan query 
  // seperti (select by id), 
  // digunakan untuk menghindari sql injection 
  // serta membersihkan string untuk query 
  public function bind($param, $value, $type = null) {
    if ( is_null($type) ) {
      switch( true ) {
        case is_int($value) :
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value) :
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value) :
          $type = PDO::PARAM_NULL;
          break;
        default :
          $type = PDO::PARAM_STR;
      }
    }

    $this->statement->bindValue($param, $value, $type);
  }

  // function untuk menjalankan query 
  public function execute() {
    $this->statement->execute();
  }

  // function untuk mengembalikan hasil query 
  // digunakan untuk mengembalikan hasil query lebih dari 1 
  public function resultSet() {
    $this->execute();
    return $this->statement->fetchAll(PDO::FETCH_ASSOC);
  }

  // function untuk mengembalikan hasil query 
  // digunakan untuk mengembalikan hasil query yang 1
  public function single() {
    $this->execute();
    return $this->statement->fetch(PDO::FETCH_ASSOC);
  }
}

