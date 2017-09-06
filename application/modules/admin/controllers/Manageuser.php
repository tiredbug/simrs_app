<?php
/**
* 
*/
class Manageuser extends ci_controller
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


	function corajal()
	{
		$this->template->load('template','manage_usercorajal');
	}

	function detail()
	{
		$modul=$this->uri->segment(5);
		$id=$this->encrypt_rs->decode($this->uri->segment(4));
		
		switch ($modul) {
			case 'corajal':
				# code...
			$data['i_u']=$this->m_manageuser->get_data_user($modul,$id)->row_array();
			$data['i_l']=$this->m_manageuser->get_data_log_user('pendaftaran',$id);
			$this->template->load('template','detail_user',$data);
				break;
			
			default:
				# code...
			redirect (base_url().'admin/home');
				break;
		}
	}
}