<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");

class Kunjungan extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_igd())
		{
			redirect(base_url().'igd/login');
		}
		$this->load->model('kunjungan/m_function');
		$this->load->model('kunjungan/m_master');
	}


	function register()
	{
		$data['poli']			=	$this->m_master->get_poli();
		$data['hub']			=	$this->m_master->get_hub();
		$data['cb']				=	$this->m_master->get_carabayar();
		$data['kelas']			=	$this->m_master->get_kelas();
		$data['cara_rujuk']		=	$this->m_master->get_cararujuk();
		$this->template->load('template','kunjungan/register',$data);
	}


	function data()
	{
		$this->template->load('template','kunjungan/data');
	}
}