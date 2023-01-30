<?php 

class Podtret extends Controller {

  public function index() {
    $this->view('layouts/navbar');
    $this->view('podtret/podtret');
    $this->view('layouts/page_footer');
  }

  public function filterKategori() {
    $_SESSION['selectedPodtretKategori'] = $_REQUEST['kategoriId'];
  }

  public function loadKategori() {
    $podtretKategori = $this->model('PodtretKategori_model')->getAllKategori();

    // echo $_SESSION['selectedPodtretKategori'];
    $curr = '';
    isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == 0 ? $curr = 'active' : $curr = '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class=' . $curr . '>All</button></a>';
    foreach ($podtretKategori as $kategori) {
      isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == $kategori['podtretKategoriId'] ? $curr = 'active' : $curr = '';
      echo '<a onclick="filterKategori(' . $kategori['podtretKategoriId'] .')" class="ms-4 d-inline-block"><button class= "' . $curr . '">' . $kategori['nama'] . '</button></a>';
    } 
  }

  public function loadPodtret() {
    $podtrets = $this->model('Podtret_model')->getAll();

    if (isset($_SESSION['selectedPodtretKategori'])) {
      $kategoriId = $_SESSION['selectedPodtretKategori'];
      if ($kategoriId != 0){
        $podtrets = $this->model('Podtret_model')->filterPodtret('podtretKategoriId', $kategoriId);
      }
    }
    
    echo '<!-- Floating Button -->
          <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <img src="assets/ic-arrow-up.png" alt="" width="24" />
          </button>
          <!-- Floating Button -->';
    foreach ($podtrets as $podtret) {
      echo '<div class="col-sm-6 col-md-4 col-lg-3">
              <div class="card card-page-podtret" data-aos="fade-down" data-aos-duration="950">
                <a href="' . BASEURL . 'podtret/podtretKonten?podtretId=' . $podtret['podtretId'] . '&views=' . $podtret['views'] . '"><img src="' . $podtret['thumbnail'] . '" class="card-img-top py-2 px-2"
                    alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-page-podtret">
                    <a href="' . BASEURL . 'podtret/podtretKonten?podtretId=' . $podtret['podtretId'] . '&views=' . $podtret['views'] . '">' . $podtret['judul'] . '</a>
                  </h5>
                  <div class="row mt-3">
                    <div class="col-10">
                      <p class="card-text-page-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col d-none d-lg-block">
                      <a href="' . BASEURL . 'podtret/podtretKonten?podtretId=' . $podtret['podtretId'] . '&views=' . $podtret['views'] . '" class="btn-go-podtret">
                        <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-flex mt-2">
                    <a href=""><img src="assets/Button Nonton MP4.png" alt="" class="btn-opsi-play-podtret me-2"></a>
                    <a href=""><img src="assets/Button Nonton MP3.png" alt="" class="btn-opsi-play-podtret"></a>
                  </div>
                </div>
              </div>
            </div>';
      } 
  }

  public function podtretKonten() {
    $podtretId = $_GET['podtretId'];
    $data['podtret'] = $this->model('Podtret_model')->updatePodtretViews('podtretId', $podtretId, $_GET['views']+1);
    $data['podtret'] = $this->model('Podtret_model')->getPodtretBy('podtretId', $podtretId);
    $data['likes'] = $this->model('PodtretLike_model')->countLike('podtretId', 'likeState', $podtretId, 1);


    $this->view('layouts/navbar');
    $this->view('podtret/podtretKonten', $data);
    $this->view('layouts/page_footer');
  }

  public function updateLike() {
    $podtretId = $_REQUEST["podtretId"];
    $userId = $_SESSION['user']['userId'];

    $userLike = $this->model('PodtretLike_model')->checkUserLike('podtretId', 'userId', $podtretId, $userId);
    if(!$userLike) {
      $this->model('PodtretLike_model')->createLike($podtretId, $userId);
    } else {
      $userLike['likeState'] == 1 ? $newLikeState = 0 : $newLikeState = 1;
      $this->model('PodtretLike_model')->updateLike('podtretLikeId', $userLike['podtretLikeId'], $newLikeState);
    }

    $likes = $this->model('PodtretLike_model')->countLike('podtretId', 'likeState', $podtretId, 1);
    echo "Like : ";
    echo $likes['likes'];
  }

  public function addComment() {
    $podtretId = $_REQUEST["podtretId"];
    $comment = $_REQUEST['comment'];
    $this->model('PodtretComment_model')->createComment($podtretId, $_SESSION['user']['userId'], $comment);
  }

  public function addReply() {
    $commentId = $_REQUEST["commentId"];
    $comment = $_REQUEST['comment'];
    $this->model('PodtretCommentReply_model')->createComment($commentId, $comment);
  }

  public function loadComment() {
    $podtretId = $_REQUEST["podtretId"];
    $comments = $this->model('PodtretComment_model')->getAllComment('podtretId', $podtretId);
    foreach($comments as $comment){
      $commentsReply = $this->model('PodtretCommentReply_model')->getAllComment('podtretCommentId', $comment['podtretCommentId']);
      echo '<div class="section-comment mb-4">
              <div class="d-flex user-comment align-items-center">
                <img src="/public/images/image-profile.jpg" alt="" class="img-comment" />
                <h5 class="ms-3">' .
                  $comment['nama'] .
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
                        Nanda Raditya
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