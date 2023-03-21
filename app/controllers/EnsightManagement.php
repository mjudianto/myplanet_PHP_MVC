<?php

class EnsightManagement extends Controller
{

  public function uploadEnsight()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');

    $data['ensight'] = $ensightModel->getAll();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/ensight/uploadEnsight', $data);
    $this->view('admin/layouts/footer');
  }

  public function deleteEnsight()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');
    $ensightModel->deleteEnsight($_GET['ensightId']);

    header("Location:" . BASEURL . 'ensightmanagement/uploadEnsight');
  }

  public function editEnsight()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');
    $ensightId = $_GET['ensightId'];

    $judul = $_POST['judulEnsight-' . $_GET['ensightId']];
    $publish = $_POST['publish-' . $_GET['ensightId']];

    $ensightId = $_GET['ensightId'];
    $thumbnail = $this->saveThumbnail($_FILES['updateThumbnail-' . $ensightId] ?? null, 'ensightAssets/thumbnail');
    $video = $this->saveVideo($_FILES['updateVideo-' . $ensightId] ?? null, 'ensightAssets/videos');
    $defaultVideo = $_POST['defaultVideo-' . $ensightId] ?? null;
    $defaultThumbnail = $_POST['defaultThumbnail-' . $ensightId] ?? null;

    $ensightModel->updateEnsight($ensightId, $judul, $thumbnail ?: $defaultThumbnail, $video ?: $defaultVideo, $publish);

    header("Location:" . BASEURL . 'ensightmanagement/uploadEnsight');
  }

  public function newEnsight()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');
    $judul = $_POST['newJudul'];
    $publish = $_POST['newPublish'];
    $deskripsi = $_POST['newDeskripsi'] ?? null;
    $thumbnail = $this->saveThumbnail($_FILES['newThumbnail'] ?? null, 'ensightAssets/thumbnail');
    $video = $this->saveVideo($_FILES['newVideo'] ?? null, 'ensightAssets/videos');

    $ensightModel->createEnsight($judul, $thumbnail, $video, $publish, $publish, $deskripsi);
    header("Location:" . BASEURL . 'ensightmanagement/uploadEnsight');
  }

  public function dateFilter()
  {
    $ensightModel = $this->model('ensight/Ensight_model', 'Ensight_model');

    $start_date = $_REQUEST['startDate'];
    $end_date = $_REQUEST['endDate'];

    $data = $ensightModel->getAll();


    $filtered_data = array_filter($data, function ($item) use ($start_date, $end_date) {
      $item_date = strtotime($item['uploadDate']);
      $start = strtotime($start_date);
      $end = strtotime($end_date);

      if ($_REQUEST['startDate'] != '') {
        if ($_REQUEST['endDate'] != '') {
          return ($item_date >= $start) && ($item_date <= $end);
        } else {
          return ($item_date >= $start);
        }
      } else {
        if ($_REQUEST['endDate'] != '') {
          return ($item_date <= $end);
        }
      }
      return;
    });

    $i = 1;
    foreach ($filtered_data as $ensight) {
      echo '<tr>
              <td>' . $i . '</td>
              <td>' . $ensight['judul'] . '</td>
              <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                    src="' . $ensight['thumbnail'] . '"
                    style="width: 130px; display:block; margin: 0 auto;"
                    alt="No-Image"></a>
              </td>
              <td>' . $ensight['publishDate'] . '</td>
              <td>';
      if ($ensight['state'] == 1) {
        echo '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">Active</div>';
      } else {
        echo '<div class="badge rounded-pill text-white bg-secondary p-2 text-uppercase px-3">Inactive</div>';
      }
      echo   '</td>
              <td>' . $ensight['uploadDate'] . '</td>
              <td>
                <div class="d-flex order-actions">
                  <a href="" class="text-primary bg-light-primary border-0"
                    data-bs-toggle="modal" data-bs-target="#modalEdit-' . $ensight['ensightId'] . '"><i
                      class="bx bxs-edit"></i></a>
                  <a href="" class="ms-2 text-danger bg-light-danger border-0"
                    data-bs-toggle="modal" data-bs-target="#deleteModal-' . $ensight['ensightId'] . '"><i
                      class="bx bxs-trash"></i></a>
                </div>
              </td>
            </tr>';
      $i += 1;
    }
  }

  public function ensightVisitor()
  {
    $this->view('admin/layouts/sidebar');
    $this->view('admin/ensight/ensightVisitor');
    $this->view('admin/layouts/footer');
  }
}
