
<body class="body-ensight">
    <section class="section-popular mt-3" id="popular">
      <div class="container">
        <div class="row">
          <div class="col text-center section-ensight">
            <img src="assets/Ensight.png" alt="" width="150" />
            <div class="nav-menu d-flex justify-content-center mt-4">
              <a href="" class=""> <button class="active">All</button></a>
              <a href="" class="ms-4"
                ><button class="segment">Segment 1</button></a
              >
              <a href="" class="ms-4"
                ><button class="segment">Segment 2</button></a
              >
              <a href="" class="ms-4"
                ><button class="segment">Segment 3</button></a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-popular-content" id="popularContent">
      <div class="container">
        <div class="section-popular-ensight row mt-5">
          <?php 
            foreach($data['ensight'] as $ensight) {
              echo '<div class="col-sm-6 col-md-4 col-lg-3">
                      <div class="card card-ensight">
                        <a href="' . BASEURL . 'ensight/ensightKonten?ensightId= . ' . encrypt($ensight['ensightId'])  .'"
                          ><img
                            src="' . $ensight['thumbnail'] . '"
                            class="card-img-top py-2 px-2 img-fluid"
                            alt="..."
                        /></a>
                        <div class="card-body">
                          <h5 class="card-title-learning">
                            <a href="video-play.html"
                              >' . $ensight['judul'] . '</a
                            >
                          </h5>
                        </div>
                      </div>
                    </div>';
            }
          ?>
        </div>
      </div>
    </section>

  </body>