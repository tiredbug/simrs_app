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

}