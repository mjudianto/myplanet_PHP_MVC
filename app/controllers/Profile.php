<?php 

class Profile extends Controller {

  public function index() {
    $data['userRecord'] = $this->model('UserLessonRecord_model')->getCourseRecord('userId', $_SESSION['user']['userId']);
    $data['userTestRecord'] = $this->model('UserTestRecordDetail_model')->getCourseRecord('userId', $_SESSION['user']['userId']);

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
        $this->model('User_model')->updateUserPassword($newPassword);
        $_SESSION['user']['password'] = sha1($newPassword);
      }
    }
    
    header("Location: " . BASEURL . 'profile');
    exit;
  }

}