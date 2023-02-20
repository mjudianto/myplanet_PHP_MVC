<?php 

class PodtretManagement extends Controller {

  public function uploadPodtret() {
    $model = $this->loadPodtretModel();

    $data['podtret'] = $model['podtret']->getAll();
    $data['podtretKategori'] = $model['podtretKategori']->getAllKategori();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/uploadPodtret', $data);
    $this->view('admin/layouts/footer');
  }

  public function filterDate() {
    $model = $this->loadPodtretModel();

    isset($_REQUEST['podtretId']) ? $podtretId = $_REQUEST['podtretId'] : '';
    $data = $_REQUEST['data'];
    $start_date = $_REQUEST['startDate'];
    $end_date = $_REQUEST['endDate'];
    $columnName = $_REQUEST['columnName'];

    $data == 'podtret' || $data == 'podtretVisitor' ? $data = $model['podtret']->getAll() : '';
    $data == 'podtretVisitorDetail' ? $data = $model['podtret']->getPodtretDetail($podtretId) : '';
    
    if ($data == 'podtretComment') {
      $data = $model['podtretRecord']->getUserCommentRecord();
      $data2 = $model['podtretRecord']->getUserReplyRecord();
    } 

    $filtered_data = array_filter($data, function($item) use ($start_date, $end_date, $columnName) {
      $item_date = strtotime($item[$columnName]);
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
      
    });

    if (isset($data2)) {
      $filtered_data2 = array_filter($data2, function($item) use ($start_date, $end_date, $columnName) {
        $item_date = strtotime($item[$columnName]);
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
        
      });
    }

    $i=1;
    if ($_REQUEST['data'] == 'podtret'){
      foreach($filtered_data as $podtret) {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $podtret['judul'] . '</td>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster-' . $podtret['podtretId'] . '"><img
                      src="' . $podtret['thumbnail'] . '"
                      style="width: 130px; display:block; margin: 0 auto;"
                      alt="edisi-pildun"></a>
                </td>
                <td>#' . $podtret['nama'] . '</td>
                <td>' . $podtret['uploadDate'] . '</td>';
        if ($podtret['state'] == 1){
          echo  '<td>
                  <div
                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                    Active
                  </div>
                </td>';
        } else {
          echo  '<td>
                  <div
                    class="badge rounded-pill text-white bg-secondary p-2 text-uppercase px-3">
                    Inactive
                  </div>
                </td>';
        }
        echo   '<td>' . $podtret['uploadDate'] . '</td>
                <td>
                  <div class="d-flex order-actions">
                    <a href="javascript:;" class="text-primary bg-light-primary border-0"
                      data-bs-toggle="modal" data-bs-target="#' . $podtret['podtretId'] . '"><i
                        class="bx bxs-edit"></i></a>
                    <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"
                      data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                        class="bx bxs-trash"></i></a>
                  </div>
                </td>
              </tr>';
        $i+=1;
      }
    }

    if ($_REQUEST['data'] == 'podtretVisitor') {
      if(isset($filtered_data)){
        foreach($filtered_data as $podtret) {
          echo '<tr>
                  <td>' . $i . '</td>
                  <td>' . $podtret['judul'] . '</td>
                  <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                        src="' . $podtret['thumbnail'] . '"
                        style="width: 130px; display:block;" alt="edisi-pildun"></a>
                  </td>
                  <td>' . $podtret['views'] . '</td>
                  <td class="text-center order-actions"><a href="' . BASEURL . 'podtretmanagement/podtretVisitorDetail?podtretId=' . $podtret['podtretId'] . '"
                      class="text-primary bg-light-primary border-0"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-eye text-primary">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                      </svg></a></td>
                </tr>';
          $i+=1;
        }
      }
    }

    if ($_REQUEST['data'] == 'podtretVisitorDetail') {
      foreach($filtered_data as $detail) {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $detail['judul'] . '</td>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                      src="' . $detail['thumbnail'] . '"
                      style="width: 130px; display:block;" alt="edisi-pildun"></a>
                </td>
                <td>' . $detail['nama'] . '</td>
                <td>' . $detail['visit'] . '</td>
                <td>' . $detail['lastVisit'] . '</td>
              </tr>';
        $i+=1;
      }
    }

    if ($_REQUEST['data'] == 'podtretComment') {
      foreach($filtered_data as $comment) {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $comment['nik'] . '</td>
                <td>' . $comment['nama'] . '</td>
                <td>' . $comment['comment'] . '</td>
                <td>' . $comment['judul'] . '</td>
                <td>' . $comment['uploadDate'] . '</td>
                <td>
                  <div class="d-flex order-actions">
                    <a href="javascript:;" class="text-primary bg-light-primary border-0"
                      data-bs-toggle="modal" data-bs-target="#modalEditComment"><i
                        class="bx bxs-edit"></i></a>
                    <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"
                      data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                        class="bx bxs-trash"></i></a>
                  </div>
                </td>
              </tr>';
        $i+=1;
      }

      foreach($filtered_data2 as $reply) {
        echo '<tr>
                <td>' . $i . '</td>
                <td>' . $reply['nik'] . '</td>
                <td>' . $reply['nama'] . '</td>
                <td>' . $reply['comment'] . '</td>
                <td>' . $reply['judul'] . '</td>
                <td>' . $reply['uploadDate'] . '</td>
                <td>
                  <div class="d-flex order-actions">
                    <a href="javascript:;" class="text-primary bg-light-primary border-0"
                      data-bs-toggle="modal" data-bs-target="#modalEditComment"><i
                        class="bx bxs-edit"></i></a>
                    <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"
                      data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                        class="bx bxs-trash"></i></a>
                  </div>
                </td>
              </tr>';
        $i+=1;
      }
    }
  }

