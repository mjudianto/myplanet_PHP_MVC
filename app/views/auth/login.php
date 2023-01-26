<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!--bootstrap harus tetep di atas file css-->
    <link rel="stylesheet" href="../public/css/app.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <?php 
  // echo sha1('password');
  ?>
  <body class="body-login">

    <div class="container">
      <div class="card card-login">
        <div class="card-body">
          <div class="text-center">
            <img src="assets/logo-2.png" alt="" class="mb-4" width="150" />
          </div>
          <form method="post" action="<?= BASEURL ?>login/auth">
            <div class="mb-3">
              <label
                for="exampleInputEmail1"
                class="form-label"
                aria-label="NIK"
                >NIK</label
              >
              <input
                type="text"
                <?php if(isset($_SESSION['falseLoginInfo'])): ?> class="form-control is-invalid" 
                <?php else: ?> class="form-control"
                <?php endif; ?>
                id="nik"
                aria-describedby="emailHelp"  
                style="border-radius: 10px"
                name="nik"
                placeholder="NIK"
              />
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label"
                >Password</label
              >
              <input
                type="password"
                <?php if(isset($_SESSION['falseLoginInfo'])): ?> class="form-control is-invalid" 
                <?php else: ?> class="form-control"
                <?php endif; ?>
                id="password"
                style="border-radius: 10px"
                name="password"
                placeholder="Password"
              />
              <div id="exampleInputPassword1Feedback" class="invalid-feedback">
              <?php if ($_SESSION['falseLoginInfo']): ?>
                <p style="color: red; font-weight: 500;">Login failed, invalid NIK or password</p>
              <?php endif; ?>
            </div>
            </div>
            
            <div class="mb-3 form-check">
              <input
                type="checkbox"
                class="form-check-input"
                id="exampleCheck1"
              />
              <label class="form-check-label" for="exampleCheck1"
                >Remember Me</label
              >
              <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"
                >Forgot Password?</a
              >
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-sign text-center">
                Login
              </button>
            </div>
          </form>

          <!-- <form action="">
            <div class="form-group">
              <label for="exampleInputEmail">NIK</label>
              <input
                type="email"
                class="form-control"
                id="exampleInputEmail"
                aria-describedby="emailHelp"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword">Password</label>
              <input
                type="password"
                class="form-control"
                id="exampleInputPassword"
              />
              <label class="form-check-label" for="exampleCheck"
                >Remember Me</label
              >
            </div>
            <button type="sumbit" class="btn btn-login btn-block">
              Sign In
            </button>
            <p class="text-center mt-4">
              <a href="">Saya lupa password</a>
            </p>
          </form> -->
        </div>
      </div>
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content modal-forget-pass">
            <div class="modal-header">
              <h5
                class="modal-title"
                id="exampleModalLabel"
                style="color: #ffffff"
              >
                Forgot Password
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label
                    for="recipient-name"
                    class="col-form-label"
                    style="color: #ffffff"
                    >NIK</label
                  >
                  <input type="text" class="form-control" id="recipient-name" />
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="button" class="btn btn-success">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="js/floating-btn.js"></script>
  </body>
</html>
