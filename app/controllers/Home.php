<?php 

class Home extends Controller{

  public function index() {
    $this->view('layouts/navbar');
    $this->view('home');
    $this->view('layouts/home_footer');
  }

}