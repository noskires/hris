<!DOCTYPE HTML>
<html>
    <head>
        <title>PLDT Charts</title>
		<style type="text/css">
			body
			{
				background:#ddd;
			}
		</style>
		<?php 
				$subgroup = array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
				$sex = array("Male", "Female");
				
				foreach($count_per_org  as $row)
				{ 
					$row_data[$row->emp_subgroup][$row->sex] = $row->cnt; 
				}
 
				
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
					
					$subgroup_total = $row_data[$sub]['Male'] + $row_data[$sub]['Female'];
					$data 			.= "['".$sub."',".$row_data[$sub]['Male'].",".$row_data[$sub]['Female']."],";
					$pie_data 	.= "['".$sub."',".$subgroup_total."],";
					
				}
				
				$data = rtrim($data, ","); 
				// echo "<br>";
				$pie_data = rtrim($pie_data, ","); 
				
				 // dataTable1.addRows([['Q1',308], ['Q2',257],['Q3',375]]);
				// echo $row_data['PLDT Management']['Male']
				// dataTable.addRows([
					// ['d',50,0],
					// ['Qasdf2',257,300],
					// ['Qasdf3',375,350],
					// ['Q4', 123,100]
				// ]);
				?>  
        <!-- load Google AJAX API -->
		    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> 
        <script type="text/javascript" src="http://www.google.com/jsapi"></script> 
        <script type="text/javascript">
            //load the Google Visualization API and the chart
            google.load('visualization', '1', {'packages':['columnchart','piechart']});
			// google.load("visualization", "1", {packages:["corechart"]});
 
            //set callback
            google.setOnLoadCallback (createChart);
 
            //callback function
            function createChart() {
 
                //create data table object
                var dataTable1 = new google.visualization.DataTable();
 
                //define columns
                dataTable1.addColumn('string','Quarters 2009');
                dataTable1.addColumn('number', 'Earnings');
 
                //define rows of data
                dataTable1.addRows([
					<?php echo $pie_data;?>
					// ['Q1',308], ['Q2',257],['Q3',1]
				]);
				// var view = new google.visualization.DataView(dataTable1);
				// view.setColumns([0, 1]);
                //instantiate our chart objects
                var chart = new google.visualization.ColumnChart (document.getElementById('chart'));
                var secondChart = new google.visualization.PieChart (document.getElementById('Chart2'));
 
				//create data table object
				var dataTable = new google.visualization.DataTable();
 
				//define columns
				dataTable.addColumn('string','Quarters');
				dataTable.addColumn('number', 'Male');
				dataTable.addColumn('number', 'Female'); 
				//define rows of data
				<?php 
				// foreach($count_per_org  as $row)
				// { 
					// echo $row->cnt." ".$row->sex." ".$row->emp_subgroup;
					// echo "<br>"; 
				// }
				?>  
				// dataTable.addRows([
					// ['d',50,0,500, 10],
					// ['Qasdf2',257,300,420, 100],
					// ['Qasdf3',375,350,235, 30],
					// ['Q4', 123,100,387, 40],
					// ['Q5', 123,100,387, 50]
				// ]);
				
				dataTable.addRows([
					<?php echo $data;?>
					// ['d',50,0],
					// ['Qasdf2',257,300],
					// ['Qasdf3',375,350],
					// ['Q4', 123,100]
				]);
                //define options for visualization
				
                var options = {height: 240, is3D: true, title: 'Employee Classifications'}; 
				// var options = {
				// legend:'none',
				// width: '100%',
				// height: '100',
				// pieSliceText: 'percentage', 
				// chartArea: { 
				// }
				// };
                //draw our chart
                chart.draw(dataTable, options);
                secondChart.draw(dataTable1, options); 
            }

			$(window).resize(function(){
				createChart(); 
			});
		</script> 
<script>
$().ready(function(){
	// drill1
	
	$('#first_drill').change(function(){
		var val = $(this).val();   
		var val2 = $('#second_drill1').val(); 
		alert(val); 
	 
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
		alert(val); 
	 
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
		alert(val); 
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
		alert(val);
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
		alert(val);
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
		alert(val2); 
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
		alert(val2); 
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
		alert(val2); 
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
		alert(val2); 
		var uri = "";
		if(val2 != "")
		{
			uri += "../../../../drill2/"+val+"/"+val2;
		}
		else
		{
			uri += "../../../drill1/"+val;
		} 
		$(location).attr("href", uri);
	});
	
	$('#third_drill2').change(function(){
		var val = $('#first_drill2').val();
		var val2 = $('#second_drill2').val(); 
		var val3 = $(this).val(); 
		alert(val3); 
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
		alert(val3); 
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
		alert(val3); 
		var uri = "";
		if(val3 != "")
		{
			uri += "../../../../drill3/"+val+"/"+val2+"/"+val3;
		}
		else
		{
			uri += "../../../drill2/"+val+"/"+val2;
		} 
		$(location).attr("href", uri);
	});
	
	 
	
	$('#fourth_drill3').change(function(){
		var val = $('#first_drill3').val();
		var val2 = $('#second_drill3').val(); 
		var val3 = $('#third_drill3').val(); 
		var val4 = $(this).val(); 
		alert(val4); 
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
		alert(val4); 
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