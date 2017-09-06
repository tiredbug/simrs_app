<?php
/**
* 
*/
class Keluar extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'e-ranap/login');
	}
}