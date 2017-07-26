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
		
		?> 
      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
		  <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <h3>
                   Organization
              
						<select class="form-control group" id = "first_drill1" onChange="first_drill1();">
							<option value="">  All </option>
							<?php 
								foreach($count_per_group as $row)
								{
									if($param1 == $row->first_level)
									{
										$selected = "selected";
										?> 
										<option selected value="<?php echo $row->first_level;?>">  <?php if($row->first_level==99999999){echo "President & CEO";}else{echo $row->first_level_txt;} ?> </option> 
										<?php
									}
									else
									{
										?>
										<option value="<?php echo $row->first_level;?>"> <?php if($row->first_level==99999999){echo "President & CEO";}else{echo $row->first_level_txt;} ?> </option>
									 <?php
									}
								}
							?>  
							</select>
 
						<?php  
						if($drill1!=0)
						{
							?>
							<select class="form-control group" id = "second_drill1" onChange="second_drill1();" style="margin-top:2px;">
							<option value="">  All </option> 
							<?php 
								foreach($drill1 as $row)
								{
									if($param2 == $row->second_level)
									{
										$selected = "selected=selected";
										?> 
										<option selected value="<?php echo $row->second_level;?>">  <?php echo $row->second_level_txt; ?> </option> 
										<?php
									}
									else
									{
									?>
										<option value="<?php echo $row->second_level;?>">  <?php echo $row->second_level_txt; ?> </option> 
									 <?php
									}
								} 
							?>  
							</select>
							<?php 
						}
						?> 
	 
                </h3>
            </div>
            </div>

         
          </div>
          <div class="clearfix"></div>

          <div class="row"> 
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
                  <canvas id="mybarChart"></canvas>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#E86F12;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MALE </div> </div> 
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#03586A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp FEMALE </div> </div>    
				</div>
              </div> 
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Employee Count<small></small></h2>
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

                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Employee Subgroup</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Officers</th>
                        <td align="right"><?php echo $row_data['PLDT Officers']['Male'];?></td>
                        <td align="right"><?php echo $row_data['PLDT Officers']['Female'];?></td> 
                        <td align="right"><?php echo $row_data['PLDT Officers']['Female'] + $row_data['PLDT Officers']['Male'];?></td>  
                      </tr>
                      <tr>
                        <th scope="row"> Executives</th>
                        <td align="right"><?php echo $row_data['PLDT Executives']['Male'];?></td>
                        <td align="right"><?php echo $row_data['PLDT Executives']['Female'];?></td> 
                        <td align="right"><?php echo $row_data['PLDT Executives']['Female'] + $row_data['PLDT Executives']['Male'];?></td>  
                      </tr>
                      <tr>
                        <th scope="row"> Management</th>
                       <td align="right"><?php echo $row_data['PLDT Management']['Male'];?></td>
                        <td align="right"><?php echo $row_data['PLDT Management']['Female'];?></td> 
                        <td align="right"><?php echo $row_data['PLDT Management']['Female'] + $row_data['PLDT Management']['Male'];?></td>  
                      </tr>
					  <tr>
                        <th scope="row"> Rank & File</th>
                        <td align="right"><?php echo $row_data['PLDT Rank & File']['Male'];?></td>
                        <td align="right"><?php echo $row_data['PLDT Rank & File']['Female'];?></td> 
                        <td align="right"><?php echo $row_data['PLDT Rank & File']['Female'] + $row_data['PLDT Rank & File']['Male'];?></td>  
                      </tr>
					  
					  <tr>
                        <th scope="row"> Grand Total</th>
                        <td align="right">
							<?php  
								$sum_male = "";
								foreach($subgroup as $sub)
								{
									$sum_male = $row_data[$sub]['Male'] + $sum_male;
								}
								
								echo $sum_male;
							?>
						</td>
                        <td align="right">
							<?php
								$sum_female = "";
								foreach($subgroup as $sub)
								{
									$sum_female = $row_data[$sub]['Female'] + $sum_female;
								}
								
								echo $sum_female;
							?>
						</td> 
                        <td align="right"><?php echo $sum_male + $sum_female;?></td>  
                      </tr>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>
          </div>
		  
		   <div class="clearfix"></div>
		  <div class="row"> 
			<div class="col-md-6 col-sm-6 col-xs-12"> 
			  <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Classification</h2>
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
				  <!--
				  "#9B59B6",
				  "#455C73",
				  "#BDC3C7",
				  "#26B99A",
				  "#3498DB" -->
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;"> <div class="pull-left" style="background:#9B59B6;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FFC221;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FB2300;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE </div> </div>    
                </div>
              </div>
			  
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Location</h2>
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
                  <canvas id="byLocation"></canvas>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp GREATER METRO MANILA</div> </div> 
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FB2300;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp REGIONALS</div> </div>    
				</div>
              </div> 
            </div>

            
          </div>
		  
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12"> 
			  <div class="x_panel">
                <div class="x_title">
                  <h2> FTEs Distribution By Classification </h2>
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
                  <canvas id="canvasDoughnut"></canvas>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Hired vs Separated</h2>
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
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
          </div>
		  <!--
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Radar <small>Sessions</small></h2>
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
                  <canvas id="canvasRadar"></canvas>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Pie Area Graph <small>Sessions</small></h2>
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
                  <canvas id="polarArea"></canvas>
                </div>
              </div>
            </div>

          </div> -->
 
		  
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