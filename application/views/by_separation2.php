 
	<?php 
 
		// print_r($data_per_sep_reason_per_year);
		
		foreach($get_separation_type as $sep_type)
		{  
			  trim($sep_type->termination_reason);
			  $data_per_sep_reason_per_year[trim($sep_type->termination_reason)];
			// echo $separation_type .= '"'.$sep_type->termination_reason.'",';
			 // echo "<br>";
				  // echo "<br>";
		}
	 
				  
				  
				  
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
		  
		  
		  
 
 
			  ?>
		
   
   
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
             
            </div>
            </div>
			
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
 
		  <div class="clearfix"></div>
          <div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Separated Employees</h2>
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
                  <canvas id="dist_per_sep_type_per_year" ></canvas>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp Hired</div> </div>    
                 <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#03586A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp Separated  </div> </div>    
                </div>
              </div>
            </div>
		  </div>
        </div>

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
 
	<!-- footer for viewing charts here -->
	
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment/moment.min.js"></script>
		<!--<script src="<?php echo base_url();?>assets/js/chartjs/chart.min.js"></script>-->
		<script src="<?php echo base_url();?>assets/js/chartjs/Chart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/icheck/icheck.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/custom.js"></script>
		<script src="<?php echo base_url();?>assets/js/pace/pace.min.js"></script>
		
		
		<script>
			// Chart.defaults.global.legend = {
			  // enabled: true
			// };

			// Line chart
			var ctx = document.getElementById("dist_per_sep_type_per_year").getContext("2d");;
			var lineChart = new Chart(ctx, {
			  type: 'line',
			  
			  
			  data: {
				  labels: ["MRP"],
				labels: [
				<?php 
					for($year=2007;$year<=2016;$year++)
					{
						$year_label .= '"'.$year.'",';
					}
					echo $year_label;
				?>
				],
				datasets: [ 
				<?php
					
				  // echo trim($sep_type->termination_reason);
				  // echo $data_per_sep_reason_per_year[trim($sep_type->termination_reason)];
				  // $backgroundColor = array('gba(255, 102, 0,.31)','rgba(51, 153, 255,.6)','rgba(0, 153, 153,.6)','rgba(0, 153, 0,.6)','rgba(255, 0, 0,.8)','rgba(255, 51, 0,.9)','rgba(255, 255, 0,.7)');
				  $backgroundColor = array(
					 "rgba(38, 185, 154, 0.31)",
					 "rgba(3, 88, 106, 0.3)",
					 "rgba(254, 34, 1, 0.3)",
					 "rgba(232, 111, 18, 0.3)",
					 "rgba(44, 116, 222, 0.3)",
					 "rgba(43, 212, 21, 0.3)",
					 "rgba(98, 5, 120, 0.3)",
					 "rgba(7, 240, 217, 0.31)",
					 "rgba(0, 51, 0, 0.3)",
					 "rgba(102, 0, 51, 0.3)",
					 "rgba(60, 31, 119, 0.3)",
					 "rgba(44, 116, 222, 0.3)",
					 "rgba(43, 212, 21, 0.3)");
				 foreach($get_separation_type as $count=>$sep_type)
				  {
					  // backgroundColor: "rgba(38, 135, 154, 0.31)",
					    // pointBorderColor: "rgba(255, 185, 154, 0.7)",
					  // borderColor: "rgba(255, 102, 0, 0.50)",
					   
					  echo '{
					  label: "'.trim($sep_type->termination_reason).'", 
					  backgroundColor: "'.$backgroundColor[$count].'",
					  borderColor: "'.$color[$count].'",
					  pointBorderColor: "rgba(255, 185, 154, 0.7)",
					  pointBackgroundColor: "'.$color[$count].'", 
					  pointHoverBorderColor: "rgba(220,220,220,1)",
					  pointBorderWidth: 1,
					  data: ['.$data_per_sep_reason_per_year[trim($sep_type->termination_reason)].']  
					}, ';  
	 
				  }
			  ?>
			 
				]
			  },
			  options: {
                    tooltips: {
                        mode: 'label'
                    },
                    responsive: true
                 
                }
			});
		
		</script>
	
	<!-- footer for viewing charts here -->
	

 