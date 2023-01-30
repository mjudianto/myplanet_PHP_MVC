
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
                <div class="col-lg-10 col-sm-12 text-center" id="kategoriContainer">
                </div>
                <div class="col-lg-2 col-sm-12">
                  <form class="d-flex search-bar" role="search">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search" />
                    <button class="btn btn-search" type="submit">
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
        <div class="section-podtret row mt-5" id="podtretContainer">
        </div>
      </div>
    </section>
  </section>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


  <script>
    $( document ).ready(function() {
      loadKategori();
      loadCourse();
    });
  </script>

  <script>
    function filterKategori (id) {
      // var kategoriId = $('#kategoriId').val();
        $.ajax({
          url: "<?= BASEURL ?>podtret/filterKategori?kategoriId=" + id,
          success: function(html) {
            loadKategori();
            loadCourse();
          }
        });
    }

    function loadKategori() {
        $.ajax({
          url: "<?= BASEURL ?>podtret/loadKategori",
          success: function(html) {
            $('#kategoriContainer').html(html);
          }
        });
      }

    function loadCourse() {
        $.ajax({
          url: "<?= BASEURL ?>podtret/loadPodtret",
          success: function(html) {
            $('#podtretContainer').html(html);
          }
        });
      }
  </script>

</body>