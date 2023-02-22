<body class="body-profile">

  <div class="container profile-page">
    <h2>Hello <?php echo $_SESSION['user']['nama'] ?>!</h2>
    <p>Welcome back, glad to see you again.</p>
    <div class="card card-profile mt-5">
      <div class="row">
        <div class="col-lg-3 text-center align-self-center">
          <img src="images/image-profile.jpg" alt="" class="py-4 ms-2 avatar-large" />
        </div>
        <div class="col card-title-profile align-self-lg-center flex-column flex-lg-row mt-4 ps-4">
          <a href=""><?php echo $_SESSION['user']['nama'] ?></a>
          <p class="mt-2"><?php echo $_SESSION['user']['organizationName'] ?></p>
          <p1><?php echo $_SESSION['user']['locationName'] ?>, Indonesia</p1>
          <a href="<?php BASEURL ?>profile/changeProfile"><button type="button" class="btn btn-edit" style="float: right">
              <img src="assets/edit.svg" alt="" width="20" class="me-1" />
              Edit Profile
            </button></a>
        </div>
      </div>
    </div>
  </div>

  <div class="container info mt-4">
    <div class="card personal-info">
      <ul class="d-lg-flex menu-profile text-center mt-2">
        <li>
          <a class="btn btn-profile tablinks selected" type="button" onclick="toggleBtn(event, 'profile')">
            Profile
          </a>
        </li>
        <li>
          <a class="btn btn-profile tablinks" type="button" onclick="toggleBtn(event, 'training')">
            Training History
          </a>
        </li>
        <li>
          <a class="btn btn-profile tablinks" type="button" onclick="toggleBtn(event, 'test')">
            Test History
          </a>
        </li>
        <li>
          <a class="btn btn-profile tablinks" type="button" onclick="toggleBtn(event, 'certificate')">
            Training Certificate
          </a>
        </li>
        <li>
          <a class="btn btn-profile tablinks" type="button" onclick="toggleBtn(event, 'activity')">
            Activity
          </a>
        </li>
        <li>
          <a href="#" class="btn" style="border: transparent;" data-bs-toggle="modal" data-bs-target="#changePassModal">
            Change Password
          </a>
        </li>
      </ul>
      <div id="profileTab">
        <div class="profile-info" id="profile">
          <div class="card card-info mb-4">
            <h3 class="text-center mt-2">Personal Information</h3>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/user-info.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?php echo $_SESSION['user']['nama'] ?> <br />
                <span> Name</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/nik.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?php echo $_SESSION['user']['nik'] ?> <br />
                <span> NIK</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/telp.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?php echo $_SESSION['user']['phone'] ?> <br />
                <span> Phone</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/gmail-abu.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?php echo $_SESSION['user']['email'] ?> <br />
                <span> Mail</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/organization.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?php echo $_SESSION['user']['organizationName'] ?> <br />
                <span> Organization Name</span>
              </h5>
            </div>
          </div>
        </div>
        <div class="profile-info" id="training">
          <div class="card card-info mb-4">
            <h3 class="text-center mt-2">Training History</h3>
            <div class="px-3">
              <table class="table table-training-history mt-3" width="520px">
                <thead>
                  <tr class="table-success">
                    <th scope="col" class="text-center">
                      Nama Course
                    </th>
                    <th scope="col" class="text-center">
                      Nama Lesson
                    </th>
                    <th scope="col" class="text-center">
                      Percobaan
                    </th>
                    <th scope="col" class="text-center">
                      Finish Date
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <?= print_r($data['userRecord']) ?> -->
                  <?php foreach($data['userRecord'] as $record) {
                    echo '<tr class="table-secondary">
                    <th scope="row" class="text-center">' . $record['judul course'] . '</th>
                    <td class="text-center">' . $record['judul lesson'] . '</td>
                    <td class="text-center">' . $record['attempt'] . '</td>
                    <td class="text-center">' . $record['finished'] . '</td>
                  </tr>';
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="profile-info" id="test">
          <div class="card card-info mb-4">
            <h3 class="text-center mt-2">Training History</h3>
            <div class="px-3">
              <table class="table table-training-history mt-3" width="520px">
                <thead>
                  <tr class="table-success">
                    <th scope="col" class="text-center">
                      Nama Course
                    </th>
                    <th scope="col" class="text-center">
                      Nama Lesson
                    </th>
                    <th scope="col" class="text-center">
                      Percobaan
                    </th>
                    <th scope="col" class="text-center">
                      Status
                    </th>
                    <th scope="col" class="text-center">
                      Score
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($data['userTestRecord'] as $record) {
                    echo '<tr class="table-secondary">
                    <th scope="row" class="text-center">' . $record['judul course'] . '</th>
                    <td class="text-center">' . $record['judul test'] . '</td>
                    <td class="text-center">' . $record['attemptNumber'] . '</td>
                    <td class="text-center">' . $record['status'] . '</td>
                    <td class="text-center">' . $record['score'] . '</td>
                  </tr>';
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="profile-info" id="certificate">
          <div class="card card-info mb-4">
            <h3 class="text-center mt-2">Training Certificate</h3>
            <div class="px-2">
              <table class="table table-training-certificate mt-3">
                <thead>
                  <tr class="table-success">
                    <th scope="col" class="text-center">Nama Course</th>
                    <th scope="col" class="text-center">No Lesson</th>
                    <th scope="col" class="text-center">
                      No Lesson Completed
                    </th>
                    <th scope="col" class="text-center">Status Sertifikat</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table-secondary">
                    <th scope="row" class="text-center">NEOP GENERAL</th>
                    <td class="text-center">21</td>
                    <td class="text-center">14</td>
                    <td class="text-center">Completed</td>
                    <td class="text-center">
                      <button class="btn btn-lihat text-center">Lihat</button>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-center">NEOP WAREHOUSE</th>
                    <td class="text-center">31</td>
                    <td class="text-center">14</td>
                    <td class="text-center">Completed</td>
                    <td class="text-center">
                      <button class="btn btn-lihat text-center">Lihat</button>
                    </td>
                  </tr>
                  <tr class="table-secondary">
                    <th scope="row" class="text-center">
                      NEOP Transportation
                    </th>
                    <td class="text-center">19</td>
                    <td class="text-center">14</td>
                    <td class="text-center">Completed</td>
                    <td class="text-center">
                      <button class="btn btn-lihat text-center">Lihat</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="profile-info" id="activity">
          <div class="card card-info-activity mb-4">
            <h3 class="text-center mt-2">Activity</h3>

            <!-- POSTINGAN PERTAMA -->
            <div class="postingan-konten mt-4">
              <div class="profile-user d-flex">
                <a href=""><img src="images/farsa.jpg" alt="" class="img-user"></a>

                <div class="section-comment ms-3">
                  <a href="">
                    <p class="user-comment">Farsa Fadilla <br> <span>UI/UX Designer</span></p>
                  </a>
                </div>

                <div class="button-more" style="float: right; margin-left: auto;">
                  <div class="wrapper">
                    <div class="notification_wrap">
                      <div class="more-btn-section-comment">
                        <!-- <i class="fa fa-bell"></i> -->
                        <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                      </div>
                      <div class="menu-sec-comment">
                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-trash fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalDeleteMoreComment">
                              <p>Delete</p>
                            </button>
                          </div>
                        </div>


                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-edit fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalEditMoreComment">
                              <p>Edit Post</p>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-post">
                <p>Planning on doing an article series on Knowledge Sharing. Give this post a like if that's something
                  you
                  guys might be interested to see!</p>
              </div>
              <div class="like-comment-info d-flex">
                <i class="fa fa-thumbs-up fa-lg" style="color: blue"></i>
                <p class="whos-like">Bella and 91 others</p>
                <a class="count-comment" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsTester" aria-expanded="false"
                  aria-controls="collapseCommentsTester">7 comments</a>
              </div>
              <div class="button-like-comment text-center border-top border-bottom">
                <div class="button-like justify-content-center">
                  <button class="btn-like d-flex me-2"><i class="fa fa-thumbs-up fa-lg me-2"
                      style="color: #7a7a7a;"></i>
                    <p>Like</p>
                  </button>
                  <button class="btn-like d-flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCommentsTester" aria-expanded="false"
                    aria-controls="collapseCommentsTester"><img src="assets/icon/ic-comment.png" alt="" class="me-2"
                      style="width: 25px; height: 25px; margin-top: -2px;">
                    <p>Comment</p>
                  </button>
                </div>

                <!-- <button class="btn-like-comment"><i class="fa fa-thumbs-up fa-lg me-2" style="color: #7a7a7a;">
                    Like</i></button>
                <button class="btn-like-comment"><i class="fa fa-comment fa-lg ms-2" style="color: #7a7a7a">
                    Comments</i></button> -->
              </div>
              <div class="collapse mt-2" id="collapseCommentsTester">
                <button class="btn-load-more" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsMore" aria-expanded="false" aria-controls="collapseCommentsMore">Load
                  more...</button>
                <div class="collapse mt-2" id="collapseCommentsMore">
                  <div class="card card-comment-section">
                    <div class="profile-user d-flex" style="padding: 10px 0px">
                      <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                      <div class="section-comment ms-3">
                        <a href="">
                          <p class="user-comment-post">Annisa Az-zahra</p>
                        </a>

                        <p class="text-comment">Lorem ipsum</p>
                        <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseReplyComments" aria-expanded="false"
                          aria-controls="collapseReplyComments">
                          Reply
                        </button>
                      </div>

                      <div class="button-more" style="float: right; margin-left: auto;">
                        <div class="wrapper">
                          <div class="notification_wrap">
                            <div class="more-btn-section-comment">
                              <!-- <i class="fa fa-bell"></i> -->
                              <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                            </div>
                            <div class="menu-sec-comment">
                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-trash fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMoreComment">
                                    <p>Delete</p>
                                  </button>
                                </div>
                              </div>

                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-edit fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMoreComment">
                                    <p>Edit Post</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="collapse" id="collapseReplyComments">
                      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                        placeholder="Write Comment"></textarea> -->
                      <div class="reply-comment-section d-flex">
                        <div class="img-reply me-3 mt-2">
                          <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                        </div>
                        <div class="input-group mb-3 mt-2">
                          <input type="text" class="form-control comment-form" placeholder="Write comment..."
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="background-color: #ededed">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="margin-top: 10px">
                </div>

                <!-- Perpisahan Load More -->

                <div class="card card-comment-section">
                  <div class="profile-user d-flex" style="padding: 10px 0px">
                    <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Bella Swan</p>
                      </a>

                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem
                        tempore suscipit illo quo,</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>
                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>


                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <hr style="margin-top: 10px">

                <div class="card card-comment-section">

                  <div class="profile-user d-flex" style="padding: 10px 0px;">
                    <a href=""><img src="images/JhonnyDepp.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Jhonny Depp</p>
                      </a>
                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>

                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>

                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr style="margin-top: 10px">

                <div class="reply-comment-section d-flex">
                  <div class="img-reply me-3 mt-2">
                    <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                  </div>
                  <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control comment-form" placeholder="Write comment..."
                      aria-label="Recipient's username" aria-describedby="button-addon2"
                      style="background-color: #ededed">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                      style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                    </button>
                  </div>
                </div>



              </div>
            </div>

            <!-- POSTINGAN KEDUA -->
            <div class="postingan-konten mt-4">
              <div class="profile-user d-flex">
                <a href=""><img src="images/Image 17.jpg" alt="" class="img-user"></a>

                <div class="section-comment ms-3">
                  <a href="">
                    <p class="user-comment">Kevin Wijaya <br> <span>Back-End Developer</span></p>
                  </a>
                </div>

                <div class="button-more" style="float: right; margin-left: auto;">
                  <div class="wrapper">
                    <div class="notification_wrap">
                      <div class="more-btn-section-comment">
                        <!-- <i class="fa fa-bell"></i> -->
                        <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                      </div>
                      <div class="menu-sec-comment">
                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-trash fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalDeleteMoreComment">
                              <p>Delete</p>
                            </button>
                          </div>
                        </div>


                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-edit fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalEditMoreComment">
                              <p>Edit Post</p>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-post">
                <p>The inauguration</p>
                <img src="images/image-1-post.jpg" alt="" class="image-1-posting-activity">
                <div class="image-posting-secondary d-flex row mb-3">
                  <div class="col"><img src="images/secondary-1.jpg" alt=""
                      class="image-secondary-posting-activity me-4"></div>
                  <div class="col"><img src="images/haloween.jpg" alt="" class="image-secondary-posting-activity me-4">
                  </div>
                  <div class="col"><img src="images/astronout.jpg" alt="" class="image-secondary-posting-activity">
                  </div>
                </div>
              </div>
              <div class="like-comment-info d-flex">
                <i class="fa fa-thumbs-up fa-lg" style="color: blue"></i>
                <p class="whos-like">Bella and 91 others</p>
                <a class="count-comment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentsDua"
                  aria-expanded="false" aria-controls="collapseCommentsDua">7 comments</a>
              </div>
              <div class="button-like-comment text-center border-top border-bottom">
                <div class="button-like justify-content-center">
                  <button class="btn-like d-flex me-2"><i class="fa fa-thumbs-up fa-lg me-2"
                      style="color: #7a7a7a;"></i>
                    <p>Like</p>
                  </button>
                  <button class="btn-like d-flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCommentsDua" aria-expanded="false" aria-controls="collapseCommentsDua"><img
                      src="assets/icon/ic-comment.png" alt="" class="me-2"
                      style="width: 25px; height: 25px; margin-top: -2px;">
                    <p>Comment</p>
                  </button>
                </div>

                <!-- <button class="btn-like-comment"><i class="fa fa-thumbs-up fa-lg me-2" style="color: #7a7a7a;">
                    Like</i></button>
                <button class="btn-like-comment"><i class="fa fa-comment fa-lg ms-2" style="color: #7a7a7a">
                    Comments</i></button> -->
              </div>
              <div class="collapse mt-2" id="collapseCommentsDua">
                <button class="btn-load-more" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsMoreDua" aria-expanded="false"
                  aria-controls="collapseCommentsMoreDua">Load
                  more...</button>
                <div class="collapse mt-2" id="collapseCommentsMoreDua">
                  <div class="card card-comment-section">
                    <div class="profile-user d-flex" style="padding: 10px 0px">
                      <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                      <div class="section-comment ms-3">
                        <a href="">
                          <p class="user-comment-post">Annisa Az-zahra</p>
                        </a>

                        <p class="text-comment">Lorem ipsum</p>
                        <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseReplyComments" aria-expanded="false"
                          aria-controls="collapseReplyComments">
                          Reply
                        </button>
                      </div>

                      <div class="button-more" style="float: right; margin-left: auto;">
                        <div class="wrapper">
                          <div class="notification_wrap">
                            <div class="more-btn-section-comment">
                              <!-- <i class="fa fa-bell"></i> -->
                              <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                            </div>
                            <div class="menu-sec-comment">
                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-trash fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMoreComment">
                                    <p>Delete</p>
                                  </button>
                                </div>
                              </div>

                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-edit fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMoreComment">
                                    <p>Edit Post</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="collapse" id="collapseReplyComments">
                      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                        placeholder="Write Comment"></textarea> -->
                      <div class="reply-comment-section d-flex">
                        <div class="img-reply me-3 mt-2">
                          <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                        </div>
                        <div class="input-group mb-3 mt-2">
                          <input type="text" class="form-control comment-form" placeholder="Write comment..."
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="background-color: #ededed">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="margin-top: 10px">
                </div>

                <!-- Perpisahan Load More -->

                <div class="card card-comment-section">
                  <div class="profile-user d-flex" style="padding: 10px 0px">
                    <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Bella Swan</p>
                      </a>

                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem
                        tempore suscipit illo quo,</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>
                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <hr style="margin-top: 10px">

                <div class="card card-comment-section">

                  <div class="profile-user d-flex" style="padding: 10px 0px;">
                    <a href=""><img src="images/JhonnyDepp.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Jhonny Depp</p>
                      </a>
                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>

                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>





                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr style="margin-top: 10px">

                <div class="reply-comment-section d-flex">
                  <div class="img-reply me-3 mt-2">
                    <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                  </div>
                  <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control comment-form" placeholder="Write comment..."
                      aria-label="Recipient's username" aria-describedby="button-addon2"
                      style="background-color: #ededed">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                      style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                    </button>
                  </div>
                </div>



              </div>
            </div>

            <!-- POSTINGAN KETIGA -->
            <div class="postingan-konten mt-4">
              <div class="profile-user d-flex">
                <a href=""><img src="images/john-lemon.jpg" alt="" class="img-user"></a>

                <div class="section-comment ms-3">
                  <a href="">
                    <p class="user-comment">John Lemon <br> <span>Human Resource Development</span></p>
                    <p class="point-on-sm">5 Points Earned</p>
                  </a>
                </div>

                <!-- <div class="point-earned d-none d-lg-block">
                  <p>5 Points</p>
                </div> -->

                <div class="button-more" style="float: right; margin-left: auto;">
                  <div class="wrapper">
                    <div class="notification_wrap">
                      <div class="more-btn-section-comment">
                        <!-- <i class="fa fa-bell"></i> -->
                        <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                      </div>
                      <div class="menu-sec-comment">
                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-trash fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalDeleteMoreComment">
                              <p>Delete</p>
                            </button>
                          </div>
                        </div>


                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-edit fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalEditMoreComment">
                              <p>Edit Post</p>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-post">
                <p>Hello! <br>
                  I want to share my article about Blockchain-based recommender systems: Applications,
                  challenges and future opportunities </p>
                <div class="container jurnal-pdf mb-3">
                  <div class="d-flex">
                    <a href=""><img src="images/pict-jurnal.jpg" alt="" class="picture-jurnal"></a>
                    <a href="" class="link-to-jurnal">Blockchain-based recommender systems:
                      Applications, challenges and future opportunities.pdf</a>
                  </div>
                </div>
              </div>
              <div class="like-comment-info d-flex">
                <i class="fa fa-thumbs-up fa-lg" style="color: blue"></i>
                <p class="whos-like">Bella and 91 others</p>
                <a class="count-comment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentsTiga"
                  aria-expanded="false" aria-controls="collapseCommentsTiga">7 comments</a>
              </div>
              <div class="button-like-comment text-center border-top border-bottom">
                <div class="button-like justify-content-center">
                  <button class="btn-like d-flex me-2"><i class="fa fa-thumbs-up fa-lg me-2"
                      style="color: #7a7a7a;"></i>
                    <p>Like</p>
                  </button>
                  <button class="btn-like d-flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCommentsTiga" aria-expanded="false"
                    aria-controls="collapseCommentsTiga"><img src="assets/icon/ic-comment.png" alt="" class="me-2"
                      style="width: 25px; height: 25px; margin-top: -2px;">
                    <p>Comment</p>
                  </button>
                </div>

                <!-- <button class="btn-like-comment"><i class="fa fa-thumbs-up fa-lg me-2" style="color: #7a7a7a;">
                    Like</i></button>
                <button class="btn-like-comment"><i class="fa fa-comment fa-lg ms-2" style="color: #7a7a7a">
                    Comments</i></button> -->
              </div>
              <div class="collapse mt-2" id="collapseCommentsTiga">
                <button class="btn-load-more" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsMoreTiga" aria-expanded="false"
                  aria-controls="collapseCommentsMoreTiga">Load more...</button>
                <div class="collapse mt-2" id="collapseCommentsMoreTiga">
                  <div class="card card-comment-section">
                    <div class="profile-user d-flex" style="padding: 10px 0px">
                      <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                      <div class="section-comment ms-3">
                        <a href="">
                          <p class="user-comment-post">Annisa Az-zahra</p>
                        </a>

                        <p class="text-comment">Lorem ipsum</p>
                        <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseReplyComments" aria-expanded="false"
                          aria-controls="collapseReplyComments">
                          Reply
                        </button>
                      </div>

                      <div class="button-more" style="float: right; margin-left: auto;">
                        <div class="wrapper">
                          <div class="notification_wrap">
                            <div class="more-btn-section-comment">
                              <!-- <i class="fa fa-bell"></i> -->
                              <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                            </div>
                            <div class="menu-sec-comment">
                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-trash fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMoreComment">
                                    <p>Delete</p>
                                  </button>
                                </div>
                              </div>

                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-edit fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMoreComment">
                                    <p>Edit Post</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="collapse" id="collapseReplyComments">
                      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                        placeholder="Write Comment"></textarea> -->
                      <div class="reply-comment-section d-flex">
                        <div class="img-reply me-3 mt-2">
                          <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                        </div>
                        <div class="input-group mb-3 mt-2">
                          <input type="text" class="form-control comment-form" placeholder="Write comment..."
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="background-color: #ededed">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="margin-top: 10px">
                </div>

                <!-- Perpisahan Load More -->

                <div class="card card-comment-section">
                  <div class="profile-user d-flex" style="padding: 10px 0px">
                    <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Bella Swan</p>
                      </a>

                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem
                        tempore suscipit illo quo,</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>
                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <hr style="margin-top: 10px">

                <div class="card card-comment-section">

                  <div class="profile-user d-flex" style="padding: 10px 0px;">
                    <a href=""><img src="images/JhonnyDepp.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Jhonny Depp</p>
                      </a>
                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>

                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>

                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>





                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr style="margin-top: 10px">

                <div class="reply-comment-section d-flex">
                  <div class="img-reply me-3 mt-2">
                    <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                  </div>
                  <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control comment-form" placeholder="Write comment..."
                      aria-label="Recipient's username" aria-describedby="button-addon2"
                      style="background-color: #ededed">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                      style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                    </button>
                  </div>
                </div>



              </div>
            </div>

            <!-- POSTINGAN KEEMPAT -->
            <div class="postingan-konten mt-4">
              <div class="profile-user d-flex">
                <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                <div class="section-comment ms-3">
                  <a href="">
                    <p class="user-comment">Annisa Az-Zahra <br> <span>Finanial Accounting</span></p>
                  </a>
                </div>

                <div class="button-more" style="float: right; margin-left: auto;">
                  <div class="wrapper">
                    <div class="notification_wrap">
                      <div class="more-btn-section-comment">
                        <!-- <i class="fa fa-bell"></i> -->
                        <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                      </div>
                      <div class="menu-sec-comment">
                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-trash fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalDeleteMoreComment">
                              <p>Delete</p>
                            </button>
                          </div>
                        </div>


                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-edit fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal" data-bs-target="#modalEvent">
                              <p>Edit Post</p>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-post">
                <img src="images/banner-event.jpg" alt="" class="banner-post-event-activity">
                <h5 class="title-event-post">What is customer Discovery? With steve Sivitz at the
                  REC Innovation Lab.</h5>
                <div class="date-event-post d-flex mt-3">
                  <img src="assets/icon/ic-tanggal.png" alt="">
                  <p class="date-event" style="font-weight: 400; color: #707070">Mon, 26 April 2022, 1:00 PM - 3:00 PM
                  </p>
                </div>
                <div class="date-event-post d-flex">
                  <img src="assets/icon/ic-venue.png" alt="">
                  <p class="date-event" style="font-weight: 400; color: #707070; margin-top: 5px;">Online</p>
                </div>
                <h5 style="color: #000000;">Detail</h5>
                <p class="description-event">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                  irure dolor
                </p>
              </div>
              <div class="like-comment-info d-flex">
                <i class="fa fa-thumbs-up fa-lg" style="color: blue"></i>
                <p class="whos-like">Bella and 91 others</p>
                <a class="count-comment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentsEmpat"
                  aria-expanded="false" aria-controls="collapseCommentsEmpat">7 comments</a>
              </div>
              <div class="button-like-comment text-center border-top border-bottom">
                <div class="button-like justify-content-center">
                  <button class="btn-like d-flex me-2"><i class="fa fa-thumbs-up fa-lg me-2"
                      style="color: #7a7a7a;"></i>
                    <p>Like</p>
                  </button>
                  <button class="btn-like d-flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCommentsEmpat" aria-expanded="false"
                    aria-controls="collapseCommentsEmpat"><img src="assets/icon/ic-comment.png" alt="" class="me-2"
                      style="width: 25px; height: 25px; margin-top: -2px;">
                    <p>Comment</p>
                  </button>
                </div>

                <!-- <button class="btn-like-comment"><i class="fa fa-thumbs-up fa-lg me-2" style="color: #7a7a7a;">
                    Like</i></button>
                <button class="btn-like-comment"><i class="fa fa-comment fa-lg ms-2" style="color: #7a7a7a">
                    Comments</i></button> -->
              </div>
              <div class="collapse mt-2" id="collapseCommentsEmpat">
                <button class="btn-load-more" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsMoreEmpat" aria-expanded="false"
                  aria-controls="collapseCommentsMoreEmpat">Load more...</button>
                <div class="collapse mt-2" id="collapseCommentsMoreEmpat">
                  <div class="card card-comment-section">
                    <div class="profile-user d-flex" style="padding: 10px 0px">
                      <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                      <div class="section-comment ms-3">
                        <a href="">
                          <p class="user-comment-post">Annisa Az-zahra</p>
                        </a>

                        <p class="text-comment">Lorem ipsum</p>
                        <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseReplyComments" aria-expanded="false"
                          aria-controls="collapseReplyComments">
                          Reply
                        </button>
                      </div>

                      <div class="button-more" style="float: right; margin-left: auto;">
                        <div class="wrapper">
                          <div class="notification_wrap">
                            <div class="more-btn-section-comment">
                              <!-- <i class="fa fa-bell"></i> -->
                              <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                            </div>
                            <div class="menu-sec-comment">
                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-trash fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMoreComment">
                                    <p>Delete</p>
                                  </button>
                                </div>
                              </div>

                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-edit fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMoreComment">
                                    <p>Edit Post</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="collapse" id="collapseReplyComments">
                      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                        placeholder="Write Comment"></textarea> -->
                      <div class="reply-comment-section d-flex">
                        <div class="img-reply me-3 mt-2">
                          <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                        </div>
                        <div class="input-group mb-3 mt-2">
                          <input type="text" class="form-control comment-form" placeholder="Write comment..."
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="background-color: #ededed">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="margin-top: 10px">
                </div>

                <!-- Perpisahan Load More -->

                <div class="card card-comment-section">
                  <div class="profile-user d-flex" style="padding: 10px 0px">
                    <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Bella Swan</p>
                      </a>

                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem
                        tempore suscipit illo quo,</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>
                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">

                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <hr style="margin-top: 10px">

                <div class="card card-comment-section">

                  <div class="profile-user d-flex" style="padding: 10px 0px;">
                    <a href=""><img src="images/JhonnyDepp.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Jhonny Depp</p>
                      </a>
                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>

                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>





                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr style="margin-top: 10px">

                <div class="reply-comment-section d-flex">
                  <div class="img-reply me-3 mt-2">
                    <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                  </div>
                  <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control comment-form" placeholder="Write comment..."
                      aria-label="Recipient's username" aria-describedby="button-addon2"
                      style="background-color: #ededed">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                      style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                    </button>
                  </div>
                </div>



              </div>
            </div>

            <!-- POSTINGAN KELIMA -->
            <div class="postingan-konten mt-4">
              <div class="profile-user d-flex">
                <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                <div class="section-comment ms-3">
                  <a href="">
                    <p class="user-comment">Bella Swan <br> <span>Data Analyst</span></p>
                  </a>
                </div>

                <div class="button-more" style="float: right; margin-left: auto;">
                  <div class="wrapper">
                    <div class="notification_wrap">
                      <div class="more-btn-section-comment">
                        <!-- <i class="fa fa-bell"></i> -->
                        <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                      </div>
                      <div class="menu-sec-comment">
                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-trash fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal"
                              data-bs-target="#modalDeleteMoreComment">
                              <p>Delete</p>
                            </button>
                          </div>
                        </div>


                        <div class="notify_item">
                          <div class="notify_img">
                            <i class="fa fa-edit fa-lg"></i>
                          </div>
                          <div class="notify_info">
                            <button class="btn-delete-inmore" data-bs-toggle="modal" data-bs-target="#modalCareer">
                              <p>Edit Post</p>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-post">
                <img src="images/banner-career.jpg" alt="" class="banner-post-event-activity">
                <h5 class="title-event-post mb-4">Development Career</h5>
                <h5 style="color: #000000;">Detail</h5>
                <p class="description-career">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                  tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                  irure dolor
                </p>
              </div>
              <div class="like-comment-info d-flex">
                <i class="fa fa-thumbs-up fa-lg" style="color: blue"></i>
                <p class="whos-like">Bella and 91 others</p>
                <a class="count-comment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCommentsLima"
                  aria-expanded="false" aria-controls="collapseCommentsLima">7 comments</a>
              </div>
              <div class="button-like-comment text-center border-top border-bottom">
                <div class="button-like justify-content-center">
                  <button class="btn-like d-flex me-2"><i class="fa fa-thumbs-up fa-lg me-2" style="color: blue;"></i>
                    <p>Like</p>
                  </button>
                  <button class="btn-like d-flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseCommentsLima" aria-expanded="false"
                    aria-controls="collapseCommentsLima"><img src="assets/icon/ic-comment.png" alt="" class="me-2"
                      style="width: 25px; height: 25px; margin-top: -2px;">
                    <p>Comment</p>
                  </button>
                </div>

                <!-- <button class="btn-like-comment"><i class="fa fa-thumbs-up fa-lg me-2" style="color: #7a7a7a;">
                    Like</i></button>
                <button class="btn-like-comment"><i class="fa fa-comment fa-lg ms-2" style="color: #7a7a7a">
                    Comments</i></button> -->
              </div>
              <div class="collapse mt-2" id="collapseCommentsLima">
                <button class="btn-load-more" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseCommentsMoreLima" aria-expanded="false"
                  aria-controls="collapseCommentsMoreLima">Load more...</button>
                <div class="collapse mt-2" id="collapseCommentsMoreLima">
                  <div class="card card-comment-section">
                    <div class="profile-user d-flex" style="padding: 10px 0px">
                      <a href=""><img src="images/annisa-az-zahra.jpg" alt="" class="img-user"></a>

                      <div class="section-comment ms-3">
                        <a href="">
                          <p class="user-comment-post">Annisa Az-zahra</p>
                        </a>

                        <p class="text-comment">Lorem ipsum</p>
                        <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseReplyComments" aria-expanded="false"
                          aria-controls="collapseReplyComments">
                          Reply
                        </button>
                      </div>

                      <div class="button-more" style="float: right; margin-left: auto;">
                        <div class="wrapper">
                          <div class="notification_wrap">
                            <div class="more-btn-section-comment">
                              <!-- <i class="fa fa-bell"></i> -->
                              <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                            </div>
                            <div class="menu-sec-comment">
                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-trash fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalDeleteMoreComment">
                                    <p>Delete</p>
                                  </button>
                                </div>
                              </div>

                              <div class="notify_item">
                                <div class="notify_img">
                                  <i class="fa fa-edit fa-lg"></i>
                                </div>
                                <div class="notify_info">
                                  <button class="btn-delete-inmore" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMoreComment">
                                    <p>Edit Post</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="collapse" id="collapseReplyComments">
                      <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                        placeholder="Write Comment"></textarea> -->
                      <div class="reply-comment-section d-flex">
                        <div class="img-reply me-3 mt-2">
                          <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                        </div>
                        <div class="input-group mb-3 mt-2">
                          <input type="text" class="form-control comment-form" placeholder="Write comment..."
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            style="background-color: #ededed">
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="margin-top: 10px">
                </div>

                <!-- Perpisahan Load More -->

                <div class="card card-comment-section">
                  <div class="profile-user d-flex" style="padding: 10px 0px">
                    <a href=""><img src="images/bellaswan.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Bella Swan</p>
                      </a>

                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quidem
                        tempore suscipit illo quo,</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>
                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>

                </div>

                <hr style="margin-top: 10px">

                <div class="card card-comment-section">

                  <div class="profile-user d-flex" style="padding: 10px 0px;">
                    <a href=""><img src="images/JhonnyDepp.jpg" alt="" class="img-user"></a>

                    <div class="section-comment ms-3">
                      <a href="">
                        <p class="user-comment-post">Jhonny Depp</p>
                      </a>
                      <p class="text-comment">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto</p>
                      <button class="btn-reply-comment" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReplyComments" aria-expanded="false"
                        aria-controls="collapseReplyComments">
                        Reply
                      </button>

                    </div>

                    <div class="button-more" style="float: right; margin-left: auto;">
                      <div class="wrapper">
                        <div class="notification_wrap">
                          <div class="more-btn-section-comment">
                            <!-- <i class="fa fa-bell"></i> -->
                            <img src="assets/icon/Menu More.png" alt="" class="delete-edit-section-comment">
                          </div>
                          <div class="menu-sec-comment">
                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-trash fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalDeleteMoreComment">
                                  <p>Delete</p>
                                </button>
                              </div>
                            </div>

                            <div class="notify_item">
                              <div class="notify_img">
                                <i class="fa fa-edit fa-lg"></i>
                              </div>
                              <div class="notify_info">
                                <button class="btn-delete-inmore" data-bs-toggle="modal"
                                  data-bs-target="#modalEditMoreComment">
                                  <p>Edit Post</p>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>





                  <div class="collapse" id="collapseReplyComments">
                    <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                      placeholder="Write Comment"></textarea> -->
                    <div class="reply-comment-section d-flex">
                      <div class="img-reply me-3 mt-2">
                        <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                      </div>
                      <div class="input-group mb-3 mt-2">
                        <input type="text" class="form-control comment-form" placeholder="Write comment..."
                          aria-label="Recipient's username" aria-describedby="button-addon2"
                          style="background-color: #ededed">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                          style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <hr style="margin-top: 10px">

                <div class="reply-comment-section d-flex">
                  <div class="img-reply me-3 mt-2">
                    <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
                  </div>
                  <div class="input-group mb-3 mt-2">
                    <input type="text" class="form-control comment-form" placeholder="Write comment..."
                      aria-label="Recipient's username" aria-describedby="button-addon2"
                      style="background-color: #ededed">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                      style="background-color: #ededed; font-weight: 600; color: #707070;">Comment
                    </button>
                  </div>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal Change Password-->
  <div class="modal fade" id="ChangePassModal" tabindex="-1" aria-labelledby="ChangePassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content card-change-pass">
        <div class="body">
          <div class="card card-change-pass">
            <div class="card-body">
              <div class="text-center">
                <img src="assets/logo-2.png" alt="" class="mb-4" width="150">
              </div>
              <form class="" method="post" action="<?php BASEURL ?>profile/changePassword">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Current Password</label>
                  <input type="password" class="form-control" id="currentPassword" name="currentPassword" style="border-radius: 10px">
                  <label for="exampleInputPassword1" class="form-label mt-3">New Password</label>
                  <input type="password" class="form-control" id="newPassword" name="newPassword" style="border-radius: 10px">
                  <label for="exampleInputPassword1" class="form-label mt-3">Confirm Password</label>
                  <input type="password" class="form-control" id="newPasswordConfirm" name="newPasswordConfirm" style="border-radius: 10px">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-ubah-pass text-center mt-2">
                    Ubah Password
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal Delete POSTING -->
  <div class="modal fade" id="modalDeleteMore" tabindex="-1" aria-labelledby="modalDeleteMoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class=" modal-title fs-5" id="modalDeleteMoreLabel" style="font-weight: 600">
            Delete</h1>
        </div>
        <div class="modal-body text-center" style="font-weight: 500">
          Are you sure about deleting this post?
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit POSTING -->
  <div class="modal fade" id="modalEditMore" tabindex="-1" aria-labelledby="modalEditMore" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="modalEditMore" style="font-weight: 600;">Make a Post</h1>
        </div>
        <div class="modal-body">
          <div class="profile-user d-flex col-lg-10">
            <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
            <a href="">
              <p class="ms-3">Harry Maguire <br> <span>UI/UX Designer</span></p>
            </a>
          </div>
          <div class="mb-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write about something"
              style="background-color: #EDEEF9; border-radius: 10px;"></textarea>
          </div>
          <div class="make-post">
            <label class="label-make-post" for="inputTag">
              Upload Photo/Video <br />
              <!-- <i class="fa fa-2x fa-camera"></i> -->
              <img src="assets/icon/ic-post.svg" alt="">
              <input class="input-tag-post" id="inputTag" type="file" />
              <br />
              <span id="imageName"></span>
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-post">Edit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DELETE COMMENT -->
  <div class="modal fade" id="modalDeleteMoreComment" tabindex="-1" aria-labelledby="modalDeleteMoreCommentLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class=" modal-title fs-5" id="modalDeleteMoreCommentLabel" style="font-weight: 600">
            Delete</h1>
        </div>
        <div class="modal-body text-center" style="font-weight: 500">
          Are you sure about deleting this comment?
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT COMMENT -->
  <div class="modal fade" id="modalEditMoreComment" tabindex="-1" aria-labelledby="modalEditMoreComment"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="modalEditMoreComment" style="font-weight: 600;">Edit
            Post
          </h1>
        </div>
        <div class="modal-body">
          <div class="profile-user d-flex col-lg-10">
            <a href=""><img src="images/image-profile.jpg" alt="" class="img-user"></a>
            <a href="">
              <p class="ms-3"><?php echo $_SESSION['user']['nama'] ?><br> <span>UI/UX Designer</span></p>
            </a>
          </div>
          <div class="mb-3">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write about something"
              style="background-color: #EDEEF9; border-radius: 10px;"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-post">Edit</button>
        </div>
      </div>
    </div>
  </div>
</body>