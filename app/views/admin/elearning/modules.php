<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Management E-learning</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="course.html">Course</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Course</li>
          </ol>
        </nav>
      </div>

    </div>
    <!--end breadcrumb-->


    <hr />
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h6 class="text-center mb-3"><?= $data['elearningCourse']['judul'] ?></h6>
          <div class="d-flex justify-content-end mb-3">
            <div>
              <button type="button" class="btn btn-warning radius-10" data-bs-toggle="modal" data-bs-target="#modalEditCourse"><i class="bx bxs-edit"></i>Edit
                Course</button>
              <button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal" data-bs-target="#modalAddNewModul"><i class="bx bx-plus"></i>Add
                Modul</button>
            </div>
          </div>
          <?php
          $i = 0;
          foreach ($data['elearningModule'] as $module) {
            echo '<div class="card bg-light-primary">
                          <div class="card-body order-actions">
                            <h6 class="text-center">' . $module['judul'] . '</h6>
                            <a href="javascript:;" class="text-danger bg-light-danger border-0 ms-2"
                                  data-bs-toggle="modal" data-bs-target="#modalDeleteModule-' . $module['elearningModuleId'] . '"
                                  style="float: right; margin-top: -27px;"><i class="bx bxs-trash"></i></a>
                            <a href="javascript:;" class="text-primary bg-light-primary border-0"
                              data-bs-toggle="modal" data-bs-target="#editModule-' . $module['elearningModuleId'] . '"
                              style="float: right; margin-top: -27px;"><i class="bx bxs-edit"></i></a>
                          </div>
                        </div>
                        <div class="container">';
            if (isset($data['elearningLesson'][$i])) {
              foreach ($data['elearningLesson'][$i] as $lesson) {
                echo  '<div class="card bg-light-success">
                              <div class="card-body text-center order-actions">
                                <h6 class="text-center">' . $lesson['judul'] . '</h6>
                                <a href="javascript:;" class="text-danger bg-light-danger border-0 ms-2"
                                  data-bs-toggle="modal" data-bs-target="#modalDeleteLesson"
                                  style="float: right; margin-top: -27px;"><i class="bx bxs-trash"></i></a>
                                <a href="javascript:;" class="text-primary bg-light-primary border-0"
                                  style="float: right; margin-top: -27px;" data-bs-toggle="modal"
                                  data-bs-target="#modalAddNewLesson"><i class="bx bxs-edit"></i></a>
                              </div>
                            </div>';
              }
            }
            if (isset($data['elearningTest'][$i])) {
              foreach ($data['elearningTest'][$i] as $test) {
                echo  '<div class="card bg-light-success">
                              <div class="card-body text-center order-actions">
                                <h6 class="text-center">' . $test['judul'] . '</h6>
                                <a href="' . BASEURL . 'elearningmanagement/deletePostTest?courseId=' . $_GET['courseId']  . '&testId=' . $test['elearningTestId'] . '" class="text-danger bg-light-danger border-0 ms-2"
                                  style="float: right; margin-top: -27px;"><i class="bx bxs-trash"></i></a>
                                <a href="' . BASEURL . 'elearningmanagement/editPostTest?testId=' . $test['elearningTestId'] . '" class="text-primary bg-light-primary border-0 ms-2"
                                  style="float: right; margin-top: -27px;"><i class="bx bxs-edit"></i></a>
                                <a href="javascript:;" class="text-success bg-light-success border-0"
                                  style="float: right; margin-top: -27px;"><i class="lni lni-download"></i></a>
                              </div>
                            </div>';
              }
            }
            echo '<div class="d-flex justify-content-end" style="margin-bottom:5%;">
                          <a href="' . BASEURL . 'elearningmanagement/addPostTest?courseId=' . $_GET['courseId'] . '&moduleId=' . $module['elearningModuleId'] . '" type="button"
                            class="btn btn-outline-danger radius-10 me-2"><i class="bx bx-plus"></i>Add
                            Post Test</a>
                          <button type="button" class="btn btn-outline-success radius-10"
                            data-bs-toggle="modal" data-bs-target="#modalAddNewLesson-' . $module['elearningModuleId'] . '"><i
                              class="bx bx-plus"></i>Add
                            Lesson</button>
                        </div>
                      </div>';
            $i += 1;
          }
          ?>

        </div>
      </div>

    </div>

    <form action="<?= BASEURL ?>elearningmanagement/addModule" method="post">
      <!-- Modal Box Add Modul -->
      <div class="modal fade" id="modalAddNewModul" tabindex="-1" aria-labelledby="modalAddNewModulLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalAddNewModulLabel">Add New Course</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="courseId" value="<?= $_GET['courseId'] ?>">
              <div class="mb-3">
                <label for="modulName" class="form-label">Modul Name</label>
                <input type="text" class="form-control" id="modulName" name="judul" placeholder="Modul Name">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" onclick="" class="btn btn-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    foreach ($data['elearningModule'] as $module) {
      echo '<form action="' . BASEURL . 'elearningmanagement/deleteModule?moduleId=' . $module['elearningModuleId'] . '" method="post">
                    <!-- Modal Delete Modul -->
                    <input type="hidden" name="courseId" value="' . $_GET['courseId'] . '">
                    <div class="modal fade" id="modalDeleteModule-' . $module['elearningModuleId'] . '" tabindex="-1" aria-labelledby="modalDeleteModulLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteModulLabel">Delete Modul</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <h6>Are you sure want to delete this modul?</h6>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>';

      echo '<form action="' . BASEURL . 'elearningmanagement/updateModule" method="post">
                  <div class="modal fade" id="editModule-' . $module['elearningModuleId'] . '" tabindex="-1" aria-labelledby="modalAddNewModulLabel"
                  aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalAddNewModulLabel">Add New Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                          aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <input type="hidden" name="moduleId" value="' . $module['elearningModuleId'] . '">
                        <input type="hidden" name="courseId" value="' . $_GET['courseId'] . '">
                        <div class="mb-3">
                          <label for="modulName" class="form-label">Modul Name</label>
                          <input type="text" class="form-control" id="modulName" value="' . $module['judul'] . '" name="moduleName" placeholder="Modul Name">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" onclick="" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>';


      echo '<!-- Modal Box Add Lesson -->
                  <form action="' . BASEURL  . 'elearningmanagement/addLesson?moduleId=' . $module['elearningModuleId'] . '&courseId=' . $_GET['courseId'] . '" method="post" enctype="multipart/form-data">
                  <div class="modal fade" id="modalAddNewLesson-' . $module['elearningModuleId'] . '" tabindex="-1" aria-labelledby="modalAddNewLessonLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalAddNewLessonLabel">Add New Lesson</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="moduleId" value="' . $module['elearningModuleId'] . '">
                          <div class="mb-3">
                            <label for="lessonName" class="form-label">Lesson Name</label>
                            <input type="text" class="form-control" name="lessonName-' . $module['elearningModuleId'] . '" placeholder="Lesson Name">
                          </div>
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Lesson File</label>
                            <input class="form-control" type="file" id="formFile" name="konten-' . $module['elearningModuleId'] . '" id="konten">
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" onclick="CreateTodo();" class="btn btn-primary">Confirm</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </form>';
    }
    ?>

    <!-- Modal Box Edit Course -->
    <form action="<?= BASEURL ?>elearningmanagement/editCourse?courseId=<?= $_GET['courseId'] ?>" method="post" enctype="multipart/form-data">
      <div class="modal fade" id="modalEditCourse" tabindex="-1" aria-labelledby="modalEditCourseLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditCourseLabel">Edit Course</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                  <label for="inputCourse" class="form-label">Judul Course</label>
                  <input type="text" class="form-control" id="inputCourse" name="editCourseName" placeholder="Input Title Course" value="<?= $data['elearningCourse']['judul'] ?>">
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                  <label class="form-label">Course Category</label>
                  <select name="editCourseKategori" class="form-select" id="selectCategoryAddNew">
                    <?php
                    foreach ($data['elearningKategori'] as $kategori) {
                      if ($data['elearningCourse']['elearningKategoriId'] == $kategori['elearningKategoriId']) {
                        echo '<option selected value="' . $kategori['elearningKategoriId'] . '">' . $kategori['nama'] . '</option>';
                      } else {
                        echo '<option value="' . $kategori['elearningKategoriId'] . '">' . $kategori['nama'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                  <label class="form-label" for="select">Choose Access</label>
                  <select name="editCourseAccessType" class="form-select" id="spesificSelected" name="form_select">
                    <?php if ($data['elearningCourse']['access_type'] == 2) {
                      echo '<option value="0">All</option>
                              <option selected value="2">Spesific</option>';
                    } else {
                      echo '<option selected value="0">All</option>
                              <option  value="2">Spesific</option>';
                    } ?>

                  </select>
                </div>
              </div>
              <div class="row" id="selectSpesific" <?php if ($data['elearningCourse']['access_type'] == 2) {
                                                      echo 'style="display: flex;"';
                                                    } else {
                                                      echo 'style="display: none;"';
                                                    } ?>>
                <div id="companyName" class="col-lg-4 col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Choose Company</label>
                    <select name="selectedCompany[]" id="selectedCompany[]" onchange="loadAksesOption()" class="checkbox-spesific" data-placeholder="Choose anything" multiple="multiple">';

                      <?php
                      foreach ($data["company"] as $company) {
                        echo "<option value='{$company['companyId']}'>{$company['companyName']}</option>";
                      } ?>

                    </select>
                  </div>
                </div>
                <div id="userName" class="col-lg-4 col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Choose User</label>
                    <select name="selectedUser[]" id="selectedUser" class="checkbox-spesific" data-placeholder="Choose anything" multiple="multiple">';


                    </select>
                  </div>
                </div>
                <div id="organizationName" class="col-lg-4 col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Choose Organization</label>
                    <select name="selectedOrganization[]" id="selectedOrganization" class="checkbox-spesific" data-placeholder="Choose anything" multiple="multiple">';


                    </select>
                  </div>
                </div>
                <div id="locationName" class="col-lg-6 col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Choose Location</label>
                    <select name="selectedLocation[]" id="selectedLocation" class="checkbox-spesific" data-placeholder="Choose anything" multiple="multiple">';


                    </select>
                  </div>
                </div>
                <div id="jobTitle" class="col-lg-6 col-md-12 col-sm-12">
                  <div class="mb-3">
                    <label class="form-label">Choose Job Title</label>
                    <select name="selectedJob[]" class="checkbox-spesific" data-placeholder="Choose anything" multiple="multiple">';


                    </select>
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label for="" class="form-label">Image Poster</label>
                <div class="card">
                  <div class="card-body">
                    <input name="editCourseThumbnail" id="fancy-file-upload" type="file" accept=".jpg, .png, image/jpeg, image/png" multiple>
                    <input name="defaultCourseThumbnail" type="hidden" value="<?= $data['elearningCourse']['thumbnail'] ?>">
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <label for="formDescription" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
              </div>
              <div class="col-12 mb-3">
                <label for="inputPublis" class="form-label">Publish</label>
                <div class="d-flex align-items-center">
                  <div class="form-check me-2">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                    <label class="form-check-label" for="flexRadioDefault2">No</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </div>
        </div>
      </div>
    </form>





  </div>
</div>
<!--end page wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<script>
  function loadAksesOption() {
    var courseId = <?= $_GET['courseId'] ?>;
    const company = document.getElementById('selectedCompany[]');
    const selectedCompanies = Array.from(company.selectedOptions).map(option => option.value);
    const selectedCompaniesString = encodeURIComponent(JSON.stringify(selectedCompanies));


    $.ajax({
      url: "<?= BASEURL ?>elearningmanagement/loadUserOption?courseId=" + courseId + "&selectedCompanies=" + selectedCompaniesString,
      success: function(html) {
        $('#selectedUser').html(html);
      }
    });

    $.ajax({
      url: "<?= BASEURL ?>elearningmanagement/loadOrganizationOption?courseId=" + courseId + "&selectedCompanies=" + selectedCompaniesString,
      success: function(html) {
        $('#selectedOrganization').html(html);
      }
    });

    $.ajax({
      url: "<?= BASEURL ?>elearningmanagement/loadLocationOption?courseId=" + courseId + "&selectedCompanies=" + selectedCompaniesString,
      success: function(html) {
        $('#selectedLocation').html(html);
      }
    });
  }
</script>