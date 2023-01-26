<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Post Test</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!--bootstrap harus tetep di atas file css-->
  <link rel="stylesheet" href="/public/css/app.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
</head>
<body class="body-video-learning" onload="setTimeout('timeOut()', <?=$data['elearningTest']['timeLimit']?>)">
  <div class="container mt-4">
    <div class="container text-center video-learning">
      <h3><?php echo $data['elearningTest']['judul']; ?></h3>
      <h5><?php echo $_SESSION['user']['nik']; ?></h5>

      <div class="card transition mt-4" id="startPostTest" style="height: 450px;">
        <!-- <img src="images/post test.png" class="card-img-top" style="width: 350px;" alt="..."> -->
        <div class="card-body mt-5">
          <h3 class="card-title mb-5">Selamat Datang di Post Test <br> <?php echo $data['elearningTest']['judul']; ?> </h3>
          <p class="card-text">Klik Start untuk memulai quiz</p>
          <button type="button" class="btn btn-primary" onclick="startClick()">Start</button>
        </div>
      </div>

      <div class="card mb-4 mt-4 transition post-test-start" id="quiz" style="height: 450px;">
        <div class="card-header header-post-test d-flex">
          <p class="mb-0">Question <p id="questionCounter">1</p> of <?= $data['numberOfQuestion']['numberOfQuestion'] ?></p>
          <p class="ms-auto mb-0"></p>

          <div class="vl ms-2 mb-0" style="border-left: solid 2px #ffffff">
            <p class="ms-2 mb-0" id="demo"></p>
          </div>
        </div>
        <form action="<?= BASEURL ?>/elearning/elearningTestSubmit?elearningTestId=<?= $data['elearningTest']['elearningTestId'] ?>" method="post" id="myForm">
          <div class="card-body text-start">
            <?php 
            if(isset($data['question'])) {
              $i=0;
              foreach($data['question'] as $question) {
                echo '<div id="question-' . $question['questionId'] . '" class="question-container">
                <h6 class="mt-2 mb-4">' . $question['question'] . '</h6>
                <div class="jawaban mb-4">';
                foreach($data['choice'][$i] as $choice) {
                  echo '<div class="opsi">
                          <div class="form-check form-post-test">
                            <input class="form-check-input" value="' . $choice['answerId'] . '" type="radio" name="selectedChoice[' . $question['questionId'] . ']" id="selectedChoice">
                            <label class="form-check-label" for="opsiRadio1">'
                              . $choice['answer'] . 
                            '</label>
                          </div>
                        </div>';
                }
                echo '</div>
                    <div class="d-flex">
                      <button type="button" class="btn btn-outline-primary prev-button">Previous</button>
                      <button type="button" class="btn btn-primary ms-auto next-button">Next</button>
                    </div>
                  </div>';
                $i+=1;
              }
              
            } 
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="/public/js/floating-btn.js"></script>
  <script src="/public/js/startClick.js"></script>

  <script>
    var countDownDate = new Date().getTime()+<?= $data['elearningTest']['timeLimit'] ?>;

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = hours + "h "
      + minutes + "m " + seconds + "s ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        timeOut();
      }
    }, 1000);
  </script>

  <script>
    
  </script>
</body>

</html>