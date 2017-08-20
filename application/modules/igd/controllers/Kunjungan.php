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


	function entrytindakan()
	{
		if(isset($_GET['nokunjungan']))
		{
			if($this->m_function->cek_kunjungan_igd($_GET['nokunjungan'])->num_rows() >0)
			{
				$data['i']=$this->m_function->get_informasi_kunjungan_form_entry($_GET['nokunjungan'])->row_array();
				$data['t']=$this->m_function->get_tindakan_in_igd($_GET['nokunjungan']);
				$this->template->load('template','kunjungan/entrytindakan',$data);
			}
			else
			{
				redirect(base_url().'igd/kunjungan/data');
			}
		}
		else
		{
			redirect(base_url().'igd/kunjungan/data');
		}
	}
}