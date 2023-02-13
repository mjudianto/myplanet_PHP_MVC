<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management Notification</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Upload Notification</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Notification</h6>
					</div>
					<div class="col-lg-8 d-flex justify-content-end">
						<!-- Date Picker -->
						<div class="d-flex justify-content-center">
							<div class="filter-awal me-2"><label for="filerDateAwal" class="sr-only">Start Date
									Filter</label>
								<div class="input-group mb-2 me-sm-2">
									<input type="text" class="form-control datepickerawal" id="filterDateAwal"
										placeholder="dd/mm/yyyy">
								</div>
							</div>
							<div class="filter-akhir me-3"><label for="filerDateAkhir" class="sr-only">End Date
									Filters</label>
								<div class="input-group mb-2 me-sm-2">
									<input type="text" class="form-control datepickerakhir" id="filterDateAkhir"
										placeholder="dd/mm/yyyy">
								</div>
							</div>
							<div class="button-filter">
								<label for="">Action</label> <br>
								<button type="button" class="btn btn-primary radius-10">Pilih</button>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="font-weight-bold mb-0">Notification</h5>
							</div>
							<div class="ms-auto mt-2">
								<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
									data-bs-target="#modalAddNewNotification"><i class="bx bx-plus"></i>Add
									New</button>
							</div>
						</div>
						<div class="">
							<br>
							<table class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Notification</th>
										<th>Given To</th>
										<th>Uploaded At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                  <?php 
                  $i=1;
                    foreach($data['notification'] as $notif) {
                      echo '<tr>
                              <td width="3%">' . $i . '</td>
                              <td width="52%">' . $notif['message'] . '</td>
                              <td width="20%"><button type="button"
                                  class="btn btn-primary btn-sm radius-30 px-4" data-bs-toggle="modal"
                                  data-bs-target="#modalViewUserNotification">View
                                  Details</button>
                              </td>
                              <td class="15%">' . $notif['uploadDate'] . '</td>
                              <td class="10%">
                                <div class="d-flex order-actions">
                                  <a href="javascript:;" class="text-primary bg-light-primary border-0"
                                    data-bs-toggle="modal" data-bs-target="#modalEdit"><i
                                      class="bx bxs-edit"></i></a>
                                  <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                      class="bx bxs-trash"></i></a>
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
										<th>Notification</th>
										<th>Given To</th>
										<th>Uploaded At</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- Modal View Detail -->
		<div class="modal fade" id="modalViewUserNotification" tabindex="-1"
			aria-labelledby="modalViewUserNotificationLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalViewUserNotificationLabel">List User</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="table-responsive">
							<div id="printbar" style="float:right"></div>
							<br>
							<table id="tableDetailUser" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Organization Name</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Nanda Raditya</td>
										<td>Human Resource Development</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Alvin Wijaya</td>
										<td>Information Technology</td>
									</tr>


								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>Name</th>
										<th>Organization Name</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Add New -->
		<div class="modal fade" id="modalAddNewNotification" tabindex="-1"
			aria-labelledby="modalAddNewNotificationLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalAddNewNotificationLabel">Push Notification</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label for="juudlPodtret" class="form-label">Notification</label>
							<input type="email" class="form-control" id="juudlPodtret" placeholder="Input title...">
						</div>
						<div class="form-group mb-3">
							<label for="selectSpesific" class="form-label">Given To</label>
							<select class="form-select" aria-label="Default select example" id="addSelectSpesific">
								<option value="all" selected>All</option>
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
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Edit -->
		<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalEditLabel">Edit Podtret</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label for="juudlPodtret" class="form-label">Notification</label>
							<input type="email" class="form-control" id="juudlPodtret" placeholder="Input title...">
						</div>
						<div class="form-group mb-3">
							<label for="selectSpesific" class="form-label">Given To</label>
							<select class="form-select" aria-label="Default select example" id="selectSpesific">
								<option value="all" selected>All</option>
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
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Delete -->
		<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="deleteModalLabel">Delete Podtret</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure want to delete this Podtret?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
    <script>
      $(document).ready(function () {
			var table = $('#tableDetailUser').DataTable({
				lengthChange: false,
				buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container()
				.appendTo('#tableDetailUser_wrapper .col-md-6:eq(0)');
		});
    </script>

<script>
		$(document).ready(function () {
			var table = $('#tablePodtret').DataTable({
				dom: '<"row top"<"col-lg-6 col-md-6 col-sm-12 mb-2"l><"col-lg-6 col-md-6 col-sm-12 mb-2"f>>rtip'
			});

			table.buttons().container()
				.appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
		$('.checkbox-spesific').select2({
			dropdownParent: $('#modalAddNewNotification'),
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

		const selectOption = document.getElementById("addSelectSpesific");
		selectOption.addEventListener("change", function () {
			const selectedOption = this.value;
			if (selectedOption === "all") {
				document.getElementById("orgName").style.display = "none";
				document.getElementById("userName").style.display = "none";
			}
			else if (selectedOption === "byOrganization") {
				document.getElementById("orgName").style.display = "block";
				document.getElementById("userName").style.display = "none";
			} else if (selectedOption === "byName") {
				document.getElementById("orgName").style.display = "none";
				document.getElementById("userName").style.display = "block";
			}
		});
	</script>