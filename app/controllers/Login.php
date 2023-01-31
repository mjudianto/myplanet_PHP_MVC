<?php 

class Login extends Controller{

  public function index() {
    $this->view('auth/login');
  }

  public function createUserSession($user) {
    $notificationModel =  $this->model('user/Notification_model', 'Notification_model');
    $_SESSION['user'] = $user;
    $_SESSION['notification'] = $notificationModel->getUserNotification('userId', $user['userId']);
  }


  public function auth() {
    $userModel = $this->model('user/User_model', 'User_model');
    $user = $userModel->userAuth($_POST['nik'], $_POST['password']);
    
    if ($user == false) {
      $_SESSION['falseLoginInfo'] = true;
      header("Location: " . BASEURL . 'login');
      exit;
    } else {
      $_SESSION['falseLoginInfo'] = false;
      $userModel->updateLastVisit($user);
      $this->createUserSession($user);
      isset($_SESSION['page']) ? header("Location: " . BASEURL . $_SESSION['page']) : header("Location: " . BASEURL);
      exit;
    }
  }

  public function logout() {
    session_destroy();
    header("Location: " . BASEURL);
    exit;
  }

}