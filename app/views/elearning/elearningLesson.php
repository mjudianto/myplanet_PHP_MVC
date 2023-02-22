<body class="body-video-learning">
    <div class="container mt-3">
      <div class="container text-center video-learning">
        <h3><?= $data['elearningLesson']['judul'] ?></h3>
        <h5>NIK : <?= $_SESSION['user']['nik'] ?></h5>

        <?php 
          $filType = explode('.', $data['elearningLesson']['konten']);

          if($filType[1] != 'pdf') {
            echo '<video controls autoplay>
                    <source src="' . $data['elearningLesson']['konten'] . '">
                  </video>';
          } else {
            echo '<iframe src="' . $data['elearningLesson']['konten'] . '"
                    style="width:100%; height:75%; border-radius: 10px; z-index:999999;">
                  </iframe>';
          }
        ?>

        <a href="<?= BASEURL ?>elearning/elearningModule?elearningCourseId=<?= $_GET['elearningCourseId'] ?>&moduleId=<?= $_GET['elearningCourseId'] == 19 ? encrypt($data['elearningLesson']['elearningModuleId']) : "" ?>"
          ><button class="btn btn-finish mt-3 mb-2">Finish</button></a
        >
      </div>
    </div>

  </body>