
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
							<input type="hidden" id="data" value="podtret">
							<input type="hidden" id="columnName" value="uploadDate">
							<!-- Date Picker -->
							<div class="d-flex justify-content-center">
								<div class="filter-awal me-2"><label for="filerDateAwal" class="sr-only">Start Date
										Filter</label>
									<div class="input-group mb-2 me-sm-2">
										<input type="text" class="form-control datepickerawal"
											placeholder="dd/mm/yyyy" id="startDate" autocomplete="off">
									</div>
								</div>
								<div class="filter-akhir me-3"><label for="filerDateAkhir" class="sr-only">End Date
										Filters</label>
									<div class="input-group mb-2 me-sm-2">
										<input type="text" class="form-control datepickerakhir"
											placeholder="dd/mm/yyyy" id="endDate" autocomplete="off">
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
								<tbody id="podtretContainer">

                <?php 
                $i=1;
                  foreach($data['podtret'] as $podtret) {
                    echo '<tr>
                            <td>' . $i . '</td>
                            <td>' . $podtret['judul'] . '</td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster-' . $podtret['podtretId'] . '"><img
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

								<?php 
								foreach($data['podtretKategori'] as $kategori){
									echo '<option value="' . $kategori['podtretkategoriId'] . '">#' . $kategori['nama'] . '</option>';
								}
								?>

							</select>
						</div>
						<div class="form-group mb-3">
							<label for="poster-upload" class="form-label">Poster</label>
							<div class="card">
								<div class="card-body">
									<input id="poster-upload" type="file" name="files"
										accept=".jpg, .png, image/jpeg, image/png">
								</div>
							</div>
						</div>
						<div class="form-group mb-3">
							<label for="video-upload" class="form-label">Video</label>
							<div class="card">
								<div class="card-body">
									<input id="video-upload" type="file" name="files"
										accept=".jpg, .png, image/jpeg, image/png, .mp4">
								</div>
							</div>
						</div>
						<div class="form-group mb-4">
							<label for="audio" class="form-label">Audio</label>
							<input class="form-control" type="file" id="audio">
						</div>
						<div class="form-group mb-3">
							<label for="" class="form-label">Publish</label>
							<div class="d-flex">
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
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
    </form>


		

    <?php 
      foreach($data['podtret'] as $podtret) {
				echo '<!-- Modal Poster -->
							<div class="modal fade" id="modalPoster-' . $podtret['podtretId'] . '" tabindex="-1" aria-labelledby="modalPosterLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="modalPosterLabel">Thumbnail Podtret</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<div class="container">
												<img src="' . $podtret['thumbnail'] . '"
													style="max-width: 100%; display:block; height: auto;" alt="">
											</div>
					
					
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					
										</div>
									</div>
								</div>
							</div>';

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
                          <option selected>#' . $podtret['nama'] . '</option>';

				foreach($data['podtretKategori'] as $kategori){
					echo            '<option value="' . $kategori['podtretkategoriId'] . '">#' . $kategori['nama'] . '</option>';
				}
        
				echo						'</select>
                      </div>
                      <div class="form-group mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input class="form-control" type="file" id="poster">
                      </div>
                      <div class="form-group mb-3">
                        <label for="video" class="form-label">Video</label>
                        <input class="form-control" type="file" id="video" value="">
                      </div>
                      <div class="form-group mb-3">
                        <label for="audio" class="form-label">Audio</label>
                        <input class="form-control" type="file" id="audio">
                      </div>
                      <div class="form-group mb-3">
                        <label for="publish" class="form-label">Publish</label>
                        <select class="form-select" aria-label="Default select example" id="publish">';
				if ($podtret['state'] == 1) {
					echo            '<option selected>Yes</option>
													 <option value="0">No</option>';
				} else {
					echo            '<option selected>No</option>
													 <option value="1">Yes</option>';
				}
        echo            '</select>
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


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

	<script>
		$(document).ready(function () {
			var table = $('#tablePodtret').DataTable({
				dom: '<"row top"<"col-lg-6 col-md-6 col-sm-12 mb-2"l><"col-lg-6 col-md-6 col-sm-12 mb-2"f>>rtip'
			});

			table.buttons().container()
				.appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
	</script>

		<script>
    function dateFilter() {
			var data = document.getElementById("data").value;
			var columnName = document.getElementById("columnName").value;
			var startDate = document.getElementById("startDate").value;;
			var endDate = document.getElementById("endDate").value;

        $.ajax({
          url: "<?= BASEURL ?>podtretmanagement/filterDate?data=" + data + "&columnName=" + columnName + "&startDate=" + startDate + "&endDate=" + endDate,
          success: function(html) {
						// alert('success');
            $('#podtretContainer').html(html);
            // loadKategori();
            // loadCourse();
          }
        });
    }
  </script>