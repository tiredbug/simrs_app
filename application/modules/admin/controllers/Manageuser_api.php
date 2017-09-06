<?php
/**
* 
*/
class Manageuser_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_manageuser');
	}

	function get_data_user_co_rajal()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$rs=array(
				'draw'=>$_POST['draw'],
				'data'=>array(),
				'recordsFiltered'=>$this->m_manageuser->count_filtered_data_user_co_rajal(),
				'recordsTotal'=>$this->m_manageuser->count_total_data_user_co_rajal(),
				);
			
			foreach ($this->m_manageuser->get_data_user_co_rajal()->result() as $u_co) {
				# code...
				$r=array();
				$r[]=$this->encrypt_rs->encode($u_co->id);
				$r[]=$u_co->nama;
				$r[]=$u_co->username;
				$r[]=$u_co->password;
				$r[]=$u_co->status_akun;
				$r[]=$u_co->last_login;
				$r[]=$u_co->last_updateakun;
				$rs['data'][]=$r;
			}
			echo json_encode($rs);
		}
	}
}