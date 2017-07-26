<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller 
{	
	public function distribution_by_separation()
	{
		$this->load->model('transaction'); 
		$data['get_count_per_separation_reason_per_year'] 		= $this->transaction->get_count_per_separation_reason_per_year(); // get count per separation per year
		$data['get_separation_type'] 		= $this->transaction->get_separation_type(); // get separation type
		 
		$this->load->view('header_chart2', $data);
		$this->load->view('by_separation', $data); 
	}
	
	public function index()
	{

		$this->load->model('transaction'); 
		$data['count_per_group'] 					= $this->transaction->get_group();   // get all name group
		$data['count_per_org'] 						= $this->transaction->get_count_per_organization_all();
		$data['count_per_year_hired'] 			= $this->transaction->get_count_hired_per_year();
		$data['count_per_year_separated'] = $this->transaction->get_count_hired_per_separated();
		$data['count_per_age_range'] 		= $this->transaction->get_count_per_age_range();
		$data['count_per_los_range'] 			= $this->transaction->get_count_per_los_range();
		$data['count_per_loc'] 						= $this->transaction->get_count_per_location();
		$data['count_per_group_code'] 		= $this->transaction->get_count_per_group(); // get count per group
		$data['count_per_PA'] 		= $this->transaction->get_count_per_PA(); // get count per group
		$data['count_per_termiation_reason'] 		= $this->transaction->get_count_per_termination_reason(); // get count per group
		// print_r($data['count_per_group']);
		// print_r($data['count_per_year_hired']);
		// print_r($data['count_per_PA'] );
		// print_r($data['count_per_termiation_reason']);
		$this->load->view('header_chart2', $data); 
		$this->load->view('chartjs', $data); 
		// $this->load->view('footer_chart', $data);
		$this->load->view('chart_list', $data);
		// $this->load->view('bar', $data);
	}
	
	
	
	public function drill1($param1)
	{
		// $this->uri->segment(3);
		$this->load->model('transaction');
		$data['count_per_group'] = $this->transaction->get_group();
		$data['drill1'] = $this->transaction->drill2($param1);
		$data['count_per_org'] = $this->transaction->get_count_per_organization($param1);
		$data['count_per_org_pa'] = $this->transaction->get_count_per_organization_location($param1);
		$data['count_per_year_hired'] = $this->transaction->get_count_hired_per_year();
		$data['count_per_year_separated'] = $this->transaction->get_count_hired_per_separated();
		$data['param1'] = $param1;
		$data['param2'] = "";
		$data['param3'] = ""; 
		// echo "asdfasdfasdfs =";print_r($data['count_per_org_pa'] );
		// $this->load->view('header_chart', $data);
		$this->load->view('header_chart2', $data); 
		$this->load->view('first_drill_chart', $data);
		$this->load->view('footer_chart', $data);
	}
	
	public function drill2($param1, $param2)
	{
		$this->load->model('transaction');
		$data['count_per_group'] = $this->transaction->get_group();
		$data['drill1'] = $this->transaction->drill2($param1);
		$data['drill2'] = $this->transaction->drill3($param1, $param2);
		$data['count_per_org'] = $this->transaction->get_count_per_organization($param2);
		$data['count_per_year_hired'] = $this->transaction->get_count_hired_per_year();
		$data['count_per_year_separated'] = $this->transaction->get_count_hired_per_separated();
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = "";
		$data['param4'] = ""; 
		$this->load->view('header_chart2', $data);
		$this->load->view('second_drill_chart', $data);
		$this->load->view('footer_chart', $data);
	}
	
	public function sample()
	{  
		$this->load->view('sample_col_vw'); 
	}
	
	public function drill3($param1, $param2, $param3)
	{
		// $this->uri->segment(4);
		$this->load->model('transaction');
		$data['count_per_group'] = $this->transaction->get_group();
		$data['drill1'] = $this->transaction->drill2($param1);
		$data['drill2'] = $this->transaction->drill3($param1, $param2);
		$data['drill3'] = $this->transaction->drill4($param1, $param2, $param3);
		$data['count_per_org'] = $this->transaction->get_count_per_organization($param3);
		$data['count_per_year_hired'] = $this->transaction->get_count_hired_per_year();
		$data['count_per_year_separated'] = $this->transaction->get_count_hired_per_separated();
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = "";
		$this->load->view('header_chart2', $data);
		$this->load->view('third_drill_chart', $data);
		$this->load->view('footer_chart', $data); 
	}
 
	
	public function drill4($param1, $param2, $param3, $param4)
	{
		$this->load->model('transaction');
		$data['count_per_group'] = $this->transaction->get_group();
		$data['drill1'] = $this->transaction->drill2($param1);
		$data['drill2'] = $this->transaction->drill3($param1, $param2);
		$data['drill3'] = $this->transaction->drill4($param1, $param2, $param3);
		$data['count_per_org'] = $this->transaction->get_count_per_organization($param4);
		$data['count_per_year_hired'] = $this->transaction->get_count_hired_per_year();
		$data['count_per_year_separated'] = $this->transaction->get_count_hired_per_separated();
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;
		$this->load->view('header_chart2', $data);
		$this->load->view('fourth_drill_chart', $data);
		$this->load->view('footer_chart', $data);
	}
	
	
	
	//tabular data
	//04-21/2016
	
	// by table
	
	public function tabular_data()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group
		$data['count_per_group_subgroup'] 						= $this->transaction->get_group_count_by_subgroup();   // get all name subgroup
		$data['count_per_group_sex'] 								= $this->transaction->get_group_count_by_sex();   // get all name sex
		$data['count_per_group_pers_area'] 					= $this->transaction->get_group_count_by_pers_area();   // get all name pers area
		$data['count_per_group_agegroup'] 						= $this->transaction->get_group_count_by_age_group();   // get all name age group
		$data['count_per_group_los'] 								= $this->transaction->get_group_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group 
 
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_group', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function distribution_by_group()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group
		$data['count_per_group_subgroup'] 						= $this->transaction->get_group_count_by_subgroup();   // get all name subgroup
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup
		$data['count_per_group_sex'] 								= $this->transaction->get_group_count_by_sex();   // get all name sex
		$data['count_per_group_pers_area'] 					= $this->transaction->get_group_count_by_pers_area();   // get all name pers area
		$data['count_per_group_agegroup'] 						= $this->transaction->get_group_count_by_age_group();   // get all name age group
		$data['count_per_group_los'] 								= $this->transaction->get_group_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group 
 
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_group', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function distribution_by_classification()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup 
		$data['count_per_subgroup_sex'] 						= $this->transaction->get_subgroup_count_by_sex();   // get all name sex 
		$data['count_per_subgroup_pers_area'] 				= $this->transaction->get_subgroup_count_by_pers_area();   // get all name pers area 
		$data['count_per_subgroup_agegroup'] 				= $this->transaction->get_subgroup_by_age_group();   // get all name age group
		$data['count_per_subgroup_los'] 							= $this->transaction->get_subgroup_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group  
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_classification', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function distribution_by_gender()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup 
		$data['count_per_sex'] 										= $this->transaction->get_count_by_gender();   // get all name sex 
		$data['count_per_gender_pers_area'] 					= $this->transaction->get_gender_count_by_pers_area();   // get all name pers area 
		$data['count_per_gender_agegroup'] 					= $this->transaction->get_gender_by_age_group();   // get all name age group
		$data['count_per_gender_los'] 							= $this->transaction->get_gender_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group  
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_gender', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function distribution_by_location()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup 
		$data['count_per_sex'] 										= $this->transaction->get_count_by_gender();   // get all name sex 
		$data['count_per_gender_pers_area'] 					= $this->transaction->get_gender_count_by_pers_area();   // get all name pers area 
		$data['count_per_location_agegroup'] 					= $this->transaction->get_location_by_age_group();   // get all name age group
		$data['count_per_location_los'] 							= $this->transaction->get_location_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group  
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_location', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function distribution_by_separation_reason()
	{
		$this->load->model('transaction');  
		$data['separation_type'] 										= $this->transaction->separation_type();   // get all by separation reason 
		$data['count_per_separation_reason'] 					= $this->transaction->get_count_by_separation_reason();   // get all by separation reason  
		$data['count_per_separation_sex'] 						= $this->transaction->get_count_by_separation_reason_gender();   // get all name sex 
		$data['count_per_separation_location'] 				= $this->transaction->get_count_by_separation_reason_location();   // get all count per location  
		$data['count_per_separation_agegroup'] 				= $this->transaction->get_count_by_age_group_separated();   // get all name age group
		$data['count_per_separation_los'] 						= $this->transaction->get_count_by_los_group_separated();   // get all name los group 
		$data['count_per_separation_year'] 						= $this->transaction->get_count_per_year_separated();   // get all name los group  
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_separation', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	//--------------------------distribution by chartss ---------------------------------------//
	
	public function distribution_by_group_chart()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group
		$data['count_per_group_subgroup'] 						= $this->transaction->get_group_count_by_subgroup();   // get all name subgroup
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup
		$data['count_per_group_sex'] 								= $this->transaction->get_group_count_by_sex();   // get all name sex
		$data['count_per_group_pers_area'] 					= $this->transaction->get_group_count_by_pers_area();   // get all name pers area
		$data['count_per_group_agegroup'] 						= $this->transaction->get_group_count_by_age_group();   // get all name age group
		$data['count_per_group_los'] 								= $this->transaction->get_group_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group  
		$data['average_per_subgroup'] 							= $this->transaction->get_average_per_subgroup(); // get average per subgroup
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_group_chart', $data);   
	}
	
	public function distribution_by_classification_chart()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_subgroup'] 								= $this->transaction->get_count_by_subgroup();   // get all name subgroup 
		$data['count_per_subgroup_sex'] 						= $this->transaction->get_subgroup_count_by_sex();   // get all name sex 
		$data['count_per_subgroup_pers_area'] 				= $this->transaction->get_subgroup_count_by_pers_area();   // get all name pers area 
		$data['count_per_subgroup_agegroup'] 				= $this->transaction->get_subgroup_by_age_group();   // get all name age group
		$data['count_per_subgroup_los'] 							= $this->transaction->get_subgroup_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group 
		$data['average_per_subgroup'] 							= $this->transaction->get_average_per_subgroup(); // get average per subgroup 
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_classification_chart', $data);   
	}
	
	public function distribution_by_gender_chart()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_gender_subgroup'] 					= $this->transaction->get_subgroup_count_by_sex();   // get all name subgroup 
		$data['count_per_sex'] 										= $this->transaction->get_count_by_gender();   // get all name sex 
		$data['count_per_gender_pers_area'] 					= $this->transaction->get_gender_count_by_pers_area();   // get all name pers area 
		$data['count_per_gender_agegroup'] 					= $this->transaction->get_gender_by_age_group();   // get all name age group
		$data['count_per_gender_los'] 							= $this->transaction->get_gender_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group   
		$data['average_per_subgroup'] 							= $this->transaction->get_average_per_subgroup(); // get average per subgroup 
		$data['average_per_gender'] 								= $this->transaction->get_average_per_gender(); // get average per gender  
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_gender_chart', $data);   
	}
	
	public function distribution_by_location_chart()
	{
		$this->load->model('transaction'); 
		$data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		$data['count_per_location_subgroup'] 					= $this->transaction->get_subgroup_count_by_pers_area();   // get all name subgroup 
		$data['count_per_sex'] 										= $this->transaction->get_count_by_gender();   // get all name sex 
		$data['count_per_gender_pers_area'] 					= $this->transaction->get_gender_count_by_pers_area();   // get all name pers area 
		$data['count_per_location_agegroup'] 					= $this->transaction->get_location_by_age_group();   // get all name age group
		$data['count_per_location_los'] 							= $this->transaction->get_location_count_by_los_group();   // get all name los group 
		$data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group 
		
		$data['average_per_pers_area'] 							= $this->transaction->get_average_per_pers_area(); // get average per pers area
 
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_location_chart', $data);    
	}
	
	public function distribution_by_separation_chart()
	{
		$this->load->model('transaction'); 
		// $data['count_per_group'] 									= $this->transaction->get_group();   // get all name group 
		// $data['count_per_location_subgroup'] 					= $this->transaction->get_subgroup_count_by_pers_area();   // get all name subgroup 
		// $data['count_per_sex'] 										= $this->transaction->get_count_by_gender();   // get all name sex 
		// $data['count_per_gender_pers_area'] 					= $this->transaction->get_gender_count_by_pers_area();   // get all name pers area 
		// $data['count_per_location_agegroup'] 					= $this->transaction->get_location_by_age_group();   // get all name age group
		// $data['count_per_location_los'] 							= $this->transaction->get_location_count_by_los_group();   // get all name los group 
		// $data['count_per_group_code'] 							= $this->transaction->get_count_per_group(); // get count per group  
		// $data['average_per_subgroup'] 							= $this->transaction->get_average_per_pers_area(); // get average per pers area
		
		$data['separation_type1'] 									= $this->transaction->separation_type();   // get all by separation reason 
		$data['separation_type'] 										= $this->transaction->separation_type();   // get all by separation reason
		$data['count_per_separation_reason'] 					= $this->transaction->get_count_per_separation_reason();   // get all by separation reason
		$data['count_per_separation_subgroup'] 				= $this->transaction->get_count_by_separation_reason();   // get all by separation reason
		$data['count_per_separation_sex'] 						= $this->transaction->get_count_by_separation_reason_gender();   // get all name sex
		$data['count_per_separation_location'] 				= $this->transaction->get_count_by_separation_reason_location();   // get all count per location
		$data['count_per_separation_agegroup'] 				= $this->transaction->get_count_by_age_group_separated();   // get all name age group
		$data['count_per_separation_los'] 						= $this->transaction->get_count_by_los_group_separated();   // get all name los group
		$data['count_per_separation_year'] 						= $this->transaction->get_count_per_year_separated();   // get all name los group
		
		// print_r($data['count_per_separation_subgroup']);
		$this->load->view('header_chart2', $data); 
		$this->load->view('distribution_by_separation_chart', $data);   
	}
	
	public function distribution_by_separation_chart1($sep_type)
	{
		// echo " sep type = ".$sep_type;
		// $sep_type = str_replace("%20"," ",$sep_type);
		$sep_type	= str_replace(array('%20', '_', '~','-'), array(' ', '(', ')','/'), $sep_type); 
		$data['sep_type'] = $sep_type;
		$this->load->model('transaction');
		$data['separation_type1'] 									= $this->transaction->separation_type();   // get all by separation reason 
		$data['separation_type'] 										= $this->transaction->separation_type1($sep_type);   // get all by separation reason 
		$data['count_per_separation_reason'] 					= $this->transaction->get_count_per_separation_reason();   // get all by separation reason  
		$data['count_per_separation_subgroup'] 				= $this->transaction->get_count_by_separation_reason();   // get all by separation reason  
		$data['count_per_separation_sex'] 						= $this->transaction->get_count_by_separation_reason_gender();   // get all name sex 
		$data['count_per_separation_location'] 				= $this->transaction->get_count_by_separation_reason_location();   // get all count per location  
		$data['count_per_separation_agegroup'] 				= $this->transaction->get_count_by_age_group_separated();   // get all name age group
		$data['count_per_separation_los'] 						= $this->transaction->get_count_by_los_group_separated();   // get all name los group 
		$data['count_per_separation_year'] 						= $this->transaction->get_count_per_year_separated();   // get all name los group   
		// print_r($data['count_per_separation_year']);
		$this->load->view('header_chart2', $data);
		$this->load->view('distribution_by_separation_chart3', $data);
	}
	
	public function sep_emps()
	{
		$this->load->model('separated/separated_emp');  
		$data['separation_type'] 										= $this->transaction->separation_type();   // get all by separation reason 
		$data['count_per_separation_reason'] 					= $this->transaction->get_count_by_subgroup_separated();   // get all by separation reason    
		print_r($data['count_per_separation_reason']);
		$this->load->view('header_chart2', $data); 
		// $this->load->view('distribution_by_separation_chart', $data);   
	}
}