<?php
/**
* 
*/
class Home extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
	}


	function index()
	{
		$this->template->load('template','homepage');
	}
}