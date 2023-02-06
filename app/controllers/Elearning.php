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
    $selectedKategoriId = isset($_SESSION['selectedKategoriId']) ? $_SESSION['selectedKategoriId'] : 0;

    // Output the "All" button
    $curr = ($selectedKategoriId == 0) ? 'active' : '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class="' . $curr . '">All</button></a>';

    // Output buttons for each category
    foreach ($elearningKategori as $kategori) {
      $curr = ($selectedKategoriId == $kategori['elearningKategoriId']) ? 'active' : '';
      echo '<a onclick="filterKategori(' . $kategori['elearningKategoriId'] .')" class="ms-2 d-inline-block">';
      echo '<button class="' . $curr . '">' . $kategori['nama'] . '</button>';
      echo '</a>';
    } 

  }

  public function loadCourse() {
    $model = $this->loadElearningModel();

    $elearningCourse = $model['elearningCourse']->getAllCourse($_SESSION['user']['organizationId'], $_SESSION['user']['userId']);

    if (isset($_SESSION['selectedKategoriId'])) {
      $kategoriId = $_SESSION['selectedKategoriId'];
      if ($kategoriId != 0){
        $elearningCourse = $model['elearningCourse']->getCourseBy($kategoriId, $_SESSION['user']['organizationId'], $_SESSION['user']['userId']);
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

    $courseId = $this->decrypt($_GET['elearningCourseId']);
    $data['elearningModule'] = $model['elearningModule']->getModuleBy($courseId);
    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];

    foreach ($data['elearningModule'] as $module) {
      $moduleId = $module['elearningModuleId'];

      $lessons = $model['elearningLesson']->getLessonBy($moduleId);
      array_push($data['elearningLesson'], $lessons);

      $test = $model['elearningTest']->getTestBy($moduleId);
      array_push($data['elearningTest'], $test);
    }


    $this->view('layouts/navbar');
    $this->view('elearning/elearningModule', $data);
    $this->view('layouts/page_footer');
  }

  public function elearningLesson() {
    $model = $this->loadElearningModel();

    $data['elearningLesson'] = $model['elearningLesson']->getSpesificLesson($_GET['elearningLessonId']);
    $this->updateUserLessonAttempt($_GET['elearningLessonId']);

    $this->view('layouts/navbar');
    $this->view('elearning/elearningLesson', $data);
    $this->view('layouts/page_footer');
  }

  public function updateUserLessonAttempt($lessonId) {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];
    $userRecord = $model['userLessonRecord']->getUserLessonRecord($lessonId, $userId);

    if (!$userRecord) {
      $model['userLessonRecord']->createUserRecord($lessonId, $userId);
    } else {
      $attempt = $userRecord['attempt'] + 1;
      $model['userLessonRecord']->updateUserAttempt($lessonId, $userId, $attempt);
    }

  }

  public function elearningTest() {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];
    $elearningTestId = $_GET['elearningTestId'];

    $test = $model['elearningTest']->getTestBy($elearningTestId);

    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userId);
    if (!$userTestRecord) {
      $userTestRecord = $model['userTestRecord']->createUserRecord($elearningTestId, $userId);
      $model['userTestMaxAttempt']->createTestMaxAttempt($userTestRecord['userTestRecordId']);
    } else {
      $maxAttempt = $model['userTestMaxAttempt']->getTestMaxAttempt($userTestRecord['userTestRecordId']);
      if ($userTestRecord['attempt'] + 1 > $maxAttempt['maxAttempt']) {
        header("Location: " . BASEURL . "elearning");
        exit;
      }
    }

    $questions = $model['question']->getQuestionBy($elearningTestId);
    $choices = [];
    foreach ($questions as $question) {
      $choice = $model['choice']->getChoiceBy($question['questionId']);
      array_push($choices, $choice);
    }

    $data = [
      'elearningTest' => $test,
      'question' => $questions,
      'choice' => $choices,
      'numberOfQuestion' => $model['question']->countQuestion($elearningTestId)
    ];


    $this->view('elearning/elearningTest', $data);
  }

  public function elearningTestSubmit() {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];
    $elearningTestId = $_GET['elearningTestId'];

    $elearningTest = $model['elearningTest']->getTestBy($elearningTestId);
    
    $questions = $model['question']->getQuestionBy($elearningTestId);
    $selectedChoices = $_POST['selectedChoice'] ?? [];
    
    $results = [];
    $score = 0;
    $i=1;
    foreach ($questions as $question) {
      $answer = $model['answer']->getQuestionAnswer($question['questionId']);
      $selectedChoice = $selectedChoices[$i] ?? '';
    
      if ($selectedChoice == $answer['answerId']) {
        $results[] = 'Correct';
        $score += $question['score'];
      } elseif ($selectedChoice == '') {
        $results[] = 'Blank';
      } else {
        $results[] = 'False';
      }
      $i+=1;
    }
    
    $status = $score >= $elearningTest['passingScore'] ? "Lulus" : 'Gagal';
    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userId);
    $attempt = $userTestRecord['attempt'] + 1;
    
    $model['userTestRecordDetail']->createTestRecordDetail($userTestRecord['userTestRecordId'], $attempt, $status, $score);
    $model['userTestRecord']->updateUserAttempt($elearningTestId, $userId, $attempt);
    
    $data = [
      'elearningTest' => $elearningTest,
      'questions' => $questions,
      'resultDetail' => $results,
      'score' => $score,
      'lulus' => $status === 'Lulus'
    ];
    
    $this->view('elearning/elearningTestResult', $data);
  }

}