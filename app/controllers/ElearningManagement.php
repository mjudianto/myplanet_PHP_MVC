<?php 

use Shuchkin\SimpleXLSX;

class ElearningManagement extends Controller {

  public function courseCategory() {
    $model = $this->loadElearningModel();

    $data['kategori'] = $model['elearningKategori']->getKategoriDetail();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courseCategory', $data);
    $this->view('admin/layouts/footer');
  }

  public function addKategori() {
    $model = $this->loadElearningModel();

    if ($_POST['courseKategori'] != '') {
      $model['elearningKategori']->addKategori($_POST['courseKategori']);
    }

    header("Location:" . BASEURL . 'elearningmanagement/courseCategory');
    exit;

  }

  public function updateKategori() {
    $model = $this->loadElearningModel();

    if ($_POST['kategori'] != '') {
      $model['elearningKategori']->updateKategori($_POST['kategoriId'], $_POST['kategori']);
    }

    // var_dump($_POST['kategori']);
    header("Location:" . BASEURL . 'elearningmanagement/courseCategory');
    exit;

  }

  public function courses() {
    $model = $this->loadElearningModel();

    $userModel = $this->model('user/User_model', 'User_model');

    $courses = $model['elearningCourse']->getUserInCourse(0);
    $courses2 = $model['elearningCourse']->getUserInCourse(2);
    $user = $userModel->getAllUsers();

    $userCount = array_map(function ($course) use ($model, $userModel) {
      $courseId = $course['Course ID'];
      $organizationCount = $model['elearningCourse']->getCourseAksesDepartmentId($courseId);
      $courseAccess = $model['elearningCourse']->getCourseUserPrivateAkses($courseId);

      $organizationUser = array_sum(array_map(function ($org) use ($userModel) {
          return (int)$userModel->countUserInOrganization($org['organizationId']);
      }, $organizationCount));
  
      return $organizationUser + (int)$courseAccess;
    }, $courses2);

    $company = $this->model('user/Company_model', 'Company_model')->getAllCompany();
    $organization = $this->model('user/Organization_model', 'Organization_model')->getAllOrganization();
    $location = $this->model('user/Location_model', 'Location_model')->getAllLocation();

    $data = [
      'courses' => $courses,
      'courses2' => $courses2,
      'userCount' => $userCount,
      'user' => $user,
      'company' => $company,
      'organization' => $organization,
      'location' => $location,
    ];

    // var_dump($data['user'][0]);
    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courses', $data);
    $this->view('admin/layouts/footer');
  }

  public function modules() {
    $model = $this->loadElearningModel();
    $courseId = $_GET['courseId'];

    $data['elearningModule'] = $model['elearningModule']->getModuleBy($courseId);
    $data['elearningCourse'] = $model['elearningCourse']->getCourseDetail($courseId);

    $moduleIds = array_column($data['elearningModule'], 'elearningModuleId');

    $data['elearningLesson'] = array_map(function($moduleId) use ($model) {
      return $model['elearningLesson']->getLessonBy($moduleId);
    }, $moduleIds);

    $data['elearningTest'] = array_map(function($moduleId) use ($model) {
      return $model['elearningTest']->getTestBy($moduleId);
    }, $moduleIds);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/modules', $data);
    $this->view('admin/layouts/footer');
  }

  public function addModule() {
    $model = $this->loadElearningModel();
    
    $model['elearningModule']->createNewModule($_POST['courseId'], $_POST['judul']);

    header("Location: " . BASEURL . "elearningmanagement/modules?courseId=" . $_POST['courseId']);
    exit;
  }

