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
          <p class="mt-2"><?php echo $_SESSION['user']['departmentName'] ?></p>
          <p1><?php echo $_SESSION['user']['locationName'] ?>, Indonesia</p1>
          <!-- <a href="<?php BASEURL ?>profile/changeProfile"><button type="button" class="btn btn-edit" style="float: right">
              <img src="assets/edit.svg" alt="" width="20" class="me-1" />
              Edit Profile
            </button></a> -->
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
                <?= $_SESSION['user']['nama'] ?> <br />
                <span> Name</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/nik.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?= $_SESSION['user']['nik'] ?> <br />
                <span> NIK</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/telp.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?= $_SESSION['user']['phone'] ?> <br />
                <span> Phone</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/gmail-abu.png" alt="" width="25" height="25" />
              <h5 class="ms-3">
                <?= $_SESSION['user']['email'] ?> <br />
                <span> Mail</span>
              </h5>
            </div>
            <div class="d-flex nama-user ms-4 mt-3">
              <img src="assets/organization.png" alt="" width="25" height="25" />
              <h5 class="ms-3"> 
                <?= $_SESSION['user']['organizationName'] ?> - <?= $_SESSION['user']['departmentName'] ?> <br />
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
              <form class="" method="post" action="<?php BASEURL ?>profile/changePassword?nik=<?= $_SESSION['user']['nik'] ?>">
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