<?php 
class Transaction extends CI_Model
{
	function __construct()
	{
		parent::__construct(); 
	}
	
	public function org_count($org_code)
	{
		$str = "SELECT COUNT( emp_id ) AS cnt 
					FROM emp_data 
					WHERE CASE WHEN emp_data.sector_code != 99999999 
					THEN emp_data.sector_code = '$org_code'
					OR emp_data.center_code = '$org_code'
					OR emp_data.div_code = '$org_code'
					ELSE emp_data.sector_code = '$org_code'
					OR emp_data.center_code = '$org_code'
					OR emp_data.div_code = '$org_code'
					END "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();  
		}
		else
		{
			return $num_rows; 
		}
	}
	
	// count per org here based on group code
	
	public function count_per_org($org_code, $level)
	{
		$data = $this->org_code($org_code, $level);
		
		if($level == 1)
		{
			$org_level = 'second_level';
		}
		elseif($level == 2)
		{
			$org_level = 'third_level';
		}
		else
		{
			$org_level = 'fourth_level';
		} 
		
		foreach($data as $rows)
		{
			$row 								= $rows->$org_level;
			$sec_level_data[$row] 	= $this->org_count($row);
		}
		
		return $sec_level_data;
	}
	
	public function org_codes($level_txt, $org_name)
	{
		$org_name = trim($org_name);
		$level_txt = trim($level_txt);
		// $level_txt = "second_level_txt";
		$level = substr( $level_txt, 0, -4 );
		$org_level_no_txt = substr( $level_txt, 0, -4 );
		
		$org_level = array("first_level_txt"=>"second_level_txt", "second_level_txt"=>"third_level_txt", "third_level_txt"=>"fourth_level_txt"); 
		
		$str = "SELECT DISTINCT $level_txt , $level FROM org_structure WHERE $level_txt = '$org_name' ";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows(); 
		if($num_rows > 0)
		{
			$row = $query->row();
			$org_code = $row->$level;
			$org_level[$level_txt];	
			$org_level_no_txt = substr( $org_level[$level_txt], 0, -4 ); // remove "_txt" suffix on the org level txt.
			$str = "SELECT DISTINCT $org_level_no_txt, $org_level[$level_txt] FROM org_structure WHERE $level = '$org_code' AND $org_level_no_txt NOT LIKE '99999999' AND $org_level_no_txt NOT LIKE '' "; 
			$query = $this->db->query($str); 
			$num_rows = $query->num_rows();
			if($num_rows > 0)
			{
				return $query->result();
			}
			else
			{
				return $num_rows; 
			}
		}
		else
		{
			return $num_rows; 
		}
	}

	public function get_org_code_count($org_name) // get emp count per organization
	{
		$level_txt 	= array('first_level_txt', 'second_level_txt', 'third_level_txt', 'fourth_level_txt');  
		$level 			= array('first_level', 'second_level', 'third_level', 'fourth_level');   
		
		for($i=0;$i<4;$i++)
		{
			if(!$this->org_codes($level_txt[$i], $org_name)==0)
			{
				$d = $this->org_codes($level_txt[$i], $org_name); 
				foreach($d as $rows)
				{
					$row 				= $rows->$level[$i+1];
					$org_name		= $rows->$level_txt[$i+1];
					// $sec_level_data[$row][$org_name] 			= $this->org_count($row);
					// $sec_level_data[$row]	= $this->org_count($row);
					$sec_level_data[$row]	= $this->org_count($row); 
				}
				return $sec_level_data; 
			}
		}
	}
	
	public function get_org_desc($org_name) // get org desc per organization
	{
		$level_txt 	= array('first_level_txt', 'second_level_txt', 'third_level_txt', 'fourth_level_txt');  
		$level 			= array('first_level', 'second_level', 'third_level', 'fourth_level');
		
		for($i=0;$i<4;$i++)
		{
			if(!$this->org_codes($level_txt[$i], $org_name)==0)
			{
				return $d = $this->org_codes($level_txt[$i], $org_name);   
			}
		}
	}
	
	public function get_org_level($org_name) // get org level per organzation
	{
		$level_txt 	= array('first_level_txt', 'second_level_txt', 'third_level_txt', 'fourth_level_txt');  
		$level 			= array('first_level', 'second_level', 'third_level', 'fourth_level');
		
		for($i=0;$i<4;$i++)
		{
			if(!$this->org_codes($level_txt[$i], $org_name)==0)
			{
				return $d = $level_txt[$i+1];   
			}
		}
	}
	
	public function get_group()
	{
		$str = "SELECT DISTINCT first_level, first_level_txt FROM org_structure"; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function drill1()
	{
		$str = "SELECT DISTINCT second_level, second_level_txt FROM org_structure "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}

	public function drill2($param1)
	{
		$str = "SELECT DISTINCT second_level, second_level_txt FROM org_structure WHERE first_level = '$param1' AND second_level NOT LIKE '99999999' "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function drill3($param1, $param2)
	{
		$str = "SELECT DISTINCT third_level, third_level_txt FROM org_structure WHERE first_level = '$param1' AND second_level = '$param2' AND third_level NOT LIKE '99999999' AND third_level_txt NOT LIKE '' "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function drill4($param1, $param2, $param3)
	{
		$str = "SELECT DISTINCT fourth_level, fourth_level_txt FROM org_structure WHERE first_level = '$param1' AND second_level = '$param2' AND third_level = '$param3' AND fourth_level_txt NOT LIKE ''  "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function get_count_per_organization($org_code)
	{
		$org_code = trim($org_code);
		// $org_code = "50020974";
		
		$str1 = "SELECT COUNT( emp_id ) AS cnt, emp_data.sex, emp_data.emp_subgroup
					FROM emp_data 
					WHERE CASE WHEN emp_data.group_code !=99999999 
					THEN emp_data.group_code = '$org_code' 
					OR emp_data.sector_code = '$org_code' 
					OR emp_data.center_code = '$org_code' 
					OR emp_data.div_code = '$org_code' 
					ELSE emp_data.sector_code = '$org_code' 
					OR emp_data.center_code = '$org_code' 
					OR emp_data.div_code = '$org_code' 
					END GROUP BY emp_subgroup, sex";
					
		$str2 = "SELECT COUNT( emp_id ) AS cnt, emp_data.sex, emp_data.emp_subgroup
					FROM emp_data 
					WHERE emp_data.group_code =99999999  
					GROUP BY emp_subgroup, sex";
					
		if($org_code != 99999999)
		{
			$str = $str1;
		}
		else
		{
			$str = $str2;
		}
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function get_count_per_organization_location($org_code)
	{
		$org_code = trim($org_code);
		// $org_code = "50020974";
		
		$str1 = "SELECT COUNT( emp_id ) AS cnt, emp_data.sex, emp_subgroup, personnel_area
					FROM emp_data 
					WHERE CASE WHEN emp_data.group_code !=99999999 
					THEN emp_data.group_code = '$org_code' 
					OR emp_data.sector_code = '$org_code' 
					OR emp_data.center_code = '$org_code' 
					OR emp_data.div_code = '$org_code' 
					ELSE emp_data.sector_code = '$org_code' 
					OR emp_data.center_code = '$org_code' 
					OR emp_data.div_code = '$org_code' 
					END GROUP BY personnel_area, emp_subgroup";
					
		$str2 = "SELECT COUNT( emp_id ) AS cnt, emp_data.sex, emp_data.emp_subgroup, personnel_area, emp_subgroup
					FROM emp_data 
					WHERE emp_data.group_code =99999999  
					GROUP BY personnel_area, emp_subgroup";
					
		if($org_code != 99999999)
		{
			$str = $str1;
		}
		else
		{
			$str = $str2;
		}
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function get_count_per_organization_all()
	{
		$str = "SELECT COUNT( emp_id ) AS cnt, emp_data.sex, emp_data.emp_subgroup
					FROM emp_data GROUP BY emp_subgroup, sex";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	// count per group
	public function get_count_per_group()
	{
		$str = "SELECT COUNT( * ) AS cnt, group_code, group_txt
					FROM emp_data 
					GROUP BY group_code order by group_code desc ";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	//for line graph
	public function get_count_hired_per_year()
	{
		$str = "SELECT COUNT( * ) AS cnt, YEAR( date_hired ) AS year_hired
					FROM emp_data
					WHERE YEAR( date_hired ) >1999
					GROUP BY YEAR( date_hired ) ";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	public function get_count_hired_per_separated()
	{
		$str = "SELECT COUNT( * ) AS cnt, YEAR( date_separated ) AS year_separated
					FROM emp_data_separated 
					WHERE YEAR( date_separated ) >1999
					GROUP BY YEAR( date_separated ) ";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	//age range
	
	public function get_count_per_age_range()
	{
		$str = "SELECT  emp_subgroup, count(*) as cnt,
					CASE 
						WHEN age BETWEEN 20 and 24 THEN '20 to 24'
						WHEN age BETWEEN 25 and 29 THEN '25 to 29'
						WHEN age BETWEEN 30 and 34 THEN '30 to 34'
						WHEN age BETWEEN 35 and 39 THEN '35 to 39'
						WHEN age BETWEEN 40 and 44 THEN '40 to 44'
						WHEN age BETWEEN 45 and 49 THEN '45 to 49'
						WHEN age BETWEEN 50 and 54 THEN '50 to 54'
						WHEN age BETWEEN 55 and 59 THEN '55 to 59' 
						WHEN age >= 60 THEN '> 60' END AS agegroup
					FROM get_age_los_loc  GROUP BY agegroup, emp_subgroup";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	//los range
	
	public function get_count_per_los_range()
	{
		$str = "SELECT  emp_subgroup, count(*) as cnt, los, 
					CASE 
						WHEN los <1 THEN '< 1' 
						WHEN los >= 1 and los <= 4 THEN '1 - 4' 
						WHEN los > 4 and los <= 9 THEN '5 - 9' 
						WHEN los > 9 and los <= 14 THEN '10 - 14' 
						WHEN los > 14 and los <= 19 THEN '15 - 19' 
						WHEN los > 19 and los <= 24 THEN '20 - 24' 
						WHEN los > 24 and los <= 29 THEN '25 - 29' 
						WHEN los > 29 and los <= 34 THEN '30 - 34' 
						WHEN los > 34 and los <= 39 THEN '35 - 39' 
						WHEN los > 39 THEN '> 40' END AS los_group 
					FROM get_age_los_loc  group by los_group, emp_subgroup ORDER BY los ";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	//by location
	
	public function get_count_per_location()
	{
		$str = "SELECT count(*) as cnt, personnel_area, emp_subgroup, CASE 
							WHEN age BETWEEN 20 and 24 THEN '20 to 24'
							WHEN age BETWEEN 25 and 29 THEN '25 to 29'
							WHEN age BETWEEN 30 and 34 THEN '30 to 34'
							WHEN age BETWEEN 35 and 39 THEN '35 to 39'
							WHEN age BETWEEN 40 and 44 THEN '40 to 44'
							WHEN age BETWEEN 45 and 49 THEN '45 to 49'
							WHEN age BETWEEN 50 and 54 THEN '50 to 54'
							WHEN age BETWEEN 55 and 59 THEN '55 to 59' 
							WHEN age >= 60 THEN '> 60' END AS agegroup  
				FROM `get_age_los_loc` group by personnel_area, emp_subgroup";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	public function get_count_per_PA()
	{
		$str = "SELECT count(*) as cnt, personnel_area, emp_subgroup, sex
				FROM emp_data group by personnel_area, emp_subgroup, sex";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	//get  count termination by reason
	public function get_count_per_termination_reason()
	{
		$str = "SELECT count(*) as cnt, trim(termination_reason) FROM emp_data_separated WHERE emp_subgroup NOT LIKE '%PLDT Tempo%' GROUP BY trim(termination_reason)";
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	// distribution by separation
	public function get_count_per_separation_reason_per_year()
	{
		$str = "SELECT COUNT( * ) AS cnt, YEAR( date_separated ) AS year_separated, termination_reason
		FROM  `emp_data_separated`  
		GROUP BY YEAR( date_separated ) , termination_reason
		ORDER BY termination_reason, YEAR( date_separated ) ";
		
		// $str = "SELECT COUNT( * ) AS cnt, YEAR( date_separated ) AS year_separated, termination_reason
		// FROM  `emp_data_separated` WHERE termination_reason not like '%resignation%' and termination_reason not like '%MRP%'  
		// GROUP BY YEAR( date_separated ) , termination_reason
		// ORDER BY termination_reason, YEAR( date_separated ) ";
					
		// WHERE termination_reason LIKE  '%MRP%'
		// OR termination_reason LIKE  '%resignation%'
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	// distribution by separation
	public function get_separation_type()
	{
		// $str = "SELECT DISTINCT termination_reason FROM  `emp_data_separated` where  termination_reason not like '%resignation%' and termination_reason not like '%MRP%'   "; 
		$str = "SELECT DISTINCT termination_reason FROM  `emp_data_separated`  "; 
		$query = $this->db->query($str); 
		$num_rows = $query->num_rows();
		if($num_rows > 0)
		{
			return $query->result();
		}
		else
		{
			return $num_rows; 
		}
	}
	
	
	
	
}
?>