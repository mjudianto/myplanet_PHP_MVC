
<body class="bg-podcast">

<section>
    <section class="section-popular-podtret mt-5" id="popular">
      <div class="container">
        <div class="text-center">
          <img src="assets/Logo Podtret.png" al t="" width="300" />
        </div>
        
          <div class="section-popular-heading">
            <div class="nav-menu-podtret d-flex mt-4 justify-content-center">
              <div class="d-flex align-items-center text-center">
                <div class="" id="kategoriContainer">
                </div>
                <div class="">
                  <!-- <form class="d-flex search-bar" role="search">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search" />
                    <button class="btn btn-search" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </form> -->
                  <div class="position-relative ms-2 mt-2">
								<input type="text" class="form-control ps-5" placeholder="Search" style="
    border-radius: 20px;
    height: 32px;
"> <span class="position-absolute top-50 product-show translate-middle-y" style="
    font-size: 18px;
    left: 15px;
    position: absolute;
"><i class="fa fa-search"></i></span>
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
      loadPodtret();
    });
  </script>

  <script>
    function filterKategori (id) {
      // var kategoriId = $('#kategoriId').val();
        $.ajax({
          url: "<?= BASEURL ?>podtrets/filterKategori?kategoriId=" + id,
          success: function(html) {
            loadKategori();
            loadPodtret();
          }
        });
    }

    function loadKategori() {
        $.ajax({
          url: "<?= BASEURL ?>podtrets/loadKategori",
          success: function(html) {
            $('#kategoriContainer').html(html);
          }
        });
      }

    function loadPodtret() {
        $.ajax({
          url: "<?= BASEURL ?>podtrets/loadPodtret",
          success: function(html) {
            $('#podtretContainer').html(html);
          }
        });
      }

    function PaginatePodtret(i) {
      $.ajax({
        url: "<?= BASEURL ?>podtrets/loadPodtret?page=" + i,
        success: function(html) {
          $('#podtretContainer').html(html);
        }
      });
    }
  </script>

</body>