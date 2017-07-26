<?php 
	$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
	$age_range 			= array("< 25","25 to 34","35 to 44","45 to 54","55 to 59","60 to 65","> 65");   
	$los_range 			= array("< 1","1 - 5","6 - 10","11 - 15","16 - 20","21 - 25","26 - 30","31 - 35","36 - 40","> 40");   
	$sex 				= array("Male", "Female");
	
	//group
	foreach($count_per_group_code as $group_org)
	{
		$group_name = $group_org->group_txt;
		$group_name = str_replace("'","",$group_name); 
		if($group_name=="")
		{
			$group_name = "President & CEO";
		}
		$group_labels .= '"'.$group_name.'",'; 
		$group_cnt .= $group_org->cnt.","; 
	} 
	
	//by gender
	foreach($count_per_org  as $row)
	{
		$row_data[$row->emp_subgroup][$row->sex] = $row->cnt; 
	}

	$data = "";
	$pie_data = "";
	foreach($subgroup as $sub)
	{
		if(!$row_data[$sub]['Male'])
		{
			$row_data[$sub]['Male'] = 0;  
		}
		
		if(!$row_data[$sub]['Female'])
		{
			$row_data[$sub]['Female'] = 0;  
		}
	
	
		$subgroup_total  = $row_data[$sub]['Male'] + $row_data[$sub]['Female'];
		$data 				.= "['".$sub."',".$row_data[$sub]['Male'].",".$row_data[$sub]['Female']."],";
		$pie_data 			.= "['".$sub."',".$subgroup_total."],";
		
		//doughnut data
		$data_label 		.= '"'.$sub.'",';
		$data_value_doughnut .= $subgroup_total.",";
		
		
		//bar graph data
		$data_value_bar_male .= $row_data[$sub]['Male'].",";
		$data_value_bar_female .= $row_data[$sub]['Female'].",";
	}
	
	//by location
	foreach($count_per_org_pa as $loc)
	{
		$loc_data[$loc->emp_subgroup][$loc->personnel_area] = $loc->cnt;
	}
	
	foreach($subgroup as $sub)
	{
		if(!$loc_data[$sub]['Greater Metro Manila'])
		{
			$loc_data[$sub]['Greater Metro Manila'] = 0;
		}
		
		if(!$loc_data[$sub]['Regional'])
		{
			$loc_data[$sub]['Regional'] = 0;
		}
		
		$data_value_bar_gmm .= $loc_data[$sub]['Greater Metro Manila'].",";
		$data_value_bar_regional .= $loc_data[$sub]['Regional'].",";
	}
	
	//by age
	foreach($count_per_org_per_age as $org_agegroup)
	{
		$emp_count_per_subgroup_agegroup[$org_agegroup->emp_subgroup][$org_agegroup->agegroup] = $org_agegroup->cnt; 
	
	}
	
	foreach($subgroup as $emp_subgroup)
	{
		foreach($age_range as $range)
		{
			if($emp_count_per_subgroup_agegroup[$emp_subgroup][$range])
			{
				$age_range_per_org = $emp_count_per_subgroup_agegroup[$emp_subgroup][$range];					
			}
			else
			{
				$age_range_per_org = 0;
			}
			$data_per_age_subgroup[$emp_subgroup] .= $age_range_per_org.",";
		}
	}
	
	
	//by LOS
	foreach($count_per_org_per_tenure as $org_tenuregroup)
	{
		$emp_count_per_subgroup_tenuregroup[$org_tenuregroup->emp_subgroup][$org_tenuregroup->los_group] = $org_tenuregroup->cnt; 
	
	}
	
	foreach($subgroup as $emp_subgroup)
	{
		foreach($los_range as $range)
		{
			if($emp_count_per_subgroup_tenuregroup[$emp_subgroup][$range])
			{
				$tenure_range_per_org = $emp_count_per_subgroup_tenuregroup[$emp_subgroup][$range];					
			}
			else
			{
				$tenure_range_per_org = 0;
			}
			$data_per_tenure_subgroup[$emp_subgroup] .= $tenure_range_per_org.",";
		} 
	} 
	
	//get header stats
	foreach($count_per_org_per_subgroup as $data_average_subgroup)
	{
		$ave_subgroup_average[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average;
                $ave_subgroup_average_los[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average_los;

		$ave_subgroup_count[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->count;
		$total_active_emp 	+= $ave_subgroup_count[$data_average_subgroup->emp_subgroup]; 
		$total_average 		+= $data_average_subgroup->sum_age;
                $total_average_los      += $data_average_subgroup->sum_los;
	}
?>
      <!-- page content -->  
			<!-- top tiles -->
				<div class="row tile_count">
			 
				  <div class="animated flipInY col-md-4 col-sm-4 col-xs-12 tile_stats_count">
					<div class="left"></div>
					<div class="right">
					  <span class="count_top red"><i class="fa fa-user"></i> Total Employees as of 03/16/2017 09:00 AM</span>
					  <div class="count blue"><?php echo number_format($total_active_emp);?></div>
					  Total Average AGE:<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b><br> 
</span>Total Average LOS:<span class="count_bottom red"><b> <?php echo number_format($total_average_los/$total_active_emp ,2);?></b> </span>
					</div>
				  </div>
				 <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<div class="left"></div>
					<div class="right">
					  <span class="count_top"><i class="fa fa-user"></i> Total Officers</span>
					  <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[0]]);?></div> 
						Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[0]],2);?></span> <br>
Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[0]],2);?></span>
					</div>
				  </div>
				  <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<div class="left"></div>
					<div class="right">
					  <span class="count_top"><i class="fa fa-user"></i> Total Executives</span>
					  <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[1]]);?></div> 
						Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[1]], 2);?></span><br>
Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[1]], 2);?></span>
					</div>
				  </div>
				  <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<div class="left"></div>
					<div class="right">
					  <span class="count_top"><i class="fa fa-user"></i> Total Management</span>
					 <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[2]]);?></div> 
						Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[2]], 2);?></span><br>
Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[2]], 2);?></span>
					</div>
				  </div>
				  <div class="animated flipInY col-md-2 col-sm-4 col-xs-6 tile_stats_count">
					<div class="left"></div>
					<div class="right">
					  <span class="count_top"><i class="fa fa-user"></i> Total Rank & File</span>
					  <div class="count green"><?php echo  number_format($ave_subgroup_count[$subgroup[3]]);?></div> 
						Average AGE: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average[$subgroup[3]], 2);?></span> <br>
