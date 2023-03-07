<?php 

class Home extends Controller{

  public function index() {
    $podtretModel = $this->loadPodtretModel();
    $elearningModel = $this->loadElearningModel();

    $podtrets = $podtretModel['podtret']->getAllActivePodtret();
    $elearnings = $elearningModel['elearningCourse']->getAll();

    $data = [
      'podtrets' => array_slice($podtrets, 0, 6),
      'elearnings' => array_slice($elearnings, 0, 4),
    ];

    $this->view('layouts/navbar');
    $this->view('home', $data);
    $this->view('layouts/home_footer');
  }

  public function tutorial() {
    $this->view('layouts/navbar');
    $this->view('tutorial');
    $this->view('layouts/page_footer');
  }

}