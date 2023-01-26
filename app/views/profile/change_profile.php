
<body class="body-profile">

<!-- Modal Notifikasi -->
<div
  class="modal fade"
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content modal-notification">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="d-flex list-notification">
          <a href="e-learning-neopgeneral.html"
            ><img src="/public/images/img-notif.jpg" alt="" class="img-nav-submenu"
          /></a>
          <a href="e-learning-neopgeneral.html"></a>
            <div class="berita">
              <p>
                Undangan! Kamu di undang untuk mengikuti kegiatan training
                mengenai IT Security
              </p>
              <p1>18 September 2022</p1>
              <a href=""><i class="fa fa-trash fa-lg trash-notification"></i></a>
            </div>
          </a>
        </div>
        <hr />
        <div class="d-flex list-notification">
          <a href="profile.html"
            ><img src="images/img-notif.jpg" alt="" class="img-nav-submenu"
          /></a>
          <a href="profile.html"
            >
            <div class="berita">
              <p>
                Selamat! sertifikat anda sudah terbit, untuk melihat silahkan kunjungi halaman profile
              </p>
              <p1>12 September 2022</p1>
              <a href=""><i class="fa fa-trash fa-lg trash-notification"></i></a>
            </div>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
        >
          Close
        </button>
        
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row gutters">
    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
      <div class="card h-100 card-edit-left">
        <div class="card-body">
          <div class="account-settings">
            <div class="user-profile">
              <div class="user-avatar text-center">
                <img
                  src="/public/images/image-profile.jpg"
                  alt="Maxwell Admin"
                  class="avatar-user"
                />
                <h5 class="mt-3"><?php echo $_SESSION['user']['nama'] ?></h5>
                <p1 class="mt-2">Upload a different photo...</p1>
                <input type="file" class="form-control mt-2" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
      <div class="card h-100 card-edit-right">
        <div class="card-body">
          <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <h6 class="mb-2 text-primary">Personal Details</h6>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
              <fieldset disabled>
                <div class="form-group">
                  <label for="fullName">Full Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="fullName"
                    placeholder="<?php echo $_SESSION['user']['nama'] ?>"
                  />
                </div>
              </fieldset>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
              <div class="form-group">
                <label for="eMail">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="newEmail"
                  name="newEmail"
                  placeholder="Enter email ID"
                  value="<?php echo $_SESSION['user']['email'] ?>"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <fieldset disabled>
                <div class="form-group">
                  <label for="phone">NIK</label>
                  <input
                    type="text"
                    class="form-control"
                    id=""
                    placeholder="<?php echo $_SESSION['user']['nik'] ?>"
                  />
                </div>
              </fieldset>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="website">Phone</label>
                <input
                  type="url"
                  class="form-control"
                  id="newTelp"
                  name="newTelp"
                  placeholder="Enter phone number"
                  value="<?php echo $_SESSION['user']['phone'] ?>"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="website">Job Title Name</label>
                <input
                  type="url"
                  class="form-control"
                  id="website"
                  placeholder="Enter Job Title"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="website">Organization Name</label>
                <input
                  type="url"
                  class="form-control"
                  id="newOrganizationName"
                  name="newOrganizationName"
                  placeholder="Enter Organization Name"
                  value="<?php echo $_SESSION['user']['organizationName'] ?>"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="website">Location Name</label>
                <input
                  type="url"
                  class="form-control"
                  id="newLocationName"
                  name="newLocationName"
                  placeholder="Enter your location office"
                  value="<?php echo $_SESSION['user']['locationName'] ?>"
                />
              </div>
            </div>
          </div>
          <!-- <div class="row gutters">
            <div
              class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3"
            >
              <h6 class="mt-3 mb-2 text-primary">Office Address</h6>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
              <div class="form-group">
                <label for="Street">Street</label>
                <input
                  type="name"
                  class="form-control"
                  id="Street"
                  placeholder="Enter Street"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-2">
              <div class="form-group">
                <label for="ciTy">City</label>
                <input
                  type="name"
                  class="form-control"
                  id="ciTy"
                  placeholder="Enter City"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="sTate">State</label>
                <input
                  type="text"
                  class="form-control"
                  id="sTate"
                  placeholder="Enter State"
                />
              </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
              <div class="form-group">
                <label for="zIp">Zip Code</label>
                <input
                  type="text"
                  class="form-control"
                  id="zIp"
                  placeholder="Zip Code"
                />
              </div>
            </div>
          </div> -->
          <div class="row gutters mt-3 text-end">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
              <div class="text-right">
                <button
                  type="button"
                  id="submit"
                  name="submit"
                  class="btn btn-secondary"
                >
                  Cancel
                </button>
                <button
                  type="button"
                  id="submit"
                  name="submit"
                  class="btn btn-primary"
                  style="background-color: #0396a6"
                >
                  Update
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>