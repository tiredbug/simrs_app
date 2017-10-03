<?php
/**
* 
*/
class Laporan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_radiologi())
		{
			redirect(base_url().'radiologi/login');
		}
		$this->load->model('m_kunjungan');
	}


	function laporanharian()
	{
		$this->template->load('template','laporanharian');
	}

	function laporanbulanan()
	{
		$this->template->load('template','laporanbulanan');
	}


	function laporanharian_api()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array(
 				'draw'				=> $this->input->post('draw'),
 				'recordsTotal'		=> '0',
 				'recordsFiltered'	=> '0',
 				'data'				=> array()
 			);

			foreach ($this->m_kunjungan->get_data_radiologi_kunjungan()->result() as $d) {
				# code...
				$arr=array();
				$arr[]=$d->nomr;
				$arr[]=$d->no_k;
				$arr[]=$d->norad;
				$arr[]=$d->nama;
				$arr[]=$d->jk;
				$arr[]=$d->tgl_order;
				$arr[]=$d->dokter_pengirim.'-'.$d->unit;
				$arr[]=$d->dokter_p;
				$arr[]=$d->n_user;
				$arr[]='';
	 			array_push($respon['data'],$arr);
			}
 			
 			echo json_encode($respon);
		}
	}
}