<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Primary extends ci_controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_depo())
		{
			redirect(base_url().'e-depo/login');
		}
		$this->load->model('primary/m_function');
	}

	function obat()
	{
		$this->template->load('template','primary/obat');
	}
}