<?php if(!defined("BASEPATH")) exit ("No direct script access allowed.");

class Jadwaldokter extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_pendaftaran())
		{
			redirect(base_url().'pendaftaran/login');
		}
		$this->load->model('jadwaldokter/m_master');
		$this->load->model('jadwaldokter/m_function');
	}

	function rajal()
	{
		$data['poli']=$this->m_master->get_poli();
		$this->template->load('template','jadwaldokter/rajal',$data);
	}


}