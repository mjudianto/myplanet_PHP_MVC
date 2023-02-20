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
								<li class="breadcrumb-item active" aria-current="page">Upload Ensight</li>
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
									<input type="text" class="form-control datepickerawal" id="startDate" autocomplete="off"
										placeholder="dd/mm/yyyy">
								</div>
							</div>
							<div class="filter-akhir me-3"><label for="filerDateAkhir" class="sr-only">End Date
									Filters</label>
								<div class="input-group mb-2 me-sm-2">
									<input type="text" class="form-control datepickerakhir" id="endDate" autocomplete="off"
										placeholder="dd/mm/yyyy">
								</div>
							</div>
							<div class="button-filter">
								<label for="">Action</label> <br>
								<button type="button" onclick="dateFilter()" class="btn btn-primary radius-10">Pilih</button>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div>
								<h5 class="font-weight-bold mb-0">Ensight</h5>
							</div>
							<div class="ms-auto mt-2">
								<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
									data-bs-target="#modalAddNewPodtret"><i class="bx bx-plus"></i>Add
									New</button>
							</div>
						</div>
						<div class="table-responsive">
							<br>
							<table id="tableEnsight" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Publish Date</th>
										<th>Status</th>
										<th>Uploaded At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="ensightContainer">
                  <?php
                  $i=1;
                    foreach ($data['ensight'] as $ensight) {
                      echo '<tr>
                              <td>' . $i . '</td>
                              <td>' . $ensight['judul'] . '</td>
                              <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                                    src="' . $ensight['thumbnail'] . '"
                                    style="width: 130px; display:block; margin: 0 auto;"
                                    alt="No-Image"></a>
                              </td>
                              <td>' . $ensight['publishDate'] . '</td>
                              <td>';
                                if ($ensight['state'] == 1) {
                                  echo '<div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">Active</div>';
                                } else {
                                  echo '<div class="badge rounded-pill text-white bg-secondary p-2 text-uppercase px-3">Inactive</div>';
                                }
                      echo   '</td>
                              <td>' . $ensight['uploadDate'] . '</td>
                              <td>
                                <div class="d-flex order-actions">
                                  <a href="" class="text-primary bg-light-primary border-0"
                                    data-bs-toggle="modal" data-bs-target="#modalEdit-' . $ensight['ensightId'] . '"><i
                                      class="bx bxs-edit"></i></a>
                                  <a href="" class="ms-2 text-danger bg-light-danger border-0"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal-' . $ensight['ensightId'] . '"><i
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
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Publish Date</th>
										<th>Status</th>
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

		<!-- Modal Add New -->
		<form action="<?= BASEURL ?>ensightmanagement/newEnsight" method="post">
			<div class="modal fade" id="modalAddNewPodtret" tabindex="-1" aria-labelledby="modalAddNewPodtretLabel"
				aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="modalAddNewPodtretLabel">Upload Ensight</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="form-group mb-3">
								<label for="juudlPodtret" class="form-label">Judul</label>
								<input required type="text" class="form-control" name="newJudul">						
							</div>		
							<div class="form-group mb-3">
								<label for="juudlPodtret" class="form-label">Deskripsi</label>
								<input required type="text" class="form-control" name="newDeskripsi">						
							</div>	
							<div class="form-group mb-3">
								<label for="poster" class="form-label">Thumbnail</label>
								<input class="form-control" accept="image/jpeg, image/png, image/jpg" type="file" name="newThumbnail">
							</div>
							<div class="form-group mb-3">
								<label for="video" class="form-label">Video</label>
								<input class="form-control" accept="video/mp4" type="file" name="newVideo">
							</div>
							<div class="form-group mb-3">
								<label for="publish" class="form-label">Publish</label>
								<select class="form-select" aria-label="Default select example" name="newPublish">
									<option value="1" selected>Yes</option>
									<option value="0">No</option>
								</select>
								</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		
		<!-- Modal Edit -->
    <?php 
      foreach ($data['ensight'] as $ensight) {
        echo '<form action="' . BASEURL . 'ensightmanagement/editEnsight?ensightId=' . $ensight['ensightId'] . '" method="POST" enctype="multipart/form-data">
                <div class="modal fade" id="modalEdit-' . $ensight['ensightId'] . '" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel">Edit Ensight</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="judulPodtret" class="form-label">Judul</label>
                          <input required type="text" class="form-control" name="judulEnsight-' . $ensight['ensightId'] . '"
                            value="' . $ensight['judul'] . '">
                        </div>
												<div class="form-group mb-3">
													<label for="juudlPodtret" class="form-label">Deskripsi</label>
													<input required type="text" class="form-control" name="deskripsiEnsight-' . $ensight['ensightId'] . '"
													value="' . $ensight['deskripsi'] . '">						
												</div>	
                        <div class="form-group mb-3">
                          <label for="poster" class="form-label">Thumbnail</label>
                          <input class="form-control" accept="image/jpeg, image/png, image/jpg" type="file" name="updateThumbnail-' . $ensight['ensightId'] . '">
                          <input class="form-control" type="hidden" name="defaultThumbnail-' . $ensight['ensightId'] . '" value="' . $ensight['thumbnail'] . '">
                        </div>
                        <div class="form-group mb-3"> 
                          <label for="video" class="form-label">Video</label>
                          <input class="form-control" accept="video/mp4" type="file" name="updateVideo-' . $ensight['ensightId'] . '">
                          <input class="form-control" type="hidden" name="defaultVideo-' . $ensight['ensightId'] . '" value="' . $ensight['thumbnail'] . '">
                        </div>
                        <div class="form-group mb-3">
                          <label for="publish" class="form-label">Publish</label>
                          <select class="form-select" aria-label="Default select example" name="publish-' . $ensight['ensightId'] . '">';
                          if ($ensight['state'] == 1 ){
                            echo '<option value="1" selected>Yes</option>
                                  <option value="0">No</option>';
                          } else {
                            echo '<option value="0" selected>No</option>
                                  <option value="1">Yes</option>';
                          }
                            
        echo             '</select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>';
      }
    ?>

		
    
    <?php 
      foreach ($data['ensight'] as $ensight) {
        echo '<form action="' . BASEURL . 'ensightmanagement/deleteEnsight?ensightId=' . $ensight['ensightId'] . '" method="post">
                <!-- Modal Delete -->
                <div class="modal fade" id="deleteModal-' . $ensight['ensightId'] . '" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content"> 
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Ensight</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Are you sure want to delete this Podtret?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>';
      }
    ?>

    <!--end page wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

		<script>
			function dateFilter() {
				var startDate = document.getElementById("startDate").value;;
				var endDate = document.getElementById("endDate").value;

					$.ajax({
						url: "<?= BASEURL ?>ensightmanagement/dateFilter?startDate=" + startDate + "&endDate=" + endDate,
						success: function(html) {
							// alert('success');
							$('#ensightContainer').html(html);
							// loadKategori();
							// loadCourse();
						}
					});
			}
		</script>
		