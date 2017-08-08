<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Penatajasa extends ci_controller{


	function __construct()
	{
		parent::__construct();
		if(! login_rajal())
		{
			redirect(base_url().'rajal/login');
		}
		$this->load->model('penatajasa/m_master');
	}


	function index()
	{
		$data['klp_lab']	=	$this->m_master->get_klp_produk_lab();
		$data['bayar']		=	$this->m_master->get_carabayar();
		$data['kelas']		=	$this->m_master->get_kelas();
		$data['poli']		=	$this->m_master->get_poli();
		$this->template->load('template','penatajasa',$data);

	}





}