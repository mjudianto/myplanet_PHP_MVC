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

  public function upload(){
    $target_dir = "podtret/poster/";
    $file = $_FILES["poster"];
    $file_name = basename($file["name"]);
    $target_file = $target_dir . $file_name;
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
      $check = getimagesize($file["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
      } else {
        echo "File is not an image.";
        $upload_ok = 0;
      }
    }

    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $upload_ok = 0;
    }

    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($image_file_type, $allowed_types)) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $upload_ok = 0;
    }

    if ($upload_ok == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars($file_name) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

  }

  public function filterDate() {
    $model = $this->loadPodtretModel();

    isset($_REQUEST['podtretId']) ? $podtretId = $_REQUEST['podtretId'] : '';
    $data = $_REQUEST['data'];
    $start_date = $_REQUEST['startDate'];
    $end_date = $_REQUEST['endDate'];
    $columnName = $_REQUEST['columnName'];

    $data == 'podtret' || $data == 'podtretVisitor' ? $data = $model['podtret']->getAll() :  $data = $model['podtret']->getPodtretDetail($podtretId);
    // $data == 'podtretVisitorDetail' ?? $data = $model['podtret']->getPodtretDetail($podtretId);

    $filtered_data = array_filter($data, function($item) use ($start_date, $end_date, $columnName) {
      $item_date = new DateTime($item[$columnName]);
      $start = new DateTime($start_date);
      $end = new DateTime($end_date);

      if (isset($_REQUEST['startDate'])) {
        if (isset($_REQUEST['endDate'])) {
          return ($item_date >= $start) && ($item_date <= $end);
        } else {
          return ($item_date >= $start);
        }
      }

      if (isset($_REQUEST['endDate'])) {
        return ($item_date <= $end);
      }
      
    });

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
  }

  public function podtretVisitor() {
    $model = $this->loadPodtretModel();

    $data['podtret'] = $model['podtret']->getAll();

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/podtretVisitor', $data);
    $this->view('admin/layouts/footer');
  }

  public function filterDatePodtretVisitor() {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];

    $model = $this->loadPodtretModel();

    $data['podtret'] = $model['podtret']->getAll();

    $columnName = 'uploadDate';
    // Filter the data based on the date range
    $filtered_data = $this->filterDate($data['podtret'], $start_date, $end_date, $columnName);

    $data['podtret'] = $filtered_data;

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

  public function filterDatePodtretVisitorDetail() {
    $start_date = $_POST['startDate'];
    $end_date = $_POST['endDate'];

    $model = $this->loadPodtretModel();
    $podtretId = $_POST['podtretId'];

    $data['podtretDetail'] = $model['podtret']->getPodtretDetail($podtretId);

    $columnName = 'lastVisit';
    // Filter the data based on the date range
    $filtered_data = $this->filterDate($data['podtretDetail'], $start_date, $end_date, $columnName);

    $data['podtretDetail'] = $filtered_data;

    $this->view('admin/layouts/sidebar');
    $this->view('admin/podtret/podtretVisitorDetail', $data);
    $this->view('admin/layouts/footer');
  }

}
  