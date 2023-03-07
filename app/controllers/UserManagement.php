<?php 

class UserManagement extends Controller {

  public function index() {
    $data['user'] = $this->model('user/User_model', 'User_model')->getAllUsers();
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();
    $data['organization'] = $this->model('user/Organization_model', 'Organization_model')->getAllOrganization();

    $data['user'] = array_slice($data['user'], 0, 1000);


    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userManagement', $data);
    $this->view('admin/layouts/footer');
  }

  public function addUser() {
    $data['nik'] = $_POST['nik'];
    $data['nama'] = $_POST['name'];
    $data['email'] = $_POST['email'] ?? null;
    $data['locationId'] = $_POST['location'];
    $data['department'] = $_POST['organization'];

    $this->model('user/User_model', 'User_model')->addUser($data);
    header('location:' . BASEURL . 'usermanagement');
    exit;
  }

  public function userDetail() {
    $model = $this->loadElearningModel();

    $userId = $_GET['userId'];
    $userdepartment = $_GET['userdepartment'];

    $data = [
      'user' => $this->model('user/User_model', 'User_model')->getUserBy('userId', $userId),
      'location' => $this->model('user/Location_model', 'Location_model')->getAllLocation(),
      'userLesson' => $model['userLessonRecord']->userLessonRecord($userId, $userdepartment),
      'userTest' => $model['userTestRecord']->userTestRecord($userId, $userdepartment),
      'course' => $model['elearningCourse']->getPrivateCourse($userdepartment, $userId)
    ];


    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userDetail', $data);
    $this->view('admin/layouts/footer');

  }

  public function loadUserCourseRecordDetail() {
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
            echo '<td>' . $detail['attempt'] . '</td>';
            
            if ($type === 'test') {
                echo '<td>' . $detail['score'] . '</td>';
                echo '<td>' . $detail['status'] . '</td>';
            } else {
                echo '<td></td>';
                echo '<td></td>';
            }
            
            echo '<td>' . $detail['finished'] . '</td>';
            echo '</tr>';
        }
    }

    // echo $courseId;


  }

  public function addUserPrivateCourse() {
    $model = $this->loadElearningModel();

    $model['userCourseAkses']->createUserPermission($_POST['selectedCourseId'], $_POST['userId']);

    header("location:" . $_POST['url']);
  }


}
  