<?php 

class Admins extends Controller {

  public function index() {
    // $this->view('admin/auth/login');
    $this->view('admin/layouts/sidebar');
    $this->view('admin/dashboard');
    $this->view('admin/layouts/footer');
  }

  public function login() {
    $user = $this->model('admin/auth/Admin_model', 'Admin_model')->userAuth($_POST['username'], $_POST['password']);

    // $user ? $this->dashboard() : exit;
  }

  // public function dashboard() {
  //   $this->view('admin/layouts/sidebar');
  //   $this->view('admin/dashboard');
  //   $this->view('admin/layouts/footer');
  // }

}
  