  public function podtretVisitor() {
    $model = $this->loadPodtretModel();

    $data['podtret'] = $model['podtret']->getAll();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/podtretVisitor', $data);
    $this->view('admin/layouts/footer');
  }

  public function podtretVisitorDetail() {
    $model = $this->loadPodtretModel();
    $podtretId = $_GET['podtretId'];
    
    $data['podtretDetail'] = $model['podtret']->getPodtretDetail($podtretId);

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/podtretVisitorDetail', $data);
    $this->view('admin/layouts/footer');
  }

  public function podtretComment() {
    $model = $this->loadPodtretModel();

    $data['comment'] = $model['podtretRecord']->getUserCommentRecord();
    $data['reply'] = $model['podtretRecord']->getUserReplyRecord();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/podtretComment', $data);
    $this->view('admin/layouts/footer');
  }

  public function newPodtret() {
    $model = $this->loadPodtretModel();

    $judul = $_POST['newJudul'];
    $kategori = $_POST['newKategori'];
    $publish = $_POST['newPublish'];
    $thumbnail = $this->saveThumbnail($_FILES['newThumbnail'] ?? null, 'podtretAssets/thumbnail');
    $video = $this->saveVideo($_FILES['newVideo'] ?? null, 'podtretAssets/video');
    $audio = $this->saveAudio($_FILES['newAudio'] ?? null, 'podtretAssets/audio');
  
    $model['podtret']->newPodtret($kategori, $judul, $thumbnail, $video, $audio, $publish);
    header("Location:" . BASEURL . 'podtretmanagement/uploadPodtret');
  }

  public function updatePodtret() {
    $model = $this->loadPodtretModel();

    $podtretId = $_GET['podtretId'];
    $judul = $_POST['updateJudul-' . $podtretId];
    $kategori = $_POST['updateKategori-' . $podtretId];
    $publish = $_POST['updatePublish-' . $podtretId];

    $thumbnail = $this->saveThumbnail($_FILES['updateThumbnail-' . $podtretId] ?? null, 'podtretAssets/thumbnail');
    $defaultThumbnail = $_POST['defaultThumbnail-' . $podtretId] ?? null;

    $video = $this->saveVideo($_FILES['updateVideo-' . $podtretId] ?? null, 'podtretAssets/video');
    $defaultVideo = $_POST['defaultVideo-' . $podtretId] ?? null;

    $audio = $this->saveAudio($_FILES['updateAudio-' . $podtretId] ?? null, 'podtretAssets/audio');
    $defaultAudio = $_POST['defaultAudio-' . $podtretId] ?? null;

    $model['podtret']->updatePodtret($podtretId, $kategori, $judul, $thumbnail ?: $defaultThumbnail, $video ?: $defaultVideo, $audio ?: $defaultAudio, $publish);
    header("Location:" . BASEURL . 'podtretmanagement/uploadPodtret');
  }

}
  