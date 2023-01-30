<body class="body-video-learning">
    <div class="container mt-3">
      <div class="container text-center video-learning">
        <h3><?= $data['elearningLesson']['judul'] ?></h3>
        <h5>NIK : <?= $_SESSION['user']['nik'] ?></h5>

        <video controls autoplay>
          <source src="<?= $data['elearningLesson']['konten'] ?>">
        </video>
        <a href="e-learning-neopgeneral.html"
          ><button class="btn btn-finish mt-3 mb-2">Finish</button></a
        >
      </div>
    </div>

  </body>