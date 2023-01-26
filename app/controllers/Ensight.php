<?php 

class Ensight extends Controller {

  public function index() {
    $this->view('layouts/navbar');
    $this->view('ensight/ensight');
    $this->view('layouts/page_footer');
  }

}