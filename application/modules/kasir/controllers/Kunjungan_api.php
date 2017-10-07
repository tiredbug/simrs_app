<?php
/**
* 
*/
class Kunjungan_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_kasir())
		{
			redirect(base_url().'kasir/home');
		}
		$this->load->model('m_kunjungan');
	}


	function get_data_kunjungan_igd()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array(
				'success'=>false,
				'data'=>array(),
				'draw'=>$_POST['draw'],
				'recordsFiltered'=>'0',
				'recordsTotal'=>'0'
			);
			foreach ($this->m_kunjungan->get_data_kunjungan_igd()->result() as $d) {
				# code...
				$d_r=array();
				$d_r[]=$d->no_kunjungan;
				$d_r[]=$d->norek;
				$d_r[]=$d->nama;
				$d_r[]=$d->alamat;
				$d_r[]=$d->jk;
				$d_r[]=$d->cb;
				$d_r[]=$d->dokter;
				$d_r[]=$d->diagnosa;
				$d_r[]=$d->pj;
				$d_r[]='';
				$r['data'][]=$d_r;
			}


			echo json_encode($r);
		}
	}
}