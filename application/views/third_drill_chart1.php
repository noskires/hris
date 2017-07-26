

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="row">
           <div class="col-md-12 col-sm-12 col-xs-12">
              <h3>
                   Organization
              
						<select class="form-control group" id = "first_drill3" onChange="first_drill3();">
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
								<select class="form-control group" id = "second_drill3" onChange="second_drill3();" style="margin-top:2px;">
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
			<select class="form-control group" id = "third_drill3" onChange="third_drill3();" style="margin-top:2px;">
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
			<select class="form-control group" id = "fourth_drill3" onChange="fourth_drill3();" style="margin-top:2px;">
			<option value="">  All </option> 
			<?php 
				foreach($drill3 as $row)
				{
					if($param4 == $row->fourth_level)
					{
						$selected = "selected";
						?> 
						<option selected value="<?php echo $row->fourth_level;?>">  <?php echo $row->fourth_level_txt; ?></option> 
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
  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#ED730D;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MALE</div> </div>
                <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#005A6C;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp FEMALE</div> </div>
                
                </div>
              </div>
			
             
            </div>

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
							  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#9b59b6;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp OFFICERS</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#ffc221;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp EXECUTIVES</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#fb2300;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp MANAGEMENT</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#26b99a;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp RANK & FILE</div> </div>
                
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
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#0b6a72;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp HIRED</div> </div>
				  <div class="" style="background:none;height:15px;width:150px;bottom:10px;margin-top:2px;"> <div class="pull-left" style="background:#176676;height:10px;width:10px;color:#000000;"></div> <div class"pull-left" style="color:#000000;font-size:10px;margin-top:-2px;">&nbsp SEPARATED</div> </div>
                
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

          </div>-->
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
