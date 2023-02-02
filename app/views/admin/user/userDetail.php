<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Detail User</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?= BASEURL ?>admins"><i
											class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item" aria-current="page"><a href="<?= BASEURL ?>usermanagement"
										class="text-decoration-none">Management User</a></li>
								<li class="breadcrumb-item active" aria-current="page">Detail User</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->


				<div class="row">
					<div class="col-lg-4">
						<div class="card">
							<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									<img src="/public/admin/images/avatars/avatar-18.png" alt="Admin"
										class="rounded-circle p-1" width="110">
									<div class="mt-3">
										<h4><?= $data['user']['nama'] ?></h4>
										<p class="text-secondary mb-1"><?= $data['user']['organizationName'] ?></p>
										<p class="text-muted font-size-sm"><?= $data['user']['locationName'] ?></p>
										<button class="btn btn-outline-primary" data-bs-toggle="modal"s
											data-bs-target="#modalEdit">Edit</button>
									</div>
								</div>
								<hr class="my-4">
								<ul class="list-group list-group-flush">
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0"><i class="bx bx-news me-2"></i><?= $data['user']['nik'] ?></h6>
										<span class="text-secondary">NIK</span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0"><i class="bx bx-user me-2"></i><?= $data['user']['nama'] ?></h6>
										<span class="text-secondary">Name</span>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0"><i class="bx bx-envelope me-2"></i><?= $data['user']['email'] ?></h6>
										<span class="text-secondary">Mail</span>
									</li>
									</li>
									<li
										class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
										<h6 class="mb-0"><i class="bx bx-sitemap me-2"></i><?= $data['user']['organizationName'] ?>
										</h6>
										<span class="text-secondary">Organization Name</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center mb-3">
									<div>
										<h5 class="font-weight-bold mb-0">Learning Assignment</h5>
									</div>
									<div class="ms-auto mt-2">
										<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
											data-bs-target="#modalAddNewAssignment"><i
												class="bx bxs-plus-square"></i>Add
											New</button>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table mb-0 align-middle" id="tableAssignment">
										<thead class="table-light">
											<tr>
												<th>Course</th>
												<th>Category</th>
												<th>Status</th>
												<th>View Details</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                      <?php 
                        $i=0;
                        if ($data['userLesson']) {
                          foreach($data['userLesson'] as $lesson){
                            echo '<tr>
                                    <td>
                                      <h6 class="mb-0 font-14">' . $lesson['judul course'] . '</h6>
                                    </td>
                                    <td>' . $lesson['nama kategori'] . '</td>
                                    <td>';
                            if ($lesson['total_lessons'] == $lesson['attempted_lessons']){
                              if(isset($data['userTest'])){
                                if($data['userTest'][$i]['total_tests'] == $data['userTest'][$i]['attempted_tests']) {
                                  echo'<div
                                        class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                        Completed
                                      </div>';
                                }
                              }
                            }
                            else {
                              echo    '<div
                                        class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                        On Progress
                                      </div>';
                            }
                            echo    '</td>
                                    <td><button type="button" onclick="loadUserCourseRecordDetail(' . $lesson['courseId'] . ')"
                                        class="btn btn-primary btn-sm radius-30 px-4"
                                        data-bs-toggle="modal" data-bs-target="#' . $lesson['courseId'] . '">View
                                        Details</button></td>
                                    <td>
                                      <div class="d-flex order-actions">
                                        <a href="javascript:;" class=""><i class="bx bxs-trash"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteCourse"></i></a>
                                      </div>
                                    </td>
                                  </tr>';
                            
                            $i+=1;
                          }
                        } else {
                          if ($data['userTest']) {
                            foreach($data['userTest'] as $test){
                              echo '<tr>
                                      <td>
                                        <h6 class="mb-0 font-14">' . $test['judul course'] . '</h6>
                                      </td>
                                      <td>' . $test['nama kategori'] . '</td>
                                      <td>';
                              echo    '<div
                                        class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                        On Progress
                                      </div>';
                              echo    '</td>
                                      <td><a href="detail-course-user.html" type="button"
                                          class="btn btn-primary btn-sm radius-30 px-4"
                                          data-bs-toggle="modal" data-bs-target="#' . $test['userId'] . '">View
                                          Details</a></td>
                                      <td>
                                        <div class="d-flex order-actions">
                                          <a href="javascript:;" class=""><i class="bx bxs-trash"
                                              data-bs-toggle="modal"
                                              data-bs-target="#modalDeleteCourse"></i></a>
                                        </div>
                                      </td>
                                    </tr>';
                            }
                          }
                        }
                      ?>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<!-- MODAL ADD NEW ASSIGNMENT -->
						<div class="modal fade" id="modalAddNewAssignment" tabindex="-1"
							aria-labelledby="modalAddNewAssignmentLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalAddNewAssignmentLabel">Add New Assignment</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="col-12 mb-3">
											<label class="form-label">Category</label>
											<select class="form-select" id="selectCategory">
												<option value="" selected>Select Category</option>
												<option value="general">General</option>
												<option value="qasecurity">QA & Security</option>
												<option value="technical">Technical</option>
												<option value="softskill">Soft Skill</option>
											</select>
										</div>
										<div class="col-12 mb-3">
											<label class="form-label">Course</label>
											<select class="form-select" id="selectAssignment">
												<option value="" selected>Select Course</option>
												<option value="cdob">CDOB 2020</option>
												<option value="cdakb">CDAKB 2020</option>
												<option value="sertifikasihalal">Sertifikasi Halal</option>
												<option value="safetysecurity2019">Sosialisasi</option>
												<option value="safetysecurity2019">Safety Security 2019</option>
												<option value="itsecurity2021">IT Security 2021</option>
												<option value="sosialisasisop">Sosialisasi SOP & IK</option>
												<option value="itsecurityemailphising">IT Security Email Phising
												</option>
												<option value="sitostatika">Penanganan Produk Sitostatika</option>
												<option value="itsecurityawareness">General IT Security Awareness
												</option>
												<option value="penggunaanapar">Penggunaan APAR</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary"
											data-bs-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary">Confirm</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

        <?php 
            foreach($data['userLesson'] as $lesson){
              echo '<!-- Modal View Detail Course -->
                    <div class="modal fade" id="' . $lesson['courseId'] . '" tabindex="-1" aria-labelledby="modalViewDetailLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" style="max-width: 735px;">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalViewDetailLabel">' . $lesson['judul course'] . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                              aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="table-responsive mt-3">
                              <table class="table align-middle mb-0">
                                <thead class="table-light">
                                  <tr>
                                    <th>Lesson</th>
                                    <th>Total Attempt</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                  </tr>
                                </thead>
                                <tbody id="lessonRecordContainer">';
              echo              '</tbody>
                              </table>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>';
            }
        ?>

				<!-- Modal BOX Edit Data -->
				<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalEditLabel">Edit User</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="col-12 mb-3">
									<label for="inputNIK" class="form-label">NIK</label>
									<input type="text" value="<?= $data['user']['nik'] ?>" class="form-control" id="inputNIK" placeholder="Input NIK...">
								</div>
								<div class="col-12 mb-3">
									<label for="inputName" class="form-label">Name</label>
									<input type="text" value="<?= $data['user']['nama'] ?>" class="form-control" id="inputName" placeholder="Input name...">
								</div>
								<div class="col-12 mb-3">
									<label for="inputEmail" class="form-label">Email</label>
									<input type="email" value="<?= $data['user']['email'] ?>" class="form-control" id="inputEmail"
										placeholder="Input email...">
								</div>
								<div class="col-12 mb-3">
									<label for="inputPassword" class="form-label">Password</label>
									<input type="password" class="form-control" id="inputPassword"
										placeholder="Input password...">
								</div>
								<div class="col-12 mb-3">
									<label class="form-label">Location</label>
									<select class="form-select" id="selectLocationEdit" name="location">
                  <option selected="selected" value="<?= $data['user']['locationId'] ?>"> <?= $data['user']['locationName'] ?> </option>
                    <?php 
											foreach($data['location'] as $location) {
												echo '<option name="location" value="' . $location['locationId'] . '">' . $location['locationName'] . '</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal Delete -->
				<div class="modal fade" id="modalDeleteCourse" tabindex="-1" aria-labelledby="modalDeleteCourseLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalDeleteCourseLabel">Delete Course</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h6>Are you sure want to delete this course?</h6>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-danger">Delete</button>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


  <script>
    $( document ).ready(function() {
      loadUserCourseRecordDetail();
    });
  </script>

  <script>

    function loadUserCourseRecordDetail(courseId) {
				var userId = <?= $_GET['userId'] ?>;
        $.ajax({
          url: "<?= BASEURL ?>userManagement/loadUserCourseRecordDetail?userId=" + userId + "&courseId=" + courseId,
          success: function(html) {
						$('#lessonRecordContainer').html(html);
          }
        });
      }
  </script>