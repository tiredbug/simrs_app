<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");

class Orderan extends ci_controller{

	function __construct()
	{
		parent::__construct();

		if(! login_lab())
		{
			redirect(base_url().'lab/login');
		}
		$this->load->model('orderan/m_master');
		$this->load->model('orderan/m_function');
	}

	function index()
	{
		$this->template->load('template','orderan/data_orderan');
	}

	function periksa()
	{
		if(isset($_GET['nomororderan']))
		{
			if($this->m_function->cek_nomor_orderan($_GET['nomororderan'])>0)
			{
				$data['dokter']=$this->m_master->get_master_dokter_aktif();
				$data['petugas']=$this->m_master->get_master_petugas_aktif();
				$data['no_register']=$this->create_no_register_lab();
				$data['info_orderan']=$this->m_function->get_informasi_orderan($_GET['nomororderan'])->row_array();
				$this->template->load('template','orderan/form_periksa',$data);
			}
			else
			{
				echo"<script>alert('Nomor orderan tidak ditemukan.');window.location.href='".base_url()."lab/orderan'</script>";
			}
		}
		else
		{
			redirect(base_url().'lab');
		}
	}

	function create_no_register_lab()
	{
		$max=$this->m_function->max_noreg_lab();
		return sprintf("%010d",$max['nomor_lab']+1);
	}

}