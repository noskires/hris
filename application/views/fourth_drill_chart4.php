<?php 
$subgroup = array("PLDT Officers", "PLDT Executives", "PLDT Management", "PLDT Rank & File");
		$sex = array("Male", "Female");
foreach($count_per_org_per_subgroup as $data_average_subgroup)
		{ 
			$ave_subgroup_average[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->average;
			$ave_subgroup_count[$data_average_subgroup->emp_subgroup] = $data_average_subgroup->count;
			$total_active_emp 	+= $ave_subgroup_count[$data_average_subgroup->emp_subgroup]; 
			$total_average 		+= $data_average_subgroup->sum_age;
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
              
						<select class="form-control group" id = "first_drill4" onChange="first_drill4();">
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
			<select class="form-control group" id = "second_drill4" onChange="second_drill4();" style="margin-top:2px;">
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
		
		<?php  
		if($drill2!=0)
		{
			?>
			<select class="form-control group" id = "third_drill4" onChange="third_drill4();" style="margin-top:2px;">
			<option value="">  All </option> 
			<?php 
				foreach($drill2 as $row)
				{
					if($param3 == $row->third_level)
					{
						$selected = "selected=selected";
						?> 
						<option selected value="<?php echo $row->third_level;?>">  <?php echo $row->third_level_txt; ?> </option> 
						<?php
					}
					else
					{
					?>
						<option value="<?php echo $row->third_level;?>">  <?php echo $row->third_level_txt; ?> </option> 
					 <?php
					}
				} 
			?>  
			</select>
			<?php 
		}
		?> 
		
		<?php  
		if($drill3!=0)
		{
			?>
			<select class="form-control group" id = "fourth_drill4" onChange="fourth_drill4();" style="margin-top:2px;">
			<option value="">  All </option> 
			<?php 
				foreach($drill3 as $row)
				{
					if($param4 == $row->fourth_level)
					{
						$selected = "selected";
						?> 
						<option selected value="<?php echo $row->fourth_level;?>">  <?php echo $row->fourth_level_txt; ?> </option> 
						<?php
					}
					else
					{
					?>
						<option value="<?php echo $row->fourth_level;?>">  <?php echo $row->fourth_level_txt; ?> </option> 
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
			<!-- top tiles -->
        <div class="row tile_count">
	 
          <div class="animated flipInY col-md-4 col-sm-4 col-xs-6 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i> Total Employees</span>
              <div class="count blue"><?php echo number_format($total_active_emp);?></div>
              <span class="count_bottom red"> As of 05/30/2016 </span>| Total Average Age :<span class="count_bottom red"><b> <?php echo number_format($total_average/$total_active_emp ,2);?></b> </span>
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
            </div>
            </div>

          
          </div>
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
				  <!--
				  "#9B59B6",
				  "#455C73",
				  "#BDC3C7",
				  "#26B99A",
				  "#3498DB" -->
				  <!--
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;"> <div class="pull-left" style="background:#9B59B6;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FFC221;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FB2300;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE </div> </div>    
                -->
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
                  <canvas id="mybarChart"></canvas>
				<!--
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#E86F12;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MALE </div> </div> 
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#03586A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp FEMALE </div> </div>    
				-->
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
                  <canvas id="byLocation"></canvas>
				  <!--
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp GREATER METRO MANILA</div> </div> 
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FB2300;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp REGIONALS</div> </div>    
				-->
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
                  <canvas id="bar_by_age"></canvas>  
				  <!--
				  "#9B59B6",
				  "#455C73",
				  "#BDC3C7",
				  "#26B99A",
				  "#3498DB" -->
				  <!--
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;"> <div class="pull-left" style="background:#9B59B6;height:10px;width:10px;bottom:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FFC221;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#FB2300;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT </div> </div>    
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26B99A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE </div> </div>    
                -->
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
                  <canvas id="bar_by_tenure"></canvas>
				<!--
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#E86F12;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MALE </div> </div> 
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#03586A;height:10px;width:10px;color:#000000;"></div> <div class="pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp FEMALE </div> </div>    
				-->
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