  public function updateModule() {
    $model = $this->loadElearningModel();

    $model['elearningModule']->updateModule($_POST['moduleName'], $_POST['moduleId']);
    header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_POST['courseId']);
  }

  public function deleteModule() {
    $model = $this->loadElearningModel();

    $model['elearningModule']->deleteModule($_GET['moduleId']);
    header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_POST['courseId']);
  }

  public function filterDate() {
    $model = $this->loadElearningModel();

    $start_date = $_REQUEST['startDate'];
    $end_date = $_REQUEST['endDate'];
    $courseId = $_REQUEST['courseId'];

    $data = $model['userTestRecord']->getAllUserRecord($courseId);


    $filtered_data = array_filter($data, function($item) use ($start_date, $end_date) {
      if ($item['nik'] != '') {
        $item_date = strtotime($item['time']);
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        
        if ($_REQUEST['startDate'] != '') {
          if ($_REQUEST['endDate'] != '') {
            return ($item_date >= $start) && ($item_date <= $end);
          } else {
            return ($item_date >= $start);
          }
        } else {
          if ($_REQUEST['endDate'] != '') {
            return ($item_date <= $end);
          }
        }
      }
      return;
      
    });

    $i=1;

    foreach($filtered_data as $record) {
      if ($record['nik'] != '') {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $record['nik'] . '</td>
                <td>' . $record['nama'] . '</td>
                <td>' . $record['judul'] . '</td>
                <td>' . $record['totalAttempt'] . '</td>
                <td>' . $record['score'] . '</td>
                <td>';

        if ($record['status'] == 'Lulus') {
            echo '<div
                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                    Lulus
                  </div>';
        } else {
          echo  '<div
                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                    Tidak Lulus
                  </div>';
        }
                  
        echo   '</td>
                <td>' . $record['time'] . '</td>
                <td>' . $record['locationName'] . '</td>
                <td>' . $record['organizationName'] . '</td>
              </tr>';
        $i+=1;
      }
    }
  }

  public function addLesson() {
    // var_dump($_FILES['konten-' . $_GET['moduleId']]["error"] != UPLOAD_ERR_NO_FILE);
    if ($_FILES['konten-' . $_GET['moduleId']]["error"] != UPLOAD_ERR_NO_FILE && $_POST['lessonName-' . $_GET['moduleId']] != '') {
      $model = $this->loadElearningModel();
      $konten = $_FILES['konten-' . $_GET['moduleId']];
      $judul = $_POST['lessonName-' . $_GET['moduleId']];

      $fileType = pathinfo($konten['name'], PATHINFO_EXTENSION);
      if (!in_array($fileType, ['mp4', 'webm', 'ogg'])) {
        if($konten['type'] != 'application/pdf'){
          // Return error message
          echo "Error: Invalid file format";
          exit;
        } else {
          $fileType = 'pdf';
        }
      } else {
        $fileType = 'video';
      }

      if ($fileType == 'video') {
        // Validate the size of the video
        if ($konten['size'] > 1000000000) { // 1 GB
          echo "Error: Video file size too large.";
          exit;
        }
      
        // Generate a unique filename for the video
        $fileName =  str_replace("." . pathinfo($konten['name'], PATHINFO_EXTENSION), "", $konten['name']) . '-' . uniqid() . '.mp4';
        $destination = BASEURL . 'elearningAssets/videos/' .  $fileName;
      
        // Move the uploaded file to the uploads folder
        move_uploaded_file($konten['tmp_name'], $destination);

        // var_dump(BASEURL . $destination);
        $model['elearningLesson']->addLesson($_GET['moduleId'], $judul, $destination);
        header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_GET['courseId']);
      } else {
        // Generate a unique file name
        $fileName = str_replace("." . pathinfo($konten['name'], PATHINFO_EXTENSION), "", $konten['name']) . '-' . md5(uniqid()) . '.pdf';
      
        // Set upload directory
        $uploadDir = 'elearningAssets/pdf/';
      
        // Check if upload directory exists, if not create it
        if (!file_exists($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }
        
        $destination = BASEURL . $uploadDir . $fileName;

        // Save PDF file to upload directory
        move_uploaded_file($konten['tmp_name'], $uploadDir . $fileName);

        $model['elearningLesson']->addLesson($_GET['moduleId'], $judul, $destination);
        header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_GET['courseId']);
      }
    } else {
      echo "please fill the lesson name and content";
    }


  }

  public function courseTestRecord() {
    $model = $this->loadElearningModel();

    $data['course'] = $model['elearningCourse']->getCourseDetail($_GET['courseId']);
    $data['testRecord'] = $model['userTestRecord']->getAllUserRecord($_GET['courseId']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courseTestRecord', $data);
    $this->view('admin/layouts/footer');
  }

  public function addPostTest() {
    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/addPostTest');
    $this->view('admin/layouts/footer');
  }

  public function importTest() {
    $model = $this->loadElearningModel();

    $uploaded = false;
    $testName = $_POST['testName'];
    $passingScore = $_POST['passingScore'];
    $timeLimit = (int)$_POST['timeLimit'] * 60 * 1000;
    $endDate = new DateTime($_POST['endDate']);
    $endDate = $endDate->format('Y-m-d');
    
    if($_FILES['xlsx_file']["error"] != UPLOAD_ERR_NO_FILE ) { // Check if file has been uploaded
      $target_dir = "elearningAssets/test/"; // Directory where you want to save the file
      $file_name = uniqid() . '.' . pathinfo($_FILES['xlsx_file']['name'], PATHINFO_EXTENSION); // Generate unique ID and concatenate with file extension
      $target_file = $target_dir . $file_name; // Get the name of the file
    
      // Check if file already exists
      if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
      } else {
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES['xlsx_file']['tmp_name'], $target_file)) {
          $uploaded = true;
        } else {
          echo "Sorry, there was an error uploading your file.";
        }
      }
    }
    
    if ($_GET['testId'] != '') {
      $model['elearningTest']->updateTest($testName, $passingScore, $timeLimit, $endDate, $_GET['testId']);
    }

    if ($uploaded) {
      if ( $xlsx = SimpleXLSX::parse('elearningAssets/test/' . $file_name )) {
        if ($_GET['moduleId'] != '') {
          $model['elearningTest']->createTest($_GET['moduleId'], $testName, $passingScore, $timeLimit, $endDate);
          $test =  $model['elearningTest']->getTestByJudul($_GET['moduleId'], $testName);
        } else {
          $test =  $model['elearningTest']->getSingleTest($_GET['testId']);
          $model['question']->resetQuestion($test['elearningTestId']);
        }
       

        foreach( $xlsx->rows() as $row ) {
          // Skip the first row
          if ($row === $xlsx->rows()[0]) {
            continue;
          }
          
          $model['question']->createQuestion($test['elearningTestId'], $row[0], $row[6]);
          $question = $model['question']->getSingelQuestion($test['elearningTestId'], $row[0]);
          $model['answer']->createAnswer($question['questionId'], $row[5]);
          $answer = $model['answer']->getQuestionAnswer($question['questionId']);

          for ($i=1 ; $i<=4 ; $i++){
            if ($row[$i] != '') {
              if ($row[$i] == $row[5]) {
                $model['choice']->createChoice($question['questionId'], $row[$i], $answer['answerId']);
              } else {
                $model['choice']->createChoice($question['questionId'], $row[$i], 'null');
              }
            }
          }
        }

        header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_POST['courseId']);
      } else {
          echo SimpleXLSX::parseError();
      }
    }

  }

  public function newTest() {
    $numberOfQuestion = $_POST['questionCounter'];
    $model = $this->loadElearningModel();

    $testName = $_POST['testName'];
    $passingScore = 75;
    $timeLimit = 3600000;
    $endDate = "2023-02-22 00:00:00";

    for ($i=1 ; $i<=$numberOfQuestion ; $i++){
      $question = $_POST['question-' . $i];

      $answerId = $_POST['answer-' . $i];
      $answer = $_POST['choice' . $i . '-' . $answerId];

      $score = $_POST['score-' . $i];

      $model['elearningTest']->createTest($_POST['moduleId'], $testName, $passingScore, $timeLimit, $endDate);
      $test =  $model['elearningTest']->getTestByJudul($_POST['moduleId'], $testName);

      $model['question']->createQuestion($test['elearningTestId'], $question, $score);
      $question = $model['question']->getSingelQuestion($test['elearningTestId'], $question);

      $model['answer']->createAnswer($question['questionId'], $answer);
      $answer = $model['answer']->getQuestionAnswer($question['questionId']);

      for ($j=1 ; $j<=4 ; $j++){
        if ($j == $answerId) {
          $model['choice']->createChoice($question['questionId'], $_POST['choice' . $i . '-' . $j], $answer['answerId']);
        } else {
          $model['choice']->createChoice($question['questionId'], $_POST['choice' . $i . '-' . $j], 'null');
        }
      }
    }

    header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_POST['courseId']);

  }

  public function editPostTest() {
    $model = $this->loadElearningModel();

    $data['elearningTest'] = $model['elearningTest']->getSingleTest($_GET['testId']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/editPostTest', $data);
    $this->view('admin/layouts/footer');
  }

  public function deletePostTest() {
    $model = $this->loadElearningModel();
    $model['elearningTest']->deleteTest($_GET['testId']);

    header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_GET['courseId']);

  }

  public function newCourseAkses() {
    print_r($_POST['selectedUser']);
  }
  
}
  