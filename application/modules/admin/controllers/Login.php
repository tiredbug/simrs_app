<?php
/**
* 
*/
class Login extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(cek_login('admin'))
		{
			redirect(base_url().'admin/home');
		}
		$this->load->model('m_login');
	}


	function index()
	{
		$this->load->view('login');
	}

	function auth()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array('success'=>false);
			$cek=$this->m_login->auth();
			if($cek->num_rows() > 0)
			{
				$r['success']=true;

				$this->session->set_userdata($cek->row_array());
				$this->session->set_userdata('login_admin',true);
				$this->logapp->log_user($_SESSION['id_admin'],'masuk aplikasi');
			}
			else
			{
				$r['success']=false;
			}

			echo json_encode($r);
		}
	}
}