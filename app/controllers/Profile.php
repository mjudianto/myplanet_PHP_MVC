<?php 

class Profile extends Controller {

  public function index() {
    $model = $this->loadElearningModel();

    isset($_SESSION['user']['empnik']) ? $nik = $_SESSION['user']['empnik'] : $nik = $_SESSION['user']['userNik'];
    $user = $this->model('user/User_model', 'User_model')->getPlanetUser($nik);
    

    $data = [
      'userRecord' => $this->model('elearning/lesson/userRecord/UserLessonRecord_model', 'UserLessonRecord_model')->getCourseRecord($nik),
      'userTestRecord' => $this->model('elearning/test/userRecord/UserTestRecordDetail_model', 'UserTestRecordDetail_model')->getCourseRecord($nik),
      'userLesson' => $model['userLessonRecord']->userSertificate($nik),
      'userTest' => $model['userTestRecord']->userSertificate($nik),
    ];

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

  public function sertifikat() {
    $this->view('profile/sertifikat');
  }

}