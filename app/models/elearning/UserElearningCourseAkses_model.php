<?php 

include_once '../app/core/Database.php';

class UserElearningCourseAkses_Model {
  private $table = 'userCourseAkses';
  private $db;

  public function __construct() { 
    $this->db = new Database;
  }
  
  public function createUserPermission($courseId, $userNik) {
    if ($this->checkUserPermission($courseId, $userNik) == null) {
      $query = ('INSERT INTO ' . $this->table . ' VALUES(null, :courseId, :userNik)');
      $this->db->query($query);
  
      $this->db->bind('courseId', $courseId);
      $this->db->bind('userNik', $userNik);
      $this->db->execute();
    }
  }
  public function selectUserPermission($courseId) {
    $query = ('SELECT * from userCourseAkses left join user 
    on user.userNik = userCourseAkses.userNik 
    where userCourseAkses.elearningCourseId=:courseId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }
  public function checkUserPermission($courseId, $userNik) {
    $query = ('SELECT * from userCourseAkses left join user 
    on user.userNik = userCourseAkses.userNik 
    where userCourseAkses.elearningCourseId=:courseId and userCourseAkses.userNik=:userNik');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    $this->db->bind('userNik', $userNik);
    return $this->db->single() ?? null;
  }


  public function createCompanyPermission($courseId, $companyId) {
    if ($this->checkCompanyPermission($courseId, $companyId) == null) {
      $query = ('INSERT INTO companyCourseAkses VALUES(null, :courseId, :companyId)');
      $this->db->query($query);
  
      $this->db->bind('courseId', $courseId);
      $this->db->bind('companyId', $companyId);
      $this->db->execute();
    }
  }
  public function getAllCompanyPermission() {
    $this->db->query('select * from companyCourseAkses');
    return $this->db->resultSet();
  }
  public function selectCompanyPermission($courseId) {
    $query = ('SELECT * from companyCourseAkses left join company 
    on company.companyId = companyCourseAkses.companyId 
    where companyCourseAkses.elearningCourseId=:courseId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }
  public function checkCompanyPermission($courseId, $companyId) {
    $query = ('SELECT * from companyCourseAkses left join company 
    on company.companyId = companyCourseAkses.companyId 
    where companyCourseAkses.elearningCourseId=:courseId and companyCourseAkses.companyId=:companyId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    $this->db->bind('companyId', $companyId);
    return $this->db->single() ?? null;
  }


  public function createOrganizationPermission($courseId, $organizationId) {
    if ($this->checkOrganizationPermission($courseId, $organizationId) == null) {
      $query = ('INSERT INTO organizationCourseAkses VALUES(null, :courseId, :organizationId)');
      $this->db->query($query);

      $this->db->bind('courseId', $courseId);
      $this->db->bind('organizationId', $organizationId);
      $this->db->execute();
    }
  }
  public function getAllOrganizationPermission() {
    $this->db->query('select * from organizationCourseAkses');
    return $this->db->resultSet();
  }
  public function selectOrganizationPermission($courseId) {
    $query = ('SELECT * from organizationCourseAkses left join organization 
    on organization.organizationId = organizationCourseAkses.organizationId 
    where organizationCourseAkses.elearningCourseId=:courseId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }
  public function checkOrganizationPermission($courseId, $organizationId) {
    $query = ('SELECT * from organizationCourseAkses where elearningCourseId=:courseId and organizationId=:organizationId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    $this->db->bind('organizationId', $organizationId);
    return $this->db->single() ?? null;
  }


  public function createLocationPermission($courseId, $locationId) {
    if ($this->checkLocationPermission($courseId, $locationId) == null) {
      $query = ('INSERT INTO locationCourseAkses VALUES(null, :courseId, :locationId)');
      $this->db->query($query);

      $this->db->bind('courseId', $courseId);
      $this->db->bind('locationId', $locationId);
      $this->db->execute();
    }
  }
  public function getAllLocationPermission() {
    $this->db->query('select * from LocationCourseAkses');
    return $this->db->resultSet();
  }
  public function selectLocationPermission($courseId) {
    $query = ('SELECT * from locationCourseAkses left join location 
    on location.locationId = locationCourseAkses.locationId 
    where locationCourseAkses.elearningCourseId=:courseId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }
  public function checkLocationPermission($courseId, $locationId) {
    $query = ('SELECT * from locationCourseAkses left join location 
    on location.locationId = locationCourseAkses.locationId 
    where locationCourseAkses.elearningCourseId=:courseId and locationCourseAkses.locationId=:locationId');
    $this->db->query($query);

    $this->db->bind('courseId', $courseId);
    $this->db->bind('locationId', $locationId);
    return $this->db->single() ?? null;
  }



}