<?php 
/**
* 
*/
class Kontrol extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}

		$this->load->model('kontrol/m_function');

	}


	function stok()
	{
		$this->template->load('template','kontrol/stok');
	}


	function expired()
	{
		$this->template->load('template','kontrol/expired');
	}

}