    </head> 
    <body> 
		
		<br>
		<br>
		<br>
		<select class="form-control group" id = "first_drill" onChange="first_drill();">
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
        <!--Divs for our charts -->
        <div id="chart" height="" style="background:#ddd;"></div>
        <div id="Chart2"></div> 
    </body>
</html>