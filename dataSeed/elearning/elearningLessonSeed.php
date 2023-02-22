<?php
require_once 'Database.php';

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'admin123');
define('DB_NAME', 'myplanet');

class ElearningLesson_model {
  private $table = 'elearningLesson';
  private $db;

  public function __construct() {
    $this->db = new Database;
  }

  public function createLesson($id, $moduleId, $judul) {
    $this->db->query('INSERT INTO ' . $this->table . ' VALUES(:id, :moduleId, :judul, 1, default, default)');

    $this->db->bind('id', $id);
    $this->db->bind('moduleId', $moduleId);
    $this->db->bind('judul', $judul);

    $this->db->execute();
  }

  public function createLessonContent($konten) {
    $this->db->query('INSERT INTO elearningLessonKonten VALUES(null, :konten)');

    $this->db->bind('konten', $konten);

    $this->db->execute();
  }

  public function checkKonten($konten) {
    $this->db->query('SELECT * from elearningLessonKonten WHERE konten=:konten');
    $this->db->bind('konten', $konten);
    return $this->db->single();
  }

  public function editElearningLesson($konten, $lessonId) {
    $this->db->query('UPDATE elearningLesson SET elearningLessonKontenId=(SELECT elearningLessonKontenId from elearningLessonKonten WHERE konten=:konten) WHERE elearningLessonId=:lessonId');
    
    $this->db->bind('konten', $konten);
    $this->db->bind('lessonId', $lessonId);

    $this->db->execute();
  }

  public function createLessonRecord($lessonId, $nik, $attempt, $finished) {
    $this->db->query('select * from elearningLesson where elearningLessonId=:lessonId');
    $this->db->bind('lessonId', $lessonId);
    $data = $this->db->single() ?? null;
    
    // return $data;

    $this->db->query('select * from user where nik=:nik');
    $this->db->bind('nik', $nik);
    $data2 = $this->db->single() ?? null;
    
    if ($data != null && $data2 != null) {
      $this->db->query('SELECT * FROM userLessonRecord WHERE elearningLessonId=:lessonId AND userId=:userId');
      $this->db->bind('lessonId', $lessonId);
      $this->db->bind('userId', $data2['userId']);
      $userRecord = $this->db->single() ?? null;

      // return $userRecord['userId'];

      if ($userRecord != null) {
        if ($userRecord['attempt'] < $attempt){
          $this->db->query('UPDATE userLessonRecord SET attempt=:attempt, finished=:finished where elearningLessonId=:lessonId AND userId=:userId');
          $this->db->bind('attempt', $attempt);
          $this->db->bind('lessonId', $lessonId);
          $this->db->bind('userId', $userRecord['userId']);
          $this->db->bind('finished', $finished);
          $this->db->execute();
        }
      } else {
        $this->db->query('INSERT INTO userLessonRecord VALUES(null, :lessonId, ' . $data2['userId'] . ', :attempt, :finished)');

        $this->db->bind('lessonId', $lessonId);
        $this->db->bind('attempt', $attempt);
        $this->db->bind('finished', $finished);
    
        $this->db->execute();
      }
    }

  }

}

$file = 'cleanLessonRecord.csv';

// Open the file for reading
$fp = fopen($file, 'r', 'UTF-8');
// $outputFile = fopen('cleanElearningLesson.csv', 'w');

$lesson = new ElearningLesson_model;

$start_time = microtime(true);

while ($row = fgetcsv($fp)) {
  // $row[0] = "delete";  
  // $row[1] = "delete";  
  // $row[2] = "delete";  
  // $row[4] = "delete";  
  // $row[5] = "delete";  
  // $row[6] = "delete";  
  // $row[7] = "delete";  
  // $row[8] = "delete";  
  // $row[9] = "delete";  
  // $row[10] = "delete";  
  // $row[11] = "delete";  
  // $row[12] = "delete";  
  // $row[13] = "delete";  
  // $row[14] = "delete";  
  // $row[15] = "delete";  
  // $row[16] = "delete";  
  // fputcsv($outputFile, $row);

  // if ($row[0] != 'other' && $row[0] != 'post_test') {
  //   $lesson->checkKonten($row[1]) ? null : $lesson->createLessonContent($row[1]);
  // }

  // $pattern = '/post test/i';

  // if (!preg_match($pattern, $row[1])) {
  //   $lesson->createLesson($row[0], $row[2], $row[1]);
  // }


  // if ($row[0] != 'other' && $row[0] != 'post_test') {
  //   $lesson->editElearningLesson($row[1], $row[2]);
  // }
  // echo $row[2];
  $lesson->createLessonRecord($row[0], $row[1], $row[2], $row[3]);
}

// your program code goes here
echo ' /n success ';
$end_time = microtime(true);

$execution_time = $end_time - $start_time;
echo "Program executed in " . number_format($execution_time, 2) . " seconds.";

fclose($fp);


