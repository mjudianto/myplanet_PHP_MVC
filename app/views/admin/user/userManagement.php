<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management User</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?= BASEURL ?>admins"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Management User</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->

				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="font-weight-bold mb-0">Management User</h5>
							</div>
							<div class="ms-auto mt-2">
								<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
									data-bs-target="#modalAddNew"><i class="bx bx-plus"></i>Add
									New</button>
							</div>
						</div>
						<div class="table-responsive">
							<div id="printbar" style="float:right"></div>
							<br>
							<table id="tableUser" class="table mb-0 align-middle" style="width:100%;">
								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Picture</th>
										<th>NIK</th>
										<th>Name</th>
										<!-- <th>Email</th> -->
										<th>Last Visit</th>
										<th>Location</th>
										<th>Org Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                  <?php 
                  $i=1;
                    foreach($data['user'] as $user){
                      echo '<tr>
                              <td>' . $i . '</td>
                              <td>
                                <div class="product-img bg-transparent border">
                                  <img src="' . BASEURL . 'admin/images/avatars/analog.jpeg" class="radius-10" alt="">
                                </div>
                              </td>
                              <td>' . $user['userNik'] . '</td>
                              <td><a href="detail-user.html" class="text-decoration-none text-black">' . $user['nama'] . '</a></td>
                              <td>' . $user['lastVisit'] . '</td>
                              <td>' . $user['companyName'] . ' - ' . $user['locationName'] . '</td>
                              <td>' . $user['companyName'] . ' - ' . $user['organizationName'] . '</td>
                              <td>
                                <div class="order-actions">
                                  <a href="' . BASEURL . 'usermanagement/userdetail?userId=' . $user['userNik'] . '&organizationId=' . $user['organizationId'] . '"
                                    class="text-primary bg-light-primary border-0"><i
                                      class="bx bxs-edit"></i></a>
                                </div>
                              </td>
                            </tr>';
                      $i+=1;
                    }
                   ?>

								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>Picture</th>
										<th>NIK</th>
										<th>Name</th>
										<!-- <th>Email</th> -->
										<th>Last Visit</th>
										<th>Location</th>
										<th>Org Name</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>



				<!-- Modal Box Add New -->
				<div class="modal fade" id="modalAddNew" tabindex="-1" aria-labelledby="modalAddNewLabel"
					aria-hidden="true">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalAddNewLabel">User Registration</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<form action="<?= BASEURL ?>usermanagement/addUser" method="post">
								<div class="modal-body">
									<div class="col-12 mb-3">
										<label for="inputNIK" class="form-label">NIK</label>
										<input type="text" name="userNik" class="form-control" id="inputNIK" placeholder="Input NIK...">
									</div>
									<div class="col-12 mb-3">
										<label for="inputName" class="form-label">Name</label>
										<input type="text" name="name" class="form-control" id="inputName" placeholder="Input name...">
									</div>
									<div class="col-12 mb-3">
										<label for="inputEmail" class="form-label">Email</label>
										<input type="email" name="email" class="form-control" id="inputEmail"
											placeholder="Input email...">
									</div>
									<!-- <div class="col-12 mb-3">
										<label for="inputPassword" class="form-label">Password</label>
										<input type="password" name="password" class="form-control" id="inputPassword"
											placeholder="Input password...">
									</div> -->
									<div class="col-12 mb-3">
										<label class="form-label">Location</label>
										<select class="form-select" id="selectLocationAddNew" name="location">
											<option value="" selected>Select Location</option>
											<?php 
											foreach($data['location'] as $location) {
												echo '<option name="location" value="' . $location['locationId'] . '">' . $location['locationName'] . '</option>';
											}
											?>
										</select>
									</div>
									<div class="col-12 mb-3">
										<label for="" class="form-label">department Name</label>
										<select class="form-select" id="selectLocationAddNew" name="department">
											<option value="" selected>Select department</option>
											<?php 
											foreach($data['department'] as $department) {
												echo '<option  value="' . $department['departmentId'] . '">' . $department['departmentName'] . '</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Confirm</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--end page wrapper -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    