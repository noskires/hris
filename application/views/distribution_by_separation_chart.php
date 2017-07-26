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
          "#57A7A5",
          "#26B99A",
          "#3498DB",
		  "#C4CC0E",
          "#FFC220",
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
	 
		
		// ------------------------------------------------------------------
		
		foreach($count_per_separation_reason as $sequence_no=>$termination_data)
		{
			$terminations .= "'".trim($termination_data->termination_reason)."',";  
			$terminations_count .= $termination_data->count.",";
		}
		
		foreach($count_per_separation_subgroup as $data_separation_subgroup)
		{
			$emp_count_per_separation[$data_separation_subgroup->emp_subgroup][$data_separation_subgroup->termination_reason] = $data_separation_subgroup->count; 
		} 
		
		foreach($count_per_separation_sex as $separation_sex)
		{
			$emp_count_per_separation_sex[$separation_sex->sex][$separation_sex->termination_reason] = $separation_sex->count; 
		}  
		
		foreach($count_per_separation_location as $separation_location)
		{
			$emp_count_per_separation_location[$separation_location->personnel_area][$separation_location->termination_reason] = $separation_location->count; 
		}  
		
		foreach($count_per_separation_agegroup as $separation_agegroup)
		{
			$emp_count_per_separation_agegroup[$separation_agegroup->agegroup][$separation_agegroup->termination_reason] = $separation_agegroup->count; 
		}
		
		foreach($count_per_separation_los as $separation_los)
		{
			$emp_count_per_separation_los[$separation_los->los_group][$separation_los->termination_reason] = $separation_los->count; 
		}
		
		foreach($count_per_separation_year as $separation_year)
		{
			$emp_count_per_separation_year[$separation_year->year_separated][$separation_year->termination_reason] = $separation_year->count; 
		}
		
		// foreach($separation_type as $data_separation)
		// { 
			// foreach($subgroup as $subgroup_data)
			// {  
				// if(isset($emp_count_per_separation[$subgroup_data][$data_separation->termination_reason]))
				// {
					// $emp_count_subgroup[$subgroup_data] = $emp_count_per_separation[$subgroup_data][$data_separation->termination_reason];
				// }
				// else
				// {
					// $emp_count_subgroup[$subgroup_data] = 0;
				// } 
				// $total_per_separation_subgroup_chart[$subgroup_data] .= $emp_count_subgroup[$subgroup_data].",";
			// }
			// $separation_reasons .= "'".trim($data_separation->termination_reason)."',";
		// }
		
		foreach($subgroup as $subgroup_data)
		{   
			foreach($separation_type as $data_separation)
			{  
 
				if(isset($emp_count_per_separation[$subgroup_data][$data_separation->termination_reason]))
				{
					 $emp_count_subgroup[$data_separation->termination_reason] = $emp_count_per_separation[$subgroup_data][$data_separation->termination_reason];
				}
				else
				{
					$emp_count_subgroup[$data_separation->termination_reason] = 0;
				} 
				 $total_per_separation_subgroup_chart[trim($data_separation->termination_reason)] .= $emp_count_subgroup[$data_separation->termination_reason].",";
			}
			// $separation_reasons .= "'".trim($data_separation->termination_reason)."',";
			$sub .= "'".$subgroup_data."',";
		}
		
		
		foreach($sex as $sex_data)
		{   
			foreach($separation_type as $data_separation)
			{  
 
				if(isset($emp_count_per_separation_sex[$sex_data][$data_separation->termination_reason]))
				{
					 $emp_count_sex[$data_separation->termination_reason] = $emp_count_per_separation_sex[$sex_data][$data_separation->termination_reason];
				}
				else
				{
					$emp_count_sex[$data_separation->termination_reason] = 0;
				} 
				 $total_per_separation_sex_chart[trim($data_separation->termination_reason)] .= $emp_count_sex[$data_separation->termination_reason].",";
			}
			// $separation_reasons .= "'".trim($data_separation->termination_reason)."',";
			$sex_label .= "'".$sex_data."',";
		}
		
		foreach($pers_area as $pers_area_data)
		{   
			foreach($separation_type as $data_separation)
			{  
 
				if(isset($emp_count_per_separation_location[$pers_area_data][$data_separation->termination_reason]))
				{
					 $emp_count_pers_area[$data_separation->termination_reason] = $emp_count_per_separation_location[$pers_area_data][$data_separation->termination_reason];
				}
				else
				{
					$emp_count_pers_area[$data_separation->termination_reason] = 0;
				} 
				 $total_per_separation_pers_area_chart[trim($data_separation->termination_reason)] .= $emp_count_pers_area[$data_separation->termination_reason].",";
			}
			// $separation_reasons .= "'".trim($data_separation->termination_reason)."',";
			$pers_area_label .= "'".$pers_area_data."',";
		}
		
		foreach($age_range as $age_range_data)
		{   
			foreach($separation_type as $data_separation)
			{  
 
				if(isset($emp_count_per_separation_agegroup[$age_range_data][$data_separation->termination_reason]))
				{
					 $emp_count_age[$data_separation->termination_reason] = $emp_count_per_separation_agegroup[$age_range_data][$data_separation->termination_reason];
				}
				else
				{
					$emp_count_age[$data_separation->termination_reason] = 0;
				} 
				$total_per_separation_age_chart[trim($data_separation->termination_reason)] .= $emp_count_age[$data_separation->termination_reason].",";
			}
			// $separation_reasons .= "'".trim($data_separation->termination_reason)."',";
			$age_range_label .= "'".$age_range_data."',";
		}
		
		foreach($los_range as $los_range_data)
		{
			foreach($separation_type as $data_separation)
			{
				if(isset($emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason]))
				{
					$emp_count_los[$data_separation->termination_reason] = $emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason];
				}
				else
				{
					$emp_count_los[$data_separation->termination_reason] = 0;
				}
				$total_per_separation_los_chart[trim($data_separation->termination_reason)] .= $emp_count_los[$data_separation->termination_reason].",";
			}
			$los_range_label .= "'".$los_range_data."',";
		}
		?>  
	
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
           <!-- <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <h3>
                   Organization 
						<select id="first_drill" name="first_drill" class="form-control group">
						<option value="">  All </option>
						<?php 
							foreach($count_per_group as $group)
							{
								?>
								<option value="<?php echo $group->first_level;?>"> <?php if($group->first_level==99999999){echo "President & CEO";}else{echo $group->first_level_txt;} ?>    </option> 
								<?php
							}
						?>
						</select>  
                </h3>
            </div>
            </div> -->
			
			<!--
            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
              </div>
            </div> -->
          </div>
          
		   <!-- top tiles -->
       <!-- <div class="row tile_count">
	 
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Employees</span>
              <div class="count blue"><?php echo number_format($total_active_emp);?></div>
              <span class="count_bottom red"> As of 03/16/2017 09:00 AM</span>| Total Average :<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b> </span>
            </div>
          </div>
         <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Officers</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[0]]);?></div> 
			    Average age : <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[0]],2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Executives</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[1]]);?></div> 
			    Average age : <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[1]], 2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Management</span>
             <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[2]]);?></div> 
			    Average age : <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[2]], 2);?></span>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Rank & File</span>
              <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[3]]);?></div> 
			    Average age : <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[3]], 2);?></span>
            </div>
          </div> 
        </div>-->
        <!-- /top tiles -->
		
		<div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <h3>
                   Types of Separation 
					<select id="separation_reason" name="separation_reason" class="form-control group">
					<option value="">  All </option>
					<?php 
						foreach($separation_type1 as $data_separation)
						{	
							// $sep_type1 = trim($data_separation->termination_reason);
							$sep_type1	= str_replace(array('/', '(', ')'), array('-', '_', '~'), $data_separation->termination_reason);
							?>
							<option value="<?php echo trim($sep_type1);?>" <?php if(trim($sep_type) == trim($data_separation->termination_reason)){echo "selected";} ?>> <?php echo    $data_separation->termination_reason;?> </option> 
							<?php
						}
					?>
					</select>  
                </h3>
            </div>
            </div>
		  
		  <div class="clearfix"></div> 
          <div class="row"> 
			<div class="col-md-6 col-sm-6 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2> Separation	</h2>
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
			
			<div class="col-md-6 col-sm-12 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2> Classification	</h2>
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
            </div>
 
			<div class="clearfix"></div> 
          <div class="row"> 
		  
		  <div class="col-md-6 col-sm-12 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2> Gender	</h2>
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
			<div class="col-md-6 col-sm-12 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2> Personnel Area	</h2>
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
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2> Distribution By Age</h2>
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
			
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2> Distribution By Tenure</h2>
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
		$().ready(function()
		{
			$('#separation_reason').change(function()
			{
				var val = $(this).val();      
				if(val!="")
				{
					uri = "../../../../../distribution_by_separation_chart1/"+val;
				}
				else
				{
					uri = "../../../../../distribution_by_separation_chart";
				}
				$(location).attr("href", uri); 
			});
		});
		</script>
	
		<script>
		Chart.defaults.global.legend = {
		  enabled: false
		};
		// Chart.defaults.global.legend = false;
		
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
			data: [<?php echo $terminations_count;?>],
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
			echo $terminations;
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
		  labels: ['Officers', 'Executives', 'Management', 'Rank & File'],
			// labels: [<?php echo $sub;?>],
			datasets: [
			<?php 
			foreach($separation_type as $seq_no => $data_separation)
			{
				?>
					{
					  label: '<?php echo trim($data_separation->termination_reason);?>',
					  backgroundColor: "<?php echo $colors[$seq_no];?>",
					  data: [<?php echo $total_per_separation_subgroup_chart[trim($data_separation->termination_reason)];?>] 
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
			responsive: true
		  }
		}); 
		
		// Bar chart by gender
		var ctx = document.getElementById("byGender");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $sex_label;?>],
			datasets: [
		<?php 
			foreach($separation_type as $seq_no => $data_separation)
			{
				?>
					{
					  label: '<?php echo trim($data_separation->termination_reason);?>',
					  backgroundColor: "<?php echo $colors[$seq_no];?>",
					  data: [<?php echo $total_per_separation_sex_chart[trim($data_separation->termination_reason)];?>] 
					}, 
				<?php
			}
			?> ]
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
			responsive: true
		  }
		});

		// Bar chart by pers area
		var ctx = document.getElementById("byPersArea");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $pers_area_label;?>],
			datasets: [
		<?php 
			foreach($separation_type as $seq_no => $data_separation)
			{
				?>
					{
					  label: '<?php echo trim($data_separation->termination_reason);?>',
					  backgroundColor: "<?php echo $colors[$seq_no];?>",
					  data: [<?php echo $total_per_separation_pers_area_chart[trim($data_separation->termination_reason)];?>] 
					}, 
				<?php
			}
			?> ]
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
			responsive: true
		  }
		});
		
		// Bar chart by Age
		
		 
		
		var ctx = document.getElementById("byAge");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: [<?php echo $age_range_label;?>],
			datasets: [
		<?php 
			foreach($separation_type as $seq_no => $data_separation)
			{
				?>
					{
					  label: '<?php echo trim($data_separation->termination_reason);?>',
					  backgroundColor: "<?php echo $colors[$seq_no];?>",
					  data: [<?php echo $total_per_separation_age_chart[trim($data_separation->termination_reason)];?>] 
					}, 
				<?php
			}
			?> ]
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
			responsive: true
		  }
		});
		
		// Bar chart by Tenure
		var ctx = document.getElementById("byTenure");
		var mybarChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			//labels: ['OCEO', 'Consumer Business', 'Audit', 'Technology', 'Bus Analytics', 'EICB', 'Home', 'Asset Protection', 'BTO', 'CSAG', 'Finance', 'HR'],
			labels: [<?php echo $los_range_label;?>],
			datasets: [
		<?php 
			foreach($separation_type as $seq_no => $data_separation)
			{
				?>
					{
					  label: '<?php echo trim($data_separation->termination_reason);?>',
					  backgroundColor: "<?php echo $colors[$seq_no];?>",
					  data: [<?php echo $total_per_separation_los_chart[trim($data_separation->termination_reason)];?>] 
					}, 
				<?php
			}
			?> ]
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
			responsive: true,
			  scaleOverlay : true, 
			  scaleOverride : true ,
		  }
		});
		 
		</script>
 