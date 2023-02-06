<?php 
// echo $_SESSION['nama'];
?>

<body class="bg-home">
  <section class="hero mt-4 hero-section pb-5">
    <div class="container">
      <div class="row">
        <div class="col align-self-center px-4">
          <!--align self center biar column yg kiri sejajar tengah sama column yang kanan-->
          <h1 class="mb-4">
            <!--margin bottom 4-->
            Investing in <br />
            Knowledge and <br />
            <span>Your Future</span>
          </h1>
          <p class="mb-5">
            Our e-learning programs has been developed to be a vehicle of
            delivering multimedia learning solutions for your business
          </p>
          <div class="btn-header">
            <form>
              <a class="btn btn-get-started" href="#podtret" role="button">Get Started</a>
            </form>
            <!-- <img src="assets/Play Button.png" alt="" class="icon" /> -->
            <form action=""><a class="btn btn-watch" href="#" role="button">
                <img src="<?= BASEURL ?>assets/Play Button.svg" alt="" class="icon-play" />
                Watch Tutorial</a></form>
          </div>
        </div>
        <!--bagian column kiri-->
        <div class="col d-none d-sm-block">
          <!--bagian column kanan, Hidden only on xs-->
          <img width="" src="<?= BASEURL ?>images/ilustrasi-myplanet.png" class="banner-img" alt="" />
        </div>
      </div>
    </div>
  </section>

  <!-- E-Learning -->
  <section class="section-popular mt-5" id="popular">
    <div class="container">
      <div class="row">
        <div class="col text-center section-popular-heading">
          <p>E-Learning</p>
          <h2>Explore our Learning</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="section-popular-content" id="popularContent">
    <div class="container">
      <div class="section-popular-travel row justify-content-center mt-5">
        <!-- Floating Button -->
        <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
          <img src="<?= BASEURL ?>assets/ic-arrow-up.png" alt="" width="24" />
          <!-- <i class="fas fa-arrow-up"
              ><img src="assets/Arrow up.svg" alt="" width="18"
            /></i> -->
        </button>
        <!-- Floating Button -->
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
            <a href="e-learning-neopgeneral.html"><img src="<?= BASEURL ?>images/Cover-Neop-General_min.png"
                class="card-img-top py-2 px-2" alt="." /></a>
            <div class="card-body">
              <h5 class="card-title-learning"><a href="">Neop General</a></h5>
              <div class="row">
                <div class="col">
                  <p class="card-text-learning">
                    <img src="<?= BASEURL ?>assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" />
                    26 Lesson
                  </p>
                </div>
                <div class="col">
                  <a href="e-learning-neopgeneral.html" class="btn-go">
                    <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                  </a>
                  <!-- <a href="#" class="btn btn-go">Go</a> -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
            <a href=""><img src="<?= BASEURL ?>images/Card Image Warehouse.png" class="card-img-top py-2 px-2" alt="." /></a>
            <div class="card-body">
              <h5 class="card-title-learning">
                <a href="">Neop Warehouse</a>
              </h5>
              <div class="row">
                <div class="col">
                  <p class="card-text-learning">
                    <img src="<?= BASEURL ?>assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" />
                    31 Lesson
                  </p>
                </div>
                <div class="col">
                  <a href="" class="btn-go">
                    <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
            <a href=""><img src="<?= BASEURL ?>images/Neop Transport.png" class="card-img-top py-2 px-2" alt="." /></a>
            <div class="card-body">
              <h5 class="card-title-learning">
                <a href="">Neop Transport</a>
              </h5>
              <div class="row">
                <div class="col">
                  <p class="card-text-learning">
                    <img src="<?= BASEURL ?>assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" />
                    13 Lesson
                  </p>
                </div>
                <div class="col">
                  <a href="" class="btn-go">
                    <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
            <a href=""><img src="<?= BASEURL ?>images/CDOB.png" class="card-img-top py-2 px-2" alt="." /></a>
            <div class="card-body">
              <h5 class="card-title-learning"><a href="">CDOB</a></h5>
              <div class="row">
                <div class="col">
                  <p class="card-text-learning">
                    <img src="<?= BASEURL ?>assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" />
                    13 Lesson
                  </p>
                </div>
                <div class="col">
                  <a href="" class="btn-go">
                    <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center">
          <a href="e-learning.html"><button type="button" class="btn btn-show-all btn-outline-primary mt-2">
              Show All
            </button></a>
        </div>
      </div>
    </div>
  </section>

  <!-- PODTRET -->
  <main class="mt-5">
    <section class="section-podtret mt-5" id="podtret">
      <div class="container">
        <div class="row">
          <div class="col text-center section-popular-podtret">
            <p>Podtret</p>
            <h2>Explore Our Podtret</h2>
          </div>
        </div>
      </div>


      <section class="section-popular-content" id="popularContent">
        <div class="container">
          <div class="section-popular-podtret row justify-content-center mt-3">
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href="video-play.html"><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2"
                    alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href="video-play.html"> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href="video-play.html"><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2"
                    alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href="video-play.html"> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href=""><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2" alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <!-- <a href=""><button type="button" class="btn btn-go-podtret">
                      <img
                        src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg"
                        alt=""
                        class=""
                      />
                    </button></a> -->
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href=""><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2" alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href=""><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2" alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
                <a href=""><img src="<?= BASEURL ?>images/videoplaceholdit.png" class="card-img-top py-2 px-2" alt="." /></a>
                <div class="card-body">
                  <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                      Siapa Takut ?! </a></h5>
                  <div class="row">
                    <div class="col-12">
                      <p class="card-text-podtret">
                        47x ditonton • 2 bulan lalu
                      </p>
                    </div>
                    <div class="col">
                      <a href="video-play-podtret.html" class="btn-go-podtret">
                        <img src="<?= BASEURL ?>assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="container">
        <div class="section-popular-podtret row justify-content-center mt-3">
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
              <a href=""><img
                src="images/videoplaceholdit.png"
                class="card-img-top py-2 px-2"
                alt="."
              /></a>
              <div class="card-body">
                <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                  Siapa Takut ?! </a></h5>
                <div class="row">
                  <div class="col-12">
                    <p class="card-text-podtret">
                      47x ditonton • 2 bulan lalu
                    </p>
                  </div>
                  <div class="col">
                    <a href="video-play-podtret.html" class="btn-go-podtret">
                      <img
                        src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg"
                        alt=""
                        class=""
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
              <a href=""><img
                src="images/videoplaceholdit.png"
                class="card-img-top py-2 px-2"
                alt="."
              /></a>
              <div class="card-body">
                <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                  Siapa Takut ?! </a></h5>
                <div class="row">
                  <div class="col-12">
                    <p class="card-text-podtret">
                      47x ditonton • 2 bulan lalu
                    </p>
                  </div>
                  <div class="col">
                    <a href="video-play-podtret.html" class="btn-go-podtret">
                      <img
                        src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg"
                        alt=""
                        class=""
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="card card-podtret" data-aos="zoom-in" data-aos-duration="950">
              <a href=""><img
                src="images/videoplaceholdit.png"
                class="card-img-top py-2 px-2"
                alt="."
              /></a>
              <div class="card-body">
                <h5 class="card-title-podtret"><a href=""> Rumpi Yuk! SPEAK UP? <br />
                  Siapa Takut ?! </a></h5>
                <div class="row">
                  <div class="col-12">
                    <p class="card-text-podtret">
                      47x ditonton • 2 bulan lalu
                    </p>
                  </div>
                  <div class="col">
                    <a href="video-play-podtret.html" class="btn-go-podtret">
                      <img
                        src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg"
                        alt=""
                        class=""
                      />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> -->

        <div class="text-center">
          <a href="podtret.html"><button type="button" class="btn btn-show-all-podtret btn-outline mt-3">
              Show All
            </button></a>
        </div>
        </div>
      </section>
    </section>
  </main>

  <!-- COMMUNITY -->
  <section class="section-community mt-5">
    <div class="container">
      <div class="row">
        <div class="col text-center community">
          <h1>Build Up The Community</h1>
          <h2>Join the <span>biggest</span> community of learning</h2>
          <p>
            Learn, share the knowledge with community members & shine from
            <br />
            wherever you're through online learning web app.
          </p>
        </div>
        <img src="<?= BASEURL ?>images/community-2.png" alt="" />
        <div class="text-center">
          <button type="button" class="btn btn-discover btn-lg">
            Discover
          </button>
        </div>
      </div>
    </div>
  </section>
</body>

