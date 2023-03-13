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
								<li class="breadcrumb-item active" aria-current="page">Data Post Test</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->




				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Detail Course</h6>
					</div>
					<div class="col-lg-8 d-flex justify-content-end">
						<!-- Date Picker -->
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
						<div class="table-responsive">
							<div id="printbar" style="float:right"></div>
							<br>
							<table id="testReportTable" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>nik</th>
										<th>Nama</th>
										<th>Post Test</th>
										<th>Total Attempt</th>
										<th>Score</th>
										<th>Status</th>
										<th>Time</th>
										<th>Location</th>
										<th>Org Name</th>
									</tr>
								</thead>
								<tbody id="recordContainer">
                  <?php 
                  $i=1;
                    foreach($data['testRecord'] as $record) {
                      if ($record['userNik'] != '') {
                        echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $record['userNik'] . '</td>
                                <td>' . $record['nama'] . '</td>
                                <td>' . $record['judul'] . '</td>
                                <td>' . $record['totalAttempt'] . '</td>
                                <td>' . $record['score'] . '</td>
                                <td>';

                        if ($record['status'] == 'Lulus') {
                            echo '<div
                                    class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                    Lulus
                                  </div>';
                        } else {
                          echo  '<div
                                    class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                    Tidak Lulus
                                  </div>';
                        }
                                  
                        echo   '</td>
                                <td>' . $record['time'] . '</td>
                                <td>' . $record['locationName'] . '</td>
                                <td>' . $record['organizationName'] . '</td>
                              </tr>';
                        $i+=1;
                      }
                    }
                  ?>
									

								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>userNik</th>
										<th>Nama</th>
										<th>Post Test</th>
										<th>Total Attempt</th>
										<th>Score</th>
										<th>Status</th>
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
    function dateFilter() {
			var startDate = document.getElementById("startDate").value;;
			var endDate = document.getElementById("endDate").value;

        $.ajax({
          url: "<?= BASEURL ?>report/filterDate?startDate=" + startDate + "&endDate=" + endDate,
          success: function(html) {
						// alert('success');
            $('#recordContainer').html(html);
            // loadKategori();
            // loadCourse();
          }
        });
    }
	</script>
                  