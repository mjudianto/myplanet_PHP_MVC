<?php 

class UserManagement extends Controller {

  public function index() {
    $data['user'] = $this->model('user/User_model', 'User_model')->getAllUsers();
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();
    $data['organization'] = $this->model('user/Organization_model', 'Organization_model')->getAllOrganization();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userManagement', $data);
    $this->view('admin/layouts/footer');
  }

  public function addUser() {
    $data['nik'] = $_POST['nik'];
    $data['nama'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['locationId'] = $_POST['location'];
    $data['department'] = $_POST['organization'];

    $this->model('user/User_model', 'User_model')->addUser($data);
    header('location:' . BASEURL . 'usermanagement');
    exit;
  }

  public function userDetail() {
    $model = $this->loadElearningModel();

    $data['user'] = $this->model('user/User_model', 'User_model')->getUserBy('userId', $_GET['userId']);
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();

    $data['userLesson'] = $model['userLessonRecord']->userLessonRecord($_GET['userId'], $_GET['userOrganization']);
    $data['userTest'] = $model['userTestRecord']->userTestRecord($_GET['userId'], $_GET['userOrganization']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userDetail', $data);
    $this->view('admin/layouts/footer');

  }

  public function loadUserCourseRecordDetail() {
    $model = $this->loadElearningModel();

    $courseId = $_REQUEST['courseId'];
    $userId = $_REQUEST['userId'];

    $data['userLessonDetail'] = $model['userLessonRecord']->userLessonRecordDetail($userId, $courseId);
    $data['userTestDetail'] = $model['userTestRecord']->userTestRecordDetail($userId, $courseId);
    
    foreach($data['userLessonDetail'] as $lessonDetail) {
      echo  '<tr>
              <td>' . $lessonDetail['judul lesson'] . '</td>
              <td>' . $lessonDetail['attempt'] . '</td>
              <td></td>
              <td class="">
              </td>
              <td>' . $lessonDetail['finished'] . '</td>
            </tr>';
    }

    foreach($data['userTestDetail'] as $testDetail) {
      echo  '<tr>
              <td>' . $testDetail['judul test'] . '</td>
              <td>' . $testDetail['attempt'] . '</td>
              <td>' . $testDetail['score'] . '</td>
              <td class="">' . $testDetail['status'] . '</td>
              <td>' . $testDetail['finished'] . '</td>
            </tr>';
    }
  }


}
  