<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!--bootstrap harus tetep di atas file css-->
  <link rel="stylesheet" href="<?= BASEURL ?>css/app.css">
  <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>
  
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="<?= BASEURL ?>assets/logo.png" alt="" class="d-inline-block align-text-top"/>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <!-- <i class="fa fa-align-justify" style="color:white"></i> -->
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <!--ms itu margin kiri-->
          <li class="nav-item">
            <a 
            <?php if (!isset($_SESSION['page']) || isset($_SESSION['page']) && $_SESSION['page'] == 'home' || $_SESSION['page'] == ''): ?>
            class="nav-link active" 
            <?php else:  ?>
            class="nav-link"
            <?php endif; ?>
            aria-current="page" 
            href="<?= BASEURL ?>home">Home</a>
          </li>
          <li class="nav-item">
            <a 
            <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'elearning'): ?>
            class="nav-link active" 
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
              class="nav-link"
            href="<?= BASEURL ?>elearning">E-Learning</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a 
            <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'leadershipfestival'): ?>
            class="nav-link active" 
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
              class="nav-link"
            href="<?= BASEURL ?>">Leadership-Festival</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a
            <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'podtret'): ?>
            class="nav-link active"
            <?php else:  ?>
            class="nav-link"
            <?php endif; ?>
            href="<?= BASEURL ?>podtrets">Podtret</a>
          </li>
          <li class="nav-item">
            <a 
            <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'ensight'): ?>
            class="nav-link active" 
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
            class="nav-link"
            href="<?= BASEURL ?>ensight">Ensight</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <a 
            <?php if (isset($_SESSION['page']) && $_SESSION['page'] == 'community'): ?>
            class="nav-link active" 
            <?php endif; ?>
            <?php if (isset($_SESSION['user'])): ?>
            class="nav-link"
            href="<?= BASEURL ?>community">Community</a>
            <?php endif; ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Aplication
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">HRIS Pro Int</a></li>
              <li><a class="dropdown-item" href="#">LOAN Online</a></li>
              <li>
                <a class="dropdown-item" href="#">FPTK Online</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Assesment Online</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Administrasi Assesment</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">AP & PA Online</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">MPP Online</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Orens</a>
              </li>
            </ul>
          </li>

          <!-- <a class="btn btn-login ms-2" href="#" role="button">Sign Up</a> -->
        </ul>

        <!-- Sign In Display On Mobile -->
        <div class="d-inline d-sm-block d-md-none">
          <a href="#" class="btn btn-login my-2 my-sm-0">Sign In</a>
        </div>
        <!-- Desktop Button -->
        <?php if( !isset($_SESSION['user']) ): ?>
        <div class="d-inline ms-2 d-none d-md-block vl" style="border-left: solid 2px #ededed">
            <a class="btn btn-login btn-navbar-right ms-3" href="<?= BASEURL ?>login">Sign In</a>
        </div>
        <?php else: ?>
          <div class="vl ms-2" style="border-left: solid 2px #ededed">
            <img src="<?= BASEURL ?>images/image-profile.jpg" alt="" class="image-navbar ms-3" onclick="toggleMenu()" />

            <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                  <a href="profile.html"><img src="<?= BASEURL ?>images/image-profile.jpg" alt="" class="img-nav-submenu"></a>
                  <a href="<?= BASEURL ?>profile">
                    <h3><?php echo $_SESSION['user']['nama'] ?></h3>
                  </a>
                </div>
                <hr>
                <a href="<?= BASEURL ?>profile/changeProfile" class="sub-menu-link">
                  <i class="fa fa-user"></i>
                  <!-- <img src="assets/user-info.png" alt="" /> -->
                  <p>Edit Profile</p>
                  <span>></span>
                </a>
                <a href="" class="sub-menu-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fa fa-bell"></i>
                  <!-- <img src="assets/user-info.png" alt="" /> -->
                  <p>Notification</p>
                  <span>></span>
                </a>
                <a href="<?= BASEURL ?>login/logout" class="sub-menu-link">
                  <i class="fa fa-sign-out"></i>
                  <!-- <img src="assets/logout.png" alt="" /> -->
                  <p>Log Out</p>
                  <span>></span>
                </a>
                
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </nav>
  </div>

  <!-- Modal Notifikasi -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content modal-notification">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php 
            foreach($_SESSION['notification'] as $notification) {
              echo '<div class="d-flex list-notification">
                      <a href="e-learning-neopgeneral.html"><img src="images/img-notif.jpg" alt="" class="img-nav-submenu" /></a>
                      <a href="e-learning-neopgeneral.html"></a>
                      <div class="berita">
                        <p>
                          '
                          . $notification['message'] .
                          '
                        </p>
                        <p1>' . $notification['uploadDate'] . '</p1>
                        <a href=""><i class="fa fa-trash fa-lg trash-notification"></i></a>
                      </div>
          
                    </div>
                    <hr />';
            }
          ?>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Close
          </button>

        </div>
      </div>
    </div>
  </div>
  