<?php

include_once '../app/core/Database.php';

class ElearningCourse_model
{
  private $table = 'elearningCourse';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAll()
  {
    $this->db->query('select * from ' . $this->table);
    return $this->db->resultSet();
  }

  public function getCourseDetail($courseId)
  {
    $this->db->query('select * from ' . $this->table . ' where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }

  public function getAllCourse()
  {
    $query = 'SELECT elearningCourse.*, companyCourseAkses.companyId, organizationCourseAkses.organizationId, locationCourseAkses.locationId
              FROM elearningCourse
              LEFT JOIN companyCourseAkses ON elearningCourse.elearningCourseId = companyCourseAkses.elearningCourseId
              LEFT JOIN organizationCourseAkses ON elearningCourse.elearningCourseId = organizationCourseAkses.elearningCourseId
              LEFT JOIN locationCourseAkses ON elearningCourse.elearningCourseId = locationCourseAkses.elearningCourseId
              LEFT JOIN jobCourseAkses ON elearningCourse.elearningCourseId = jobCourseAkses.elearningCourseId
              WHERE elearningCourse.access_type = 0
              AND elearningCourse.elearningCourseId != 19 
              AND elearningCourse.state=1
              OR elearningCourse.access_type = 2 
              AND elearningCourse.elearningCourseId != 19 
              AND elearningCourse.state=1';

    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getCourseBy($kategoriId)
  {
    $this->db->query('SELECT ' . $this->table . '.*, companyCourseAkses.companyId, organizationCourseAkses.organizationId, locationCourseAkses.locationId
                      FROM ' . $this->table . '
                      RIGHT JOIN elearningKategori on elearningKategori.elearningKategoriId = elearningCourse.elearningKategoriId
                      LEFT JOIN companyCourseAkses ON ' . $this->table . '.' . $this->table . 'Id = companyCourseAkses.' . $this->table . 'Id
                      LEFT JOIN organizationCourseAkses ON ' . $this->table . '.' . $this->table . 'Id = organizationCourseAkses.' . $this->table . 'Id
                      LEFT JOIN locationCourseAkses ON ' . $this->table . '.' . $this->table . 'Id = locationCourseAkses.' . $this->table . 'Id
                      LEFT JOIN jobCourseAkses ON ' . $this->table . '.' . $this->table . 'Id = jobCourseAkses.' . $this->table . 'Id
                      WHERE ' . $this->table . '.access_type = 0
                      AND ' . $this->table . '.' . $this->table . 'Id != 19 
                      AND ' . $this->table . '.state=1
                      AND elearningKategori.elearningKategoriId=:kategoriId
                      OR ' . $this->table . '.access_type = 2 
                      AND ' . $this->table . '.' . $this->table . 'Id != 19 
                      AND ' . $this->table . '.state=1
                      AND elearningKategori.elearningKategoriId=:kategoriId;');

    $this->db->bind('kategoriId', $kategoriId);
    return $this->db->resultSet();
  }

  public function getSopCourse($nik)
  {
    $this->db->query('SELECT * FROM elearningModule 
                      where elearningCourseId=19 AND accessType=0
                      UNION
                      SELECT elearningModule.* FROM elearningModule
                      right join userModuleAkses on userModuleAkses.moduleId=elearningModule.elearningModuleId
                      WHERE elearningModule.elearningCourseId=19 AND elearningModule.accessType=2 AND userModuleAkses.userNik=:nik');

    $this->db->bind('nik', $nik);
    return $this->db->resultSet();
  }

  public function getPrivateCourse($orgId, $nik)
  {
    $this->db->query('SELECT *
                      FROM ' . $this->table . '
                      WHERE access_type = 2
                      AND elearningCourseId NOT IN (
                      SELECT ' . $this->table . '.elearningCourseId
                      FROM ' . $this->table . ' 
                      JOIN organizationCourseAkses ON ' . $this->table . '.elearningCourseId = organizationCourseAkses.elearningCourseId
                      WHERE organizationCourseAkses.organizationId = :orgId
                      AND ' . $this->table . '.access_type = 2 )
                      AND elearningCourseId NOT IN (
                      SELECT ' . $this->table . '.elearningCourseId
                      FROM ' . $this->table . ' 
                      JOIN userCourseAkses ON ' . $this->table . '.elearningCourseId = userCourseAkses.elearningCourseId
                      WHERE userCourseAkses.userNik = :nik
                      AND ' . $this->table . '.access_type = 2)');

    $this->db->bind('orgId', $orgId);
    $this->db->bind('nik', $nik);
    return $this->db->resultSet();
  }

  public function getUserInCourse($accessType)
  {
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
                        ' . $this->table . '.elearningCourseId
                      ORDER BY elearningCourse.uploadDate DESC');

    $this->db->bind('accessType', $accessType);
    return $this->db->resultSet();
  }

  public function getCourseAksesDepartmentId($courseId)
  {
    $this->db->query('select organizationId from organizationCourseAkses
                      where elearningCourseId=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->resultSet();
  }

  public function getCourseUserPrivateAkses($courseId)
  {
    $this->db->query('select count(*) as "totalUser" from companyCourseAkses where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    $companyAkses = $this->db->single()['totalUser'];

    $this->db->query('select count(*) as "totalUser" from organizationCourseAkses where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    $organizationAkses = $this->db->single()['totalUser'];

    $this->db->query('select count(*) as "totalUser" from jobCourseAkses where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    $jobAkses = $this->db->single()['totalUser'];

    $this->db->query('select count(*) as "totalUser" from userCourseAkses where elearningCourseId=:courseId');
    $this->db->bind('courseId', $courseId);
    $userAkses = $this->db->single()['totalUser'];

    $total = intval($companyAkses) + intval($organizationAkses) + intval($jobAkses) + intval($userAkses);
    return $total;
  }

  public function countLesson($courseId)
  {
    $this->db->query('select count(elearningLesson.elearningLessonId) as "total lesson"
                      from ' . $this->table . '
                      right join elearningModule on ' . $this->table . '.' . $this->table . 'Id=elearningModule.' . $this->table . 'Id
                      right join elearningLesson on elearningModule.elearningModuleId=elearningLesson.elearningModuleId
                      where ' . $this->table . '.' . $this->table . 'Id=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }

  public function countTest($courseId)
  {
    $this->db->query('select count(elearningTest.elearningTestId) as "total test"
                      from ' . $this->table . '
                      right join elearningModule on ' . $this->table . '.' . $this->table . 'Id=elearningModule.' . $this->table . 'Id
                      right join elearningTest on elearningModule.elearningModuleId=elearningTest.elearningModuleId
                      where ' . $this->table . '.' . $this->table . 'Id=:courseId');

    $this->db->bind('courseId', $courseId);
    return $this->db->single();
  }
}
