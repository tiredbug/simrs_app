<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Kunjungan extends ci_controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_coranap())
		{
			redirect(base_url().'coranap/login');
		}
		$this->load->model('kunjungan/m_function');
	}

	
	function ranap()
	{
		$this->template->load('template','kunjungan/ranap');
	}

	function igd()
	{
		$this->template->load('template','kunjungan/igd');
	}


	function rajal()
	{
		$this->template->load('template','Kunjungan/rajal');
	}

	function rujukinap()
	{
		$this->template->load('template','kunjungan/rujukinap');
	}
}