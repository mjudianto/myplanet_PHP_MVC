<body class="body-elearning">
<!-- E-Learning -->
<section class="section-popular mt-5" id="popular">
  <div class="container">
    <div class="row">
      <div class="col text-center section-popular-heading">
        <h2>E-Learning</h2>
        <div class="nav-menu-learning justify-content-center mt-4">
          <?php 
            $curr = '';
            $_SESSION['selectedKategori'] == 'all' ? $curr = 'active' : $curr = '';
            echo '<a href="' . BASEURL . 'elearning/filterKategori?kategori=all" class="ms-2 d-inline-block"><button class=' . $curr . '>All</button></a>';
            foreach ($data['elearningKategori'] as $kategori) {
              $_SESSION['selectedKategori'] == strtok($kategori['nama'], " ") ? $curr = 'active' : $curr = '';
              echo '<a href="' . BASEURL . 'elearning/filterKategori?kategori=' . strtok($kategori['nama'], " ") .  '&kategoriId=' . $kategori['elearningKategoriId'] . '" class="ms-2 d-inline-block"><button class= "' . $curr . '">' . $kategori['nama'] . '</button></a>';
            } 
          ?>
        </div>
        <!-- <div class="nav-menu-learning d-flex justify-content-center mt-4">
            <a href="e-learning.html" class=""
              ><button class="active">All</button></a
            >
            <a href="e-learning-general.html" class="ms-4"
              ><button>General</button></a
            >
            <a href="e-learning-qas.html" class="ms-4"
              ><button>QA & Security</button></a
            >
            <a href="e-learning-technical.html" class="ms-4"
              ><button>Technical</button></a
            >
            <a href="e-learning-softskill.html" class="ms-4"
              ><button>Soft Skill</button></a
            >
          </div> -->
      </div>
    </div>
  </div>
</section>

<section class="section-popular-content" id="popularContent">
  <div class="container">
    <div class="section-popular-learning row mt-5">
      <!-- Floating Button -->
      <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
        <img src="assets/ic-arrow-up.png" alt="" width="24" />
      </button>
      <!-- Floating Button -->
      <?php 
        foreach ($data['elearningCourse'] as $course) {
          echo '<div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="card card-learning" data-aos="fade-down" data-aos-duration="950">
                    <a href="' . BASEURL . 'elearning/elearningModule?elearningCourseId=' . $course['elearningCourseId'] . '"><img src="' . $course['thumbnail'] .
                        '" class="card-img-top py-2 px-2" alt="..." /></a>
                    <div class="card-body">
                      <h5 class="card-title-learning">
                        <a href="e-learning-neopgeneral.html">' . $course['judul'] . '</a>
                      </h5>
                      <div class="row">
                        <div class="col">
                          <p class="card-text-learning">
                            <img src="assets/list_alt_FILL1_wght400_GRAD0_opsz48.png" alt="" class="" />
                            26 Lesson
                          </p>
                        </div>
                        <div class="col">
                          <a href="e-learning-neopgeneral.html" class="btn-go">
                            <img src="assets/arrow_right_alt_FILL1_wght400_GRAD0_opsz48.svg" alt="" class="" />
                          </a>
                          <!-- <a href="#" class="btn btn-go">Go</a> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>';
        } 
      ?>
    </div>
  </div>

</section>


</body>