<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Manaegent Podtret</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Podtret Comment</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Podtret Comment</h6>
					</div>
					<div class="col-lg-8 d-flex justify-content-end">
						<!-- Date Picker -->
            <input type="hidden" id="data" value="podtretComment">
						<input type="hidden" id="columnName" value="uploadDate">
						<div class="d-flex justify-content-center">
							<div class="filter-awal me-2"><label for="filerDateAwal" class="sr-only">Start Date
									Filter</label>
								<div class="input-group mb-2 me-sm-2">
									<input type="text" class="form-control datepickerawal" id="startDate"
										placeholder="dd/mm/yyyy" autocomplete="off">
								</div>
							</div>
							<div class="filter-akhir me-3"><label for="filerDateAkhir" class="sr-only">End Date
									Filters</label>
								<div class="input-group mb-2 me-sm-2">
									<input type="text" class="form-control datepickerakhir" id="endDate"
										placeholder="dd/mm/yyyy" autocomplete="off">
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
						<div class="d-flex justify-content-center">
							<div>
								<h5 class="font-weight-bold mb-0">Podtret Comment</h5>
							</div>
						</div>
						<div class="table-responsive">
							<br>
							<table id="podtretCommentTable" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Comment</th>
										<th>Judul Podtret</th>
										<th>Timestamp</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="podtretContainer">
                  <?php 
                  $i=1;
                    foreach($data['comment'] as $comment) {
                      echo '<tr>
                              <td>' . $i . '</td>
                              <td>' . $comment['userNik'] . '</td>
                              <td>' . $comment['nama'] . '</td>
                              <td>' . $comment['comment'] . '</td>
                              <td>' . $comment['judul'] . '</td>
                              <td>' . $comment['uploadDate'] . '</td>
                              <td>
                                <div class="d-flex order-actions">
                                  <a href="javascript:;" class="text-primary bg-light-primary border-0"
                                    data-bs-toggle="modal" data-bs-target="#modalEditComment"><i
                                      class="bx bxs-edit"></i></a>
                                  <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                      class="bx bxs-trash"></i></a>
                                </div>
                              </td>
                            </tr>';
                      $i+=1;
                    }

                    foreach($data['reply'] as $reply) {
                      echo '<tr>
                              <td>' . $i . '</td>
                              <td>' . $reply['userNik'] . '</td>
                              <td>' . $reply['nama'] . '</td>
                              <td>' . $reply['comment'] . '</td>
                              <td>' . $reply['judul'] . '</td>
                              <td>' . $reply['uploadDate'] . '</td>
                              <td>
                                <div class="d-flex order-actions">
                                  <a href="javascript:;" class="text-primary bg-light-primary border-0"
                                    data-bs-toggle="modal" data-bs-target="#modalEditComment"><i
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
										<th>userNik</th>
										<th>Nama</th>
										<th>Comment</th>
										<th>Judul Podtret</th>
										<th>Timestamp</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!-- Modal Edit Comment -->
		<div class="modal fade" id="modalEditComment" tabindex="-1" aria-labelledby="modalEditCommentLabel"
			aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="modalEditCommentLabel">Comment Podtret</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="form-group mb-3">
							<label for="comment" class="form-label">Comment</label>
							<input type="email" class="form-control" id="comment"
								value="Keren ya final piala dunia 2022">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save Changes</button>
					</div>
				</div>
			</div>
		</div>



		<!-- Modal Delete -->
		<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="deleteModalLabel">Delete Comment</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Are you sure want to delete this Comment?
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