<?php 

include_once '../app/core/Database.php';

class ElearningCourse_model {
  private $table = 'elearningCourse';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }
  
  public function getAllCourse($orgId) {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 0
                      UNION
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN elearningCourseAkses ON ' . $this->table . '.elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE elearningCourseAkses.organizationId = :orgId
                      AND ' . $this->table . '.access_type = 2');

    $this->db->bind('orgId', $orgId);
    return $this->db->resultSet();
  }

  public function getCourseBy($kategoriId, $orgId) {
    $this->db->query("SELECT *
                      FROM " . $this->table . "
                      JOIN elearningKategori ON " . $this->table . ".elearningKategoriId = elearningKategori.elearningKategoriId
                      JOIN elearningCourseAkses ON " . $this->table . ".elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE " . $this->table . ".elearningKategoriId = :kategoriId
                      AND (" . $this->table . ".Access_Type = 0 OR (" . $this->table . ".Access_Type = 2 AND elearningCourseAkses.organizationId = :orgId))");

    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('orgId', $orgId);
    return $this->db->resultSet();
  }

}