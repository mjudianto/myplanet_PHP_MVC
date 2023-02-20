<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management Ensight</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Ensight Visitors</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Ensight</h6>
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
						<div class="d-flex justify-content-center">
							<div>
								<h5 class="font-weight-bold mb-0">Ensight Visitors</h5>
							</div>
						</div>
						<div class="table-responsive">
							<br>
							<table id="tableVisitorEnsight" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Visitors</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>Judul 1</td>
										<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
													src="assets/images/poster/pildun.jpg"
													style="width: 130px; display:block;" alt="edisi-pildun"></a>
										</td>
										<td>376</td>
										<td class="text-center order-actions"><a href="podtret-visitor-all.html"
												class="text-primary bg-light-primary border-0"><svg
													xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-eye text-primary">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Judul 2</td>
										<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
													src="assets/images/poster/pildun.jpg"
													style="width: 130px; display:block;" alt="edisi-pildun"></a>
										</td>
										<td>562</td>
										<td class="text-center order-actions"><a href="podtret-visitor-all.html"
												class="text-primary bg-light-primary border-0"><svg
													xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-eye text-primary">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Judul 3</td>
										<td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
													src="assets/images/poster/pildun.jpg"
													style="width: 130px; display:block;" alt="edisi-pildun"></a>
										</td>
										<td>562</td>
										<td class="text-center order-actions"><a href="podtret-visitor-all.html"
												class="text-primary bg-light-primary border-0"><svg
													xmlns="http://www.w3.org/2000/svg" width="24" height="24"
													viewBox="0 0 24 24" fill="none" stroke="currentColor"
													stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
													class="feather feather-eye text-primary">
													<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
													<circle cx="12" cy="12" r="3"></circle>
												</svg></a></td>
									</tr>


								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Visitors</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!--end page wrapper -->