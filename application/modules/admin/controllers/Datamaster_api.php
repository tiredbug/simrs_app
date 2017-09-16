<?php
/**
* 
*/
class Datamaster_api extends ci_controller
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

	function get_data_ruangan_inap()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$rs=array(
				'draw'=>$_POST['draw'],
				'data'=>array(),
				'recordsFiltered'=>$this->m_datamaster->count_filtered_data_ruangan_inap(),
				'recordsTotal'=>$this->m_datamaster->count_total_data_ruangan_inap(),
				);
			
			foreach ($this->m_datamaster->get_data_ruangan_inap()->result() as $r_i) {
				# code...
				$r=array();
				$r[]=$r_i->id_ruangan;
				$r[]=$r_i->nama_ruangan;
				$r[]=$r_i->status_ruangan;
				$r[]=$this->encrypt_rs->encode($r_i->id_ruangan);
				
				$rs['data'][]=$r;
			}
			echo json_encode($rs);
		}
	}
}