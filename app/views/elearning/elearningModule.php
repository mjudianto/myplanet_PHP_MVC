<body class="body-elearning">
  <!-- E-Learning -->
  <section class="section-popular mt-5" id="popular">
    <div class="container">
      <div class="row">
        <div class="col text-center section-popular-heading">
          <h2><?= $data['elearningCourse']['judul'] ?></h2>
        </div>
      </div>
    </div>
  </section>

  <!-- Floating Button -->
  <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
    <img src="<?= BASEURL ?>assets/ic-arrow-up.png" alt="" width="24" />
  </button>
  <!-- Floating Buttonnn -->

  <section class="section-popular-neop" id="popularNeop">
    <?php
    $i = 0;
    foreach ($data['elearningModule'] as $module) {
      echo '<div class="container">
              <div class="section-popular-neop row justify-content-center" style="margin-top: 7vh">
                <button class="btn-collapse-neop" type="button" data-bs-toggle="collapse" data-bs-target="#' . $module['elearningModuleId'] . '"
                  aria-expanded="false" aria-controls="collapseGrooming" onclick="toggleCollapse(event)">
                  ' . $module['judul'] . '
                  <i class="fa-chevron-up fa arrow-button"></i>
                </button>
                <div class="collapse show" id="' . $module['elearningModuleId'] . '">';
      if (isset($data['elearningLesson'][$i])) {
        foreach ($data['elearningLesson'][$i] as $lesson) {
          echo    '<div class="card card-neop-general mt-5">
                    <div class="row">
                      <div class="col-lg-4 text-center align-self-center">
                        <img src="' . BASEURL . 'images/post test.png" alt="" class="py-4 ms-2" width="300" height="200" />
                      </div>
                      <div class="col card-title-neop align-self-lg-center flex-column flex-lg-row mt-4 ms-2">
                        <a href="">
                          <h3>' . $lesson['judul'] . '</h3>
                        </a>
                        <p class="mt-3">' . $_SESSION['user']['empnik'] . '</p>
                        <ul class="d-lg-flex list-nilai-test">
                          <a href="' . BASEURL . 'elearning/elearningLesson?elearningCourseId=' . $_GET['elearningCourseId'] . '&elearningLessonId=' . encrypt($lesson['elearningLessonId']) . '"><button style="" type="button" class="btn btn-start-resp-non-test">
                              Start
                            </button></a>

                        </ul>
                      </div>
                    </div>
                  </div>';
        }
        if (!empty($data['elearningTest'][$i])) {
          // echo $data['elearningTest'][$i]['judul'];
          $j = 0;
          foreach ($data['elearningTest'][$i] as $test) {
            echo '<div class="card card-neop-general mt-5">
                    <div class="row">
                      <div class="col-lg-4 text-center align-self-center">
                        <img src="' . BASEURL . 'images/post test.png" alt="" class="py-4 ms-2" width="300" height="200" />
                      </div>
                      <div class="col card-title-neop align-self-lg-center flex-column flex-lg-row mt-4 ms-2">
                        <div class="d-flex align-items-center">
                          <a href="">
                            <h3>' . $test['judul'] . '</h3>
                          </a>
                          <p class="ms-auto mt-2 empnik-post-test">' . $_SESSION['user']['empnik'] . '</p>
                        </div>
                        <!-- CODINGAN LAMA -->
                        <ul class="d-lg-flex list-nilai-test">
                          <li class="nilai">
                            <p> My Score : ';
            if (isset($data['testRecord'][$i][$j]['score'])) echo $data['testRecord'][$i][$j]['score'];
            echo '</p>
                          </li>
                          <li class="percobaan">
                            <p> My Attempts : ';
            if (isset($data['testRecord'][$i][$j]['attempt'])) echo $data['testRecord'][$i][$j]['attempt'];
            echo '</p>
                          </li>
                        </ul>
                        <!-- Pembatas -->
                        <ul class="d-lg-flex list-nilai-test">
                          <li class="kondisi">
                            <p> My Status : <span>';
            if (isset($data['testRecord'][$i][$j]['status'])) echo $data['testRecord'][$i][$j]['status'];
            echo '</span></p>
                          </li>
                          <li class="time">
                            <p>';
            if (isset($data['testRecord'][$i][$j]['finished'])) {
              echo $data['testRecord'][$i][$j]['finished'];
            } else {
              echo "No Attempt";
            }
            echo '</p>
                          </li>
                          <a ';
            if ($data['maxedAttempt']($test['elearningTestId'])) {
              echo 'data-bs-toggle="modal" data-bs-target="#modalWarning"';
            } else {
              echo 'href="' . BASEURL . 'elearning/elearningTest?elearningCourseId=' . $_GET['elearningCourseId'] . '&elearningTestId=' . encrypt($test['elearningTestId']) . '"';
            }
            echo             ' ><button type="button" class="btn btn-start-resp">
                              Start
                            </button></a>
                        </ul>
                        <!-- End Codingan lama -->
                      </div>
                    </div>
                  </div>';
            $j += 1;
          }
        }
        echo '</div>
              </div>
            </div>';
        $i = $i + 1;
      }
    }
    ?>


    <!-- Modal Warning -->
    <div class="modal fade" id="modalWarning" tabindex="-1" aria-labelledby="modalWarningLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalWarningLabel">Warning!</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="text-align: center;">
            Post Test anda sudah melebihi batas maksimal percobaan. <br><br> Silahkan menghubungi tim training untuk informasi lebih lanjut.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


  </section>
</body>