<?php 

class Login extends Controller{

  public function index() {
    // $data['users'] =  $this->model('User_model')->getAllUsers();
    $this->view('auth/login');
  }

  public function createUserSession($user) {
    $_SESSION['user'] = $user;
    header("Location: " . BASEURL);
    exit;
  }


  public function auth() {
    $user =  $this->model('User_model')->userAuth($_POST['nik'], $_POST['password']);
    
    if ($user == false) {
      $_SESSION['falseLoginInfo'] = true;
      header("Location: " . BASEURL . 'login');
      exit;
    } else {
      $_SESSION['falseLoginInfo'] = false;
      $this->model('User_model')->updateLastVisit($user);
      $this->createUserSession($user);
    }
  }

  public function logout() {
    session_destroy();
    header("Location: " . BASEURL);
    exit;
  }

}