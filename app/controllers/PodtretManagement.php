<?php 

class PodtretManagement extends Controller {

  public function uploadPodtret() {
    $model = $this->loadPodtretModel();

    $data['podtret'] = $model['podtret']->getAll();

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


}
  