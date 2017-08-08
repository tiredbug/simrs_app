<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");
class Home extends ci_controller{


	function __construct()
	{
		parent::__construct();
		if(! login_rajal())
		{
			redirect(base_url().'rajal/login');
		}
	}

	function index()
	{
		$this->template->load('template','home');
	}
}