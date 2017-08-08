<?php if(!defined("BASEPATH")) exit("No script direct access allowed.");

class Keluar extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_pendaftaran())
		{
			redirect(base_url().'pendaftaran');
		}
	}

	function index()
	{
		$this->session->sess_destroy();
		redirect(base_url().'pendaftaran/login');
	}
}