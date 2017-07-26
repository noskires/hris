	<?php 
		$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex 					= array("Male", "Female");
		$pers_area 			= array("Greater Metro Manila", "Regional");
		$age_range 			= array("20 to 24","25 to 29","30 to 34","35 to 39","40 to 44","45 to 49","50 to 54","55 to 59","> 60");  
		$los_range 			= array("< 1","1 - 4","5 - 9","10 - 14","15 - 19","20 - 24","25 - 29","30 - 34","35 - 39","> 40");  
		
 
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
		
		
		//get all group names
		foreach($count_per_group_code as $sequence_no=>$group_org)
		{
			$group_name = $group_org->group_txt;
			$group_name = str_replace("'","",$group_name); 
			if($group_name=="")
			{
				$group_name = "President & CEO";
			}
			
			$org_group_names .= "'".$group_name."',";
		}
		// $org_group_names;
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
            <div class="col-md-12 col-sm-12 col-xs-12">  
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
					<canvas id="byClassification"></canvas>    
                </div>
              </div> 
            </div>
            </div>
			
			
		  <div class="clearfix"></div> 
          <div class="row"> 
            <div class="col-md-12 col-sm-12 col-xs-12">  
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
                        <th align="center"> Group Name</th>
						<th align="center">  Officers </th>
						<th align="center">  Executives </th>
						<th align="center">  Management </th>
						<th align="center">  Rank & File </th>
						<th align="center">  Total </th>
                      </tr>
                    </thead>
                    <tbody> 
						<?php 
							//' get count per group
							foreach($count_per_group_code as $sequence_no=>$group_org)
							{
								$group_name = $group_org->group_txt;
								$group_name = str_replace("'","",$group_name); 
								if($group_name=="")
								{
									$group_name = "President & CEO";
								}  
								
								foreach($subgroup as $subgroup_data)
								{
									if(isset($emp_count_per_org_group_subgroup[$group_org->group_code][$subgroup_data]))
									{
										$emp_count_subgroup[$subgroup_data] = $emp_count_per_org_group_subgroup[$group_org->group_code][$subgroup_data];
									}
									else
									{
										$emp_count_subgroup[$subgroup_data] = 0;
									}
									$total_per_orggroup_per_subgroup[$subgroup_data] += $emp_count_subgroup[$subgroup_data];
									//for charts
									$total_per_orggroup_per_subgroup_chart[$subgroup_data] .= $emp_count_subgroup[$subgroup_data].",";
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $group_name;?></th>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[0]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[1]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[2]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[3]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[0]] + $emp_count_subgroup[$subgroup[1]] + $emp_count_subgroup[$subgroup[2]] + $emp_count_subgroup[$subgroup[3]];?></td>
								 
							</tr>
							<?php 
								//for graphs
							
							}
						?>
						<tr> 
							<th align="center" scope="row"> Grand Total </th>
							<td align="right"> <?php echo $total_per_orggroup_per_subgroup[$subgroup[0]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_subgroup[$subgroup[1]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_subgroup[$subgroup[2]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_subgroup[$subgroup[3]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_subgroup[$subgroup[0]] + $total_per_orggroup_per_subgroup[$subgroup[1]] + $total_per_orggroup_per_subgroup[$subgroup[2]] + $total_per_orggroup_per_subgroup[$subgroup[3]];?></td>
						</tr>
					</tbody>
					</table>
                  
				  
                </div>
              </div> 
            </div>
            </div>
			
			
		  <div class="clearfix"></div> 
          <div class="row"> 
			 
			<div class="col-md-4 col-sm-4 col-xs-12">
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
                        <th>Employee Subgroup</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per group
							foreach($count_per_group_code as $sequence_no=>$group_org)
							{
								$group_name = $group_org->group_txt;
								$group_name = str_replace("'","",$group_name); 
								if($group_name=="")
								{
									$group_name = "President & CEO";
								}  
								
								// foreach($subgroup as $subgroup_data)
								foreach($sex as $sex_data)
								{
									if(isset($emp_count_per_org_group_sex[$group_org->group_code][$sex_data]))
									{
										$emp_count_sex[$sex_data] = $emp_count_per_org_group_sex[$group_org->group_code][$sex_data];
									}
									else
									{
										$emp_count_sex[$sex_data] = 0;
									} 
									$total_per_orggroup_per_sex[$sex_data] += $emp_count_sex[$sex_data];
									$total_per_orggroup_per_sex_chart[$sex_data] .= $emp_count_sex[$sex_data].",";
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $group_name;?></th>
								<td align="right"> <?php echo $emp_count_sex[$sex[0]];?></td>
								<td align="right"> <?php echo $emp_count_sex[$sex[1]];?></td> 
								<td align="right"> <?php echo $emp_count_sex[$sex[0]] + $emp_count_sex[$sex[1]];?></td>
								 
							</tr>
							<?php 
							} 
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<td align="right"> <?php echo $total_per_orggroup_per_sex[$sex[0]];?></td>
							<td align="right"> <?php echo $total_per_orggroup_per_sex[$sex[1]];?></td> 
							<td align="right"> <?php echo $total_per_orggroup_per_sex[$sex[0]] + $total_per_orggroup_per_sex[$sex[1]];?></td> 
						</tr> 
                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
			
			<div class="col-md-8 col-sm-12 col-xs-12">
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
			  
			<div class="col-md-4 col-sm-6 col-xs-12">
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
							foreach($count_per_group_code as $sequence_no=>$group_org)
							{
								$group_name = $group_org->group_txt;
								$group_name = str_replace("'","",$group_name); 
								if($group_name=="")
								{
									$group_name = "President & CEO";
								}  
								
								// foreach($subgroup as $subgroup_data)
								// foreach($sex as $sex_data)
								foreach($pers_area as $pers_area_data)
								{ 
									if(isset($emp_count_per_org_group_pers_area[$group_org->group_code][$pers_area_data]))
									{
										$emp_count_pers_area[$pers_area_data] = $emp_count_per_org_group_pers_area[$group_org->group_code][$pers_area_data]; 
									}
									else
									{
										$emp_count_pers_area[$pers_area_data] = 0;
									}
									$total_per_orggroup_per_pers_area[$pers_area_data] += $emp_count_pers_area[$pers_area_data];
									$total_per_orggroup_per_pers_area_chart[$pers_area_data] .= $emp_count_pers_area[$pers_area_data].",";
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $group_name;?></th>
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
			
			<div class="col-md-8 col-sm-12 col-xs-12">
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
                        <th>Group Name</th>
						
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
							//' get count per group
							foreach($count_per_group_code as $sequence_no=>$group_org)
							{
								$group_name = $group_org->group_txt;
								$group_name = str_replace("'","",$group_name); 
								if($group_name=="")
								{
									$group_name = "President & CEO";
								}  
								
								// foreach($subgroup as $subgroup_data)
								// foreach($sex as $sex_data)
								foreach($age_range as $age_range_data)
								{  
									if(isset($emp_count_per_org_group_agegroup[$group_org->group_code][$age_range_data]))
									{
										$emp_count_pers_agegroup[$age_range_data] = $emp_count_per_org_group_agegroup[$group_org->group_code][$age_range_data]; 
									}
									else
									{
										$emp_count_pers_agegroup[$age_range_data] = 0;
									} 
									$total_per_orggroup_per_pers_age[$age_range_data] += $emp_count_pers_agegroup[$age_range_data];
									$total_per_orggroup_per_pers_age_chart[$age_range_data] .= $emp_count_pers_agegroup[$age_range_data].",";
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $group_name;?></th>
								<?php 
								$total_per_age_range = 0;
								for($i = 0;$i<=8;$i++)
								{
									?>
									<td align="right"> <?php echo $emp_count_pers_agegroup[$age_range[$i]];?></td>
									<?php
									$total_per_age_range += $emp_count_pers_agegroup[$age_range[$i]];
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
								for($i = 0;$i<=8;$i++)
								{
									?>
									<td align="right"> <?php echo $total_per_orggroup_per_pers_age[$age_range[$i]];?></td>
									<?php 
									$overall_total_per_age_range += $total_per_orggroup_per_pers_age[$age_range[$i]]; 
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
					 <canvas id="byTenure"></canvas>  
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
                        <th>Group Name</th>
						
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
							//' get count per group
							foreach($count_per_group_code as $sequence_no=>$group_org)
							{
								$group_name = $group_org->group_txt;
								$group_name = str_replace("'","",$group_name); 
								if($group_name=="")
								{
									$group_name = "President & CEO";
								}  
								
							 
								foreach($los_range as $los_range_data)
								{   
									if(isset($emp_count_per_org_group_losgroup[$group_org->group_code][$los_range_data]))
									{
										$emp_count_pers_losgroup[$los_range_data] = $emp_count_per_org_group_losgroup[$group_org->group_code][$los_range_data]; 
									}
									else
									{
										$emp_count_pers_losgroup[$los_range_data] = 0;
									} 
									$total_per_orggroup_per_pers_los[$los_range_data] += $emp_count_pers_losgroup[$los_range_data];
									$total_per_orggroup_per_pers_los_chart[$los_range_data] .= $emp_count_pers_losgroup[$los_range_data].",";
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $group_name;?></th>
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
		  type: 'bar',
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
			mode: "label"},
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
 