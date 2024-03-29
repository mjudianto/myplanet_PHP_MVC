<?php

class Elearning extends Controller
{

  public function index()
  {
    $this->view('layouts/navbar');
    $this->view('elearning/elearning');
    $this->view('layouts/page_footer');
  }

  public function filterKategori()
  {
    $_SESSION['selectedKategoriId'] = $_REQUEST['kategoriId'];
  }

  // This function loads all e-learning categories and outputs corresponding filter buttons
  public function loadKategori()
  {
    // Load the e-learning model to get all categories
    $model = $this->loadElearningModel();
    $elearningKategori = $model['elearningKategori']->getAllKategori();

    // Check which category is currently selected
    $selectedKategoriId = isset($_SESSION['selectedKategoriId']) ? $_SESSION['selectedKategoriId'] : 0;

    // Output the "All" button
    $curr = ($selectedKategoriId == 0) ? 'active' : '';
    echo '<a onclick="filterKategori(0)" class="ms-2 mt-2 d-inline-block"><button class="px-3 py-1 ' . $curr . '">All</button></a>';

    // Output buttons for each category
    foreach ($elearningKategori as $kategori) {
      $curr = ($selectedKategoriId == $kategori['elearningKategoriId']) ? 'active' : '';
      echo '<a onclick="filterKategori(' . $kategori['elearningKategoriId'] . ')" class="ms-2 mt-2 d-inline-block">';
      echo '<button class="px-3 py-1 ' . $curr . '">' . $kategori['nama'] . '</button>';
      echo '</a>';
    }
  }

