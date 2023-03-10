<?php 

class Podtrets extends Controller {

  public function index() {
    $this->view('layouts/navbar');
    $this->view('podtrets/podtret');
    $this->view('layouts/page_footer');
  }

  public function filterKategori() {
    $_SESSION['selectedPodtretKategori'] = $_REQUEST['kategoriId'];
  }

  public function loadKategori() {
    $model = $this->loadPodtretModel();

    $podtretKategori = $model['podtretKategori']->getAllKategori();

    $curr = '';
    !isset($_SESSION['selectedPodtretKategori']) || isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == 0 ? $curr = 'active' : $curr = '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class="px-3 py-1' . $curr . '">All</button></a>';
    foreach ($podtretKategori as $kategori) {
      isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == $kategori['podtretKategoriId'] ? $curr = 'active' : $curr = '';
      echo '<a onclick="filterKategori(' . $kategori['podtretKategoriId'] .')" class="ms-2 d-inline-block mt-2"><button class= "px-3 py-1 ' . $curr . '">' . $kategori['nama'] . '</button></a>';
    } 
  }

  public function loadPodtret() {
    // Load the model
    $model = $this->loadPodtretModel();

    // Get all active podtrets
    $podtrets = $model['podtret']->getAllActivePodtret();

    // Filter podtrets by selected kategori, if any
    if (isset($_SESSION['selectedPodtretKategori'])) {
      $kategoriId = $_SESSION['selectedPodtretKategori'];
      if ($kategoriId != 0) {
        $podtrets = $model['podtret']->filterPodtret($kategoriId);
      }
    }

    // Pagination
    $pageSize = ceil(sizeof($podtrets) / 8); // 8 podtrets per page
    $page = $_REQUEST['page'] ?? 1;
    $paginatePodtret = array_slice($podtrets, ($page - 1) * 8, 8);
    
    echo '<!-- Floating Button -->
          <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <img src="assets/ic-arrow-up.png" alt="" width="24" />
          </button>
          <!-- Floating Button -->';

    foreach ($paginatePodtret as $podtret) {
      echo '<div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-page-podtret" data-aos="fade-down" data-aos-duration="950">
                <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '&views=' .$podtret['views'] . '"><img src="' . $podtret['thumbnail'] . '" class="card-img-top py-2 px-2"
                    alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-page-podtret">
                    <a 
                    style="display: block;
                    width: 15vw;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;"
                    href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '&views=' . $podtret['views'] . '">' . $podtret['judul'] . '</a>
                  </h5>
                  <div class="row mt-3">
                    <div class="col-10">
                      <p class="card-text-page-podtret">
                        ' . $podtret['views'] . 'x ditonton • ' . $this->dateFormatAsString($podtret['uploadDate']) . '
                      </p>
                    </div>
                    <div class="col d-none d-lg-block">
                      <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '&views=' . $podtret['views'] . '" class="btn-go-podtret">
                        <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-flex mt-2">
                    <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '&views=' . $podtret['views'] . '"><img src="assets/Button Nonton MP4.png" alt="" class="btn-opsi-play-podtret me-2"></a>
                    <a href="' . BASEURL . 'podtrets/podtretKonten?type=audio&podtretId=' . $this->encrypt($podtret['podtretId']) . '&views=' . $podtret['views'] . '"><img src="assets/Button Nonton MP3.png" alt="" class="btn-opsi-play-podtret"></a>
                  </div>
                </div>
              </div>
            </div>';
      } 
      echo '<div class="pagination-page d-flex justify-content-center"><a onclick="paginateCourse(' . $page-1 . ')">&laquo;</a>';
      for ($i=1 ; $i<=$pageSize ; $i++) {
        $i == $page ? $active = 'active' : $active = "";
        echo '<a class="' . $active . '" onclick="PaginatePodtret(' . $i . ')">' . $i . '</a>';
      } 
      echo '<a onclick="paginateCourse(' . $page+1 . ')">&raquo;</a>
          </div>';
  }

  public function dateFormatAsString($date) {
    $now = new DateTime(); // get the current date and time
    $originalDate = new DateTime($date); // create a DateTime object for the original date

    // calculate the difference between the original date and the current date
    $interval = $now->diff($originalDate);
    $string = '';
    // output the result based on the difference
    if ($interval->y > 0) {
        $string = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    } else if ($interval->m > 0) {
        $string = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    } else if ($interval->d > 0) {
        $string = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    } else if ($interval->h > 0) {
        $string = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    } else if ($interval->i > 0) {
        $string = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    } else {
        $string = 'just now';
    }

    return $string;
  }

