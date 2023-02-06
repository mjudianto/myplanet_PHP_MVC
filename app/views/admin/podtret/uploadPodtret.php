<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Management Podtret</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Upload Podtret</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Podtret</h6>
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
								<h5 class="font-weight-bold mb-0">Podtret</h5>
							</div>
							<div class="ms-auto mt-2">
								<button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
									data-bs-target="#modalAddNewPodtret"><i class="bx bx-plus"></i>Add
									New</button>
							</div>
						</div>
						<div class="table-responsive">
							<br>
							<table id="tablePodtret" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Segmen</th>
										<th>Premiere</th>
										<th>Publish</th>
										<th>Published At</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

                <?php 
                $i=1;
                  foreach($data['podtret'] as $podtret) {
                    echo '<tr>
                            <td>' . $i . '</td>
                            <td>' . $podtret['judul'] . '</td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                                  src="' . $podtret['thumbnail'] . '"
                                  style="width: 130px; display:block; margin: 0 auto;"
                                  alt="edisi-pildun"></a>
                            </td>
                            <td>#' . $podtret['nama'] . '</td>
                            <td>' . $podtret['uploadDate'] . '</td>';
                    if ($podtret['state'] == 1){
                      echo  '<td>
                              <div
                                class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                Active
                              </div>
                            </td>';
                    } else {
                      echo  '<td>
                              <div
                                class="badge rounded-pill text-white bg-secondary p-2 text-uppercase px-3">
                                Inactive
                              </div>
                            </td>';
                    }
                    echo   '<td>' . $podtret['uploadDate'] . '</td>
                            <td>
                              <div class="d-flex order-actions">
                                <a href="javascript:;" class="text-primary bg-light-primary border-0"
                                  data-bs-toggle="modal" data-bs-target="#' . $podtret['podtretId'] . '"><i
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
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Segmen</th>
										<th>Premiere</th>
										<th>Publish</th>
										<th>Published At</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

    <form action="<?= BASEURL ?>podtretmanagement/upload" method="post" enctype="multipart/form-data">
    <!-- Modal Add New -->
		<div class="modal fade" id="modalAddNewPodtret" tabindex="-1" aria-labelledby="modalAddNewPodtretLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalAddNewPodtretLabel">Upload Podtret</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label for="juudlPodtret" class="form-label">Judul</label>
							<input type="email" class="form-control" id="juudlPodtret" placeholder="Input title...">
						</div>
						<div class="form-group mb-3">
							<label for="judulSegmen" class="form-label">Segmen</label>
							<select class="form-select" aria-label="Default select example" id="judulSegmen">
								<option selected>Select segmen...</option>
								<option value="1">#ngobrolsantai</option>
								<option value="2">#sapamantan</option>
								<option value="3">#kumis</option>
								<option value="4">#innotalk</option>
							</select>
						</div>
						<div class="form-group mb-3">
							<label for="filterDatePremiere" class="sr-only">Tanggal Premiere</label>
							<div class="input-group mb-2 me-sm-2">
								<input type="text" class="form-control datepickerpremiere" id="filterDatePremiere"
									placeholder="dd/mm/yyyy">
							</div>
						</div>
						<div class="form-group mb-3">
							<label for="poster" class="form-label">Poster</label>
							<input class="form-control" type="file" id="poster" name="poster">
						</div>
						<div class="form-group mb-3">
							<label for="video" class="form-label">Video</label>
							<input class="form-control" type="file" id="video" name="video">
						</div>
						<div class="form-group mb-3">
							<label for="audio" class="form-label">Audio</label>
							<input class="form-control" type="file" id="audio" name="audio">
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


		<!-- Modal Poster -->
		<div class="modal fade" id="modalPoster" tabindex="-1" aria-labelledby="modalPosterLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalPosterLabel">Thumbnail Podtret</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="container">
							<img src="assets/images/poster/Ibuck-ibuck.png"
								style="max-width: 100%; display:block; height: auto;" alt="">
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

					</div>
				</div>
			</div>
		</div>

    <?php 
      foreach($data['podtret'] as $podtret) {
        echo '<!-- Modal Edit -->
              <div class="modal fade" id="' . $podtret['podtretId'] . '" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalEditLabel">Edit Podtret</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label for="judulPodtret" class="form-label">Judul</label>
                        <input type="email" class="form-control" id="judulPodtret"
                          value="' . $podtret['judul'] . '">
                      </div>
                      <div class="form-group mb-3">
                        <label for="judulSegmen" class="form-label">Segmen</label>
                        <select class="form-select" aria-label="Default select example" id="judulSegmen">
                          <option selected>#' . $podtret['nama'] . '</option>
                          <option value="1">#ngobrolsantai</option>
                          <option value="2">#sapamantan</option>
                          <option value="3">#kumis</option>
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label for="filterDatePremiere" class="sr-only">Tanggal Premiere</label>
                        <div class="input-group mb-2 me-sm-2">
                          <input type="text" class="form-control datepickerpremiereupload" id="filterDatePremiere"
                            value="2022-12-13">
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input class="form-control" type="file" id="poster">
                      </div>
                      <div class="form-group mb-3">
                        <label for="video" class="form-label">Video</label>
                        <input class="form-control" type="file" id="video" value="' . $podtret['video'] . '">
                      </div>
                      <div class="form-group mb-3">
                        <label for="audio" class="form-label">Audio</label>
                        <input class="form-control" type="file" id="audio">
                      </div>
                      <div class="form-group mb-3">
                        <label for="publish" class="form-label">Publish</label>
                        <select class="form-select" aria-label="Default select example" id="publish">
                          <option selected>Yes</option>
                          <option value="1">No</option>
          
                        </select>
                      </div>
                      <!-- <div class="form-group mb-3">
                        <label for="poster">Poster</label>
                        <div class="card">
                          <div class="card-body">
                            <input id="fancy-file-upload" type="file" name="files"
                              accept=".jpg, .png, image/jpeg, image/png" id="poster" multiple>
                          </div>
                        </div>
                      </div> -->
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