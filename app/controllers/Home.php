<?php 

class Home extends Controller{

  public function index() {
    // $data['users'] =  $this->model('User_model')->getAllUsers();
    $this->view('layouts/navbar');
    $this->view('home');
    $this->view('layouts/home_footer');
  }

}