	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<!--plugins-->
	<script src="<?= BASEURL ?>admin/js/jquery.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<!-- highcharts js -->
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/highcharts.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/highcharts-more.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/variable-pie.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/solid-gauge.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/highcharts-3d.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/cylinder.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/funnel3d.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/exporting.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/export-data.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/highcharts/js/accessibility.js"></script>
	<script src="<?= BASEURL ?>admin/js/index3.js"></script>
	<script src="<?= BASEURL ?>admin/libraries/gijgo/js/gijgo.min.js"></script>
	<script src="<?= BASEURL ?>admin/plugins/select2/js/select2.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>



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

<script>
	const selectOption = document.getElementById("addSelectSpesific");
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

</html>