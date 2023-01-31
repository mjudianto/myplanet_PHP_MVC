<?php 

class Elearning extends Controller {

  public function index() {
    $this->view('layouts/navbar');
    $this->view('elearning/elearning');
    $this->view('layouts/page_footer');
  }

  public function filterKategori() {
    $_SESSION['selectedKategoriId'] = $_REQUEST['kategoriId'];
  }

  public function loadKategori() {
    $model = $this->loadElearningModel();
    $elearningKategori = $model['elearningKategori']->getAllKategori();

    $curr = '';
    isset($_SESSION['selectedKategoriId']) && $_SESSION['selectedKategoriId'] == 0 || !isset($_SESSION['selectedKategoriId'])? $curr = 'active' : $curr = '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class=' . $curr . '>All</button></a>';
    foreach ($elearningKategori as $kategori) {
      isset($_SESSION['selectedKategoriId']) && $_SESSION['selectedKategoriId'] == $kategori['elearningKategoriId'] ? $curr = 'active' : $curr = '';
      echo '<a onclick="filterKategori(' . $kategori['elearningKategoriId'] .')" class="ms-2 d-inline-block"><button class= "' . $curr . '">' . $kategori['nama'] . '</button></a>';
    } 
  }

  public function loadCourse() {
    $model = $this->loadElearningModel();

    $elearningCourse = $model['elearningCourse']->getAllCourse();

    if (isset($_SESSION['selectedKategoriId'])) {
      $kategoriId = $_SESSION['selectedKategoriId'];
      if ($kategoriId != 0){
        $elearningCourse = $model['elearningCourse']->getCourseBy('elearningKategoriId', $kategoriId);
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
                <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '"><img src="' . $course['thumbnail'] .
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
    $model = $this->loadElearningModel();

    $data['elearningModule'] = $model['elearningModule']->getModuleBy('elearningCourseId',  $this->decrypt($_GET['elearningCourseId']));
    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];
    foreach($data['elearningModule'] as $module){
      $lessons = $model['elearningLesson']->getLessonBy('elearningModuleId', $module['elearningModuleId']);
      array_push($data['elearningLesson'], $lessons);

      $test = $model['elearningTest']->getTestBy('elearningModuleId', $module['elearningModuleId']);
      array_push($data['elearningTest'], $test);
    }

    $this->view('layouts/navbar');
    $this->view('elearning/elearningModule', $data);
    $this->view('layouts/page_footer');
  }

  public function elearningLesson() {
    $model = $this->loadElearningModel();

    $data['elearningLesson'] = $model['elearningLesson']->getSpesificLesson('elearningLessonId', $_GET['elearningLessonId']);
    $this->updateUserLessonAttempt($_GET['elearningLessonId']);
    $this->view('layouts/navbar');
    $this->view('elearning/elearningLesson', $data);
    $this->view('layouts/page_footer');
  }

  public function updateUserLessonAttempt($lessonId) {
    $model = $this->loadElearningModel();

    $userRecord = $model['userLessonRecord']->getUserLessonRecord('elearningLessonId', 'userId', $lessonId, $_SESSION['user']['userId']);
    if($userRecord == false) {
      $model['userLessonRecord']->createUserRecord($lessonId, $_SESSION['user']['userId']);
    } else {
      $attempt = $userRecord['attempt']+1;
      $model['userLessonRecord']->updateUserAttempt('elearningLessonId', 'userId', $lessonId, $_SESSION['user']['userId'], $attempt);
    }
  }

  public function elearningTest() {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];

    $data['elearningTest'] = $model['elearningTest']->getTestBy('elearningModuleId', $_GET['elearningModuleId']);
    $elearningTestId = $data['elearningTest']['elearningTestId'];

    $userTestRecord = $model['userTestRecord']->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
    if (!$userTestRecord) {
      $model['userTestRecord']->createUserRecord($elearningTestId, $userId);
      $userTestRecord = $model['userTestRecord']->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
      $model['userTestMaxAttempt']->createTestMaxAttempt($userTestRecord['userTestRecordId']);
    } else {
      $maxAttempt = $model['userTestMaxAttempt']->getTestMaxAttempt('userTestRecordId', $userTestRecord['userTestRecordId']);
      if ($userTestRecord['attempt']+1 > $maxAttempt['maxAttempt']) {
        header("Location: " . BASEURL . "elearning");
        exit;
      }
    }

    $data['question'] = $model['question']->getQuestionBy('elearningTestId', $elearningTestId);
    $data['choice'] = [];
    foreach($data['question'] as $question){
      $choice = $model['choice']->getChoiceBy('questionId', $question['questionId']);
      array_push($data['choice'], $choice);
    }
    $data['numberOfQuestion'] = $model['question']->countQuestion('elearningTestId', $elearningTestId);

    $this->view('elearning/elearningTest', $data);
  }

  public function elearningTestSubmit() {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];

    $data['elearningTest'] = $model['elearningTest']->getTestBy('elearningTestId', $_GET['elearningTestId']);
    $elearningTestId = $data['elearningTest']['elearningTestId'];

    $data['questions'] = $model['question']->getQuestionBy('elearningTestId', $elearningTestId);
    isset($_POST['selectedChoice']) ? $choice = $_POST['selectedChoice'] : $choice = '';

    $i=1;
    $data['resultDetail'] = [];
    $data['score'] = 0;
    foreach($data['questions'] as $question) {
      $answer = $model['answer']->getQuestionAnswer('questionId', $question['questionId']);
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
    $userTestRecord = $model['userTestRecord']->getUserTestRecord('elearningTestId', 'userId', $elearningTestId, $userId);
    $model['userTestRecordDetail']->createTestRecordDetail($userTestRecord['userTestRecordId'], $userTestRecord['attempt']+1, $status, $data['score']);
    $model['userTestRecord']->updateUserAttempt('elearningTestId', 'userId', $elearningTestId, $userId, $userTestRecord['attempt']+1);

    $status == 'Lulus' ? $data['lulus'] = true : $data['lulus'] = false;

    $this->view('elearning/elearningTestResult', $data);
  }

}