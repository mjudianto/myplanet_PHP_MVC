<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Management SOP - IK</div>
      <div class="ps-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="<?= BASEURL ?>sopikmanagement">SOP - IK</a>
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
          <h6 class="text-center mb-3"><?= $data['sopik']['judul'] ?></h6>
          <div class="d-flex justify-content-end mb-3">
            <div>
              <button type="button" class="btn btn-warning radius-10" data-bs-toggle="modal" data-bs-target="#modalEditCourse"><i class="bx bxs-edit"></i>Edit
                Course</button>
            </div>
          </div>
          <div class="container">
            <?php
            foreach ($data['sopikLesson'] as $sopik) {
              echo '<div class="card bg-light-success">
                      <div class="card-body text-center order-actions">
                        <h6 class="text-center">' . $sopik['judul'] . '</h6>
                        <a href="javascript:;" class="text-danger bg-light-danger border-0 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeleteLesson" style="float: right; margin-top: -27px;"><i class="bx bxs-trash"></i></a>
                        <a href="javascript:;" class="text-primary bg-light-primary border-0 ms-2" style="float: right; margin-top: -27px;" data-bs-toggle="modal" data-bs-target="#modalEditLesson"><i class="bx bxs-edit"></i></a>
                        <a href="javascript:;" class="text-success bg-light-success border-0" style="float: right; margin-top: -27px;"><i class="lni lni-download"></i></a>
                      </div>
                    </div>';
            }
            foreach ($data['sopikTest'] as $sopik) {
              echo '<div class="card bg-light-success">
                      <div class="card-body text-center order-actions">
                        <h6 class="text-center">' . $sopik['judul'] . '</h6>
                        <a href="javascript:;" class="text-danger bg-light-danger border-0 ms-2" data-bs-toggle="modal" data-bs-target="#modalDeleteLesson" style="float: right; margin-top: -27px;"><i class="bx bxs-trash"></i></a>
                        <a href="' . BASEURL . 'elearningmanagement/editPostTest?testId=' . $sopik['elearningTestId'] . '" class="text-primary bg-light-primary border-0 ms-2" style="float: right; margin-top: -27px;"><i class="bx bxs-edit"></i></a>
                        <a href="" class="text-success bg-light-success border-0" style="float: right; margin-top: -27px;"><i class="lni lni-download"></i></a>
                      </div>
                    </div>';
            }
            ?>

            <div class="d-flex justify-content-end">
              <a href="add-post-test.html" type="button" class="btn btn-outline-danger radius-10 me-2"><i class="bx bx-plus"></i>Add
                Post Test</a>
              <button type="button" class="btn btn-outline-success radius-10" data-bs-toggle="modal" data-bs-target="#modalAddNewLesson"><i class="bx bx-plus"></i>Add
                Lesson</button>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Modal Box Add Modul -->
    <div class="modal fade" id="modalAddNewModul" tabindex="-1" aria-labelledby="modalAddNewModulLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddNewModulLabel">Add New Modul</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="modulName" class="form-label">Modul Name</label>
              <input type="text" class="form-control" id="modulName" placeholder="Modul Name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="CreateTodo();" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Box Edit Modul -->
    <div class="modal fade" id="modalEditModul" tabindex="-1" aria-labelledby="modalEditModulLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditModulLabel">Edit Modul</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="modulName" class="form-label">Modul Name</label>
              <input type="text" class="form-control" id="modulName" value="Judul Modul">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="CreateTodo();" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Box Add Lesson -->
    <div class="modal fade" id="modalAddNewLesson" tabindex="-1" aria-labelledby="modalAddNewLessonLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAddNewLessonLabel">Add New Lesson</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="lessonName" class="form-label">Lesson Name</label>
              <input type="text" class="form-control" id="lessonName" placeholder="Lesson Name">
            </div>
            <div class="mb-3">
              <label for="lessonType" class="form-label">Lesson Type</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Video</option>
                <option value="2">PDF</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Lesson File</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="CreateTodo();" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Box Edit Lesson -->
    <div class="modal fade" id="modalEditLesson" tabindex="-1" aria-labelledby="modalEditLessonLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditLessonLabel">Edit Lesson</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="lessonName" class="form-label">Lesson Name</label>
              <input type="text" class="form-control" id="lessonName" value="Judul Lesson">
            </div>
            <div class="mb-3">
              <label for="lessonType" class="form-label">Lesson Type</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">Video</option>
                <option value="2">PDF</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Lesson File</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" onclick="CreateTodo();" class="btn btn-primary">Confirm</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Box Edit By Import -->
    <div class="modal fade" id="modalEditByImport" tabindex="-1" aria-labelledby="modalEditByImportLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditByImportLabel">Import Post Test</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="modulName" class="form-label">Title Post Test</label>
              <input type="text" class="form-control" id="modulName" value="Judul Post Test">
            </div>
            <div class="mb-3">
              <label for="formFile" class="form-label">Attachment</label>
              <input class="form-control" type="file" id="formFile">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete Modul -->
    <div class="modal fade" id="modalDeleteModul" tabindex="-1" aria-labelledby="modalDeleteModulLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteModulLabel">Delete Modul</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Are you sure want to delete this modul?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete Lesson-->
    <div class="modal fade" id="modalDeleteLesson" tabindex="-1" aria-labelledby="modalDeleteLessonLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLessonLabel">Delete Lesson</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Are you sure want to delete this lesson?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal Box Edit Course -->
    <form action="<?= BASEURL ?>" method="post" enctype="multipart/form-data">
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
                  <input type="text" class="form-control" id="inputCourse" name="editCourseName" placeholder="Input Title Course" value="<?= $data['sopik']['judul'] ?>">
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
              <!-- <div class="col-12 mb-3">
                <label for="" class="form-label">Image Poster</label>
                <div class="card">
                  <div class="card-body">
                    <input name="editCourseThumbnail" id="fancy-file-upload" type="file" accept=".jpg, .png, image/jpeg, image/png" multiple>
                    <input name="defaultCourseThumbnail" type="hidden" value="<?= $data['elearningCourse']['thumbnail'] ?>">
                  </div>
                </div>
              </div> -->
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