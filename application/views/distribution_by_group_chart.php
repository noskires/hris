	<?php 
		$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex 					= array("Male", "Female");
		$pers_area 			= array("Greater Metro Manila", "Regional");
		// $age_range 			= array("20 to 24","25 to 29","30 to 34","35 to 39","40 to 44","45 to 49","50 to 54","55 to 59","> 60");  
		$age_range 			= array("< 25","25 to 34","35 to 44","45 to 54","55 to 59","60 to 65","> 65");  
		$los_range 			= array("< 1","1 - 5","6 - 10","11 - 15","16 - 20","21 - 25","26 - 30","31 - 35","36 - 40","> 40");  
		
		$colors = array(
		  "#9B59B6",
          "#455C73",
          "#03586A",
          "#3498DB",
          "#26B99A",
          "#FFC220",
          "#57A7A5",
		  "#C4CC0E",
          "#E8CF76",
		  "#F74834",
          "#3170EF",
          "#A3F4CB",
          "#63064E",
          "#13D4D0",
          "#B3F2E8",
          "#3B2728",
          "#237F9C",
          "#874FA6",
          "#60A2EC",
          "#A736C3"
		);
		
		//tabular here
		//by classification
		foreach($count_per_group_subgroup as $org_group_subgroup)
		{
			$emp_count_per_org_group_subgroup[$org_group_subgroup->group_code][$org_group_subgroup->emp_subgroup] = $org_group_subgroup->count; 
		}
		
		//by sex
		foreach($count_per_group_sex as $org_group_sex)
		{
			$emp_count_per_org_group_sex[$org_group_sex->group_code][$org_group_sex->sex] = $org_group_sex->count; 
		}
		
		//by pers_area
		foreach($count_per_group_pers_area as $org_group_pers_area)
		{
			$emp_count_per_org_group_pers_area[$org_group_pers_area->group_code][$org_group_pers_area->personnel_area] = $org_group_pers_area->count; 
		}
		
		//by age group
		foreach($count_per_group_agegroup as $org_group_agegroup)
		{
			$emp_count_per_org_group_agegroup[$org_group_agegroup->group_code][$org_group_agegroup->agegroup] = $org_group_agegroup->count; 
		}
		
		//by age group 
		foreach($count_per_group_los as $org_group_losgroup)
		{
			$emp_count_per_org_group_losgroup[$org_group_losgroup->group_code][$org_group_losgroup->los_group] = $org_group_losgroup->count; 
		}
		
 
		foreach($count_per_group_code as $sequence_no=>$group_org)
		{
			$group_name = $group_org->group_txt;
			$group_name = str_replace("'","",$group_name); 
			if($group_name=="")
			{
				$group_name = "President & CEO";
			}
			
			$org_group_names .= "'".$group_name."',";
			$org_group_count .= $group_org->cnt.",";
		}
		 
		foreach($average_per_subgroup as $data_average_subgroup)
		{
			 
			$ave_subgroup_average[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average;
			$ave_subgroup_count[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->count;
                        
                        $ave_subgroup_average_los[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average_los;

			$total_active_emp += $ave_subgroup_count[$data_average_subgroup->emp_subgroup]; 
			$total_average += $data_average_subgroup->sum_age;
                        $total_average_los  += $data_average_subgroup->sum_los;

		}
		
		foreach($count_per_group_code as $sequence_no=>$group_org)
		{
			foreach($pers_area as $pers_area_data) // personnel_area
			{ 
				if(isset($emp_count_per_org_group_pers_area[$group_org->group_code][$pers_area_data]))
				{
					$emp_count_pers_area[$pers_area_data] = $emp_count_per_org_group_pers_area[$group_org->group_code][$pers_area_data]; 
				}
				else
				{
					$emp_count_pers_area[$pers_area_data] = 0;
				}
				$total_per_orggroup_per_pers_area_chart[$pers_area_data] .= $emp_count_pers_area[$pers_area_data].",";
			}
			
			foreach($age_range as $age_range_data) // age range
			{  
				if(isset($emp_count_per_org_group_agegroup[$group_org->group_code][$age_range_data]))
				{
					$emp_count_pers_agegroup[$age_range_data] = $emp_count_per_org_group_agegroup[$group_org->group_code][$age_range_data]; 
				}
				else
				{
					$emp_count_pers_agegroup[$age_range_data] = 0;
				} 
				$total_per_orggroup_per_pers_age_chart[$age_range_data] .= $emp_count_pers_agegroup[$age_range_data].",";
			}
			
			foreach($los_range as $los_range_data)// per tenure
			{   
				if(isset($emp_count_per_org_group_losgroup[$group_org->group_code][$los_range_data]))
				{
					$emp_count_pers_losgroup[$los_range_data] = $emp_count_per_org_group_losgroup[$group_org->group_code][$los_range_data]; 
				}
				else
				{
					$emp_count_pers_losgroup[$los_range_data] = 0;
				} 
				$total_per_orggroup_per_pers_los_chart[$los_range_data] .= $emp_count_pers_losgroup[$los_range_data].",";

			}
			
			foreach($subgroup as $subgroup_data)// per classification
			{
				if(isset($emp_count_per_org_group_subgroup[$group_org->group_code][$subgroup_data]))
				{
					$emp_count_subgroup[$subgroup_data] = $emp_count_per_org_group_subgroup[$group_org->group_code][$subgroup_data];
				}
				else
				{
					$emp_count_subgroup[$subgroup_data] = 0;
				}
				$total_per_orggroup_per_subgroup_chart[$subgroup_data] .= $emp_count_subgroup[$subgroup_data].",";
			}
			
			foreach($sex as $sex_data)//by sex
			{
				if(isset($emp_count_per_org_group_sex[$group_org->group_code][$sex_data]))
				{
					$emp_count_sex[$sex_data] = $emp_count_per_org_group_sex[$group_org->group_code][$sex_data];
				}
				else
				{
					$emp_count_sex[$sex_data] = 0;
				} 
				$total_per_orggroup_per_sex_chart[$sex_data] .= $emp_count_sex[$sex_data].",";
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
	 
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-12 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top red"><i class="fa fa-user"></i> Total Employees as of 03/16/2017 09:00 AM</span>
              <div class="count blue"><?php echo number_format($total_active_emp);?></div>
              Total Average AGE:<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b> </span><br>
              Total Average LOS:<span class="count_bottom red"><b> <?php echo number_format($total_average_los/$total_active_emp ,2);?></b> </span>
            </div>
          </div>
         <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Officers</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[0]]);?></div> 
			    Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[0]],2);?></span><br>
                            Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[0]],2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Executives</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[1]]);?></div> 
			    Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[1]],2);?></span><br>
                            Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[1]],2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Management</span>
             <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[2]]);?></div> 
			    Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[2]],2);?></span><br>
                            Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[2]],2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Rank & File</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[3]]);?></div> 
			    Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[3]],2);?></span><br>
                            Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[3]],2);?></span>
            </div>
          </div> 
        </div>
        <!-- /top tiles -->
		  
		  <div class="clearfix"></div> 
          <div class="row"> 
			<div class="col-md-6 col-sm-6 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs By Group	</h2>
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
					<canvas id="byGroup"></canvas>    
                </div>
              </div> 
            </div>
			
            <div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Gender</h2>
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
                   <canvas id="byGender"></canvas>    
                </div>
              </div> 
            </div>
            </div>
			
			
			
		  <div class="clearfix"></div> 
          <div class="row"> 
			
			<div class="col-md-6 col-sm-6 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Classification	</h2>
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
					<canvas id="byClassification"></canvas>    
                </div>
              </div> 
            </div>
			
			
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Personnel Area</h2>
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
                   <canvas id="byPersArea"></canvas>    
                </div>
              </div> 
            </div>
			
          </div>
		  
		  <div class="clearfix"></div> 
          <div class="row">  
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Age</h2>
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
					 <canvas id="byAge"></canvas>  
				</div>
              </div> 
            </div>
          </div>		 
		 
          
		  <div class="clearfix"></div> 
          <div class="row">  
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Tenure</h2>
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
					 <canvas id="byTenure"></canvas>  
				</div>
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
		  enabled: false
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
		
		//pie chart by org group
		var ctx = document.getElementById("byGroup");
		var data = {
		  datasets: [{
			data: [<?php echo $org_group_count;?>],
			backgroundColor: [
			  "#9B59B6",
          "#455C73",
          "#03586A",
          "#3498DB",
          "#26B99A",
          "#FFC220",
          "#57A7A5",
		  "#C4CC0E",
          "#E8CF76",
		  "#F74834",
          "#3170EF",
          "#A3F4CB",
          "#63064E",
          "#13D4D0",
          "#B3F2E8",
          "#3B2728",
          "#237F9C",
          "#874FA6",
          "#60A2EC",
          "#A736C3"
			],
			label: 'My dataset' // for legend
		  }],
		  labels: [
		  <?php 
			echo $org_group_names;
			// "Officers",
			// "Executives",
			// "Management",
			// "Rank & File" ?>
		  ]
		};

		var pieChart = new Chart(ctx, {
		  data: data,
		  type: 'pie',
		  otpions: {
			legend: false
		  }
		});
		
		// Bar chart
		var ctx = document.getElementById("byClassification");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $org_group_names;?>],
			datasets: [
			{
			  label: 'Officers',
			  backgroundColor: "#26B99A",
			  data: [<?php echo $total_per_orggroup_per_subgroup_chart[$subgroup[0]];?>] 
			  // data: [51, 30, 30, 30, 30, 30, 30, 30, 30] 
			}, 
			{
			  label: 'Executives',
			  backgroundColor: "#3498DB",
			  data: [<?php echo $total_per_orggroup_per_subgroup_chart[$subgroup[1]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			},
			{
			  label: 'Management',
			  backgroundColor: "#03586A",
			  data: [<?php echo $total_per_orggroup_per_subgroup_chart[$subgroup[2]];?>] 
			  // data: [51, 30, 30, 30, 30, 30, 30, 30, 30] 
			}, 
			{
			  label: 'Rank & File',
			  backgroundColor: "#C4CC0E",
			  data: [<?php echo $total_per_orggroup_per_subgroup_chart[$subgroup[3]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			}]
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
		
		// Bar chart by gender
		var ctx = document.getElementById("byGender");
		var mybarChart = new Chart(ctx, {
		  type: 'horizontalBar',
		  data: {
			labels: [<?php echo $org_group_names;?>],
			datasets: [
			{
			  label: 'Male',
			  backgroundColor: "#26B99A",
			  data: [<?php echo $total_per_orggroup_per_sex_chart[$sex[0]];?>] 
			  // data: [51, 30, 30, 30, 30, 30, 30, 30, 30] 
			}, 
			{
			  label: 'Female',
			  backgroundColor: "#03586A",
			  data: [<?php echo $total_per_orggroup_per_sex_chart[$sex[1]];?>] 
			  // data: [41, 56, 56, 56, 56, 56, 56, 56, 56, 56, 56] 
			}]
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
				mode: 'label',
				callbacks: {
					title: function(tooltipItems, data){
						return 	'';
					},
					label: function(tooltipItems, data) {
						return data.datasets[tooltipItems.datasetIndex].label+': ' + tooltipItems.yLabel +'- ' +tooltipItems.xLabel;
					}
				}
			},
			responsive: true
		  }
		});

		// Bar chart by pers area
		var ctx = document.getElementById("byPersArea");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $org_group_names;?>],
			datasets: [
			{
			  label: 'GMM',
			  backgroundColor: "#26B99A",
			  data: [<?php echo $total_per_orggroup_per_pers_area_chart[$pers_area[0]];?>]  
			},
			{
			  label: 'Regional',
			  backgroundColor: "#03586A",
			  data: [<?php echo $total_per_orggroup_per_pers_area_chart[$pers_area[1]];?>]  
			}]
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
		
		// Bar chart by Age
		var ctx = document.getElementById("byAge");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $org_group_names;?>],
			datasets: [
			
			<?php 
			foreach($age_range as $index=>$ranges)
			{ 
				?>
				{
				  label: '<?php echo $ranges;?>',
				  backgroundColor: "<?php echo $colors[$index];?>",
				  data: [<?php echo $total_per_orggroup_per_pers_age_chart[$ranges];?>]  
				},
				<?php 
			}
			?>]
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
		
		// Bar chart by Tenure
		var ctx = document.getElementById("byTenure");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			//labels: ['OCEO', 'Consumer Business', 'Audit', 'Technology', 'Bus Analytics', 'EICB', 'Home', 'Asset Protection', 'BTO', 'CSAG', 'Finance', 'HR'],
labels: [<?php echo $org_group_names;?>],
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
			?>]
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
		total_per_orggroup_per_pers_los_chart
		</script>
 