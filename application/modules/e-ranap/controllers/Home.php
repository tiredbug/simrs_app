<?php
/**
* 
*/
class Home extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_ranap())
		{
			redirect(base_url().'e-ranap/login');
		}
	}

	function index()
	{
		$this->template->load('template','home');
	}
}