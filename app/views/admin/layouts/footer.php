	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<!--plugins-->
	<script src="/public/admin/js/jquery.min.js"></script>
	<script src="/public/admin/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="/public/admin/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="/public/admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="/public/admin/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<!-- highcharts js -->
	<script src="/public/admin/plugins/highcharts/js/highcharts.js"></script>
	<script src="/public/admin/plugins/highcharts/js/highcharts-more.js"></script>
	<script src="/public/admin/plugins/highcharts/js/variable-pie.js"></script>
	<script src="/public/admin/plugins/highcharts/js/solid-gauge.js"></script>
	<script src="/public/admin/plugins/highcharts/js/highcharts-3d.js"></script>
	<script src="/public/admin/plugins/highcharts/js/cylinder.js"></script>
	<script src="/public/admin/plugins/highcharts/js/funnel3d.js"></script>
	<script src="/public/admin/plugins/highcharts/js/exporting.js"></script>
	<script src="/public/admin/plugins/highcharts/js/export-data.js"></script>
	<script src="/public/admin/plugins/highcharts/js/accessibility.js"></script>
	<script src="/public/admin/js/index3.js"></script>
	<script src="/public/admin/libraries/gijgo/js/gijgo.min.js"></script>
	<script>
		$(document).ready(function () {


			$(".datepickerawal").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="/public/admin/images/icons/calendar-days.svg" />'
				}
			})

			$(".datepickerakhir").datepicker({
				uiLibrary: "bootstrap4",
				icons: {
					rightIcon: '<img src="/public/admin/images/icons/calendar-days.svg" />'
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
	<script src="/public/admin/js/app.js"></script>
</body>

</html>