Average LOS: <span class="count_bottom red"><?php echo  number_format($ave_subgroup_average_los[$subgroup[3]], 2);?></span>
					</div>
				  </div> 
				</div>
			<!-- /top tiles -->

          <div class="clearfix"></div> 
          <div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12"> 
			  <div class="x_panel">
                <div class="x_title">
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
				
                <div class="x_content">
                  <canvas id="pieChart"></canvas> 
				</div>
              </div> 
            </div>
			
            <div class="col-md-4 col-sm-6 col-xs-12">
				<div class="x_panel">
				<div class="x_title">
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
				<div class="x_content">
				  <canvas id="byGender"></canvas>
				</div>
				</div> 
            </div>
			
			<div class="col-md-4 col-sm-6 col-xs-12">
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
                  <canvas id="byLocations"> </canvas>
				 
				</div>
              </div> 
            </div>
            
          </div>
		  
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
                  <canvas id="byAge"></canvas>  
				</div>
              </div>
			  
            </div>
			
            <div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
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

	  <div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"> </ul>
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

	var ctx1 = document.getElementById("sample"); 
    var data1 = {
      datasets: [{
        data: [1], 
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
	
	// Pie chart
    var ctx2 = document.getElementById("pieChart"); 
    var data2 = {
      datasets: [{
        data: [<?php echo $data_value_doughnut;?>], 
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
        <?php echo $data_label; ?>
      ]
    };

    var pieChart = new Chart(ctx2, {
      data: data2,
      type: 'pie',
      otpions: {
        legend: false
      }
    });
	
    // by gender
    var ctx = document.getElementById("byGender");
    var byGender = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Officers', 'Executives', 'Management', 'Rank & File'],
        // labels: [<?php echo $data_label;?>],
        datasets: [
		{
          label: 'Male',
          backgroundColor: "#E86F12",
          data: [<?php echo $data_value_bar_male;?>]
          // data: [51, 30, 40, 28, 92, 50, 45]
        }, 
		{
          label: 'Female',
          backgroundColor: "#03586A",
          data: [<?php echo $data_value_bar_female;?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
	
		
	var ctx = document.getElementById("byLocations");
    var byLocation = new Chart(ctx, {
      type: 'bar',
      data: {
		 labels: ['Officers', 'Executives', 'Management', 'Rank & File'],
        // labels: [<?php echo $data_label;?>],
        datasets: [
		{
          label: 'GMM',
          backgroundColor: "#26B99A",
          data: [<?php echo $data_value_bar_gmm;?>]
          // data: [51, 30, 40, 28, 92, 50, 45]
        }, 
		{
          label: 'Regional',
          backgroundColor: "#FB2300",
          data: [<?php echo $data_value_bar_regional;?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
	
	var ctx = document.getElementById("byAge");
    var bar_by_age = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php foreach($age_range as $range){echo "'".$range."',";};?>],
        datasets: [
		{
          label: '<?php echo $subgroup[0];?>',
          backgroundColor: "#E86F12",
          data: [<?php echo $data_per_age_subgroup[$subgroup[0]];?>]
          // data: [51, 30, 40, 28, 92, 50, 45]
        }, 
		{
          label: '<?php echo $subgroup[1];?>',
          backgroundColor: "#03586A",
          data: [<?php echo $data_per_age_subgroup[$subgroup[1]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }, 
		{
          label: '<?php echo $subgroup[2];?>',
          backgroundColor: "#3170EF",
          data: [<?php echo $data_per_age_subgroup[$subgroup[2]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }, 
		{
          label: '<?php echo $subgroup[3];?>',
          backgroundColor: "#F74834",
          data: [<?php echo $data_per_age_subgroup[$subgroup[3]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
	
	//data_per_tenure_subgroup
	var ctx = document.getElementById("byTenure");
    var bar_by_tenure = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php foreach($los_range as $range){echo "'".$range."',";};?>],
        datasets: [
		{
          label: '<?php echo $subgroup[0];?>',
          backgroundColor: "#E86F12",
          data: [<?php echo $data_per_tenure_subgroup[$subgroup[0]];?>]
          // data: [51, 30, 40, 28, 92, 50, 45]
        }, 
		{
          label: '<?php echo $subgroup[1];?>',
          backgroundColor: "#03586A",
          data: [<?php echo $data_per_tenure_subgroup[$subgroup[1]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }, 
		{
          label: '<?php echo $subgroup[2];?>',
          backgroundColor: "#3170EF",
          data: [<?php echo $data_per_tenure_subgroup[$subgroup[2]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }, 
		{
          label: '<?php echo $subgroup[3];?>',
          backgroundColor: "#F74834",
          data: [<?php echo $data_per_tenure_subgroup[$subgroup[3]];?>]
          // data: [41, 56, 25, 48, 72, 34, 12]
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });

    
</script>
  
<script>
$().ready(function(){
	// drill1 
	$('#first_drill').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill1').val(); 
		// alert(val); 
	 
		var uri = "";
		if(val != "")
		{
			uri += "drill1/"+val;
		}
		else
		{
			alert("home");
		} 
		$(location).attr("href", uri);
	});
	
	$('#first_drill1').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill1').val(); 
		// alert(val); 
	 
		var uri = "";
		if(val != "")
		{
			uri += "../drill1/"+val;
		}
		else
		{
			// alert("home");
			uri += "../";
		} 
		$(location).attr("href", uri);
	});
	
	$('#first_drill2').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill2').val(); 
		// alert(val); 
		var uri = "";
		if(val != "")
		{ 
			uri += "../../drill1/"+val;
		}
		else
		{
			uri += "../../";
		}
		$(location).attr("href", uri);
	});
	
	$('#first_drill3').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill3').val(); 
		// alert(val);
		var val3 = $('#third_drill3').val(); 
		var uri = "";
		if(val != "")
		{ 
			uri += "../../../drill1/"+val;
		}
		else
		{
			uri += "../../../";
		} 
		$(location).attr("href", uri);
	});
	
	
	$('#first_drill4').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill4').val(); 
		// alert(val);
		var val3 = $('#third_drill4').val(); 
		var uri = "";
		if(val != "")
		{
			uri += "../../../../drill1/"+val;
		}
		else
		{
			uri += "../../../../";
		} 
		$(location).attr("href", uri);
	});
	
	$('#second_drill1').change(function(){
		var val = $('#first_drill1').val();
		var val2 = $(this).val(); 
		// alert(val2); 
		var uri = ""; 
		if(val2 != "")
		{
			uri += "../drill2/"+val+"/"+val2;
		}
		else
		{
			uri += "../../drill1/"+val;
		} 
		$(location).attr("href", uri);
	});

	$('#second_drill2').change(function(){
		var val = $('#first_drill2').val();
		var val2 = $(this).val(); 
		// alert(val2); 
		var uri = "";
		if(val2 != "")
		{
			uri += "../../drill2/"+val+"/"+val2;
		}
		else
		{
			uri += "../../drill1/"+val;
		} 
		$(location).attr("href", uri);
	});
	
	$('#second_drill3').change(function(){
		var val = $('#first_drill3').val();
		var val2 = $(this).val(); 
		// alert(val2); 
		var uri = "";
		if(val2 != "")
		{
			uri += "../../../drill2/"+val+"/"+val2;
		}
		else
		{
			uri += "../../../drill1/"+val;
		} 
		$(location).attr("href", uri);
	});
	
	$('#second_drill4').change(function(){
		var val = $('#first_drill4').val();
		var val2 = $(this).val(); 
		// alert(val2); 
		var uri = "";
		if(val2 != "")
		{
			uri += "../../../../drill2/"+val+"/"+val2;
		}
		else
		{
			uri += "../../../../drill1/"+val;
		} 
		$(location).attr("href", uri);
	});
	
	$('#third_drill2').change(function(){
		var val = $('#first_drill2').val();
		var val2 = $('#second_drill2').val(); 
		var val3 = $(this).val(); 
		// alert(val3); 
		var uri = "";
		if(val3 != "")
		{
			uri += "../../drill3/"+val+"/"+val2+"/"+val3;
		}
		else
		{
			uri += "../drill2/"+val+"/"+val2;
		} 
		$(location).attr("href", uri);
	});
	
	$('#third_drill3').change(function(){
		var val = $('#first_drill3').val();
		var val2 = $('#second_drill3').val(); 
		var val3 = $(this).val(); 
		// alert(val3); 
		var uri = "";
		if(val3 != "")
		{
			uri += "../../../drill3/"+val+"/"+val2+"/"+val3;
		}
		else
		{
			uri += "../../../drill2/"+val+"/"+val2;
		} 
		$(location).attr("href", uri);
	});
	
	$('#third_drill4').change(function(){
		var val = $('#first_drill4').val();
		var val2 = $('#second_drill4').val(); 
		var val3 = $(this).val(); 
		// alert(val3); 
		var uri = "";
		if(val3 != "")
		{
			uri += "../../../../drill3/"+val+"/"+val2+"/"+val3;
		}
		else
		{
			uri += "../../../../drill2/"+val+"/"+val2;
		} 
		$(location).attr("href", uri);
	});
	
	 
	
	$('#fourth_drill3').change(function(){
		var val = $('#first_drill3').val();
		var val2 = $('#second_drill3').val(); 
		var val3 = $('#third_drill3').val(); 
		var val4 = $(this).val(); 
		// alert(val4); 
		var uri = "";
		if(val4 != "")
		{
			uri += "../../../drill4/"+val+"/"+val2+"/"+val3+"/"+val4;
		}
		else
		{
			uri += "../../../drill3/"+val+"/"+val2+"/"+val3;
		} 
		$(location).attr("href", uri);
	});
	
	
	$('#fourth_drill4').change(function(){
		var val = $('#first_drill4').val();
		var val2 = $('#second_drill4').val(); 
		var val3 = $('#third_drill4').val(); 
		var val4 = $(this).val(); 
		// alert(val4); 
		var uri = "";
		if(val4 != "")
		{
			uri += "../../../../drill4/"+val+"/"+val2+"/"+val3+"/"+val4;
		}
		else
		{
			uri += "../../../../drill3/"+val+"/"+val2+"/"+val3;
		} 
		$(location).attr("href", uri);
	});
}); 
</script> 