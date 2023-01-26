<?php 

class Community extends Controller {

  public function index() {
    $this->view('layouts/navbar');
    $this->view('community/community');
    // $this->view('layouts/page_footer');
  }

}