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
								<li class="breadcrumb-item active" aria-current="page">Podtret Visitors</li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mt-lg-4 mb-3">
						<h6 class="mb-0 text-uppercase">Podtret</h6>
					</div>
					<div class="col-lg-8 d-flex justify-content-end">
							<input type="hidden" id="data" value="podtretVisitor">
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
						<div class="d-flex justify-content-center">
							<div>
								<h5 class="font-weight-bold mb-0">Podtret Visitors</h5>
							</div>
						</div>
						<div class="table-responsive">
							<br>
							<table id="tableVisitorPodtret" class="table align-middle" style="width:100%">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Thumbnail</th>
										<th>Visitors</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="podtretContainer">
                <?php 
                $i=1;
								if(isset($data['podtret'])){
									foreach($data['podtret'] as $podtret) {
                    echo '<tr>
                            <td>' . $i . '</td>
                            <td>' . $podtret['judul'] . '</td>
                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalPoster"><img
                                  src="' . $podtret['thumbnail'] . '"
                                  style="width: 130px; display:block;" alt="edisi-pildun"></a>
                            </td>
                            <td>' . $podtret['views'] . '</td>
                            <td class="text-center order-actions"><a href="' . BASEURL . 'podtretmanagement/podtretVisitorDetail?podtretId=' . $podtret['podtretId'] . '"
                                class="text-primary bg-light-primary border-0"><svg
                                  xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                  viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  class="feather feather-eye text-primary">
                                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                  <circle cx="12" cy="12" r="3"></circle>
                                </svg></a></td>
                          </tr>';
                    $i+=1;
                  }
								}
                ?>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

		<script>
		$(document).ready(function () {
			var table = $('#tableVisitorPodtret').DataTable({
				dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
				buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container()
    		.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
				
		});
	</script>

	<script>
    function dateFilter() {
			var data = document.getElementById("data").value;
			var columnName = document.getElementById("columnName").value;
			var startDate = document.getElementById("startDate").value;
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