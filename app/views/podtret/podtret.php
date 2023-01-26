
<body class="bg-podcast">

<section>
    <section class="section-popular-podtret" id="popular">
      <div class="container">
        <div class="text-center">
          <img src="assets/Logo Podtret.png" al t="" width="300" />
        </div>
        <div class="row">
          <div class="col section-popular-heading">
            <div class="nav-menu-podtret d-flex mt-4">
              <div class="row">
                <div class="col-lg-10 col-sm-12 text-center">
                  <div class="">
                  <?php 
                    $curr = '';
                    $_SESSION['selectedPodtretKategori'] == 'all' ? $curr = 'active' : $curr = '';
                    echo '<a href="' . BASEURL . 'podtret/filterKategori?kategori=all" class="ms-2 d-inline-block"><button class=' . $curr . '>All</button></a>';
                    foreach ($data['podtretKategori'] as $kategori) {
                      $_SESSION['selectedPodtretKategori'] == $kategori['nama'] ? $curr = 'active' : $curr = '';
                      echo '<a href="' . BASEURL . 'podtret/filterKategori?kategori=' . $kategori['nama'] .  '&kategoriId=' . $kategori['podtretKategoriId'] . '" class="ms-4 d-inline-block"><button class= "' . $curr . '">' . $kategori['nama'] . '</button></a>';
                    } 
                  ?>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <form class="d-flex search-bar" role="search">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search" />

                    <button class="btn btn-search" type="submit">
                      <!-- <img src="assets/ic-search.svg" alt="" /> -->
                      <i class="fa fa-search"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-content-podtret" id="popularContent">
      <div class="container">
        <div class="section-podtret row mt-5">
          <!-- Floating Button -->
          <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
            <img src="assets/ic-arrow-up.png" alt="" width="24" />
            <!-- <i class="fas fa-arrow-up"
              ><img src="assets/Arrow up.svg" alt="" width="18"
            /></i> -->
          </button>
          <!-- Floating Button -->
          <?php 
            foreach ($data['podtret'] as $podtret) {
              echo '<div class="col-sm-6 col-md-4 col-lg-3">
                      <div class="card card-page-podtret">
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
          ?>
          

        </div>
      </div>
    </section>
  </section>
</body>