  public function podtretKonten() {
    $model = $this->loadPodtretModel();
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];


    $podtretId = $this->decrypt($_GET['podtretId']);
    $data['podtret'] = $model['podtret']->updatePodtretViews($podtretId, (int)$_GET['views']+1);
    $data['podtret'] = $model['podtret']->getPodtretBy($podtretId);
    $data['likes'] = $model['podtretLike']->countLike($podtretId, 1);

    $podtretRecord = $model['podtretRecord']->checkUserRecord($podtretId, $userNik);
    if(is_bool($podtretRecord)){
      $model['podtretRecord']->createPodtretRecord($podtretId, $userNik);
    } else {
      $model['podtretRecord']->updatePodtretRecord($podtretId, $userNik, (int)$podtretRecord['views'] + 1);
    }

    $this->view('layouts/navbar');
    $this->view('podtrets/podtretKonten', $data);
    $this->view('layouts/page_footer');
  }

  public function updateLike() {
    $model = $this->loadPodtretModel();

    $podtretId = $_REQUEST["podtretId"];
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $userLike = $model['podtretLike']->checkUserLike('podtretId', 'userNik', $podtretId, $userNik);
    if(!$userLike) {
      $model['podtretLike']->createLike($podtretId, $userNik);
    } else {
      $userLike['likeState'] == 1 ? $newLikeState = 0 : $newLikeState = 1;
      $model['podtretLike']->updateLike('podtretLikeId', $userLike['podtretLikeId'], $newLikeState);
    }

    $likes = $model['podtretLike']->countLike($podtretId, 1);
    echo "Like : ";
    echo $likes['likes'];
  }

  public function addComment() {
    $model = $this->loadPodtretModel();
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $podtretId = $_REQUEST["podtretId"];
    $comment = $_REQUEST['comment'];
    $model['podtretComment']->createComment($podtretId, $userNik, $comment);
  }

  public function addReply() {
    $model = $this->loadPodtretModel();

    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $commentId = $_REQUEST["commentId"];
    $comment = $_REQUEST['comment'];
    $model['podtretCommentReply']->createComment($commentId, $userNik, $comment);
  }

  public function loadComment() {
    $model = $this->loadPodtretModel();

    $podtretId = $_REQUEST["podtretId"];
    $comments = $model['podtretComment']->getAllComment($podtretId);
    foreach($comments as $comment){
      $commentsReply = $model['podtretCommentReply']->getAllComment('podtretCommentId', $comment['podtretCommentId']);
      echo '<div class="section-comment mb-4">
              <div class="d-flex user-comment align-items-center">
                <img src="/public/images/image-profile.jpg" alt="" class="img-comment" />
                <h5 class="ms-3">' .
                  // $comment['nama'] .
                '</h5>
                <p class="ms-2 mt-2">' . date('d M Y', strtotime($comment['uploadDate'])) . '</p>
              </div>
              <p class="mt-2" id="comment1">' . $comment['comment'] . '</p>';
      if (isset($commentsReply)) {
        foreach($commentsReply as $reply){
          echo    '<!-- Section Komen Balasan -->
                  <div class="section-comment ms-5">
                    <div class="d-flex user-reply-comment align-items-center mt-3">
                      <img src="/public/images/nanda.jpg" alt="" class="img-reply-comment" />
                      <h5 class="ms-3">
                      </h5>
                      <p class="ms-2 mt-2">' . date('d M Y', strtotime($reply['uploadDate'])) . '</p>
                    </div>
                    <p class="mt-1">' . $reply['comment'] . '</p>
                  </div>
                  <!-- End Section Komen Balasan -->';
        }  
        echo '<p>
                <button class="btn btn-reply" type="button" data-bs-toggle="collapse" data-bs-target="#' . $comment['podtretCommentId'] . '"
                  aria-expanded="false" aria-controls="' . $comment['podtretCommentId'] . '" id="hideBtnReply">
                  Reply
                </button>
              </p>

              <div class="collapse" id="' . $comment['podtretCommentId'] . '">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Comments" aria-label="Comments"
                    aria-describedby="button-addon2" id=reply-' . $comment['podtretCommentId'] . '>
                  <button onclick="addReply(' . $comment['podtretCommentId'] . ')" class="btn-post-comments me-2" type="button" id="btnAddon">Reply</button>
                </div>
              </div>
            </div>';
      }
      
    }
    
  }

}