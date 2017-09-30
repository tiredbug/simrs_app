<?php
/**
* 
*/
class Tarif_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_tarif');
	}


	function form_input_tindakan_radiologi()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['group_tindakan_radiologi']=$this->m_tarif->get_group_tindakan_radiologi();
			$this->load->view('form_input_tindakan_radiologi',$data);
		}
	}

}
