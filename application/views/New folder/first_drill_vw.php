



    </head> 
    <body> 
		
		<br>
		<br>
		<br>
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
			<select class="form-control group" id = "second_drill1" onChange="second_drill1();">
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
        <!--Divs for our charts -->
        <div id="chart" height="" style="background:#ddd;"></div>
        <div id="Chart2"></div> 
    </body>
</html>