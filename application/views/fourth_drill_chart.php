
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
	</div>
  </div> 
</div>
