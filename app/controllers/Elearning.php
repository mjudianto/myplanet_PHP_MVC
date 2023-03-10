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
    echo '<a onclick="filterKategori(0)" class="ms-2 mt-2 d-inline-block"><button class="px-3 py-1 ' . $curr . '">All</button></a>';

    // Output buttons for each category
    foreach ($elearningKategori as $kategori) {
      $curr = ($selectedKategoriId == $kategori['elearningKategoriId']) ? 'active' : '';
      echo '<a onclick="filterKategori(' . $kategori['elearningKategoriId'] .')" class="ms-2 mt-2 d-inline-block">';
      echo '<button class="px-3 py-1 ' . $curr . '">' . $kategori['nama'] . '</button>';
      echo '</a>';
    } 

  }

  public function loadCourse() {
    $model = $this->loadElearningModel();
    $organizationModel = $this->model('user/Organization_model', 'Organization_model');
    $companyModel = $this->model('user/Company_model', 'Company_model');
    $jobModel = $this->model('user/Job_model', 'Job_model');

    function sortByUploadDateDesc($a, $b) {
      return strtotime($b["uploadDate"]) - strtotime($a["uploadDate"]);
    }

    $userNik = $_SESSION['user']['empnik'];

    $organizationName = explode('-', $_SESSION['user']['orgname'])[1];
    $organizationId = $organizationModel->getSpesificOrganization(trim($organizationName));

    $companyName = explode('-', $_SESSION['user']['orgname'])[0];
    $companyId = $companyModel->getSpesificCompany($companyName);

    $jobName = $_SESSION['user']['Jobtitle'];
    $jobId = $jobModel->getSpesificJob($jobName);
    
    if (isset($_SESSION['selectedKategoriId'])) {
        $kategoriId = $_SESSION['selectedKategoriId'];
        if ($kategoriId != 0) {
            if ($kategoriId == 5) {
                $elearningCourse = $model['elearningCourse']->getSopCourse($userNik);
            } else {
                $elearningCourse = $model['elearningCourse']->getCourseBy($kategoriId, $organizationId, $userNik);
                usort($elearningCourse, "sortByUploadDateDesc");
            }
        } else {
            $elearningCourse = $model['elearningCourse']->getAllCourse($organizationId, $userNik, $companyId, $jobId);
            usort($elearningCourse, "sortByUploadDateDesc");
        }
    } else {
        $elearningCourse = $model['elearningCourse']->getAllCourse($organizationId, $userNik, $companyId, $jobId);
        usort($elearningCourse, "sortByUploadDateDesc");
    }

    // Get the search term from the request parameter
    $search = $_REQUEST['search'] ?? '';

    // Define the search fields
    $searchFields = ['judul'];

    // Filter the items that match the search term
    if ($search !== '') {
        $elearningCourse = array_filter($elearningCourse, function($item) use ($searchFields, $search) {
            foreach ($searchFields as $field) {
                if (stripos($item[$field], $search) !== false) {
                    return true;
                }
            }
            return false;
        });
    }

    // Define the number of items per page
    $itemsPerPage = 8;

    // Get the total number of items and calculate the total number of pages
    $totalItems = count($elearningCourse);
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Get the current page from the request parameter
    $page = max(1, ($_REQUEST['page'] ?? 1));

    // Calculate the starting index and length of the slice
    $startIndex = ($page - 1) * $itemsPerPage;
    $sliceLength = min($itemsPerPage, $totalItems - $startIndex);

    // Slice the array based on the current page
    $paginateCourse = array_slice($elearningCourse, $startIndex, $sliceLength);
    
    // Floating Button
    echo '<button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
      <img src="assets/ic-arrow-up.png" alt="" width="24" />
    </button>';
    // Floating Button

    // Loop through the paginated courses and display them
    foreach ($paginateCourse as $course) {
      // Get the total lesson count for the course
      $lessonCount = $model['elearningCourse']->countLesson($course['elearningCourseId']);
      
      // Get the total test count for the course
      $testCount = $model['elearningCourse']->countTest($course['elearningCourseId']);
      
      // Set the thumbnail to the course thumbnail or default to noImage.jpeg
      isset($course['thumbnail']) != '' ? $thumbnail = $course['thumbnail'] : $thumbnail = BASEURL . 'assets/noImage.jpeg';
      
      // Set the module ID to the course module ID or leave blank
      isset($course['elearningModuleId']) != '' ? $moduleId = $course['elearningModuleId'] : $moduleId = '';

      // Display the course card
      echo '<div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
                <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '&moduleId=' . $this->encrypt($moduleId) . '"><img src="' . $thumbnail .
                    '" class="card-img-top py-2 px-2" alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-learning">
                    <a
                    style="display: block;
                    width: 15vw;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;" 
                    id="judul" href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $this->encrypt($course['elearningCourseId']) . '&moduleId=' . $this->encrypt($moduleId) . '">' . $course['judul'] . '</a>
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

    // Display the pagination links
    echo '<div class="pagination-page d-flex justify-content-center"><a onclick="paginateCourse(' . $page-1 . ')">&laquo;</a>';
    for ($i=1 ; $i<=$totalPages ; $i++) {
      // Highlight the active page
      $i == $page ? $active = 'active' : $active = "";
      echo '<a class="' . $active . '" onclick="paginateCourse(' . $i . ')">' . $i . '</a>';
    } 
    echo '<a onclick="paginateCourse(' . $page+1 . ')">&raquo;</a></div>';
  }

  public function elearningModule() {
    // Load e-learning model
    $model = $this->loadElearningModel();
    $userNik = $_SESSION['user']['empnik'];

    // Decrypt e-learning course ID and module ID from GET parameter
    $courseId = $this->decrypt($_GET['elearningCourseId']);
    $moduleId = $this->decrypt($_GET['moduleId'] ?? null);

    // Get e-learning module and course detail based on the decrypted IDs
    if ($moduleId != '') {
    $data['elearningModule'] = $model['elearningModule']->getSpesificModule($moduleId);
    } else {
    $data['elearningModule'] = $model['elearningModule']->getModuleBy($courseId);
    }
    $data['elearningCourse'] = $model['elearningCourse']->getCourseDetail($courseId);

    // Initialize arrays to store e-learning lesson, test, and user's test record
    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];
    $data['testRecord'] = [];

    // Loop through each module and get its lessons, tests, and user's test record
    foreach ($data['elearningModule'] as $module) {
    $moduleId = $module['elearningModuleId'];

    // Get lessons and tests for the module and store them in arrays
    $lessons = $model['elearningLesson']->getLessonBy($moduleId);
    array_push($data['elearningLesson'], $lessons);
    $test = $model['elearningTest']->getTestBy($moduleId);
    array_push($data['elearningTest'], $test);

    // Get user's test record for the module and store it in an array
    $testRecord = $model['userTestRecord']->getTestRecord($userNik, $moduleId);
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
    $userNik = $_SESSION['user']['empnik'];


    
    $userRecord = $model['userLessonRecord']->getUserLessonRecord($lessonId, $userNik);

    if (!$userRecord) {
      $model['userLessonRecord']->createUserRecord($lessonId, $userNik);
    } else {
      $attempt = $userRecord['attempt'] + 1;
      $model['userLessonRecord']->updateUserAttempt($lessonId, $userNik, $attempt);
    }

  }

  public function elearningTest() {
    $model = $this->loadElearningModel();

    $userNik = $_SESSION['user']['empnik'];
    
    $elearningTestId = $this->decrypt($_GET['elearningTestId']);

    $test = $model['elearningTest']->getSingleTest($elearningTestId);

    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userNik);
    if (!$userTestRecord) {
      $model['userTestRecord']->createUserRecord($elearningTestId, $userNik);
      $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userNik);
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

    $userNik = $_SESSION['user']['empnik'];
    
    $elearningTestId = $_GET['elearningTestId'];

    $elearningTest = $model['elearningTest']->getSingleTest($elearningTestId);
    
    $questions = $model['question']->getQuestionBy($elearningTestId);
    $selectedChoices = $_POST['selectedChoice'] ?? [];
    
    $results = [];
    $score = 0;
    // print_r(isset($selectedChoices[24]));
    foreach ($questions as $question) {
      $answer = $model['answer']->getQuestionAnswer($question['questionId']);
      $selectedChoice = $selectedChoices[$question['questionId']] ?? "";
      
      if (isset($selectedChoices[$question['questionId']])) {
        if ($selectedChoice == $answer['answerId']) {
          $results[] = 'Correct';
          $score += $question['score'];
        } elseif ($selectedChoices) {
          $results[] = 'False';
        }
      } else {
        $results[] = 'Blank';
      } 
    }
    
    $status = $score >= $elearningTest['passingScore'] ? "Lulus" : 'Gagal';
    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userNik);
    $attempt = $userTestRecord['attempt'] + 1;
    
    $model['userTestRecordDetail']->createTestRecordDetail($userTestRecord['userTestRecordId'], $attempt, $status, $score);
    $model['userTestRecord']->updateUserAttempt($elearningTestId, $userNik, $attempt);
    
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