<?php  if(! defined("BASEPATH")) exit('No direct script access allowed');

class Register extends CI_Controller{


	function __construct()
	{
		parent::__construct();
		if(! login_pendaftaran())
		{
			redirect(base_url().'pendaftaran/login');
		}
		$this->load->model('register/m_core');
        $this->load->model('register/m_function');
        $this->load->model('register/m_master');
	}

	function index()
	{
		redirect(base_url().'pendaftaran');
	}

	function rajal()
	{
		$data['poli']			=	$this->m_master->get_poli();
		$data['hub']			=	$this->m_master->get_hub();
		$data['cb']				=	$this->m_master->get_carabayar();
		$data['kelas']			=	$this->m_master->get_kelas();
		$data['cara_rujuk']		=	$this->m_master->get_cararujuk();
		$this->template->load('template','register/rajal',$data);
	}

	function igd()
	{
		$data['hub']			=	$this->m_master->get_hub();
		$data['cara_rujuk']		=	$this->m_master->get_cararujuk();
		$data['cb']				=	$this->m_master->get_carabayar();
		$data['kelas']			=	$this->m_master->get_kelas();
		$this->template->load('template','register/igd',$data);
	}

	function laboraturium()
	{
		$data['hub']			=	$this->m_master->get_hub();
		$data['cara_rujuk']		=	$this->m_master->get_cararujuk();
		$data['cb']				=	$this->m_master->get_carabayar();
		$data['kelas']			=	$this->m_master->get_kelas();
		$this->template->load('template','register/laboraturium',$data);
	}
      
}