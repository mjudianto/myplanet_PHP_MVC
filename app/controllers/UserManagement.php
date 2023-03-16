<?php

class UserManagement extends Controller
{

  public function index()
  {
    $data['user'] = $this->model('user/User_model', 'User_model')->getAllUsers();
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();
    $data['organization'] = $this->model('user/Organization_model', 'Organization_model')->getAllOrganization();

    // $data['user'] = array_slice($data['user'], 0, 1000);
    // $user = array($user);

    // echo sha1(123);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userManagement', $data);
    $this->view('admin/layouts/footer');
  }

  public function addUser()
  {
    $data['nik'] = $_POST['nik'];
    $data['nama'] = $_POST['name'];
    $data['email'] = $_POST['email'] ?? null;
    $data['locationId'] = $_POST['location'];
    $data['department'] = $_POST['organization'];

    $this->model('user/User_model', 'User_model')->addUser($data);
    header('location:' . BASEURL . 'usermanagement');
    exit;
  }

  public function userDetail()
  {
    $model = $this->loadElearningModel();

    $userId = $_GET['userId'];
    $organization = $_GET['organizationId'];
    $user = $this->model('user/User_model', 'User_model')->getPlanetUser($userId);

    $data = [
      'user' => $user,
      'location' => $this->model('user/Location_model', 'Location_model')->getAllLocation(),
      'userLesson' => $model['userLessonRecord']->userLessonRecord($userId, $organization, $user['companyId'], $user['locationId']),
      'userTest' => $model['userTestRecord']->userTestRecord($userId, $organization),
      'course' => $model['elearningCourse']->getPrivateCourse($organization, $userId)
    ];


    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userDetail', $data);
    $this->view('admin/layouts/footer');
  }

  public function loadUserCourseRecordDetail()
  {
    $model = $this->loadElearningModel();

    $courseId = $_REQUEST['courseId'] ?? null;
    $userId = $_REQUEST['userId'] ?? null;

    if (!$courseId || !$userId) {
      return;
    }

    $userLessonDetail = $model['userLessonRecord']->userLessonRecordDetail($userId, $courseId);
    $userTestDetail = $model['userTestRecord']->userTestRecordDetail($userId, $courseId);

    $data = [
      'lesson' => $userLessonDetail,
      'test' => $userTestDetail,
    ];

    foreach ($data as $type => $details) {
      foreach ($details as $detail) {
        echo '<tr>';
        echo '<td>' . $detail['judul ' . $type] . '</td>';
        echo '<td class="text-center">' . $detail['attempt'] . '</td>';

        if ($type === 'test') {
          echo '<td class="text-center">' . $detail['score'] . '</td>';
          if ($detail['score'] == '') {
            echo '<td class="text-center"></td>';
          } else {
            echo '<td class="text-center">' . $detail['status'] . '</td>';
          }
        } else {
          echo '<td class="text-center"></td>';
          echo '<td class="text-center"></td>';
        }

        echo '<td class="text-center">' . $detail['finished'] . '</td>';
        if ($type === 'test') {
          echo '<td class="text-center order-actions-single"><a
                  class="text-primary bg-light-primary border-0 me-2"
                  data-bs-toggle="modal" data-bs-target="#modalActionCourse-' . $detail['userTestRecordId'] . '"><i
                    class="bx bxs-edit"></i></a></td>';
        } else {
          echo '<td class="text-center"></td>';
        }
        echo '</tr>';
      }
    }
  }

  public function loadTestAction()
  {
    $model = $this->loadElearningModel();

    $courseId = $_REQUEST['courseId'] ?? null;
    $userId = $_REQUEST['userId'] ?? null;
    $organizationId = $_REQUEST['organizationId'] ?? null;

    if (!$courseId || !$userId) {
      return;
    }

    $userTestDetail = $model['userTestRecord']->userTestRecordDetail($userId, $courseId);


    foreach ($userTestDetail as $test) {
      $maxAttempt = $model['userTestMaxAttempt']->getTestMaxAttempt($test['userTestRecordId']) ?? null;
          echo '<!-- Modal BOX Action Course -->
                <div class="modal fade" id="modalActionCourse-' . $test['userTestRecordId'] . '" tabindex="-1" aria-labelledby="modalActionCourseLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalActionCourseLabel">' . $test['judul test'] . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                          aria-label="Close"></button>
                      </div>
                      <div class="modal-body" style="text-align:center;">';
                      if ($test['score'] == '') {
                        echo '<p>Course ' . $test['judul test'] . ' have not been attempted. <br>
                                No action needed.
                              </p>
                              </div>';
                      }
                      else if ($maxAttempt != null &&  $maxAttempt['maxAttempt'] <= $test['attempt']) {
                        echo '<p>Course ' . $test['judul test'] . ' have reach it"s max attempt. <br>
                                Open the course Akses?
                              </p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-target="#modalViewDetail"
                                  data-bs-toggle="modal">No</button>
                                <a type="button" href="' . BASEURL . 'usermanagement/IncreaseMaxAttempt?testRecordId=' . $test['userTestRecordId'] . '&userId=' . $userId . '&organizationId=' . $organizationId . '" class="btn btn-primary">Yes</a>
                              </div>';
                      } 
                      else {
                        echo '<p>Course ' . $test['judul test'] . ' have been passed. <br>
                                No action needed.
                              </p>
                              </div>';
                      }
          echo       '</div>
                  </div>
                </div>';

    }
  }

  public function addUserPrivateCourse()
  {
    $model = $this->loadElearningModel();

    $model['userCourseAkses']->createUserPermission($_POST['selectedCourseId'], $_POST['userId']);

    header("location:" . $_POST['url']);
  }

  public function IncreaseMaxAttempt() {
    $model = $this->loadElearningModel();

    $testRecordId = $_GET['testRecordId'];
    $userNik = $_GET['userId'];
    $organizationId = $_GET['organizationId'];

    $attempt = $model['userTestMaxAttempt']->getTestMaxAttempt($testRecordId)['maxAttempt'];

    $model['userTestMaxAttempt']->updateMaxAttempt($testRecordId, $attempt+3);
    header("Location:" . BASEURL . 'usermanagement/userDetail?userId=' . $userNik . '&organizationId=' . $organizationId);
    exit;
  }
}
