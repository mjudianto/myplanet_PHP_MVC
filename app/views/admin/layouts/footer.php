<!-- Bootstrap JS -->
<script src="<?= BASEURL ?>admin/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="<?= BASEURL ?>admin/js/jquery.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script src="<?= BASEURL ?>admin/js/index3.js"></script>
	<script src="<?= BASEURL ?>admin/libraries/gijgo/js/gijgo.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/select2/js/select2.min.js"></script>
	
	<script>
		$(document).ready(function () {
			$(".datepickerawal").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="<?= BASEURL ?>admin/images/icons/calendar-days.svg" />'
				}
			})

			$(".datepickerakhir").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="<?= BASEURL ?>admin/images/icons/calendar-days.svg" />'
				}
			})
		});
		new PerfectScrollbar('.store-metrics');
	</script>
	
	<script>

		$(document).ready(function () {
			var table = $('#tableCourse').DataTable({
				dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
				buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableCourse_wrapper .col-md-6:eq(0)');
			
			var table = $('#testReportTable').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#testReportTable_wrapper .col-md-6:eq(0)');

			var table = $('#lessonReportTable').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#lessonReportTable_wrapper .col-md-6:eq(0)');

			var table = $('#tablePodtret').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tablePodtret_wrapper .col-md-6:eq(0)');

			var table = $('#tableVisitorPodtret').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableVisitorPodtret_wrapper .col-md-6:eq(0)');

			var table = $('#tablePodtretVisitorDetail').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tablePodtretVisitorDetail_wrapper .col-md-6:eq(0)');
				
			var table = $('#podtretCommentTable').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#podtretCommentTable_wrapper .col-md-6:eq(0)');

			var table = $('#tableUser').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableUser_wrapper .col-md-6:eq(0)');

			var table = $('#tableEnsight').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableEnsight_wrapper .col-md-6:eq(0)');

			var table = $('#tableVisitorEnsight').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableVisitorEnsight_wrapper .col-md-6:eq(0)');
			
			var table = $('#tableVisitorEnsight').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableVisitorEnsight_wrapper .col-md-6:eq(0)');

			var table = $('#tableNotification').DataTable({
			dom: '<"row top"<"col-lg-4 col-md-4 col-sm-12 mb-2"B><"col-lg-4 col-md-4 col-sm-12 mb-2"l><"col-lg-4 col-md-4 col-sm-12 mb-2"f>>rtip',
			buttons: ['csv', 'excel', 'pdf', 'print']
			});

			table.buttons().container().appendTo('#tableNotification_wrapper .col-md-6:eq(0)');
		});
	</script>

	<script>
		$('#selectCategoryAddNew').select2({
			dropdownParent: $('#modalAddNewCourse'),
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.checkbox-spesific').select2({
			dropdownParent: $('#modalAddNewCourse'),
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
	</script>
	<script>
		$('#fancy-file-upload').FancyFileUpload({
			params: {
				action: 'fileuploader'
			},
			maxfilesize: 1000000
		});
	</script>
	<script>
		$(document).ready(function () {
			$('#image-uploadify').imageuploadify();
		})
		const selectOption = document.getElementById("selectSpesific");
		selectOption.addEventListener("change", function () {
			const selectedOption = this.value;
			if (selectedOption === "all") {
				document.getElementById("orgName").style.display = "none";
				document.getElementById("userName").style.display = "none";
			}
			else if (selectedOption === "byOrganization") {
				document.getElementById("orgName").style.display = "block";
				document.getElementById("userName").style.display = "none";
			} else if (selectedOption === "byName") {
				document.getElementById("orgName").style.display = "none";
				document.getElementById("userName").style.display = "block";
			}
		});
	</script>
	<script src="<?= BASEURL ?>admin/js/app.js"></script>



	<script>
		$(document).ready(function () {
			$('#example').DataTable();

			$(".datepickerawal").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="<?= BASEURL ?>admin/images/icons/calendar-days.svg" />'
				}
			})

			$(".datepickerakhir").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="<?= BASEURL ?>admin/images/icons/calendar-days.svg" />'
				}
			})
		});
	</script>


	<script>
		new PerfectScrollbar('.best-selling-products');
		new PerfectScrollbar('.recent-reviews');
		new PerfectScrollbar('.support-list');
	</script>
	<!--app JS-->
	<script src="<?= BASEURL ?>admin/js/app.js"></script>
</body>

</html>