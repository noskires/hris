	<?php 
		$subgroup 			= array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex 					= array("Male", "Female");
		$pers_area 			= array("Greater Metro Manila", "Regional");
		// $age_range 			= array("20 to 24","25 to 29","30 to 34","35 to 39","40 to 44","45 to 49","50 to 54","55 to 59","> 60");  
		// $los_range 			= array("< 1","1 - 4","5 - 9","10 - 14","15 - 19","20 - 24","25 - 29","30 - 34","35 - 39","> 40");  
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
		//by separation reason
			
		
		foreach($count_per_separation_reason as $per_separation)
		{
			$emp_count_per_separation[$per_separation->emp_subgroup][$per_separation->termination_reason] = $per_separation->count; 
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
                  <h2>Separated - Separation Classification</h2>
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
                        <th align="center"> Separation Type</th>
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
							foreach($separation_type as $data_separation)
							{
								 
								
								foreach($subgroup as $subgroup_data)
								{
									if(isset($emp_count_per_separation[$subgroup_data][$data_separation->termination_reason]))
									{
										$emp_count_subgroup[$subgroup_data] = $emp_count_per_separation[$subgroup_data][$data_separation->termination_reason];
									}
									else
									{
										$emp_count_subgroup[$subgroup_data] = 0;
									}
									$total_per_orggroup_per_subgroup[$subgroup_data] += $emp_count_subgroup[$subgroup_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[0]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[1]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[2]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[3]];?></td>
								<td align="right"> <?php echo $emp_count_subgroup[$subgroup[0]] + $emp_count_subgroup[$subgroup[1]] + $emp_count_subgroup[$subgroup[2]] + $emp_count_subgroup[$subgroup[3]];?></td>
								 
							</tr>
							<?php 
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
            <div class="col-md-6 col-sm-12 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2>Separated - Gender</h2>
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
                        <th align="center"> Separation Type</th>
						<th align="center">  Male </th>
						<th align="center">  Female </th> 
						<th align="center">  Total </th>
                      </tr>
                    </thead>
                    <tbody> 
						<?php 
							//' get count per group
							foreach($separation_type as $data_separation)
							{
								 
								
								foreach($sex as $sex_data)
								{
									if(isset($emp_count_per_separation_sex[$sex_data][$data_separation->termination_reason]))
									{
										$emp_count_sex[$sex_data] = $emp_count_per_separation_sex[$sex_data][$data_separation->termination_reason];
									}
									else
									{
										$emp_count_sex[$sex_data] = 0;
									}
									$total_count_separation_sex[$sex_data] += $emp_count_sex[$sex_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
								<td align="right"> <?php echo $emp_count_sex[$sex[0]];?></td>
								<td align="right"> <?php echo $emp_count_sex[$sex[1]];?></td> 
								<td align="right"> <?php echo $emp_count_sex[$sex[0]] + $emp_count_sex[$sex[1]];?></td>
								 
							</tr>
							<?php 
							}
						?>
						<tr> 
							<th align="center" scope="row"> Grand Total </th>
							<td align="right"> <?php echo $total_count_separation_sex[$sex[0]];?></td>
							<td align="right"> <?php echo $total_count_separation_sex[$sex[1]];?></td> 
							<td align="right"> <?php echo $total_count_separation_sex[$sex[0]] + $total_count_separation_sex[$sex[1]];?></td>
						</tr>
					</tbody>
					</table>
                </div>
              </div> 
            </div>
			
			<div class="col-md-6 col-sm-12 col-xs-12">  
			  <div class="x_panel">
                <div class="x_title">
                  <h2>Separated - Personnel Area</h2>
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
                        <th align="center"> Separation Type</th>
						<th align="center">  GMM </th>
						<th align="center">  Regional </th> 
						<th align="center">  Total </th>
                      </tr>
                    </thead>
                    <tbody> 
						<?php 
							//' get count per group
							
							foreach($separation_type as $data_separation)
							{
								foreach($pers_area as $pers_area_data)
								{
									if(isset($emp_count_per_separation_location[$pers_area_data][$data_separation->termination_reason]))
									{
										$emp_count_location[$pers_area_data] = $emp_count_per_separation_location[$pers_area_data][$data_separation->termination_reason];
									}
									else
									{
										$emp_count_location[$pers_area_data] = 0;
									}
									$total_count_separation_location[$pers_area_data] += $emp_count_location[$pers_area_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
								<td align="right"> <?php echo $emp_count_location[$pers_area[0]];?></td>
								<td align="right"> <?php echo $emp_count_location[$pers_area[1]];?></td> 
								<td align="right"> <?php echo $emp_count_location[$pers_area[0]] + $emp_count_location[$pers_area[1]];?></td>
								 
							</tr>
							<?php 
							}
						?>
						<tr> 
							<th align="center" scope="row"> Grand Total </th>
							<td align="right"> <?php echo $total_count_separation_location[$pers_area[0]];?></td>
							<td align="right"> <?php echo $total_count_separation_location[$pers_area[1]];?></td> 
							<td align="right"> <?php echo $total_count_separation_location[$pers_area[0]] + $total_count_separation_location[$pers_area[1]];?></td>
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
                  <h2>Separated - Age</h2>
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
                        <th>Separation Type</th>
						
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
							// foreach($subgroup as $subgroup_data)
							foreach($separation_type as $data_separation)
							{ 
								foreach($age_range as $age_range_data)
								{  
									// echo $age_range_data;
									if(isset($emp_count_per_separation_agegroup[$age_range_data][$data_separation->termination_reason]))
									{
										$emp_count_pers_agegroup[$age_range_data] = $emp_count_per_separation_agegroup[$age_range_data][$data_separation->termination_reason]; 
									}
									else
									{
										$emp_count_pers_agegroup[$age_range_data] = 0;
									} 
									$total_count_separation_per_age[$age_range_data] += $emp_count_pers_agegroup[$age_range_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
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
									<td align="right"> <?php echo $total_count_separation_per_age[$age_range_data];?></td>
									<?php 
									$overall_total_per_age_range += $total_count_separation_per_age[$age_range_data]; 
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
                  <h2>Separated - Tenure</h2>
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
                        <th>Separation Type</th>
						
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
							// foreach($subgroup as $subgroup_data)
							foreach($separation_type as $data_separation)
							{ 
								foreach($los_range as $los_range_data)
								{  
									// echo $age_range_data;
									if(isset($emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason]))
									{
										$emp_count_pers_los[$los_range_data] = $emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason]; 
									}
									else
									{
										$emp_count_pers_los[$los_range_data] = 0;
									} 
									$total_count_separation_per_los[$los_range_data] += $emp_count_pers_los[$los_range_data];
								}
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
								<?php 
								$total_per_los_range = 0;
								for($i = 0;$i<=9;$i++)
								{
									?>
									<td align="right"> <?php echo $emp_count_pers_los[$los_range[$i]];?></td>
									<?php
									$total_per_los_range += $emp_count_pers_los[$los_range[$i]];
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
									<td align="right"> <?php echo $total_count_separation_per_los[$los_range[$i]];?></td>
									<?php 
									$overall_total_per_los_range += $total_count_separation_per_los[$los_range[$i]]; 
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
		  
		  <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Separated - Year</h2>
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
                        <th>Separation Type</th>
						
						<?php 
						for($i =2007; $i<= 2017; $i++)
						{
							echo "<th>";
							echo $i;
							echo "</th>";
						} 
						?> 
						<th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php 
							//' get count per subgroup
							// foreach($subgroup as $subgroup_data)
							foreach($separation_type as $data_separation)
							{ 
								for($year_separated =2007; $year_separated<= 2017; $year_separated++)
								{
									if(isset($emp_count_per_separation_year[$year_separated][$data_separation->termination_reason]))
									{
										$emp_count_pers_year_separated[$year_separated] = $emp_count_per_separation_year[$year_separated][$data_separation->termination_reason]; 
									}
									else
									{
										$emp_count_pers_year_separated[$year_separated] = 0;
									} 
									$total_count_separation_per_year_separated[$year_separated] += $emp_count_pers_year_separated[$year_separated];
								}
								
								// foreach($los_range as $los_range_data)
								// {  
									// // echo $age_range_data;
									// if(isset($emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason]))
									// {
										// $emp_count_pers_los[$los_range_data] = $emp_count_per_separation_los[$los_range_data][$data_separation->termination_reason]; 
									// }
									// else
									// {
										// $emp_count_pers_los[$los_range_data] = 0;
									// } 
									// $total_count_separation_per_los[$los_range_data] += $emp_count_pers_los[$los_range_data];
								// }
							?>
							<tr> 
								<th scope="row"> <?php echo $data_separation->termination_reason;?></th>
								<?php 
								$total_per_year_separated = 0;
								for($i = 2007;$i<=2017;$i++)
								{
									?>
									<td align="right"> <?php echo $emp_count_pers_year_separated[$i];?></td>
									<?php
									$total_per_year_separated += $emp_count_pers_year_separated[$i];
								}
								
								?>
								<td align="right"> <?php echo $total_per_year_separated;?></td>
							</tr>
							<?php  
							}
						?>
						<tr> 
							<th scope="row"> Grand Total</th>
							<?php 
								for($i = 2007;$i<=2017;$i++)
								{
									?>
									<td align="right"> <?php echo $total_count_separation_per_year_separated[$i];?></td>
									<?php 
									$overall_total_per_year_separated += $total_count_separation_per_year_separated[$i]; 
								}
							?> 
							<td align="right"> <?php echo $overall_total_per_year_separated;?></td> 
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
 