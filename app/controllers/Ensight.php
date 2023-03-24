<?php

class Ensight extends Controller
{

  public function index()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');

    $data['ensight'] = $ensightModel->getActiveEnsight();

    $this->view('layouts/navbar');
    $this->view('ensight/ensight', $data);
    $this->view('layouts/page_footer');
  }

  public function ensightKonten()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');
    $userEnsightRecordModel = $this->model('ensight/userRecord/UserEnsightRecord_model', 'UserEnsightRecord_model');

    $ensightId = $this->decrypt($_GET['ensightId']);
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];
    $data['ensight'] = $ensightModel->getSpesificEnsigth($ensightId);

    $userRecord = $userEnsightRecordModel->getUserRecord($ensightId, $userNik);
    if (is_bool($userRecord)) {
      $userEnsightRecordModel->createUserRecord($ensightId, $userNik);
    } else {
      $userRecord = $userEnsightRecordModel->getUserRecord($ensightId, $userNik);
      $userEnsightRecordModel->updateUserRecordViews($ensightId, $userNik, $userRecord['views'] + 1);
    }

    $ensightModel->updateEnsightViews($ensightId, $data['ensight']['views'] + 1);
    $data['ensight']['views'] += 1;

    $this->view('layouts/navbar');
    $this->view('ensight/ensightKonten', $data);
    $this->view('layouts/page_footer');
  }
}
