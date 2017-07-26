<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller 
{	
	public function dist_separtion()
	{
		$this->load->model('transaction'); 
		$data['get_count_per_separation_reason_per_year'] 		= $this->transaction->get_count_per_separation_reason_per_year(); // get count per separation per year
		$data['get_separation_type'] 		= $this->transaction->get_separation_type(); // get separation type
		 
		$this->load->view('header_chart2', $data);
		$this->load->view('by_separation', $data); 
	}
	
	public function index()
	{
		$z = array();
		for($a=1;$a<=5;$a++)
		{	  
			// $a = array();
			$d[] = array_push($z, $a);
		} 

		// $stack = array("orange", "banana");
		// array_push($stack, "apple", "raspberry");
		// print_r($stack);
		$data['d'] = $d;
		$this->load->library('encrypt');
		// echo "username = ".$username = "erikson";
		// echo "<br>";
		// echo "encrypted 1= ".$enc_username=$this->encrypt->encode($username);
		// echo "<br>";
		// echo "<br>";
		// echo "encrypted 2= ".$enc_username=str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
		// echo "<br>";
		// echo "<br>";
		// echo "<br>";
		// echo "decrypted 1= ".$dec_username=str_replace(array('-', '_', '~'), array('+', '/', '='), $enc_username);
		// echo "<br>";
		// echo "decrypted 2= ".$dec_username=$this->encrypt->decode($dec_username);

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
	 
		$this->load->view('header_chart2', $data);
		$this->load->view('chartjs', $data);  
		$this->load->view('chart_list', $data); 
	}
	
	public function drill1($param1)
	{
		// $this->uri->segment(3);
		$this->load->library('encrypt');
		// echo "username = ".$username = "erikson";
		// echo "<br>";
		// echo "encrypted 1= ".$enc_username=$this->encrypt->encode($username);
		// echo "<br>";
		// echo "<br>";
		// echo "encrypted 2= ".$enc_username=str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_username);
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "decrypted 1= ".$param1=str_replace(array('-', '_', '~'), array('+', '/', '='), $param1);
		echo "<br>";
		echo "decrypted 2= ".$param1=$this->encrypt->decode($param1);
		
		
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
	
	// public function index()
	// {  
		// // $this->load->view('header_vw');
		// $this->load->model('transaction'); 
		// $data['count_per_group'] = $this->transaction->get_group();  
		// $data['count_per_org'] = $this->transaction->get_count_per_organization_all();
		// // print_r($data['count_per_org']);
		// $this->load->view('drilling_vw', $data);
		// $this->load->view('index_all_vw', $data);
		// // $this->load->view('javascripts');
	// } 
	
	public function googlecharts()
	{
		$this->load->model('transaction');
		$data['count_per_group'] = $this->transaction->get_group();  
		// print_r($data['count_per_group']);
		foreach($data['count_per_group'] as $row)
		{
			echo $row->first_level_txt;
			echo "<br>";
		}
		$this->load->view('googlecharts2');
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
}