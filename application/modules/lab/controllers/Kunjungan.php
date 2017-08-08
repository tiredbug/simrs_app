<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

class Kunjungan extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_lab() )
		{
			redirect(base_url().'lab/login');
		}
	}


	function register()
	{
		$this->template->load('template','kunjungan/register');
	}
}