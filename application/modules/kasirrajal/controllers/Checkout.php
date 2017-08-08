<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class Checkout extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_kasirrajal())
		{
			redirect(base_url().'kasirrajal/login');
		}
		$this->load->model('checkout/m_function');
		$this->load->model('checkout/m_master');
	}

	function index()
	{
		$data['metode']=$this->m_master->get_metodec();
		$this->template->load('template','checkout/form',$data);
	}
	
}