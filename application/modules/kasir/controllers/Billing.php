<?php 
/**
* 
*/
class Billing extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_kasir())
		{
			redirect(base_url().'kasir/login');
		}

	}

	function data()
	{
		$this->template->load('template','data_billing');
	}
}