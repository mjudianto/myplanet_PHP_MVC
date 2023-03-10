<?php 

class Profile extends Controller {

  public function index() {
    isset($_SESSION['user']['empnik']) ? $nik = $_SESSION['user']['empnik'] : $nik = $_SESSION['user']['userNik'];
    $data['userRecord'] = $this->model('elearning/lesson/userRecord/UserLessonRecord_model', 'UserLessonRecord_model')->getCourseRecord($nik);
    $data['userTestRecord'] = $this->model('elearning/test/userRecord/UserTestRecordDetail_model', 'UserTestRecordDetail_model')->getCourseRecord($nik);

    $this->view('layouts/navbar');
    $this->view('profile/profile', $data);
    $this->view('layouts/page_footer');
  }

  public function changeProfile() {
    $this->view('layouts/navbar');
    $this->view('profile/change_profile');
    $this->view('layouts/page_footer');
  }

  public function changePassword() {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $newPasswordConfirm = $_POST['newPasswordConfirm'];

    if ($newPassword == $newPasswordConfirm) {
      if ( sha1($currentPassword) == $_SESSION['user']['password'] ) {
        $this->model('user/User_model', 'User_model')->updateUserPassword($newPassword, $_GET['nik']);
        session_destroy();
      }
    }
    
    header("Location: " . BASEURL . 'login');
    exit;
  }

}