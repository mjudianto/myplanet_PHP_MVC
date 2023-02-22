<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Report E-Learning</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Report Attempt</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->




				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Total Attempt</h6>
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
						<h5 class="font-weight-bold mb-0 text-center">Report Attempt</h5>
						<div class="table-responsive">
							<div id="printbar" style="float:right"></div>
							<br>
							<table id="detailCourse" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Lesson</th>
										<th>Attempt</th>
										<th>Time</th>
										<th>Location</th>
										<th>Org Name</th>
									</tr>
								</thead>
								<tbody>
									<?php 	
									$i=1;
										foreach($data['lessonRecord'] as $lesson) {
											echo '<tr>
															<td>' . $i . '</td>
															<td>' . $lesson['nik'] . '</td>
															<td>' . $lesson['nama'] . '</td>
															<td>' . $lesson['judul'] . '</td>
															<td>' . $lesson['attempt'] . '</td>
															<td>' . $lesson['finished'] . '</td>
															<td>' . $lesson['organizationName'] . '</td>
															<td>' . $lesson['locationName'] . '</td>
					
														</tr>';
											$i+=1;
										}
									?>
									
								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Post Test</th>
										<th>Attempt</th>
										<th>Time</th>
										<th>Location</th>
										<th>Org Name</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--end page wrapper -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <script>
		$(document).ready(function () {
			var table = $('#detailCourse').DataTable({
				lengthChange: true,
				buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container()
				.appendTo('#detailCourse_wrapper .col-md-6:eq(0)');
		});
	</script>