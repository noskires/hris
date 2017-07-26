	<?php 
		$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex 					= array("Male", "Female");
		$pers_area 			= array("Greater Metro Manila", "Regional");
		$age_range 			= array("< 25","25 to 34","35 to 44","45 to 54","55 to 59","60 to 65","> 65");  
		$los_range 			= array("< 1","1 - 5","6 - 10","11 - 15","16 - 20","21 - 25","26 - 30","31 - 35","36 - 40","> 40");  
	 
		$colors = array(
		  "#9B59B6",
          "#455C73",
          "#03586A",
          "#26B99A",
          "#3498DB",
		  "#C4CC0E",
          "#FFC220",
          "#13D4D0",
          "#57A7A5",
          "#E8CF76",
		  "#F74834",
          "#3170EF",
          "#A3F4CB",
          "#63064E",
          "#B3F2E8",
          "#3B2728",
          "#237F9C",
          "#874FA6",
          "#60A2EC",
          "#A736C3"
		  );
 
		//by classification 
		
		foreach($count_per_sex as $per_sex)
		{
			$emp_count_per_sex[$per_sex->sex] = $per_sex->count; 
		}  
		
 
		foreach($count_per_location_subgroup as $subgroup_location)
		{
			$emp_count_per_subgroup_location[trim($subgroup_location->emp_subgroup)][trim($subgroup_location->personnel_area)] = $subgroup_location->count;  
		}
		//get count per location per subgroup
		foreach($pers_area as $data_pers_area)
		{
			foreach($subgroup as $data_subgroup)
			{
				if(isset($emp_count_per_subgroup_location[$data_subgroup][$data_pers_area]))
				{
					$emp_count_subgroup_pers_area[$data_subgroup] = $emp_count_per_subgroup_location[$data_subgroup][$data_pers_area];
				}
				else
				{
					$emp_count_subgroup_pers_area[$data_subgroup] = 0;
				}
				$data_emp_count_subgroup_pers_area[$data_subgroup] .= $emp_count_subgroup_pers_area[$data_subgroup].",";
				$data_emp_count_subgroup_pers_area_chart[$data_pers_area] += $emp_count_subgroup_pers_area[$data_subgroup];
			}
		}
 
		
		//get count per location per gender
		foreach($count_per_gender_pers_area as $gender_pers_area)
		{
			$emp_count_per_gender_pers_area[$gender_pers_area->sex][$gender_pers_area->personnel_area] = $gender_pers_area->count; 
		}
		foreach($pers_area as $data_pers_area) 
		{
			foreach($sex as $data_sex)
			{
				if(isset($emp_count_per_gender_pers_area[$data_sex][$data_pers_area]))
				{
					$emp_count_sex_pers_area[$data_sex] = $emp_count_per_gender_pers_area[$data_sex][$data_pers_area];
				}
				else
				{
					$emp_count_sex_pers_area[$data_sex] = 0;
				}
				$data_emp_count_sex_pers_area[$data_sex] .= $emp_count_sex_pers_area[$data_sex].",";
			}
		}
		
		foreach($count_per_location_agegroup as $location_agegroup)
		{
			$emp_count_per_location_agegroup[$location_agegroup->personnel_area][$location_agegroup->agegroup] = $location_agegroup->count; 
		}
	 
		foreach($count_per_location_los as $location_losgroup)
		{
			$emp_count_per_location_losgroup[$location_losgroup->personnel_area][$location_losgroup->los_group] = $location_losgroup->count; 
		}
		

		foreach($average_per_pers_area as $data_average_pers_area)
		{
			 
			$emp_average[$data_average_pers_area->personnel_area] = $data_average_pers_area->average;
			$emp_count[$data_average_pers_area->personnel_area] = $data_average_pers_area->count;
			$emp_average_los[$data_average_pers_area->personnel_area] = $data_average_pers_area->average_los;
			
			$total_active_emp += $emp_count[$data_average_pers_area->personnel_area]; 
			$total_average += $data_average_pers_area->sum_age;
			$total_average_los  += $data_average_pers_area->sum_los;
			
		}
		
		foreach($pers_area as $pers_area_data) 
		{
			foreach($los_range as $los_range_data)// by los
			{
				if(isset($emp_count_per_location_losgroup[$pers_area_data][$los_range_data]))
				{
					$emp_count_pers_losgroup[$los_range_data] = $emp_count_per_location_losgroup[$pers_area_data][$los_range_data]; 
				}
				else
				{
					$emp_count_pers_losgroup[$los_range_data] = 0;
				}
				$total_per_orggroup_per_pers_los_chart[$los_range_data] .= $emp_count_pers_losgroup[$los_range_data].",";
			}
			
			foreach($age_range as $age_range_data)// by age
			{  
				if(isset($emp_count_per_location_agegroup[$pers_area_data][$age_range_data]))
				{
					$emp_count_pers_agegroup[$age_range_data] = $emp_count_per_location_agegroup[$pers_area_data][$age_range_data]; 
				}
				else
				{
					$emp_count_pers_agegroup[$age_range_data] = 0;
				}
				$total_per_pers_age_chart[$age_range_data] .= $emp_count_pers_agegroup[$age_range_data].",";
			}
		}
		?>  
   
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
          </div>
          
		  <!-- top tiles -->
        <div class="row tile_count">
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top red"><i class="fa fa-user"></i> Total Employees as of 03/16/2017 09:00 AM</span>
              <div class="count blue"><?php echo number_format($total_active_emp);?></div> 
			  Total Average AGE:<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b> </span><br>
                          Total Average LOS:<span class="count_bottom red"><b> <?php echo number_format($total_average_los/$total_active_emp ,2);?></b> </span>
            </div>
          </div>
         <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Greater Metro Manila</span>
              <div class="count green"><?php echo number_format($emp_count[$pers_area[0]]);?></div> 
			    Average AGE : <span class="count_bottom red"><?php echo number_format($emp_average[$pers_area[0]], 2);?></span><br>
			    Average LOS : <span class="count_bottom red"><?php echo number_format($emp_average_los[$pers_area[0]], 2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Regional</span>
              <div class="count green"><?php echo number_format($emp_count[$pers_area[1]]);?></div>  
			  Average AGE : <span class="count_bottom red"><?php echo number_format($emp_average[$pers_area[1]], 2);?></span><br>
			  Average LOS : <span class="count_bottom red"><?php echo number_format($emp_average_los[$pers_area[1]], 2);?></span>
            </div>
          </div>
           
        </div>
        <!-- /top tiles -->
		
		
		<div class="clearfix"></div> 
          <div class="row">  
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs By Personnel Area</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
					<canvas class="animated flipInX" id="byPersArea"></canvas> 
					<!--<canvas id="byGender1"></canvas> -->
				</div>
              </div> 
            </div>
			
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
                <div class="x_title " >
                  <h2>FTEs By Classification</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content animated flipInX">
					<canvas  id="byClassification"></canvas> 
				</div>
              </div> 
            </div>
			
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="x_panel">
                <div class="x_title " >
                  <h2>FTEs By Gender</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content animated flipInX">
					<canvas  id="byGender"></canvas> 
				</div>
              </div> 
            </div>
          </div>
		  
		  <div class="clearfix"></div> 
          <div class="row">  
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs By Age</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
					<canvas class="animated flipInX" id="byAge"></canvas>  
				</div>
              </div> 
            </div>
			
		 
			
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title " >
                  <h2>FTEs By Tenure</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content animated flipInX">
					<canvas  id="byTenure"></canvas> 
				</div>
              </div> 
            </div>
          </div>
	
		<!-- sample here!!! -->
		<canvas id="sample" style="display:none;"></canvas> 
		
        <!-- footer content -->
        <footer>
          <div class="copyright-info">
            <p class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>

  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>
 
  <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/chartjs/Chart.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/icheck/icheck.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/custom.js"></script>
	<script src="<?php echo base_url();?>assets/js/pace/pace.min.js"></script>
	
		
		<script>
		Chart.defaults.global.legend = {
		  enabled: true
		};
		
		
		
		//sample only
		var ctx1 = document.getElementById("sample"); 
		var data1 = {
		  datasets: [{
			data: [10], 
			backgroundColor: [
			  "#9B59B6",
			  "#FFC221",
			  "#FB2300",
			  "#26B99A",
			  "#3498DB"
			],
			label: 'My dataset' // for legend
		  }], 
		   labels: [
			'sample'
		  ]
		};
		
		 var pieChart = new Chart(ctx1, {
		  data: data1,
		  type: 'pie',
		  otpions: {
			legend: false
		  }
		});
		
		
		// Pie chart gender
		var ctx = document.getElementById("byPersArea");
		var data = {
		  datasets: [{
			data: [<?php echo $data_emp_count_subgroup_pers_area_chart[$pers_area[0]].",".$data_emp_count_subgroup_pers_area_chart[$pers_area[1]];?>],
			backgroundColor: [
			  "#3498DB",
 "#26B99A",
			  
"#BDC3C7",
"#9B59B6",
			  
			 
			  "#3498DB"
			],
			label: 'My dataset' // for legend
		  }],
		  labels: [
			"GMM",
			"Regional"
		  ]
		};

		var pieChart = new Chart(ctx, {
		  data: data,
		  type: 'pie',
		  otpions: {
			legend: false
		  }
		});
 
		
		// Bar chart Pers Area
		var ctx = document.getElementById("byClassification");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: { 
			labels: ['GMM', 'Regional'],
			datasets: [
			{
			  label: 'Officers',
			  backgroundColor: "<?php echo $colors[0]?>",
			  data: [<?php echo $data_emp_count_subgroup_pers_area[$subgroup[0]];?>] 
			  // data: [51, 30, 30, 30, 30, 30, 30, 30, 30] 
			}, 
			{
			  label: 'Executives',
			  backgroundColor: "<?php echo $colors[6]?>",
			  data: [<?php echo $data_emp_count_subgroup_pers_area[$subgroup[1]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			} , 
			{
			  label: 'Management',
			  backgroundColor: "<?php echo $colors[2]?>",
			  data: [<?php echo $data_emp_count_subgroup_pers_area[$subgroup[2]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			} , 
			{
			  label: 'Rank & File',
			  backgroundColor: "<?php echo $colors[3]?>",
			  data: [<?php echo $data_emp_count_subgroup_pers_area[$subgroup[3]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			} ]
		  },

		  options: {  
		  scales: {
			  yAxes: [{
				ticks: {
				  beginAtZero: true
				}
			  }]
			},
		  
			tooltips: {
			mode: "label"},
			responsive: true
		  }
		}); 
		
		// Bar chart Pers Area
		var ctx = document.getElementById("byGender");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: { 
			labels: ['GMM', 'Regional'],
			datasets: [
			{
			  label: 'Male',
			  backgroundColor: "<?php echo $colors[0]?>",
			  data: [<?php echo $data_emp_count_sex_pers_area[$sex[0]];?>] 
			  // data: [51, 30, 30, 30, 30, 30, 30, 30, 30] 
			}, 
			{
			  label: 'Female',
			  backgroundColor: "<?php echo $colors[6]?>",
			  data: [<?php echo $data_emp_count_sex_pers_area[$sex[1]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			} ]
		  },

		  options: {  
		  scales: {
			  yAxes: [{
				ticks: {
				  beginAtZero: true
				}
			  }]
			},
		  
			tooltips: {
			mode: "label"},
			responsive: true
		  }
		}); 
		
		
		// Bar chart Age
		var ctx = document.getElementById("byAge");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ['GMM', 'Regional'],
			datasets: [
			<?php 
			foreach($age_range as $index=>$ranges)
			{ 
				?>
				{
				  label: '<?php echo $ranges;?>',
				  backgroundColor: "<?php echo $colors[$index];?>",
				  data: [<?php echo $total_per_pers_age_chart[$ranges];?>]  
				},
				<?php 
			}
			?> 
			]
		  },

		  options: {  
		  scales: {
			  yAxes: [{
				ticks: {
				  beginAtZero: true
				}
			  }]
			},
		  
			// tooltips: {
			// mode: "label"},
			// responsive: true
		  }
		}); 
		
		// Bar chart Age
		var ctx = document.getElementById("byTenure");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ['GMM', 'Regional'],
			datasets: [
			<?php 
			foreach($los_range as $index=>$ranges)
			{ 
				?>
				{
				  label: '<?php echo $ranges;?>',
				  backgroundColor: "<?php echo $colors[$index];?>",
				  data: [<?php echo $total_per_orggroup_per_pers_los_chart[$ranges];?>]  
				},
				<?php 
			}
			?> 
			]
		  },

		  options: {  
		  scales: {
			  yAxes: [{
				ticks: {
				  beginAtZero: true
				}
			  }]
			},
		  
			// tooltips: {
			// mode: "label"},
			// responsive: true
		  }
		}); 
		
		</script>