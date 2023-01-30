<?php 

class Elearning extends Controller {

  public function index() {
    $data['elearningKategori'] = $this->model('ElearningKategori_model')->getAllKategori();
    $data['elearningCourse'] = $this->model('ElearningCourse_model')->getAllCourse();

    $this->view('layouts/navbar');
    $this->view('elearning/elearning', $data);
    $this->view('layouts/page_footer');
  }

  public function filterKategori() {
    $_SESSION['selectedKategoriId'] = $_REQUEST['kategoriId'];
  }

  public function loadKategori() {
    $elearningKategori = $this->model('ElearningKategori_model')->getAllKategori();

    $curr = '';
    isset($_SESSION['selectedKategoriId']) && $_SESSION['selectedKategoriId'] == 0 ? $curr = 'active' : $curr = '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class=' . $curr . '>All</button></a>';
    foreach ($elearningKategori as $kategori) {
      isset($_SESSION['selectedKategoriId']) && $_SESSION['selectedKategoriId'] == $kategori['elearningKategoriId'] ? $curr = 'active' : $curr = '';
      echo '<a onclick="filterKategori(' . $kategori['elearningKategoriId'] .')" class="ms-2 d-inline-block"><button class= "' . $curr . '">' . $kategori['nama'] . '</button></a>';
    } 
  }

  public function loadCourse() {
    $elearningCourse = $this->model('ElearningCourse_model')->getAllCourse();

    if (isset($_SESSION['selectedKategoriId'])) {
      $kategoriId = $_SESSION['selectedKategoriId'];
      if ($kategoriId != 0){
        $elearningCourse = $this->model('ElearningCourse_model')->getCourseBy('elearningKategoriId', $kategoriId);
      }
    }
    
    echo '<!-- Floating Button -->
          <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <img src="assets/ic-arrow-up.png" alt="" width="24" />
          </button>
          <!-- Floating Button -->';
    foreach ($elearningCourse as $course) {
      echo '<div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
                <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $course['elearningCourseId'] . '"><img src="' . $course['thumbnail'] .
                    '" class="card-img-top py-2 px-2" alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-learning">
                    <a href="e-learning-neopgeneral.html">' . $course['judul'] . '</a>
                  </h5>
                  <div class="row">
                    <div class="col">
                      <p class="card-text-learning">
                        <img src="assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" class="" />
                        26 Lesson
                      </p>
                    </div>
                    <div class="col">
                      <a href="e-learning-neopgeneral.html" class="btn-go">
                        <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                      <!-- <a href="#" class="btn btn-go">Go</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>';
    } 
  }

  public function elearningModule() {
    $data['elearningModule'] = $this->model('ElearningModule_model')->getModuleBy('elearningCourseId', $_GET['elearningCourseId']);
    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];
    foreach($data['elearningModule'] as $module){
      $lessons = $this->model('ElearningLesson_model')->getLessonBy('elearningModuleId', $module['elearningModuleId']);
      array_push($data['elearningLesson'], $lessons);

      $test = $this->model('ElearningTest_model')->getTestBy('elearningModuleId', $module['elearningModuleId']);
      array_push($data['elearningTest'], $test);
    }

    $this->view('layouts/navbar');
    $this->view('elearning/elearningModule', $data);
    $this->view('layouts/page_footer');
  }

  public function elearningLesson() {
    $data['elearningLesson'] = $this->model('ElearningLesson_model')->getSpesificLesson('elearningLessonId', $_GET['elearningLessonId']);
    $this->updateUserLessonAttempt($_GET['elearningLessonId']);
    $this->view('layouts/navbar');
    $this->view('elearning/elearningLesson', $data);
    $this->view('layouts/page_footer');
  }

  public function updateUserLessonAttempt($lessonId) {
    $userRecord = $this->model('UserLessonRecord_model')->getUserLessonRecord('elearningLessonId', 'userId', $lessonId, $_SESSION['user']['userId']);
    if($userRecord == false) {
      $this->model('UserLessonRecord_model')->createUserRecord($lessonId, $_SESSION['user']['userId']);
    } else {
      $attempt = $userRecord['attempt']+1;
      $this->model('UserLessonRecord_model')->updateUserAttempt('elearningLessonId', 'userId', $lessonId, $_SESSION['user']['userId'], $attempt);
    }
  }

  public function elearningTest() {
    $userId = $_SESSION['user']['userId'];

    $data['elearningTest'] = $this->model('ElearningTest_model')->getTestBy('elearningModuleId', $_GET['elearningModuleId']);
    $elearningTestId = $data['elearningTest']['elearningTestId'];

    $userTestRecord = $this->model('UserTestRecord_model')->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
    if (!$userTestRecord) {
      $this->model('UserTestRecord_model')->createUserRecord($elearningTestId, $userId);
      $userTestRecord = $this->model('UserTestRecord_model')->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
      $this->model('UserTestMaxAttempt_model')->createTestMaxAttempt($userTestRecord['userTestRecordId']);
    } else {
      $maxAttempt = $this->model('UserTestMaxAttempt_model')->getTestMaxAttempt('userTestRecordId', $userTestRecord['userTestRecordId']);
      if ($userTestRecord['attempt']+1 > $maxAttempt['maxAttempt']) {
        header("Location: " . BASEURL . "elearning");
        exit;
      }
    }

    $data['question'] = $this->model('Question_model')->getQuestionBy('elearningTestId', $elearningTestId);
    $data['choice'] = [];
    foreach($data['question'] as $question){
      $choice = $this->model('Choice_model')->getChoiceBy('questionId', $question['questionId']);
      array_push($data['choice'], $choice);
    }
    $data['numberOfQuestion'] = $this->model('Question_model')->countQuestion('elearningTestId', $elearningTestId);

    $this->view('elearning/elearningTest', $data);
  }

  public function elearningTestSubmit() {
    $userId = $_SESSION['user']['userId'];

    $data['elearningTest'] = $this->model('ElearningTest_model')->getTestBy('elearningTestId', $_GET['elearningTestId']);
    $elearningTestId = $data['elearningTest']['elearningTestId'];

    $data['questions'] = $this->model('Question_model')->getQuestionBy('elearningTestId', $elearningTestId);
    isset($_POST['selectedChoice']) ? $choice = $_POST['selectedChoice'] : $choice = '';

    $i=1;
    $data['resultDetail'] = [];
    $data['score'] = 0;
    foreach($data['questions'] as $question) {
      $answer = $this->model('Answer_model')->getQuestionAnswer('questionId', $question['questionId']);
      if (isset($choice[$i])) {
        if ($choice[$i] == $answer['answerId']) {
          array_push($data['resultDetail'], 'Correct');
          $data['score'] += $question['score'];
        } else {
          array_push($data['resultDetail'], 'False');
        }
      } else {
        array_push($data['resultDetail'], 'Blank');
      }
      $i+=1;
    }

    $data['score']<$data['elearningTest']['passingScore'] ? $status = 'Gagal' : $status = "Lulus";
    $userTestRecord = $this->model('UserTestRecord_model')->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
    $this->model('UserTestRecordDetail_model')->createTestRecordDetail($userTestRecord['userTestRecordId'], $userTestRecord['attempt']+1, $status, $data['score']);
    $this->model('UserTestRecord_model')->updateUserAttempt('elearningTestId', 'userId', $elearningTestId, $userId, $userTestRecord['attempt']+1);

    $status == 'Lulus' ? $data['lulus'] = true : $data['lulus'] = false;

    $this->view('elearning/elearningTestResult', $data);
  }

  

}