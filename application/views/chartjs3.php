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
			
			//doughnut data
			$data_label .=  '"'.$sub.'",';
			$data_value_doughnut .= $subgroup_total.",";
			
			//bar graph data
			
			 $data_value_bar_male .= $row_data[$sub]['Male'].",";
			 $data_value_bar_female .= $row_data[$sub]['Female'].",";
			
		}
		
		//' get count per group
		foreach($count_per_group_code as $sequence_no=>$group_org)
		{
			$group_name = $group_org->group_txt;
			$group_name = str_replace("'","",$group_name); 
			if($group_name=="")
			{
				$group_name = "President & CEO";
			} 
			$group_labels[$sequence_no] = $group_name;
			$group_cnt[$sequence_no] = $group_org->cnt; 
		}
 
// echo "<br> sequence = ". count($group_labels);
// // ecount
// print_r($group_labels);
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
		  
		  
		foreach($count_per_termiation_reason as $ter_index =>$termination)
		{
			$termination_label[$ter_index] = $termination->termination_reason;
			$termination_cnt[$ter_index] = $termination->cnt;
			
			$termination_labels .= '"'.trim($termination->termination_reason).'",';
			$termination_cnts .= $termination->cnt.",";
			// echo "<br>";
		}
		
		foreach($average_per_subgroup as $data_average_subgroup)
		{
			 
			$ave_subgroup_average[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average;
			$ave_subgroup_count[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->count;
			$total_active_emp += $ave_subgroup_count[$data_average_subgroup->emp_subgroup]; 
$total_average += $data_average_subgroup->sum_age;

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
          
		  
		   <!-- top tiles -->
        <div class="row tile_count">
	 
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Employees</span>
              <div class="count blue"><?php echo number_format($total_active_emp);?></div>
              <span class="count_bottom red"> As of 05/20/2016 </span>| Total Average :<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b> </span>
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
        </div>
        <!-- /top tiles -->
		  
		  <div class="clearfix"></div> 
          <div class="row"> 
            <div class="col-md-6 col-sm-6 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Group</h2>
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
                  <canvas id="group_org_data"></canvas>
				  <div class="row"> 
					<?php 
					$count = 0;
					for($i=1;$i<=count($group_labels);$i+=6)
					{
						for($group_count=0;$group_count<6;$group_count++)
						{ 
							// echo "erikson ".$i." ".$group_count ." ".$count;
							// echo "<br>";
							if($group_labels[$count])
							{
							?>
							
							<div class="col-md-6 col-sm-6 col-xs-12">  
								<div class="" style="background:none;height:15px; bottom:10px;"> <div class="pull-left" style="background:<?php echo $colors[$count];?>;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp <?php echo $group_labels[$count]." - " .$group_cnt[$count];?></div> </div>     
							</div>
									
							<?php
							}
							$count++;
						}
						
					}
						
					?>
			 
				  </div>
				  
                </div>
              </div> 
            </div>
			
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution By Employee Class and Gender</h2>
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
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;"> <div class="pull-left" style="background:#DD080B;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#455C73;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#E87011;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE </div> </div>    
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
                  <canvas id="mybarChart"></canvas>    
				    <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#ED730D;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MALE</div> </div>
                <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#005A6C;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp FEMALE</div> </div></div>
              </div> 
            </div>
          </div>
		  
          
		  
		  <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
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
                  <canvas id="canvasAgeRange"></canvas>
				 <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#9b59b6;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#ffc221;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#fb2300;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26b99a;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE</div>
                </div>
              </div>
            </div>
			</div>
			
			<div class="col-md-6 col-sm-12 col-xs-12">
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
                  <canvas id="canvasTenure"></canvas>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#36CF20;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#455C73;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FD4023;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE </div> </div>  
                </div>
              </div>
            </div>
		  </div>
		  <!--
		  <div class="clearfix"></div>
          <div class="row">
       
			
			<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution by Tenure</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
							<a href="#">Settings 1</a>
                        </li>
                        <li>
							<a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li>
					<a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="canvasTenure"></canvas>
                </div>
              </div>
            </div>
		  </div>
		  -->
		  <div class="clearfix"></div>
          <div class="row">
       
			
			<div class="col-md-6 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>FTEs Distribution by Location</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li>
							<a href="#">Settings 1</a>
                        </li>
                        <li>
							<a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li>
					<a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="canvasPersonnelArea"></canvas>
                <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#1BD035;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp GREATER METRO MANILA</div> </div>    
                 <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#490B8D;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp REGIONAL</div> </div>    
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
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26b99a;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp HIRED</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#fdbb1a;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp SEPARATED</div> </div>
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
                  <h2>Radar  </h2>
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
          </div>
		  -->
		  <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
			  <div class="x_panel">
                <div class="x_title">
                  <h2>Distribution By Termination Reason</h2>
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
				  <div class="row"> 
					<?php 
					$count = 0;
					for($i=1;$i<=count($termination_label);$i+=6)
					{
						for($termination_count=0;$termination_count<6;$termination_count++)
						{ 
							if($termination_label[$count])
							{
							?>
							
							<div class="col-md-6 col-sm-6 col-xs-12">  
								<div class="" style="background:none;height:15px; bottom:10px;"> <div class="pull-left" style="background:<?php echo $colors[$count];?>;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp <?php echo $termination_label[$count]." - " .$termination_cnt[$count];?></div> </div>     
							</div>
									
							<?php
							}
							$count++;
						}
						
					}
						
					?>
			 
				  </div>
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
 