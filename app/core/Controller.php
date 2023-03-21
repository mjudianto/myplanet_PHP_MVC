<?php 


class Controller {

  public function view($view, $data = []) {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($modelPath, $model) {
    require_once '../app/models/' . $modelPath . '.php';
    return new $model;
  }

  public function encryptionDetail() {
    $ciphering = "AES-128-CTR";

    // Using OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '9dj37f8wjr091834';

    // Storing the encryption key
    $encryption_key = "snfjkdsnjkvanljdbfj";

    return array($ciphering, $iv_length, $options, $encryption_iv, $encryption_key);
  }

  public function encrypt($string) {
    list($ciphering, $iv_length, $options, $encryption_iv, $encryption_key) = $this->encryptionDetail();
    $encryption = openssl_encrypt($string ?? "", $ciphering, $encryption_key, $options, $encryption_iv);

    return $encryption;
  }

  public function decrypt($string) {
    list($ciphering, $iv_length, $options, $encryption_iv, $encryption_key) = $this->encryptionDetail();
    $decryption = openssl_decrypt($string ?? "", $ciphering, $encryption_key, $options, $encryption_iv);

    return $decryption;
  }

  public function loadElearningModel() {
    $model['elearningKategori'] = $this->model('elearning/ElearningKategori_model', 'ElearningKategori_model');

    $model['elearningCourse'] = $this->model('elearning/ElearningCourse_model', 'ElearningCourse_model');
    $model['userCourseAkses'] = $this->model('elearning/UserElearningCourseAkses_Model', 'UserElearningCourseAkses_Model');

    $model['elearningModule'] = $this->model('elearning/ElearningModule_model', 'ElearningModule_model');

    $model['elearningLesson'] = $this->model('elearning/lesson/ElearningLesson_model', 'ElearningLesson_model');
    $model['elearningTest'] = $this->model('elearning/test/ElearningTest_model', 'ElearningTest_model');

    $model['userLessonRecord'] = $this->model('elearning/lesson/userRecord/UserLessonRecord_model', 'UserLessonRecord_model');

    $model['userTestRecord'] = $this->model('elearning/test/userRecord/UserTestRecord_model', 'UserTestRecord_model');
    $model['userTestRecordDetail'] = $this->model('elearning/test/userRecord/UserTestRecordDetail_model', 'UserTestRecordDetail_model');
    $model['userTestMaxAttempt'] = $this->model('elearning/test/userRecord/UserTestMaxAttempt_model', 'UserTestMaxAttempt_model');
    $model['question'] = $this->model('elearning/test/Question_model', 'Question_model');
    $model['choice'] = $this->model('elearning/test/Choice_model', 'Choice_model');
    $model['answer'] = $this->model('elearning/test/Answer_model', 'Answer_model');


    return $model;
  }

  public function loadPodtretModel() {
    $model['podtretKategori'] = $this->model('podtret/PodtretKategori_model', 'PodtretKategori_model');
    $model['podtret'] = $this->model('podtret/Podtret_model', 'Podtret_model');
    $model['podtretLike'] = $this->model('podtret/PodtretLike_model', 'PodtretLike_model');
    $model['podtretComment'] = $this->model('podtret/PodtretComment_model', 'PodtretComment_model');
    $model['podtretCommentReply'] = $this->model('podtret/PodtretCommentReply_model', 'PodtretCommentReply_model');
    $model['podtretRecord'] = $this->model('podtret/UserPodtretRecord_model', 'UserPodtretRecord_model');

    return $model;
  }

  public function saveFile($file, $allowedExtensions, $maxSize, $destinationDir, $destinationExtension) {
    if (!isset($file)) {
      return null;
    }
    $fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
    if (!in_array($fileType, $allowedExtensions)) {
        echo "Error: File only accepts " . implode(', ', $allowedExtensions) . " file types.";
        return null;
    }
    if ($file['size'] > $maxSize) {
        echo "Error: File size too large (maximum " . $maxSize / 1000000 . " MB).";
        return null;
    }
    $filename = uniqid();
    $destination = $destinationDir . '/' . basename($filename . $destinationExtension);
    move_uploaded_file($file['tmp_name'], $destination);
    $destination = '/public/' . $destination;
    return $destination;
  }
  
  public function saveThumbnail($thumbnail, $destinationDir) {
      return $this->saveFile($thumbnail, ['jpg', 'png', 'jpeg'], 5000000, $destinationDir, 'png');
  }
  
  public function saveVideo($video, $destinationDir) {
      return $this->saveFile($video, ['mp4', 'webm', 'ogg'], 1000000000, $destinationDir, 'mp4');
  }

  public function saveAudio($audio, $destinationDir) {
    return $this->saveFile($audio, ['mp3'], 500000000, $destinationDir, 'mp3');
  }

  public function serverSideDatatables($data) {
    // Get total data length
    $dataLength = count($data);
    
    // Search the data
    $search = $_POST['search']['value'] ?? '';
    if (!empty($search)) {
      $terms = explode(' ', $search);
      $data = array_filter($data, function($row) use ($terms) {
        foreach ($terms as $term) {
          $found = false;
          foreach ($row as $value) {
            if (is_string($value) && strpos(strtolower($value), strtolower($term)) !== false) {
              $found = true;
              break;
            }
          }
          if (!$found) {
            return false;
          }
        }
        return true;
      });
    }

    $filteredDataLength = count($data);

    // Paginate the data
    $start = $_POST['start'] ?? 0;
    $length = $_POST['length'] ?? 10;
    $data = array_slice($data, $start, $length);

    // Prepare the response for DataTables
    $response = array(
      "draw" => intval($_POST['draw'] ?? 0),
      "recordsTotal" => $dataLength,
      "recordsFiltered" => $filteredDataLength, // Change this to the unfiltered data length
      "data" => $data
    );

    echo json_encode($response);
  }
  
}