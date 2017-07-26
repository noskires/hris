 <?php 
		$subgroup = array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		//get range
		for($age_r_min = 20, $age_r_max = 24;$age_r_min <60; $age_r_min += 5, $age_r_max += 5)
		{
			$range .=  '"'.$age_r_min.' to '.$age_r_max.'",';
		}
		
		for($los_r_min = 1, $los_r_max = 4;$los_r_min <40; $los_r_min += 4, $los_r_max += 5)
		{ 
			$los .=  '"'.$los_r_min.' to '.$los_r_max.'",'; 
		}
	
		$age_range 			= array("< 25","25 to 34","35 to 44","45 to 54","55 to 59","60 to 65","> 65");   
		$los_range 			= array("< 1","1 - 5","6 - 10","11 - 15","16 - 20","21 - 25","26 - 30","31 - 35","36 - 40","> 40");   
		$sex 					= array("Male", "Female");
		
		// print_r($count_per_group_code);
		
		foreach($count_per_org  as $row)
		{
			$row_data[$row->emp_subgroup][$row->sex] = $row->cnt; 
		}
		
		
		//group by age range
		foreach($count_per_age_range  as $row)
		{ 
			$row_data_age[$row->emp_subgroup][$row->agegroup] = $row->cnt; 
		}
		
		//age range
		
		// foreach($age_range  as $ranges)
		// {
			// foreach($subgroup as $sub)
			// {
				// if(!$row_data_age[$sub][$ranges])
				// {
					// $row_data_age[$sub][$ranges] = 0; 
				// }
				// $data_value_age .= $row_data_age[$sub][$ranges].", ".$sub;
				// echo 
				// "<br>";
				// "<br>";
				// "<br>";
			// }
		// }
		
		foreach($age_range  as $ranges)
		{
			if(!$row_data_age[$subgroup[0]][$ranges])
			{
				$row_data_age[$subgroup[0]][$ranges] = 0; 
			}
			if(!$row_data_age[$subgroup[1]][$ranges])
			{
				$row_data_age[$subgroup[1]][$ranges] = 0; 
			}
			if(!$row_data_age[$subgroup[2]][$ranges])
			{
				$row_data_age[$subgroup[2]][$ranges] = 0; 
			}
			if(!$row_data_age[$subgroup[3]][$ranges])
			{
				$row_data_age[$subgroup[3]][$ranges] = 0; 
			}
			
			$data_value_age_officers .= $row_data_age[$subgroup[0]][$ranges].",";
			$data_value_age_executives .= $row_data_age[$subgroup[1]][$ranges].",";
			$data_value_age_management .= $row_data_age[$subgroup[2]][$ranges].",";
			$data_value_age_rank .= $row_data_age[$subgroup[3]][$ranges].",";
			
			$age_range_label .= '"'.$ranges.'",'; 
		}
		
		
		// los range
		// echo "count = ". count($count_per_los_range);
		foreach($count_per_los_range  as $row)
		{ 
			$row_data_los[$row->emp_subgroup][$row->los_group] = $row->cnt;  
		}
		
		foreach($los_range  as $ranges)
		{
			if(!$row_data_los[$subgroup[0]][$ranges])
			{
				$row_data_los[$subgroup[0]][$ranges] = 0; 
			}
			if(!$row_data_los[$subgroup[1]][$ranges])
			{
				$row_data_los[$subgroup[1]][$ranges] = 0; 
			}
			if(!$row_data_los[$subgroup[2]][$ranges])
			{
				$row_data_los[$subgroup[2]][$ranges] = 0; 
			}
			if(!$row_data_los[$subgroup[3]][$ranges])
			{
				$row_data_los[$subgroup[3]][$ranges] = 0; 
			}
			
			$data_value_los_officers .= $row_data_los[$subgroup[0]][$ranges].",";
			$data_value_los_executives .= $row_data_los[$subgroup[1]][$ranges].",";
			$data_value_los_management .= $row_data_los[$subgroup[2]][$ranges].",";
			$data_value_los_rank .= $row_data_los[$subgroup[3]][$ranges].",";
			
			
			$los_range_label .= '"'.$ranges.'",'; 
		}
		
		// echo "asddddddddddddd = ".$data_value_los_officers;
		// echo "<br>";
		// echo "asddddddddddddd = ".$data_value_los_executives;
		// echo "<br>";
		// echo "asddddddddddddd = ".$data_value_los_management;
		// echo "<br>";
		// echo "asddddddddddddd = ".$data_value_los_rank;
		// echo "<br>";
		// echo count($count_per_age_range);
		// echo "<br>";
		// echo "<br>";
		// print_r($row_data_age);
		
		// echo $data_row['PLDT Officers']['Male'];
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
		
		//line graph data 
		//data: [31, 74, 6, 39, 20, 85, 7] 
		foreach($count_per_year_hired as $hired_year)
		{
			$hired_year->cnt." - ".$hired_year->year_hired;  
			$line1[$hired_year->year_hired] = $hired_year->cnt; 
		}
		
		//count separated emps per year
		foreach($count_per_year_separated as $separated_year)
		{
			$separated_year->cnt." - ".$separated_year->year_hired;  
			$line2[$separated_year->year_separated] = $separated_year->cnt;
		}
 
		for($year = 2007; $year <= 2016; $year++)
		{
			$labels .= $year.","; 
			if(!$line1[$year])
			{
				$line1[$year] = 0;
			}
			else
			{
				$line1[$year] = $line1[$year];
			}
			
			if(!$line2[$year])
			{
				$line2[$year] = 0;
			}
			else
			{
				$line2[$year] = $line2[$year];
			}
			
			$line_data1 .= $line1[$year].",";
			$line_data2 .= $line2[$year].",";
		}
		
		
		// per personnel Location
		foreach($count_per_loc as $pers_loc)
		{
			$location_data[$pers_loc->emp_subgroup][$pers_loc->personnel_area] = $pers_loc->cnt;
			// echo "<br>";
			// echo $pers_loc->personnel_area;
			// echo "<br>";
			// echo $pers_loc->emp_subgroup;
			// echo "<br>";
			// echo $pers_loc->cnt;
			// echo "<br>";
		}
		
		foreach($subgroup as $sub)
		{
			if(!$location_data[$sub]['Greater Metro Manila'])
			{
				$location_data[$sub]['Greater Metro Manila'] = 0;  
			}
			
			if(!$location_data[$sub]['Regional'])
			{
				$location_data[$sub]['Regional'] = 0;  
			}
			 
			$location_data_gmm .= $location_data[$sub]['Greater Metro Manila'].", ";
			$location_data_regional .= $location_data[$sub]['Regional'].","; 
		}
 
 
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
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// // print_r($count_per_loc);
		// echo "<br>";
		// echo "<br>";
		// echo "data here=".$group_labels;
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// print_r($count_per_age_range);
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "Pie chart data  hereeeeee =".$data_label;
		
		//for personnel area
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
		
		?>
		
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/chartjs/chart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/icheck/icheck.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		<script src="<?php echo base_url();?>assets/js/pace/pace.min.js"></script>

  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

    // Line chart
	/*
    var ctx = document.getElementById("lineChart");
    var lineChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [<?php echo rtrim($labels, ",");?>],
        // labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: "Hired",
          backgroundColor: "rgba(38, 185, 154, 0.31)",
          borderColor: "rgba(38, 185, 154, 0.7)",
          pointBorderColor: "rgba(38, 185, 154, 0.7)",
          pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointBorderWidth: 1,
          data: [<?php echo rtrim($line_data1, ",");?>] 
          // data: [31, 74, 6, 39, 20, 85, 7] 
        }, {
          label: "Separated",
          backgroundColor: "rgba(3, 88, 106, 0.3)",
          borderColor: "rgba(3, 88, 106, 0.70)",
          pointBorderColor: "rgba(3, 88, 106, 0.70)",
          pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(151,187,205,1)",
          pointBorderWidth: 1,
          data: [<?php echo rtrim($line_data2, ",");?>] 
          // data: [82, 23, 66, 9, 99, 4, 2]
        }]
      },
    });
	*/
	
	var ctx_loc = document.getElementById("byLocation");
    var mybarChartLocation = new Chart(ctx_loc, {
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

    // Bar chart
    var ctx = document.getElementById("mybarChart");
    var mybarChart = new Chart(ctx, {
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
	
	var ctx = document.getElementById("bar_by_age");
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
	var ctx = document.getElementById("bar_by_tenure");
    var bar_by_age = new Chart(ctx, {
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
	
		 // Bar chart per location
   
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

</body>

</html>
