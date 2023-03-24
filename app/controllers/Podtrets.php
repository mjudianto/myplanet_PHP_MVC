<?php

class Podtrets extends Controller
{

  public function index()
  {
    $this->view('layouts/navbar');
    $this->view('podtrets/podtret');
    $this->view('layouts/page_footer');
  }

  public function filterKategori()
  {
    $_SESSION['selectedPodtretKategori'] = $_REQUEST['kategoriId'];
  }

  public function loadKategori()
  {
    $model = $this->loadPodtretModel();

    $podtretKategori = $model['podtretKategori']->getAllKategori();

    $curr = '';
    !isset($_SESSION['selectedPodtretKategori']) || isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == 0 ? $curr = 'active' : $curr = '';
    echo '<a onclick="filterKategori(0)" class="ms-2 d-inline-block"><button class="px-3 py-1' . $curr . '">All</button></a>';
    foreach ($podtretKategori as $kategori) {
      isset($_SESSION['selectedPodtretKategori']) && $_SESSION['selectedPodtretKategori'] == $kategori['podtretKategoriId'] ? $curr = 'active' : $curr = '';
      echo '<a onclick="filterKategori(' . $kategori['podtretKategoriId'] . ')" class="ms-2 d-inline-block mt-2"><button class= "px-3 py-1 ' . $curr . '">' . $kategori['nama'] . '</button></a>';
    }
  }

