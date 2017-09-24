<?php 
/**
* 
*/
class Laporan extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
		if(! login_ranap())
		{
			redirect(base_url().'e-ranap/login');
		}
		$this->load->model('m_checkout');
	}


	function laporanharian()
	{
		$this->template->load('template','laporanharian');
	}



	function laporanbulanan()
	{
		$this->template->load('template','laporanbulanan');
	}
}