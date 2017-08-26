<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Keluar extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			redirect(base_url().'e-lab');
		}
	}

	function index()
	{
		$this->logapp->log_user($_SESSION['kode_user'],'keluar dari aplikasi');
		$this->session->sess_destroy();
		redirect(base_url().'e-lab/login');
	}
}