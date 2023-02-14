<?php 

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

    $userCount = array_map(function ($course) use ($model, $userModel) {
      $courseId = $course['Course ID'];
      $organizationCount = $model['elearningCourse']->getCourseAksesOrganizationId($courseId);
      $courseAccess = $model['elearningCourse']->getCourseUserPrivateAkses($courseId);

      $organizationUser = array_sum(array_map(function ($org) use ($userModel) {
          return (int)$userModel->countUserInOrganization($org['organizationId']);
      }, $organizationCount));
  
      return $organizationUser + (int)$courseAccess['totalUser'];
    }, $courses2);
  

    $data = [
      'courses' => $courses,
      'courses2' => $courses2,
      'userCount' => $userCount
    ];


    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courses', $data);
    $this->view('admin/layouts/footer');
  }

  public function modules() {
    $model = $this->loadElearningModel();
    $courseId = $_GET['courseId'];

    $data['elearningModule'] = $model['elearningModule']->getModuleBy($courseId);

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
        $filename = uniqid() . '.' . $fileType;
        $destination = 'elearningAssets/videos/' .  basename($filename . 'mp4');
      
        // Move the uploaded file to the uploads folder
        move_uploaded_file($konten['tmp_name'], $destination);

        // var_dump(BASEURL . $destination);
        $model['elearningLesson']->addLesson($_GET['moduleId'], $judul, $destination);
        header("Location:" . BASEURL . 'elearningmanagement/modules?courseId=' . $_GET['courseId']);
      }
    } else {
      echo "please fill the lesson name and content";
    }

    // if(isset($_FILES['pdf_file'])){
    //   $pdf = $_FILES['pdf_file'];
    
    //   // Check if file is a PDF
    //   if($pdf['type'] != 'application/pdf'){
    //     // Return error message
    //     echo "Error: Only PDF files are allowed.";
    //     return;
    //   }
    
    //   // Generate a unique file name
    //   $fileName = md5(uniqid()) . '.pdf';
    
    //   // Set upload directory
    //   $uploadDir = 'uploads/';
    
    //   // Check if upload directory exists, if not create it
    //   if (!file_exists($uploadDir)) {
    //     mkdir($uploadDir, 0777, true);
    //   }
    
    //   // Save PDF file to upload directory
    //   move_uploaded_file($pdf['tmp_name'], $uploadDir . $fileName);
    // }


  }

  public function courseTestRecord() {
    $model = $this->loadElearningModel();

    $data['course'] = $model['elearningCourse']->getCourseDetail($_GET['courseId']);
    $data['testRecord'] = $model['userTestRecord']->getAllUserRecord($_GET['courseId']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courseTestRecord', $data);
    $this->view('admin/layouts/footer');
  }
  
  

}
  