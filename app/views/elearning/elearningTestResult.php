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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body class="body-video-learning">
  <div class="container mt-4">
    <div class="container text-center video-learning">
      <h3>POST TEST PERATURAN PERUSAHAAN DAN GROOMING</h3>
      <h5>NIK : NK9512</h5>

      <div class="card mb-4 mt-4">
        <div class="card-header header-post-test">
          <h6 class="text-white">Finish Post Test</h6>
        </div>
        <div class="card-body">
          <div class="row d-flex align-items-center text-start">
            <table class="table">
              <tbody>
                <tr class="row ps-2 pe-2">
                  <th class="col-6">Status</th>
                  <?php if($data['lulus'] != true): ?>
                  <td class="table-danger col-6">Gagal</td>
                  <?php else: ?>
                  <td class="table-success col-6">Lulus</td>
                  <?php endif; ?>
                </tr>
                <tr class="row ps-2 pe-2">
                  <th class="col-6">Grading Result</th>
                  <td class="col-6"><?php echo $data['score']; ?></td>
                </tr>
                <tr class="row ps-2 pe-2">
                  <th class="col-6">Passing Grade</th>
                  <td class="col-6"><?php echo $data['elearningTest']['passingScore']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex">
            <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" href="#collapseResultTest">View
              Result</button>
            <a href="<?= BASEURL ?>/elearning" type="button" class="btn btn-planet ms-auto">Back
              E-learning</a>
          </div>
        </div>
      </div>

      <div class="collapse" id="collapseResultTest">
        <div class="card">
          <div class="card-header header-post-test">
            <h6 class="text-white">Post Test</h6>
          </div>
          <div class="card-body">
            <?php 
            $i=0;
            foreach($data['questions'] as $question) {
              echo  '<div id="answer" class="text-start d-flex">
                      <h6 class="">' . $question['question'] . '
                      </h6>
                      <div class="text-danger fw-bold ms-auto">';
              if ($data['resultDetail'][$i] == 'Correct') {
                echo    '<span class="badge bg-light-success text-success">Correct</span>';
              } elseif ($data['resultDetail'][$i] == 'False') {
                echo    '<span class="badge bg-light-danger text-danger">False</span>';
              } else {
                echo    '<span class="badge bg-light-danger text-danger">Blank</span>';
              }
              echo    '</div>
                    </div>
                    <hr>';
              $i+=1;
            } 
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="/public/js/floating-btn.js"></script>
  <script src="/public/js/startClick.js"></script>
</body>

</html>