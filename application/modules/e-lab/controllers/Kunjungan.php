<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Kunjungan extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			redirect(base_url().'e-lab/login');
		}
		$this->load->model('kunjungan/m_function');
		$this->load->model('login/M_master');
	}

	function register()
	{
		$data['dokter']=$this->m_function->get_dokter_lab();
		$this->template->load('template','kunjungan/register',$data);
	}

	function datakunjungan()
	{
		$this->template->load('template','kunjungan/datakunjungan');
	}

	function inputhasil()
	{
		if( !isset($_GET['nolab'])||$_GET['nolab']=='' || $this->m_function->get_kunjungan_lab_where($_GET['nolab'],'N')->num_rows()<1)
		{
			redirect(base_url().'e-lab/home');
		}
		else
		{
			$data['list']=$this->m_function->get_data_pemeriksaan($_GET['nolab']);
			$data['r']=$this->m_function->get_kunjungan_lab_where($_GET['nolab'],'N')->row_array();
			$this->template->load('template','kunjungan/inputhasil',$data);
		}
	}

	function cetakhasil()
	{
		if( !isset($_GET['nolab'])||$_GET['nolab']=='' || $this->m_function->get_kunjungan_lab_where($_GET['nolab'],'Y')->num_rows()<1)
		{
			redirect(base_url().'e-lab/home');
		}
		else
		{
			$data['nama_rs']	=	$this->M_master->get_namars()->row_array();
	    	$data['alamat_rs']	=	$this->M_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->M_master->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->M_master->get_faxrs()->row_array();
			$data['r']			=	$this->m_function->get_kunjungan_lab_where($_GET['nolab'],'Y')->row_array();
			$this->load->view('kunjungan/hasillab.php',$data);
		}
	}


	function histori()
	{
		# code...
		$this->template->load('template','kunjungan/histori');
	}
}