  public function loadPodtret()
  {
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
                <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '"><img src="' . $podtret['thumbnail'] . '" class="card-img-top py-2 px-2"
                    alt="..." /></a>
                <div class="card-body">
                  <h5 class="card-title-page-podtret">
                    <a 
                    style="display: block;
                    width: 15vw;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;"
                    href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '">' . $podtret['judul'] . '</a>
                  </h5>
                  <div class="row mt-3">
                    <div class="col-10">
                      <p class="card-text-page-podtret">
                        ' . $podtret['views'] . 'x ditonton • ' . $this->dateFormatAsString($podtret['uploadDate']) . '
                      </p>
                    </div>
                    <div class="col d-none d-lg-block">
                      <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '" class="btn-go-podtret">
                        <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                  <div class="d-flex mt-2">
                    <a href="' . BASEURL . 'podtrets/podtretKonten?type=video&podtretId=' . $this->encrypt($podtret['podtretId']) . '"><img src="assets/Button Nonton MP4.png" alt="" class="btn-opsi-play-podtret me-2"></a>
                    <a href="' . BASEURL . 'podtrets/podtretKonten?type=audio&podtretId=' . $this->encrypt($podtret['podtretId']) . '"><img src="assets/Button Nonton MP3.png" alt="" class="btn-opsi-play-podtret"></a>
                  </div>
                </div>
              </div>
            </div>';
    }
    echo '<div class="pagination-page d-flex justify-content-center"><a onclick="paginateCourse(' . $page - 1 . ')">&laquo;</a>';
    for ($i = 1; $i <= $pageSize; $i++) {
      $i == $page ? $active = 'active' : $active = "";
      echo '<a class="' . $active . '" onclick="PaginatePodtret(' . $i . ')">' . $i . '</a>';
    }
    echo '<a onclick="paginateCourse(' . $page + 1 . ')">&raquo;</a>
          </div>';
  }

  public function dateFormatAsString($date)
  {
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

  public function podtretKonten()
  {
    $model = $this->loadPodtretModel();
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];


    $podtretId = $this->decrypt($_GET['podtretId']);
    $data['podtret'] = $model['podtret']->getPodtretBy($podtretId);
    $data['podtret'] = $model['podtret']->updatePodtretViews($podtretId, (int)$data['podtret']['views'] + 1);
    $data['podtret'] = $model['podtret']->getPodtretBy($podtretId);
    $data['likes'] = $model['podtretLike']->countLike($podtretId, 1);
    $data['userLike'] = $model['podtretLike']->checkUserLike('podtretId', 'userNik', $podtretId, $userNik);

    $podtretRecord = $model['podtretRecord']->checkUserRecord($podtretId, $userNik);
    if (is_bool($podtretRecord)) {
      $model['podtretRecord']->createPodtretRecord($podtretId, $userNik);
    } else {
      $model['podtretRecord']->updatePodtretRecord($podtretId, $userNik, (int)$podtretRecord['views'] + 1);
    }

    $this->view('layouts/navbar');
    $this->view('podtrets/podtretKonten', $data);
    $this->view('layouts/page_footer');
  }

  public function updateLike()
  {
    $model = $this->loadPodtretModel();

    $podtretId = $_REQUEST["podtretId"];
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $userLike = $model['podtretLike']->checkUserLike('podtretId', 'userNik', $podtretId, $userNik);
    if (!$userLike) {
      $model['podtretLike']->createLike($podtretId, $userNik);
    } else {
      $userLike['likeState'] == 1 ? $newLikeState = 0 : $newLikeState = 1;
      $model['podtretLike']->updateLike('podtretLikeId', $userLike['podtretLikeId'], $newLikeState);
    }
    $userLike = $model['podtretLike']->checkUserLike('podtretId', 'userNik', $podtretId, $userNik);

    $likes = $model['podtretLike']->countLike($podtretId, 1);
    $state = $userLike['likeState'] == 1 ? "active" : "";
    echo '<a class="like-button null ' . $state . '">
            <svg width="30" height="30" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
              <path d="M320 1344q0-26-19-45t-45-19q-27 0-45.5 19t-18.5 45q0 27 18.5 45.5t45.5 18.5q26 0 45-18.5t19-45.5zm160-512v640q0 26-19 45t-45 19h-288q-26 0-45-19t-19-45v-640q0-26 19-45t45-19h288q26 0 45 19t19 45zm1184 0q0 86-55 149 15 44 15 76 3 76-43 137 17 56 0 117-15 57-54 94 9 112-49 181-64 76-197 78h-129q-66 0-144-15.5t-121.5-29-120.5-39.5q-123-43-158-44-26-1-45-19.5t-19-44.5v-641q0-25 18-43.5t43-20.5q24-2 76-59t101-121q68-87 101-120 18-18 31-48t17.5-48.5 13.5-60.5q7-39 12.5-61t19.5-52 34-50q19-19 45-19 46 0 82.5 10.5t60 26 40 40.5 24 45 12 50 5 45 .5 39q0 38-9.5 76t-19 60-27.5 56q-3 6-10 18t-11 22-8 24h277q78 0 135 57t57 135z">
              </path>
            </svg>
            <span class="ms-2" id="angkanya" style="position: absolute;margin-top:3px;color: white;">
              <span style="font-size: 20px;">Like : ' . $likes['likes'] . '</span></span>
          </a>';
  }

  public function addComment()
  {
    $model = $this->loadPodtretModel();
    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $podtretId = $_REQUEST["podtretId"];
    $comment = $_REQUEST['comment'];
    if ($comment != '') {
      $model['podtretComment']->createComment($podtretId, $userNik, $comment);
    }
  }

  public function addReply()
  {
    $model = $this->loadPodtretModel();

    $userNik = $_SESSION['user']['empnik'] ?? $_SESSION['user']['userNik'];

    $commentId = $_REQUEST["commentId"];
    $comment = $_REQUEST['comment'];
    if ($comment != '') {
      $model['podtretCommentReply']->createComment($commentId, $userNik, $comment);
    }
  }

  public function loadComment()
  {
    $model = $this->loadPodtretModel();

    $podtretId = $_REQUEST["podtretId"];
    $comments = $model['podtretComment']->getAllComment($podtretId);
    foreach ($comments as $comment) {
      $commentsReply = $model['podtretCommentReply']->getAllComment('podtretCommentId', $comment['podtretCommentId']);
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
        foreach ($commentsReply as $reply) {
          echo    '<!-- Section Komen Balasan -->
                  <div class="section-comment ms-5">
                    <div class="d-flex user-reply-comment align-items-center mt-3">
                      <img src="/public/images/nanda.jpg" alt="" class="img-reply-comment" />
                      <h5 class="ms-3">' .
            $reply['nama'] .
            '</h5>
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
              </p>' .
          // $comment['nama'] .
          '<div class="collapse" id="' . $comment['podtretCommentId'] . '">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Comments" aria-label="Comments"
                    aria-describedby="button-addon2" id=reply-' . $comment['podtretCommentId'] . '>
                  <button onclick="addReply(' . $comment['podtretCommentId'] . ')" class="btn-post-comments me-2" type="button" id="btnAddon">Post</button>
                </div>
              </div>
            </div>';

        echo '<script>
                // Get the input field
                var input = document.getElementById("reply-' . $comment['podtretCommentId'] . '");
          
                // Execute a function when the user presses a key on the keyboard
                input.addEventListener("keypress", function(event) {
                  // If the user presses the "Enter" key on the keyboard
                  if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    addReply(' . $comment['podtretCommentId'] . ');
                  }
                });
              </script>';
      }
    }
  }
}
