<?php 

include_once '../app/core/Database.php';

class ElearningCourse_model {
  private $table = 'elearningCourse';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function getAll() {
    $this->db->query('select * from ' . $this->table);
    return $this->db->resultSet();
  }

  public function getCourseDetail($courseId) {
    $this->db->query('select * from ' . $this->table . ' where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }
  
  public function getAllCourse($orgId, $userId) {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 0 and elearningCourseId != 19
                      UNION
                      SELECT ' . $this->table . '.*
                      FROM ' . $this->table . ' 
                      JOIN elearningCourseAkses ON ' . $this->table . '.elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE elearningCourseAkses.departmentId = :orgId
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
    $this->db->query("SELECT elearningCourse.elearningCourseId, elearningCourse.elearningKategoriId, elearningCourse.judul, elearningCourse.thumbnail, elearningCourse.uploadDate
                      FROM " . $this->table . "
                      JOIN elearningKategori ON " . $this->table . ".elearningKategoriId = elearningKategori.elearningKategoriId
                      LEFT JOIN elearningCourseAkses ON " . $this->table . ".elearningCourseId = elearningCourseAkses.elearningCourseId
                      LEFT JOIN userElearningCourseAkses ON " . $this->table . ".elearningCourseId = userElearningCourseAkses.elearningCourseId
                      WHERE " . $this->table . ".elearningKategoriId = :kategoriId
                      AND (" . $this->table . ".Access_Type = 0 OR (" . $this->table . ".Access_Type = 2 AND elearningCourseAkses.departmentId = :orgId) OR (" . $this->table . ".Access_Type = 2 AND userElearningCourseAkses.userId=:userId) )");

    $this->db->bind('kategoriId', $kategoriId);
    $this->db->bind('orgId', $orgId);
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

  public function getSopCourse($userId) {
    $this->db->query('SELECT * FROM elearningModule 
                      where elearningCourseId=19 AND accessType=0
                      UNION
                      SELECT elearningModule.* FROM elearningModule
                      right join userModuleAkses on userModuleAkses.moduleId=elearningModule.elearningModuleId
                      WHERE elearningModule.elearningCourseId=19 AND elearningModule.accessType=2 AND userModuleAkses.userId=:userId');
    
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

  public function getPrivateCourse($orgId, $userId) {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 2
                      AND elearningCourseId NOT IN (
                      SELECT ' . $this->table . '.elearningCourseId
                      FROM ' . $this->table . ' 
                      JOIN elearningCourseAkses ON ' . $this->table . '.elearningCourseId = elearningCourseAkses.elearningCourseId
                      WHERE elearningCourseAkses.departmentId = :orgId
                      AND ' . $this->table . '.access_type = 2 )
                      AND elearningCourseId NOT IN (
                      SELECT ' . $this->table . '.elearningCourseId
                      FROM ' . $this->table . ' 
                      JOIN userElearningCourseAkses ON ' . $this->table . '.elearningCourseId = userElearningCourseAkses.elearningCourseId
                      WHERE userElearningCourseAkses.userId = :userId
                      AND ' . $this->table . '.access_type = 2)');

    $this->db->bind('orgId', $orgId);
    $this->db->bind('userId', $userId);
    return $this->db->resultSet();
  }

  public function getUserInCourse($accessType) {
    $this->db->query('SELECT 
                        ' . $this->table . '.judul AS "Judul Course", 
                        ' . $this->table . '.elearningCourseId AS "Course ID", 
                        count(elearningLesson.elearningLessonId) AS "Total Lessons",
                        (select count(*) from user) as "totalUser",
                        elearningCourse.state,
                        elearningCourse.uploadDate,
                        elearningCourse.access_type
                      FROM 
                        ' . $this->table . ' 
                        LEFT JOIN elearningModule
                          ON ' . $this->table . '.elearningCourseId = elearningModule.elearningCourseId
                        LEFT JOIN elearningLesson
                          ON elearningModule.elearningModuleId = elearningLesson.elearningModuleId
                      WHERE access_type=:accessType
                      GROUP BY 
                        ' . $this->table . '.elearningCourseId');
                        
    $this->db->bind('accessType', $accessType);
    return $this->db->resultSet();
  }

  public function getCourseAksesDepartmentId($courseId) {
    $this->db->query('select departmentId from elearningCourseAkses
                      where elearningCourseId=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }

  public function getCourseUserPrivateAkses($courseId) {
    $this->db->query('select count(*) as "totalUser" from userElearningCourseAkses where elearningCourseId=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }

  public function countLesson($courseId) {
    $this->db->query('select count(elearningLesson.elearningLessonId) as "total lesson"
                      from ' . $this->table . '
                      right join elearningModule on ' . $this->table . '.' . $this->table . 'Id=elearningModule.' . $this->table . 'Id
                      right join elearningLesson on elearningModule.elearningModuleId=elearningLesson.elearningModuleId
                      where ' . $this->table . '.' . $this->table . 'Id=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }

  public function countTest($courseId) {
    $this->db->query('select count(elearningTest.elearningTestId) as "total test"
                      from ' . $this->table . '
                      right join elearningModule on ' . $this->table . '.' . $this->table . 'Id=elearningModule.' . $this->table . 'Id
                      right join elearningTest on elearningModule.elearningModuleId=elearningTest.elearningModuleId
                      where ' . $this->table . '.' . $this->table . 'Id=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }

}