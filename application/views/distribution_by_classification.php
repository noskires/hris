	<?php 
		$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex 					= array("Male", "Female");
		$pers_area 			= array("Greater Metro Manila", "Regional");
		$age_range 			= array("< 25","25 to 34","35 to 44","45 to 54","55 to 59","60 to 65","> 65");  
		$los_range 			= array("< 1","1 - 5","6 - 10","11 - 15","16 - 20","21 - 25","26 - 30","31 - 35","36 - 40","> 40");   
		
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
		
		//tabular here
		//by classification 
		
		foreach($count_per_subgroup as $per_subgroup)
		{
			$emp_count_per_subgroup[$per_subgroup->emp_subgroup] = $per_subgroup->count; 
		}  
		
		foreach($count_per_subgroup_sex as $subgroup_sex)
		{
			$emp_count_per_subgroup_sex[$subgroup_sex->emp_subgroup][$subgroup_sex->sex] = $subgroup_sex->count; 
		} 
		
		foreach($count_per_subgroup_pers_area as $subgroup_pers_area)
		{
			$emp_count_per_subgroup_pers_area[$subgroup_pers_area->emp_subgroup][$subgroup_pers_area->personnel_area] = $subgroup_pers_area->count; 
		} 
		
		foreach($count_per_subgroup_agegroup as $subgroup_agegroup)
		{
			$emp_count_per_org_group_agegroup[$subgroup_agegroup->emp_subgroup][$subgroup_agegroup->agegroup] = $subgroup_agegroup->count; 
		}
	 
		foreach($count_per_subgroup_los as $subgroup_losgroup)
		{
			$emp_count_per_subgroup_losgroup[$subgroup_losgroup->emp_subgroup][$subgroup_losgroup->los_group] = $subgroup_losgroup->count; 
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
          
		  


		  <div class="clearfix"></div> 
          <div class="row"> 
           <!-- <div class="col-md-4 col-sm-12 col-xs-12">  
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
					<table class="table table-striped table-bordered">
					<thead>
                      <tr>
						<th align="center">  Employee Classification </th> 
                        <th align="center"> Total</th>
                      </tr>
                    </thead>
                    <tbody> 
						<?php 
							//' get count per group
							 
								
								foreach($subgroup as $subgroup_data)
								{
									if(isset($emp_count_per_subgroup[$subgroup_data]))
									{
										$emp_count_subgroup[$subgroup_data] = $emp_count_per_subgroup[$subgroup_data];
									}
									else
									{
										$emp_count_subgroup[$subgroup_data] = 0;
									}
									$total_per_subgroup += $emp_count_subgroup[$subgroup_data];
							
							?>
							<tr> 
								<th scope="row"> <?php echo $subgroup_data;?></th>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup_data];?></td> 
								 
							</tr>
							<?php 
						 	}
						?>
						<tr> 
							<th align="center" scope="row"> Grand Total </th>
							<td align="right"> <?php echo $total_per_subgroup;?></td> </tr>
					</tbody>
					</table>
                  
				  
                </div>
				
				
              </div> 
            </div> -->
			
			<div class="col-md-6 col-sm-12 col-xs-12">
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
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <td><b>Employee Subgroup</b></td>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per subgroup 
							foreach($subgroup as $subgroup_data)
							{
								// foreach($subgroup as $subgroup_data)
								foreach($sex as $sex_data)
								{
									if(isset($emp_count_per_subgroup_sex[$subgroup_data][$sex_data]))
									{
										$emp_count_sex[$sex_data] = $emp_count_per_subgroup_sex[$subgroup_data][$sex_data];
									}
									else
									{
										$emp_count_sex[$sex_data] = 0;
									} 
									$total_per_subgroup_per_sex[$sex_data] += $emp_count_sex[$sex_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $subgroup_data;?></th>
								<td align="right"> <?php echo $emp_count_sex[$sex[0]];?></td>
								<td align="right"> <?php echo $emp_count_sex[$sex[1]];?></td> 
								<td align="right"> <?php echo $emp_count_sex[$sex[0]] + $emp_count_sex[$sex[1]];?></td>
								 
							</tr>
							<?php 
							} 
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<td align="right"> <?php echo $total_per_subgroup_per_sex[$sex[0]];?></td>
							<td align="right"> <?php echo $total_per_subgroup_per_sex[$sex[1]];?></td> 
							<td align="right"> <?php echo $total_per_subgroup_per_sex[$sex[0]] + $total_per_subgroup_per_sex[$sex[1]];?></td> 
						</tr> 
                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
			
			<div class="col-md-6 col-sm-12 col-xs-12">
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
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Employee Subgroup</th>
                        <th>GMM</th>
                        <th>Regional</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per group
						  
							foreach($subgroup as $subgroup_data)
							{
								foreach($pers_area as $pers_area_data)
								{ 
									if(isset($emp_count_per_subgroup_pers_area[$subgroup_data][$pers_area_data]))
									{
										$emp_count_pers_area[$pers_area_data] = $emp_count_per_subgroup_pers_area[$subgroup_data][$pers_area_data]; 
									}
									else
									{
										$emp_count_pers_area[$pers_area_data] = 0;
									}
									$total_per_orggroup_per_pers_area[$pers_area_data] += $emp_count_pers_area[$pers_area_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $subgroup_data;?></th>
								<td align="right"> <?php echo $emp_count_pers_area[$pers_area[0]];?></td>
								<td align="right"> <?php echo $emp_count_pers_area[$pers_area[1]];?></td> 
								<td align="right"> <?php echo $emp_count_pers_area[$pers_area[0]] + $emp_count_pers_area[$pers_area[1]];?></td>
								 
							</tr>
							<?php 
							} 
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<td align="right"> <?php echo $total_per_orggroup_per_pers_area[$pers_area[0]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_pers_area[$pers_area[1]];?></td> 
							<td align="right"> <?php echo $total_per_orggroup_per_pers_area[$pers_area[0]] + $total_per_orggroup_per_pers_area[$pers_area[1]];?></td> 
						</tr> 
                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
            </div>
			
			
		  <div class="clearfix"></div> 
          <div class="row">  
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
					 <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Employee Subgroup</th>
						
						<?php 
						foreach($age_range as $age_range_data)
						{
							echo "<th>";
							echo $age_range_data;
							echo "</th>";
						} 
						?> 
						<th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per subgroup
							foreach($subgroup as $subgroup_data)
							{ 
								foreach($age_range as $age_range_data)
								{  
									if(isset($emp_count_per_org_group_agegroup[$subgroup_data][$age_range_data]))
									{
										$emp_count_pers_agegroup[$age_range_data] = $emp_count_per_org_group_agegroup[$subgroup_data][$age_range_data]; 
									}
									else
									{
										$emp_count_pers_agegroup[$age_range_data] = 0;
									} 
									$total_per_orggroup_per_pers_age[$age_range_data] += $emp_count_pers_agegroup[$age_range_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $subgroup_data;?></th>
								<?php 
								$total_per_age_range = 0;
								foreach($age_range as $age_range_data)
						{
									?>
									<td align="right"> <?php echo $emp_count_pers_agegroup[$age_range_data];?></td>
									<?php
									$total_per_age_range += $emp_count_pers_agegroup[$age_range_data];
								}
								
								?>
								<td align="right"> <?php echo $total_per_age_range;?></td>
							</tr>
							<?php  
							}
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<?php 
								foreach($age_range as $age_range_data)
						{
									?>
									<td align="right"> <?php echo $total_per_orggroup_per_pers_age[$age_range_data];?></td>
									<?php 
									$overall_total_per_age_range += $total_per_orggroup_per_pers_age[$age_range_data]; 
								}
							?> 
							<td align="right"> <?php echo $overall_total_per_age_range;?></td> 
						</tr> 
                    </tbody>
                  </table>
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
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Employee Subgroup</th>
						
						<?php 
						foreach($los_range as $los_range_data)
						{
							echo "<th>";
							echo $los_range_data;
							echo "</th>";
						} 
						?> 
						<th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per subgroup
							foreach($subgroup as $subgroup_data)
							{ 
							 
								foreach($los_range as $los_range_data)
								{   
									if(isset($emp_count_per_subgroup_losgroup[$subgroup_data][$los_range_data]))
									{
										$emp_count_pers_losgroup[$los_range_data] = $emp_count_per_subgroup_losgroup[$subgroup_data][$los_range_data]; 
									}
									else
									{
										$emp_count_pers_losgroup[$los_range_data] = 0;
									} 
									$total_per_orggroup_per_pers_los[$los_range_data] += $emp_count_pers_losgroup[$los_range_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $subgroup_data;?></th>
								<?php 
								$total_per_los_range = 0;
								for($i = 0;$i<=9;$i++)
								{
									?>
									<td align="right"> <?php echo $emp_count_pers_losgroup[$los_range[$i]];?></td>
									<?php
									$total_per_los_range += $emp_count_pers_losgroup[$los_range[$i]];
								}
								
								?>
								<td align="right"> <?php echo $total_per_los_range;?></td>
							</tr>
							<?php  
							}
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<?php 
								for($i = 0;$i<=9;$i++)
								{
									?>
									<td align="right"> <?php echo $total_per_orggroup_per_pers_los[$los_range[$i]];?></td>
									<?php 
									$overall_total_per_los_range += $total_per_orggroup_per_pers_los[$los_range[$i]]; 
								}
							?> 
							<td align="right"> <?php echo $overall_total_per_los_range;?></td> 
						</tr> 
                    </tbody>
                  </table>
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
 