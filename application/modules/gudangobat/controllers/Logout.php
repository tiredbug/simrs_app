<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Logout extends ci_controller{

	function __construc()
	{
		parent::__construct();
		if(! login_kasirrajal())
		{
			redirect(base_url().'gudangobat');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'gudangobat/login');
	}
}