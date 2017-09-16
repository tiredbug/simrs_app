<?php
/**
* 
*/
class Penatajasa extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_ranap())
		{
			redirect(base_url().'e-ranap/login');
		}

		$this->load->model('m_penatajasa');
	}


	function index()
	{
		$this->template->load('template','penatajasa');
	}

	function pindahruangan()
	{
		if($this->m_penatajasa->cek_kunjungan($this->uri->segment(4))->num_rows() > 0)
		{
			$data['i_r']=$this->m_penatajasa->get_i_r();
			$data['i_kls']=$this->m_penatajasa->get_i_kls();
			$this->template->load('template','pindahruangan',$data);
		}
		else
		{
			echo "<script>alert('Kunjungan tidak ditemukan');window.location.href='".base_url()."e-ranap/penatajasa'</script>";
		}
	}
}