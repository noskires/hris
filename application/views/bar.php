		
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/chartjs/chart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/icheck/icheck.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		<script src="<?php echo base_url();?>assets/js/pace/pace.min.js"></script>

<script>
    var ctx = document.getElementById("mybarChart");
	var myBarChart = new Chart(ctx, {
	type: 'bar',
	data: data,
	options: options
});


var data = {
	labels: ["January", "February", "March", "April", "May", "June", "July"],
	datasets: [
		{
			label: "My First dataset",

			// The properties below allow an array to be specified to change the value of the item at the given index
			// String  or array - the bar color
			backgroundColor: "rgba(220,220,220,0.2)",

			// String or array - bar stroke color
			borderColor: "rgba(220,220,220,1)",

			// Number or array - bar border width
			borderWidth: 1,

			// String or array - fill color when hovered
			hoverBackgroundColor: "rgba(220,220,220,0.2)",

			// String or array - border color when hovered
			hoverBorderColor: "rgba(220,220,220,1)",

			// The actual data
			data: [65, 59, 80, 81, 56, 55, 40],

			// String - If specified, binds the dataset to a certain y-axis. If not specified, the first y-axis is used.
			yAxisID: "y-axis-0",
		},
		{
			label: "My Second dataset",
			backgroundColor: "rgba(220,220,220,0.2)",
			borderColor: "rgba(220,220,220,1)",
			borderWidth: 1,
			hoverBackgroundColor: "rgba(220,220,220,0.2)",
			hoverBorderColor: "rgba(220,220,220,1)",
			data: [28, 48, 40, 19, 86, 27, 90]
		}
	]
};
</script>


<canvas id="mybarChart"></canvas>    