  // Load the elearning Course
  public function loadCourse()
  {
    $model = $this->loadElearningModel();

    // Define a sorting function to sort courses by upload date in descending order
    function sortByUploadDateDesc($a, $b)
    {
      return strtotime($b["uploadDate"]) - strtotime($a["uploadDate"]);
    }

    // Get the user's NIK from the session
    $userNik = $_SESSION['user']['empnik'];

    // Get the selected category ID from the session
    $kategoriId = $_SESSION['selectedKategoriId'] ?? 0;

    // Get the courses based on the selected category ID, or get all courses if no category is selected
    if ($kategoriId == 5) {
      // If the selected category is 5, get SOP courses for the user
      $elearningCourse = $model['elearningCourse']->getSopCourse($userNik);
    } else {
      // Otherwise, get the courses based on the selected category ID, or get all courses if no category is selected
      $elearningCourse = $kategoriId != 0 ? $model['elearningCourse']->getCourseBy($kategoriId) : $model['elearningCourse']->getAllCourse();

      // Sort the courses by upload date in descending order
      usort($elearningCourse, "sortByUploadDateDesc");

      // Filter the courses to exclude those that the user has already completed
      $elearningCourse = $this->filterCourse($elearningCourse);
    }

    // Get the search term from the request parameter
    $search = $_REQUEST['search'] ?? '';

    // Define the search fields
    $searchFields = ['judul'];

    // Filter the courses that match the search term
    if ($search !== '') {
      $elearningCourse = array_filter($elearningCourse, function ($item) use ($searchFields, $search) {
        foreach ($searchFields as $field) {
          if (stripos($item[$field], $search) !== false) {
            return true;
          }
        }
        return false;
      });
    }


    // Get the search term from the request parameter
    $search = $_REQUEST['search'] ?? '';

    // Define the search fields
    $searchFields = ['judul'];

    // Filter the items that match the search term
    if ($search !== '') {
      $elearningCourse = array_filter($elearningCourse, function ($item) use ($searchFields, $search) {
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
              <div class="card card-learning" data-aos="zoom-in" data-aos-duration="400">
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
    echo '<div class="pagination-page d-flex justify-content-center"><a onclick="paginateCourse(' . $page - 1 . ')">&laquo;</a>';
    for ($i = 1; $i <= $totalPages; $i++) {
      // Highlight the active page
      $i == $page ? $active = 'active' : $active = "";
      echo '<a class="' . $active . '" onclick="paginateCourse(' . $i . ')">' . $i . '</a>';
    }
    echo '<a onclick="paginateCourse(' . $page + 1 . ')">&raquo;</a></div>';
  }

  function filterCourse($courses)
  {
    // Get the user's company, organization, and location IDs
    $companyId = $this->model('user/Company_model', 'Company_model')->getSpesificCompany(explode('-', $_SESSION['user']['orgname'])[0]);
    $organizationId = $this->model('user/Organization_model', 'Organization_model')->getSpesificOrganization(trim(explode('-', $_SESSION['user']['orgname'])[1]));
    $locationId = $this->model('user/Location_model', 'Location_model')->getSpesificLocation(trim(explode('-', $_SESSION['user']['LocationName'])[1]));

    // Define a filter function to use with array_filter
    $filterFunction = function ($course) use ($companyId, $organizationId, $locationId) {
      // Check if the course has a company ID
      if ($course['companyId'] !== null) {
        // Check if any of the IDs match
        $companyIdMatches = $companyId === $course['companyId'];
        $organizationIdMatches = $organizationId === $course['organizationId'];
        $locationIdMatches = $locationId === $course['locationId'];

        // Check if the course has both an organization ID and a location ID
        if ($course['organizationId'] !== null && $course['locationId'] !== null) {
          // Return true if all IDs match, or if the course has public access
          return $course['access_type'] === 0 || ($companyIdMatches && $organizationIdMatches && $locationIdMatches);
        }

        // Check if the course has an organization ID
        if ($course['organizationId'] !== null) {
          // Return true if the company ID and organization ID match, or if the course has public access
          return $course['access_type'] === 0 || ($companyIdMatches && $organizationIdMatches);
        }

        // Check if the course has a location ID
        if ($course['locationId'] !== null) {
          // Return true if the company ID and location ID match, or if the course has public access
          return $course['access_type'] === 0 || ($companyIdMatches && $locationIdMatches);
        }

        // Return true if only the company ID matches, or if the course has public access
        return $course['access_type'] === 0 || $companyIdMatches;
      }

      // Return true if the course has public access
      return $course['access_type'] === 0;
    };

    // Filter the courses array using the filter function
    $filteredCourse = array_filter($courses, $filterFunction);

    return $filteredCourse;
  }

  // This function loads all e-learning course modules and outputs corresponding lesson and test
  public function elearningModule()
  {
    // Load e-learning model and get user's NIk
    $model = $this->loadElearningModel();
    $userNik = $_SESSION['user']['empnik'];

    // Decrypt e-learning course ID and module ID from GET parameter
    $courseId = $this->decrypt($_GET['elearningCourseId']);
    $moduleId = $this->decrypt($_GET['moduleId'] ?? null);

    // Get e-learning module and course detail based on the decrypted IDs
    $data['elearningCourse'] = $model['elearningCourse']->getCourseDetail($courseId);
    $data['elearningModule'] = ($moduleId != '') ? $model['elearningModule']->getSpesificModule($moduleId) : $model['elearningModule']->getModuleBy($courseId);

    $data['elearningLesson'] = [];
    $data['elearningTest'] = [];
    $data['testRecord'] = [];

    // Loop through each module to get its lessons, tests, and user's test record
    foreach ($data['elearningModule'] as $module) {
      // Get lessons and tests for the module and store them in arrays
      $data['elearningLesson'][] = $model['elearningLesson']->getLessonBy($module['elearningModuleId']);
      $data['elearningTest'][] = $model['elearningTest']->getTestBy($module['elearningModuleId']);

      // Get user's test record for the module and store it in an array
      $data['testRecord'][] = $model['userTestRecord']->getTestRecord($userNik, $module['elearningModuleId']);
    }

    $data['maxedAttempt'] = function ($testId) {
      $model = $this->loadElearningModel();

      // get user information
      $userNik = $_SESSION['user']['empnik'];

      $userTestRecord = $model['userTestRecord']->getUserTestRecord($testId, $userNik);
      if (is_bool($userTestRecord)) {
        $userTestRecordId = null;
        $userTestRecordAttempt = 0;
      } else {
        $userTestRecordId = $userTestRecord['userTestRecordId'];
        $userTestRecordAttempt = $userTestRecord['attempt'];
      }

      // if user test record already exists, check if user has exceeded max attempt
      $maxAttempt = $model['userTestMaxAttempt']->getTestMaxAttempt($userTestRecordId);
      if (is_bool($maxAttempt)) {
        $maxAttempt = 3;
      } else {
        $maxAttempt = $maxAttempt['maxAttempt'];
      }

      if ($userTestRecordAttempt + 1 > $maxAttempt) {
        return true;
      }

      return false;
    };

    // Load the necessary views
    $this->view('layouts/navbar');
    $this->view('elearning/elearningModule', $data);
    $this->view('layouts/page_footer');
  }

  public function elearningLesson()
  {
    $model = $this->loadElearningModel();

    $lessonId = $this->decrypt($_GET['elearningLessonId']);
    $data['elearningLesson'] = $model['elearningLesson']->getSpesificLesson($lessonId);
    $this->updateUserLessonAttempt($lessonId);

    $this->view('layouts/navbar');
    $this->view('elearning/elearningLesson', $data);
    $this->view('layouts/page_footer');
  }

  public function updateUserLessonAttempt($lessonId)
  {
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


  // This function loads the question for the test
  public function elearningTest()
  {
    // load e-learning model
    $model = $this->loadElearningModel();

    // get user information
    $userNik = $_SESSION['user']['empnik'];

    // decrypt the e-learning test id from the URL
    $elearningTestId = $this->decrypt($_GET['elearningTestId']);

    // get the e-learning test information
    $test = $model['elearningTest']->getSingleTest($elearningTestId);

    // get user test record
    $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userNik);

    // if user test record doesn't exist, create new user record and set max attempt
    if (!$userTestRecord) {
      $model['userTestRecord']->createUserRecord($elearningTestId, $userNik);
      $userTestRecord = $model['userTestRecord']->getUserTestRecord($elearningTestId, $userNik);
      $model['userTestMaxAttempt']->createTestMaxAttempt($userTestRecord['userTestRecordId']);
    }

    // get questions for the e-learning test
    $questions = $model['question']->getQuestionBy($elearningTestId);

    // if question number is specified in the test and there are more questions than the specified number, randomize questions
    if ($test['questionNumber'] != 0 && count($questions) > $test['questionNumber']) {
      $questions = array_rand($questions, $test['questionNumber']);
    }

    // shuffle questions and get choices for each question
    shuffle($questions);
    $choices = [];
    foreach ($questions as $question) {
      $choice = $model['choice']->getChoiceBy($question['questionId']);
      shuffle($choice);
      array_push($choices, $choice);
    }

    // prepare data to be passed to the view
    $data = [
      'elearningTest' => $test,
      'question' => $questions,
      'choice' => $choices,
      'numberOfQuestion' => count($questions),
    ];

    // load the e-learning test view with the prepared data
    $this->view('elearning/elearningTest', $data);
  }

  public function elearningTestSubmit()
  {
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
