<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Keluar extends ci_controller{

	function __construc()
	{
		parent::__construct();
		if(! login_lab())
		{
			redirect(base_url().'e-lab');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'e-lab/login');
	}
}