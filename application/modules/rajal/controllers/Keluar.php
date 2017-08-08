<?php if(!defined("BASEPATH")) exit("No script direct access allowed.");

class Keluar extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_rajal())
		{
			redirect(base_url().'rajal');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'rajal/login');
	}
}