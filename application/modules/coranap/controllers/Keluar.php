<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Keluar extends ci_controller{

	function __construc()
	{
		parent::__construct();
		if(! login_igd())
		{
			redirect(base_url().'coranap/login');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'coranap/login');
	}
}