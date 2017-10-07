<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Keluar extends ci_controller{

	function __construc()
	{
		parent::__construct();
		if(! login_kasirrajal())
		{
			redirect(base_url().'kasir');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'kasir/login');
	}
}