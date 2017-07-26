<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends CI_Controller 
{
	public function index()
	{
		$this->home();
	}
 
	// public function create_pdf()
	// {
		// //$this->home();
 
		// // As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		// $pdfFilePath = "assets/downloads/s.pdf";
		// $data['page_title'] = 'Hello world'; // pass data to the view
		 
		// if (file_exists($pdfFilePath) == FALSE)
		// {		
			// ini_set('memory_limit','32M'); // boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
			// // $this->load->view('header_vw');
			// $html = $this->load->view('sample_vw', $data, true); // render the view into HTML
			// // $this->load->view('footer_vw');
			// $this->load->library('pdf');
			// $pdf = $this->pdf->load(); 
			// //$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
			// $pdf->WriteHTML($html); // write the HTML into the PDF
			// $pdf->Output($pdfFilePath, 'F'); // save to file because we can
		// }
		// //redirect("/assets/downloads/reports/erikson.pdf"); 
	// }
	
	public function sample1()
	{
		$this->load->view('header_vw');
		$this->load->view('sample1');
	}
	
	public function home()
	{
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
		$this->load->view('header_vw');
		$this->load->view('home_vw', 'refresh');
		$this->load->view('footer_vw');
	}
	
	public function login()
	{
		$this->load->view('header_vw');
		$this->load->view('login', 'refresh');
		$this->load->view('footer_vw');
	}
	
	public function registration()
	{
		$this->load->view('header_vw');
		$this->load->view('registration');
		$this->load->view('footer_vw');
	}
	
	public function second_step()
	{
		$this->load->view('header_vw');
		$this->load->view('second_step_vw.php');
	}
	
	public function attempt_login()
	{
		// session_start();
		// echo "<script> alert('success.'); </script>";
		$account_type 		= $this->security->sanitize_filename($this->input->post('account_type'));
		$idno 					= $this->security->sanitize_filename($this->input->post('idno'));
		$email 					= $this->security->sanitize_filename($this->input->post('email'));
		$ballot_password 	= $this->security->sanitize_filename($this->input->post('ballot_password'));
		$this->load->model('login_attempt_mdl');		
		$this->login_attempt_mdl->login($idno,  $email, $ballot_password, $account_type);
	}
	
	public function attempt_register()
	{
		$idno 					= $this->security->sanitize_filename($this->input->post('idno'));
		$email 					= $this->security->sanitize_filename($this->input->post('email'));
		$fname 				= $this->security->sanitize_filename($this->input->post('fname'));
		$mname 				= $this->security->sanitize_filename($this->input->post('mname'));
		$lname 				= $this->security->sanitize_filename($this->input->post('lname'));
		$bdate			 		= $this->security->sanitize_filename($this->input->post('bdate'));
		$address			 	= $this->security->sanitize_filename($this->input->post('address'));
		$region				 	= $this->security->sanitize_filename($this->input->post('region'));
		$province			 	= $this->security->sanitize_filename($this->input->post('province'));
		$municipality			= $this->security->sanitize_filename($this->input->post('municipality'));
		$this->load->model('registration_mdl');		
		$this->registration_mdl->register($idno, $email, $fname, $mname, $lname, $bdate, $address, $region, $province, $municipality);
	}
	
	public function cast_vote()
	{
		// $str = "SELECT * FROM candidates_posititon_tbl";
		// $query = $this->db->query($str);
		
		// $idno 					= $this->security->sanitize_filename($this->input->post('idno'));
		$this->load->model('cast_vote_mdl');
		$list 		= $this->input->post('list');
		$count_list =  count($list);
		for($i = 0; $i < $count_list; $i++)
		{
			$candidate_id = $list[$i];		
			$this->cast_vote_mdl->cast_vote($candidate_id);
		}
		$this->cast_vote_mdl->create_pdf();
		$this->cast_vote_mdl->update_status();
		$this->cast_vote_mdl->send_pdf_ballot_copy();
	}

	public function confirmation()
	{
		$this->load->view('header_vw');
		$this->load->view('account_activated');
	}
	
	public function confirm_account()
	{
		$voters_id = $_GET['confirm'];
		
		$str = "SELECT md5(concat(voters_id,'erikson')), voters_id FROM voters_tbl WHERE md5(concat(voters_id,'erikson')) = '$voters_id' ";
		$query = $this->db->query($str);
		$num_rows = $query->num_rows();

		if($num_rows > 0)
		{
			foreach($query->result_array() as $row)
			{
				$id = $row['voters_id'];
			}
			$str = "UPDATE voters_tbl SET status = '1' WHERE voters_id = '$id' ";
			$query = $this->db->query($str);
			//redirect('confirmation', 'refresh');
			echo "<META HTTP-EQUIV='refresh' content='0.5;URL= confirmation'>";
			
		}
		else
		{
			"You are forbidden to do this action.";
		}
	}

	public function view_provinces()
	{
		$region_id 			= $this->security->sanitize_filename($this->input->post('region_id'));
		$data['region_id']	= $region_id;
		$this->load->view('province_vw', $data);
	}
	
	public function view_municipalities()
	{
		$province_id 			= $this->security->sanitize_filename($this->input->post('province_id'));
		$data['province_id']	= $province_id;
		$this->load->view('municipality_vw', $data);
	}
	
	public function review_ballot()
	{
		$this->load->view('review_ballot_vw');
		// $this->load->view('sample_review');
	}
	
	

	// public function logout()
	// {
		// // // session_start();
		// // // unset($_SESSION['voters_id']);
		// // session_destroy();
		// // // unset_userdata();
		// $this->session->unset_userdata('voters_id');
		// // $this->session->sess_destroy();
		// echo "<script> alert('erikson');</script>";
		// // header('location:login');
		
				// // // echo "<META HTTP-EQUIV='refresh' content='0.5;URL= login'>";
				// // self::login();
	// }
	
	public function check_id()
	{
		$id = $this->security->sanitize_filename($this->input->post('id'));
		$data['id'] = $id;
		$this->load->view('check_id_vw', $data);
	}
	
	public function check_voters_id()
	{
		// echo $id = $this->security->sanitize_filename($this->input->post('idno'));
		// $data['voters_id'] = $id;
		$this->load->view('check_voters_id');
	}
	
	public function logout()
	{
		
		// unset($_SESSION['voters_id']);
		$this->session->unset_userdata('voters_id');
		// $this->_remove_session($this->session->all_userdata());
		// $this->session->delete('voters_id');
		$this->session->sess_destroy();
		// session_destroy();
		// self::home();
		redirect('login', 'refresh');
	}
	
	// -- COMMITTEE HERE -- //
	
	public function committee()
	{
		$this->load->view('header_vw');
		$this->load->view('committee_vw');
		$this->load->view('footer_vw');
	}
	
	public function browser()
	{
		$this->load->view('browser_msg');
	}
}