<script>
	$(document).ready(function() {
		$("#table_data_1").DataTable({
			"scrollX": "300px",
			"scrollY": "500px",
			order: [
				[0, 'desc']
			],
			"responsive": false,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

		$("#table_data_2").DataTable({
			"scrollX": "300px",
			"scrollY": "500px",
			order: [
				[0, 'desc']
			],
			"responsive": false,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print"]
		}).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');
	});
</script>
