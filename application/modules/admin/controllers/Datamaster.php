<?php
/**
* 
*/
class Datamaster extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_datamaster');
	}


	function ruanganinap()
	{
		$this->template->load('template','data_ruanganinap');
	}

	function form_input_ruangan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['max']=$this->m_datamaster->get_max_kode_ruangan()->row_array();
			$this->load->view('form_input_ruangan',$data);
		}
	}

	function aktifkankamar()
	{

		if($this->m_datamaster->aktifkankamar())
		{
			redirect(base_url().'admin/datamaster/ruanganinap');
		}
		else
		{
			redirect(base_url().'admin/datamaster/ruanganinap');
		}
	}

	function kamar()
	{
		if($this->m_datamaster->cek_ruang($this->encrypt_rs->decode($_GET['ruang']))->num_rows() > 0)
		{
			$data['i_r']=$this->m_datamaster->cek_ruang($this->encrypt_rs->decode($_GET['ruang']))->row_array();
			$data['i_kls']=$this->m_datamaster->cek_kls($this->encrypt_rs->decode($_GET['kls']))->row_array();
			
			$this->template->load('template','data_kamar',$data);
		}
		else
		{
			redirect(base_url().'admin/datamaster/ruanganinap');
		}
		
	}

	function bed()
	{
		if($this->m_datamaster->cek_kamar($this->encrypt_rs->decode($this->uri->segment(4)))->num_rows() > 0)
		{
			$this->template->load('template','data_bed');
		}
		else
		{
			echo "<script>alert('url tidak valid.');window.location.href='".base_url()."admin/datamaster/ruanganinap'</script>";
		}
	}

	function form_input_kamar()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['max']=$this->m_datamaster->get_max_kode_kamar()->row_array();
			$this->load->view('form_input_kamar',$data);
		}
	}

}