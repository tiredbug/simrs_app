<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Home extends ci_controller
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
		$this->template->load('template','home');
	}
}