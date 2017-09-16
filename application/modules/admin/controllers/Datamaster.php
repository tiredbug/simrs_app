<?php
/**
* 
*/
class Datamaster extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_datamaster');
	}


	function ruanganinap()
	{
		$this->template->load('template','data_ruanganinap');
	}

}