<?php 

class ElearningManagement extends Controller {

  public function courseCategory() {
    $model = $this->loadElearningModel();

    $data['kategori'] = $model['elearningKategori']->getKategoriDetail();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/elearning/courseCategory', $data);
    $this->view('admin/layouts/footer');
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

  public function addLesson() {
    if (isset($_FILES['video'])) {
      $video = $_FILES['video'];
    
      // Ensure the file is a valid video file
      $fileType = pathinfo($video['name'], PATHINFO_EXTENSION);
      if (!in_array($fileType, ['mp4', 'webm', 'ogg'])) {
        echo "Error: Invalid video format.";
        exit;
      }
    
      // Validate the size of the video
      if ($video['size'] > 100000000) { // 100 MB
        echo "Error: Video file size too large.";
        exit;
      }
    
      // Generate a unique filename for the video
      $filename = uniqid() . '.' . $fileType;
      $destination = 'uploads/' . $filename;
    
      // Move the uploaded file to the uploads folder
      move_uploaded_file($video['tmp_name'], $destination);
    }

    if(isset($_FILES['pdf_file'])){
      $pdf = $_FILES['pdf_file'];
    
      // Check if file is a PDF
      if($pdf['type'] != 'application/pdf'){
        // Return error message
        echo "Error: Only PDF files are allowed.";
        return;
      }
    
      // Generate a unique file name
      $fileName = md5(uniqid()) . '.pdf';
    
      // Set upload directory
      $uploadDir = 'uploads/';
    
      // Check if upload directory exists, if not create it
      if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
      }
    
      // Save PDF file to upload directory
      move_uploaded_file($pdf['tmp_name'], $uploadDir . $fileName);
    }
  }

}
  