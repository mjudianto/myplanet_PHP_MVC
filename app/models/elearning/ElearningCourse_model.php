<?php 

include_once '../app/core/Database.php';

class ElearningCourse_model {
  private $table = 'elearningCourse';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllCourse($orgId, $userId) {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 0
                      UNION
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN elearningCourseAkses ON ' . $this->table . '.elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE elearningCourseAkses.organizationId = :orgId
                      AND ' . $this->table . '.access_type = 2
                      UNION
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN userElearningCourseAkses ON ' . $this->table . '.elearningCourseId = userElearningCourseAkses.elearningCourseId
                      WHERE userElearningCourseAkses.userId = :userId
                      AND ' . $this->table . '.access_type = 2');

    $this->db->bind('orgId', $orgId);
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

  public function getCourseBy($kategoriId, $orgId, $userId) {
    $this->db->query("SELECT elearningCourse.elearningCourseId, elearningCourse.elearningKategoriId, elearningCourse.judul, elearningCourse.thumbnail
                      FROM " . $this->table . "
                      JOIN elearningKategori ON " . $this->table . ".elearningKategoriId = elearningKategori.elearningKategoriId
                      LEFT JOIN elearningCourseAkses ON " . $this->table . ".elearningCourseId = elearningCourseAkses.elearningCourseId
                      LEFT JOIN userElearningCourseAkses ON " . $this->table . ".elearningCourseId = userElearningCourseAkses.elearningCourseId
                      WHERE " . $this->table . ".elearningKategoriId = :kategoriId
                      AND (" . $this->table . ".Access_Type = 0 OR (" . $this->table . ".Access_Type = 2 AND elearningCourseAkses.organizationId = :orgId) OR (" . $this->table . ".Access_Type = 2 AND userElearningCourseAkses.userId=:userId) )");

    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('orgId', $orgId);
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

  public function getPrivateCourse($orgId, $userId) {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 2
                      EXCEPT
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN elearningCourseAkses ON ' . $this->table . '.elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE elearningCourseAkses.organizationId = :orgId
                      AND ' . $this->table . '.access_type = 2
                      EXCEPT
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN userElearningCourseAkses ON ' . $this->table . '.elearningCourseId = userElearningCourseAkses.elearningCourseId
                      WHERE userElearningCourseAkses.userId = :userId
                      AND ' . $this->table . '.access_type = 2');

    $this->db->bind('orgId', $orgId);
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

}