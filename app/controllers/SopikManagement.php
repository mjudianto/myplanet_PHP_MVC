<?php

class SopikManagement extends Controller
{
  public function index()
  {
    $elearningModel = $this->loadElearningModel();

    $data['sopik'] = $elearningModel['elearningModule']->countUserAkses();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/sopik/managementSopik', $data);
    $this->view('admin/layouts/footer');
  }

  public function reportSopik()
  {
    $this->view('admin/layouts/sidebar');
    $this->view('admin/sopik/reportSopik');
    $this->view('admin/layouts/footer');
  }

  public function sopikLessonRecord() {
    $model = $this->loadElearningModel();

    $data = $model['userLessonRecord']->getSopikLessonRecord();

    $this->serverSideDatatables($data);
  }

  public function editSopik()
  {
    $elearningModel = $this->loadElearningModel();

    $data['sopik'] = $elearningModel['elearningModule']->getSpesificModule($_GET['moduleId']);
    $data['sopikLesson'] = $elearningModel['elearningLesson']->getLessonBy($_GET['moduleId']);
    $data['sopikTest'] = $elearningModel['elearningTest']->getTestBy($_GET['moduleId']);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/sopik/editSopik', $data);
    $this->view('admin/layouts/footer');
  }
}
