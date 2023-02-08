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
								<li class="breadcrumb-item active" aria-current="page">Courses</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

				<hr />
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="font-weight-bold mb-0">Course</h5>
							</div>
							<div class="ms-auto mt-2">
								<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
									data-bs-target="#modalAddNewCourse"><i class="bx bx-plus"></i>Add
									New</button>
							</div>
						</div>
						<div class="table-responsive">
							<div id="printbar" style="float:right"></div>
							<br>
							<table id="tableCourse" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Course Title</th>
										<th>Total User</th>
										<th>Total Lesson</th>
										<th>Time Uploaded</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                  <?php 
                  $i = 1;
                  $courses = array_merge($data['courses2'], $data['courses']);

                  foreach ($courses as $course) {
                    $userCount = $course['access_type'] == 0 ? $course['totalUser'] : $data['userCount'][$i-1];
                    echo '<tr>
                            <td>' . $i . '</td>
                            <td><a href="detail-course.html" class="text-black">' . $course['Judul Course'] . '</a></td>
                            <td>' . $userCount . '</td>
                            <td>' . $course['Total Lessons'] . '</td>
                            <td>' . $course['uploadDate'] . '</td>';
                    
                    if ($course['state'] == 1) {
                      echo   '<td class="">
                                <div
                                  class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                  Active</div>
                              </td>';
                    }
                    else {
                      echo   '<td class="">
                                <div
                                  class="badge rounded-pill text-white bg-secondary p-2 text-uppercase px-3">
                                  Inactive</div>
                              </td>';
                    }
                    
                    echo   '<td>
                              <div class="d-flex order-actions">
                                <a href="' . BASEURL . 'elearningmanagement/modules?courseId=' . $course['Course ID'] . '"
                                  class="text-primary bg-light-primary border-0"><i
                                    class="bx bxs-edit"></i></a>
                                <a href="detail-course.html"
                                  class="ms-4 text-success bg-light-success border-0"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-eye text-success">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                  </svg></a>
                                <a href="javascript:;" class="ms-4 text-danger bg-light-danger border-0"
                                  data-bs-toggle="modal" data-bs-target="#modalDeleteCourse"><i
                                    class="bx bxs-trash"></i></a>
                              </div>
                            </td>
                          </tr>';
                    $i += 1;
                  }


                    
                  ?>
								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>Course Title</th>
										<th>Total User</th>
										<th>Total Lesson</th>
										<th>Time Uploaded</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				<!-- Modal Box Add New -->
				<div class="modal fade" id="modalAddNewCourse" tabindex="-1" aria-labelledby="modalAddNewCourseLabel"
					aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalAddNewCourseLabel">Add New Course</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="col-12 mb-3">
									<label for="inputCourse" class="form-label">Judul Course</label>
									<input type="text" class="form-control" id="inputCourse"
										placeholder="Input Title Course">
								</div>
								<div class="col-12 mb-3">
									<label class="form-label">Course Category</label>
									<select class="form-select" id="selectCategoryAddNew">
										<option value="" selected>Select Category</option>
										<option value="general">General</option>
										<option value="qasecurity">QA & Security</option>
										<option value="technical">Technical</option>
										<option value="softskill">Soft Skill</option>
									</select>
								</div>
								<div class="col-12 mb-3">
									<label class="form-label" for="select">Choose:</label>
									<!-- <select class="form-select" id="test" name="form_select"
										onchange="showDiv('hidden_spesific', this)">
										<option value="0">All</option>
										<option value="1">Spesific</option>
									</select> -->
									<select class="form-select" id="selectSpesific" name="form_select">
										<option value="all">All</option>
										<option value="byOrganization">Spesific by Organization</option>
										<option value="byName">Spesific by User</option>
									</select>
								</div>
								<div id="orgName" class="col-12 mb-3" style="display:none;">
									<div class="mb-3">
										<label class="form-label">Choose Organization</label>
										<select class="checkbox-spesific" data-placeholder="Choose anything"
											multiple="multiple">
											<option value="hrd">Human Resource Development</option>
											<option value="it">Information Technology</option>
											<option value="finance">Finance</option>
											<option value="marketing">Marketing</option>
											<option value="operation">Operation</option>
											<option value="production">Production</option>
											<option value="quality">Quality</option>
											<option value="sales">Sales</option>
											<option value="supplychain">Supply Chain</option>
										</select>
									</div>

								</div>
								<div id="userName" class="col-12 mb-3" style="display:none;">
									<div class="mb-3">
										<label class="form-label">Choose User</label>
										<select class="checkbox-spesific" data-placeholder="Choose anything"
											multiple="multiple">
											<option value="nanda">Nanda Raditya</option>
											<option value="dwi">Dwi Prasetyo</option>
											<option value="dewi">Dewi Sartika</option>
											<option value="siti">Siti Nuraini</option>
											<option value="susi">Susi Susanti</option>
											<option value="sari">Sari Sari</option>
											<option value="siti">Siti Nuraini</option>
											<option value="susi">Susi Susanti</option>
											<option value="sari">Sari Sari</option>
											<option value="siti">Siti Nuraini</option>
										</select>
									</div>
								</div>
								<div class="col-12 mb-3">
									<label for="" class="form-label">Image Poster</label>
									<div class="card">
										<div class="card-body">
											<input id="fancy-file-upload" type="file" name="files"
												accept=".jpg, .png, image/jpeg, image/png" multiple>
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
											<input class="form-check-input" type="radio" name="flexRadioDefault"
												id="flexRadioDefault1">
											<label class="form-check-label" for="flexRadioDefault1">Yes</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="flexRadioDefault"
												id="flexRadioDefault2" checked="">
											<label class="form-check-label" for="flexRadioDefault2">No</label>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Confirm</button>
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
		<!--end page wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <script>
		$(document).ready(function () {
			var table = $('#tableCourse').DataTable({
				lengthChange: false,
				buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container()
				.appendTo('#tableCourse_wrapper .col-md-6:eq(0)');
		});
	</script>

<script>
		$('#selectCategoryAddNew').select2({
			dropdownParent: $('#modalAddNewCourse'),
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.checkbox-spesific').select2({
			dropdownParent: $('#modalAddNewCourse'),
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>