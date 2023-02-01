<?php 

class UserManagement extends Controller {

  public function index() {
    $data['user'] = $this->model('user/User_model', 'User_model')->getAllUsers();
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userManagement', $data);
    $this->view('admin/layouts/footer');
  }

  public function addUser() {
    $data['nik'] = $_POST['nik'];
    $data['nama'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['locationId'] = $_POST['location'];
    $data['department'] = $_POST['organizationName'];

    $this->model('user/User_model', 'User_model')->addUser($data);
    header('location:' . BASEURL . 'usermanagement');
    exit;
  }

  public function userDetail() {
    $data['user'] = $this->model('user/User_model', 'User_model')->getUserBy('userId', $_GET['userId']);
    $data['location'] = $this->model('user/Location_model', 'Location_model')->getAllLocation();
    $data['userLesson'] = $this->model('user/User_model', 'User_model')->userLessonRecord($_GET['userId']);
    $data['userLessonDetail'] = $this->model('user/User_model', 'User_model')->userLessonRecordDetail($_GET['userId']);
    $data['userTest'] = $this->model('user/User_model', 'User_model')->userTestRecord($_GET['userId']);
    $data['userTestDetail'] = $this->model('user/User_model', 'User_model')->userTestRecordDetail($_GET['userId']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/user/userDetail', $data);
    $this->view('admin/layouts/footer');

    // var_dump($this->model('user/User_model', 'User_model')->userCourseDetail());
  }


}
  