<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Master extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}
	}

	function index()
	{
		redirect(base_url().'gudangobat/');
	}

	function obat()
	{
		$this->template->load('template','master/obat');
	}

	function supplier()
	{
		$this->template->load('template','master/supplier');
	}
}