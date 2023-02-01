<?php 

include_once '../app/core/Database.php';
include_once '../app/core/Ldap.php';

class User_model{
  private $table = 'user';
  private $db;
  private $ldap;

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

    // $ldap = $this->ldap->getUserByUsername($nik, $password) ?? false;
    // if ($ldap != false) {
    //   $user = $this->getUserBy('nik', $ldap['nik']);
    //   if (!$user) {
    //     $this->addUserLdap($ldap);
    //     $user = $this->getUserBy('nik', $nik);
    //     return $user;
    //   }
    //   return $user;
    // }

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
    $query = "INSERT INTO " . $this->table . " VALUES (null, :nik, :pass, :nama, null, :email, :orgname, :locationId, CURRENT_TIMESTAMP(), default)";
    $this->db->query($query);

    $this->db->bind('nik', $data['nik']);
    $this->db->bind('pass', sha1( $data['nik'] ));
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('orgname', $data['department']);
    $this->db->bind('locationId', $data['locationId']);

    $this->db->execute();
  }

  public function userLessonRecord($userId) {
    $query = 'SELECT 
                elearningKategori.nama AS "nama kategori", elearningCourse.judul AS "judul course", 
                (SELECT COUNT(*) FROM elearningLesson) AS total_lessons, 
                SUM(CASE WHEN userLessonRecord.elearningLessonId IS NOT NULL THEN 1 ELSE 0 END) AS attempted_lessons,
                userLessonRecord.userId 
              FROM 
                elearningKategori 
                INNER JOIN elearningCourse 
                ON elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
                INNER JOIN elearningModule
                ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId
                INNER JOIN elearningLesson
                ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN userLessonRecord ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId
              WHERE
                userLessonRecord.userId=:userId
              GROUP BY 
                elearningKategori.nama,
                elearningCourse.judul,
                userLessonRecord.userId';

    $this->db->query($query);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

  public function userLessonRecordDetail($userId) {
    $query = 'SELECT
                elearningLesson.judul AS "judul lesson",
                COALESCE(userLessonRecord.attempt, 0) AS attempt,
                  userLessonRecord.finished
              FROM
                elearningModule
                INNER JOIN elearningLesson ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                LEFT JOIN userLessonRecord ON userLessonRecord.elearningLessonId = elearningLesson.elearningLessonId AND userLessonRecord.userId = :userId
              GROUP BY
                elearningLesson.judul,
                userLessonRecord.finished,
                COALESCE(userLessonRecord.attempt, 0)';

    $this->db->query($query);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

  public function userTestRecord($userId) {
    $query = 'SELECT 
                elearningKategori.nama AS "nama kategori", elearningCourse.judul AS "judul course", 
                (SELECT COUNT(*) FROM elearningTest) AS total_tests, 
                SUM(CASE WHEN userTestRecord.elearningTestId IS NOT NULL THEN 1 ELSE 0 END) AS attempted_tests,
                userTestRecord.userId 
            FROM 
              elearningKategori 
              INNER JOIN elearningCourse 
              ON elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
              INNER JOIN elearningModule
              ON elearningCourse.elearningCourseId = elearningModule.elearningCourseId
              INNER JOIN elearningTest
              ON elearningModule.elearningModuleId = elearningTest.elearningModuleId
              LEFT JOIN userTestRecord ON userTestRecord.elearningTestId = elearningTest.elearningTestId
            WHERE
              userTestRecord.userId=:userId
            GROUP BY 
              elearningKategori.nama,
              elearningCourse.judul,
              userTestRecord.userId';

    $this->db->query($query);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

  public function userTestRecordDetail($userId) {
    $query = 'SELECT 
                elearningTest.judul AS "judul test", 
                COALESCE(userTestRecord.attempt, 0) AS attempt, 
                MAX(userTestRecordDetail.finished) AS finished, 
                MAX(userTestRecordDetail.score) AS score, 
                (
                    SELECT status 
                    FROM userTestRecordDetail
                    WHERE score = ( SELECT MAX(score) FROM userTestRecordDetail LIMIT 1)
                    LIMIT 1
                ) AS status
            FROM 
                userTestRecord
                INNER JOIN elearningTest ON userTestRecord.elearningTestId = elearningTest.elearningTestId
                INNER JOIN elearningModule ON elearningModule.elearningModuleId = elearningTest.elearningModuleId
                LEFT JOIN userTestRecordDetail ON userTestRecordDetail.userTestRecordId = userTestRecord.userTestRecordId
            WHERE 
                userTestRecord.userId = :userId
            GROUP BY 
                elearningTest.judul, 
                userTestRecord.attempt';

    $this->db->query($query);
    $this->db->bind('userId', $userId);

    return $this->db->resultSet();
  }

  

}