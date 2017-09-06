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
		$asal=$this->uri->segment(5);
		$no_kunjungan=$this->uri->segment(4);
		if($asal=='igd')
		{
			$data['i_k']=$this->m_function->get_i_kunjungan_igd($no_kunjungan)->row_array();
		}
		else
		{
			$data['i_k']=$this->m_function->get_i_kunjungan_rajal($no_kunjungan)->row_array();
		}

		$data['dokter']=$this->m_function->get_data_dokter_spesialis();
		$data['ruang']=$this->m_function->get_ruang();
		$data['kelas']=$this->m_function->get_kelas();
		$data['m_hub']=$this->m_function->get_m_hub();
		$this->template->load('template','kunjungan/rujukinap',$data);
	}
}
