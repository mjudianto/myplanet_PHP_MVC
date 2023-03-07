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
								<li class="breadcrumb-item" aria-current="page"><a href="podtret-visitor.html"
										class="text-decoration-none">Podtret Visitors</a></li>
								<li class="breadcrumb-item active" aria-current="page">Podtret Visitors All</li>
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
							<input type="hidden" id="data" value="podtretVisitorDetail">
							<input type="hidden" id="columnName" value="lastVisit">
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
									<button type="button" onclick="dateFilter(<?= $_GET['podtretId'] ?>)" class="btn btn-primary radius-10">Pilih</button>
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
							<table id="tablePodtretVisitorDetail" class="table" style="width:100%;">

								<thead class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Name</th>
										<th>Visit</th>
										<th>Timestamp</th>
									</tr>
								</thead>
								<tbody id="podtretContainer">
									<?php 
									$i=1;
										foreach($data['podtretDetail'] as $detail) {
											echo '<tr>
															<td>' . $i . '</td>
															<td>' . $detail['judul'] . '</td>
															<td>' . $detail['nama'] . '</td>
															<td>' . $detail['visit'] . '</td>
															<td>' . $detail['lastVisit'] . '</td>
														</tr>';
											$i+=1;
										}
									?>
									
								</tbody>
								<tfoot class="table-light">
									<tr>
										<th>No</th>
										<th>Judul</th>
										<th>Name</th>
										<th>Visit</th>
										<th>Timestamp</th>
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
			var table = $('#tablePodtret').DataTable({
				dom: '<"row top"<"col-lg-6 col-md-6 col-sm-12 mb-2"l><"col-lg-6 col-md-6 col-sm-12 mb-2"f>>rtip'
			});

			table.buttons().container()
				.appendTo('#example2_wrapper .col-md-6:eq(0)');
		});
	</script>

		<script>
    function dateFilter(podtretId) {
			var data = document.getElementById("data").value;
			var columnName = document.getElementById("columnName").value;
			var startDate = document.getElementById("startDate").value;;
			var endDate = document.getElementById("endDate").value;

        $.ajax({
          url: "<?= BASEURL ?>podtretmanagement/filterDate?data=" + data + "&columnName=" + columnName + "&startDate=" + startDate + "&endDate=" + endDate + "&podtretId=" + podtretId,
          success: function(html) {
						// alert('success');
            $('#podtretContainer').html(html);
            // loadKategori();
            // loadCourse();
          }
        });
    }
		</script>