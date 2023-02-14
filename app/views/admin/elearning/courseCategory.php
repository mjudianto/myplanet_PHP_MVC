<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management E-learning</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="<?= BASEURL ?>admins/dashboard"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Course Category</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->


				<hr />

				<div class="row">
					<div class="col">
						<div class="card radius-10 mb-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Course Category</h5>
									</div>
									<div class="ms-auto">
										<a href="#" class="btn btn-primary btn-sm radius-5" data-bs-toggle="modal"
											data-bs-target="#modalAddNewCategory"><i class="bx bx-plus"></i>Add
											New</a>
									</div>
								</div>

								<div class="table-responsive mt-3"  style="width: 100%; text-align:center;">
									<table class="table align-middle mb-0" id="kategoriTable">
										<thead class="table-light">
											<tr>
												<th style="width: 5%;">No</th>
												<th style="width: 30%;">Category</th>
												<th style="width: 25%;">Total Course</th>
												<th style="width: 25%;">Status</th>
												<th style="width: 15%;">Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=1;
												foreach($data['kategori'] as $kategori) {
													echo '<tr>
																	<td>' . $i . '</td>
																	<td><a href="course-spesifik.html"
																			class="text-decoration-none text-black">' . $kategori['nama'] . '</a></td>
																	<td>' . $kategori['course'] . '</td>';

													if ($kategori['state'] == 1) {
														echo	 '<td class=""><span
																			class="badge bg-light-success text-success w-100">Active</span>
																		</td>';
													}
													else {
														echo	 '<td class=""><span
																			class="badge bg-secondary text-white w-100">Inactive</span>
																		</td>';
													}
													
													echo	 '<td>
																		<div class="d-flex order-actions" style="width:100%; justify-content:center;">
																			<a href="#" class="text-primary bg-light-primary border-0"
																				data-bs-toggle="modal"
																				data-bs-target="#modalEditCategory-' . $kategori['elearningKategoriId'] . '"><i
																					class="bx bxs-edit"></i></a>
																			<!-- <a href="javascript:;"
																				class="ms-4 text-danger bg-light-danger border-0"
																				data-bs-toggle="modal"
																				data-bs-target="#modalDeleteCategory"><i
																					class="bx bxs-trash"></i></a> -->
																		</div>
																	</td>
																</tr>';
													$i+=1;
												}
											?>
											
										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div><!--end row-->

				<!-- Modal Box Add New -->
				<div class="modal fade" id="modalAddNewCategory" tabindex="-1"
					aria-labelledby="modalAddNewCategoryLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalAddNewCategoryLabel">Add New Category</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<form action="<?= BASEURL ?>elearningmanagement/addKategori" method="post">
								<div class="modal-body">
									<div class="col-12 mb-3">
										<label for="inputCategory" class="form-label">Judul Category</label>
										<input type="text" class="form-control" id="inputCategory" name="courseKategori"
											placeholder="Input Title Category">
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
				
				<form action="<?= BASEURL ?>elearningmanagement/updateKategori" method="post">
				<?php 
					foreach($data['kategori'] as $kategori) {
						echo '<!-- Modal Edit Category -->
									<div class="modal fade" id="modalEditCategory-' . $kategori['elearningKategoriId'] . '" tabindex="-1" aria-labelledby="modalEditCategoryLabel"
										aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalEditCategoryLabel">Edit Category</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal"
														aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="col-12 mb-3">
														<input type="hidden" name="kategoriId" value="' . $kategori['elearningKategoriId'] . '">
														<label for="inputCategory" class="form-label">Judul Category</label>
														<input type="text" class="form-control" name="kategori" value="' . $kategori['nama'] . '"
															placeholder="Input Title Category">
													</div>
					
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Confirm</button>
												</div>
											</div>
										</div>
									</div>';
					}
				?>
				</form>
				



				<!-- Modal Delete -->
				<div class="modal fade" id="modalDeleteCategory" tabindex="-1"
					aria-labelledby="modalDeleteCategoryLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalDeleteCategoryLabel">Delete Category</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<h6>Are you sure want to delete this category?</h6>
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
