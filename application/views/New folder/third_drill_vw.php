 
    </head> 
    <body> 
		
		<br>
		<br>
		<br>
		<select class="form-control group" id = "first_drill3" onChange="first_drill3();">
		<option value="">  All </option>
		<?php 
			foreach($count_per_group as $row)
			{
				if($param1 == $row->first_level)
				{
					$selected = "selected";
					?> 
					<option selected value="<?php echo $row->first_level;?>">  <?php echo $row->first_level_txt; ?> </option> 
					<?php
				}
				else
				{
					?>
					<option value="<?php echo $row->first_level;?>">  <?php echo $row->first_level_txt; ?> </option>
				 <?php
				}
			}
		?>  
		</select> 
		 
		<?php  
		if($drill1!=0)
		{
			?>
			<select class="form-control group" id = "second_drill3" onChange="second_drill3();">
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
			<select class="form-control group" id = "third_drill3" onChange="third_drill3();">
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
			<select class="form-control group" id = "fourth_drill3" onChange="fourth_drill3();">
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
		
 
        <!--Divs for our charts -->
        <div id="chart" height="" style="background:#ddd;"></div>
        <div id="Chart2"></div> 
    </body>
</html>