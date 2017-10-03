<?php 
/**
* 
*/
class Kunjungan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_radiologi())
		{
			redirect(base_url().'radiologi/home');
		}
		$this->load->model('m_kunjungan');
	}


	function register()
	{
		$data['dokter']=$this->m_kunjungan->get_dokter_radiologi();
		$this->template->load('template','register_kunjungan',$data);
	}


	function data()
	{
		$this->template->load('template','data_kunjungan');
	}

	function detail()
	{
		$data['d']=$this->m_kunjungan->get_detail_i_kunjungan($this->uri->segment('4'))->row_array();
		$this->template->load('template','detail_kunjungan',$data);
	}
}