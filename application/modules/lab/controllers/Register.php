<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

class Register extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_lab() )
		{
			redirect(base_url().'lab/login');
		}
		$this->load->model('register/m_master');
	}


	function index()
	{
		$data['klp_lab']		=	$this->m_master->get_klp_produk_lab();
		$data['dokter']			=	$this->m_master->get_dokter();
		$data['petugas']		=	$this->m_master->get_petugas();
		$data['dokter_lab']		=	$this->m_master->get_dokter_lab();
		$this->template->load('template','register/form_register',$data);
	}
}