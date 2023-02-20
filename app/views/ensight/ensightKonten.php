
<body class="body-ensight">

<div class="container mt-5">
      <div class="container video-play">
        <video controls autoplay>
          <source src="<?= $data['ensight']['video'] ?>">
        </video>
        <h3 class="mt-3"><?= $data['ensight']['judul'] ?></h3>
        <h5>Premiere : <?= $data['ensight']['publishDate'] ?></h5>
        <p><?= $data['ensight']['views'] ?> views</p>
        <div class="description">
          <p><?= $data['ensight']['deskripsi'] ?></p>
        </div>
      </div>
    </div>
</body>