<body class="body-elearning">
<!-- E-Learning -->
<section class="section-popular mt-5" id="popular">
<div class="container">
    
    <div class="text-center section-popular-heading">
      <h2 class="mb-4">E-Learning</h2>
      <div class="d-flex align-items-center justify-content-center">
      <div class="nav-menu-learning justify-content-center" id="kategoriContainer">
      </div>
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
</section>

<section class="section-popular-content" id="popularContent">
  <div class="container">
    <div class="section-popular-learning row mt-5" id="courseContainer">
      
    </div>
  </div>

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
          url: "<?= BASEURL ?>elearning/filterKategori?kategoriId=" + id,
          success: function(html) {
            loadKategori();
            loadCourse();
          }
        });
    }

    function loadKategori() {
        $.ajax({
          url: "<?= BASEURL ?>elearning/loadKategori",
          success: function(html) {
            $('#kategoriContainer').html(html);
          }
        });
      }

    function loadCourse() {
        $.ajax({
          url: "<?= BASEURL ?>elearning/loadCourse",
          success: function(html) {
            $('#courseContainer').html(html);
          }
        });
      }
    
    function paginateCourse(i) {
      $.ajax({
        url: "<?= BASEURL ?>elearning/loadCourse?page=" + i,
        success: function(html) {
          $('#courseContainer').html(html);
        }
      });
    }
  </script>
</body>