<?php
/**
* 
*/
class Tarif extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_tarif');
	}

	function index()
	{
		$this->template->load('template','index_tarif');
	}


	function radiologi()
	{
		$this->template->load('template','tarif_radiologi_data');
	}
}