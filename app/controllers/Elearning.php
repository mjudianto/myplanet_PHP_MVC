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
        if ($kategoriId == 5) {
          $elearningCourse = $model['elearningCourse']->getSopCourse();
        } else {
          $elearningCourse = $model['elearningCourse']->getCourseBy($kategoriId, $_SESSION['user']['organizationId'], $_SESSION['user']['userId']);
        }
      }
    }

    $pageSize = ceil(sizeof($elearningCourse)/8);
    $page = $_REQUEST['page'] ?? 1;
    for ($i = 1 ; $i<=$page ; $i++) {
      if (sizeof($elearningCourse) > 8) {
        // Slice the first 8 values into a new array
        $paginateCourse = array_slice($elearningCourse, 0, 8);

        // Remove the first 8 values from the original array
        array_splice($elearningCourse, 0, 8);
      } else {
        $paginateCourse = $elearningCourse;
      }
    }

    echo '<!-- Floating Button -->
          <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <img src="assets/ic-arrow-up.png" alt="" width="24" />
          </button>
          <!-- Floating Button -->';
    foreach ($paginateCourse as $course) {
      $lessonCount = $model['elearningCourse']->countLesson($course['elearningCourseId']);
      $testCount = $model['elearningCourse']->countTest($course['elearningCourseId']);
      isset($course['thumbnail']) != '' ? $thumbnail = $course['thumbnail'] : $thumbnail = BASEURL . 'assets/noImage.jpeg';
      isset($course['elearningModuleId']) != '' ? $moduleId = $course['elearningModuleId'] : $moduleId = '';

      echo '<div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
                <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '&moduleId=' . $this->encrypt($moduleId) . '"><img src="' . $thumbnail .
                    '" class="card-img-top py-2 px-2" alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-learning">
                    <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '&moduleId=' . $this->encrypt($moduleId) . '">' . $course['judul'] . '</a>
                  </h5>
                  <div class="row">
                    <div class="col">
                      <p class="card-text-learning">
                        <img src="assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" class="" />
                        ' . $lessonCount['total lesson'] + $testCount['total test'] . ' Lesson
                      </p>
                    </div>
                    <div class="col">
                      <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '&moduleId=' . $this->encrypt($moduleId) . '" class="btn-go">
                        <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                      <!-- <a href="#" class="btn btn-go">Go</a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>';
    } 
    echo '<div class="pagination-page d-flex justify-content-center"><a onclick="paginateCourse(' . $page-1 . ')">&laquo;</a>';
    for ($i=1 ; $i<=$pageSize ; $i++) {
      $i == $page ? $active = 'active' : $active = "";
      echo '<a class="' . $active . '" onclick="paginateCourse(' . $i . ')">' . $i . '</a>';
    } 
      echo '<a onclick="paginateCourse(' . $page+1 . ')">&raquo;</a>
          </div>';
  }

  public function elearningModule() {
    $model = $this->loadElearningModel();

    $courseId = $this->decrypt($_GET['elearningCourseId']);
    $moduleId = $this->decrypt($_GET['moduleId'] ?? null);

    if ($moduleId != ''){
      $data['elearningModule'] = $model['elearningModule']->getSpesificModule($moduleId);
    } else {
      $data['elearningModule'] = $model['elearningModule']->getModuleBy($courseId);
    }

    $data['elearningCourse'] = $model['elearningCourse']->getCourseDetail($courseId);
    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];
    $data['testRecord'] = [];

    foreach ($data['elearningModule'] as $module) {
      $moduleId = $module['elearningModuleId'];

      $lessons = $model['elearningLesson']->getLessonBy($moduleId);
      array_push($data['elearningLesson'], $lessons);

      $test = $model['elearningTest']->getTestBy($moduleId);
      array_push($data['elearningTest'], $test);

      $testRecord = $model['userTestRecord']->getTestRecord($_SESSION['user']['userId'], $moduleId); 
      $data['testRecord'][] = $testRecord;
    }


    $this->view('layouts/navbar');
    $this->view('elearning/elearningModule', $data);
    $this->view('layouts/page_footer');
  }

  public function elearningLesson() {
    $model = $this->loadElearningModel();

    $lessonId = $this->decrypt($_GET['elearningLessonId']);
    $data['elearningLesson'] = $model['elearningLesson']->getSpesificLesson($lessonId);
    $this->updateUserLessonAttempt($lessonId);

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
    $elearningTestId = $this->decrypt($_GET['elearningTestId']);

    $test = $model['elearningTest']->getSingleTest($elearningTestId);

    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userId);
    if (!$userTestRecord) {
      $model['userTestRecord']->createUserRecord($elearningTestId, $userId);
      $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userId);
      $model['userTestMaxAttempt']->createTestMaxAttempt($userTestRecord['userTestRecordId']);
    } else {
      $maxAttempt = $model['userTestMaxAttempt']->getTestMaxAttempt($userTestRecord['userTestRecordId']);
      if ($userTestRecord['attempt'] + 1 > $maxAttempt['maxAttempt']) {
        header("Location: " . BASEURL . "elearning");
        exit;
      }
    }

    $questions = $model['question']->getQuestionBy($elearningTestId);
    if ($test['questionNumber'] != 0 && count($questions) > $test['questionNumber']) {
      $questions = array_rand($questions,$test['questionNumber']);
    }
    shuffle($questions);
    $choices = [];
    foreach ($questions as $question) {
      $choice = $model['choice']->getChoiceBy($question['questionId']);
      shuffle($choice); 
      array_push($choices, $choice);
    }

    $data = [
      'elearningTest' => $test,
      'question' => $questions,
      'choice' => $choices,
      'numberOfQuestion' => count($questions),
    ];

    $this->view('elearning/elearningTest', $data);
  }

  public function elearningTestSubmit() {
    $model = $this->loadElearningModel();

    $userId = $_SESSION['user']['userId'];
    $elearningTestId = $_GET['elearningTestId'];

    $elearningTest = $model['elearningTest']->getSingleTest($elearningTestId);
    
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