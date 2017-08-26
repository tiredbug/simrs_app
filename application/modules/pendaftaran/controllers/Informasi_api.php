<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Informasi_api extends CI_Controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_pendaftaran())
		{
			exit("No direct script access allowed.");
		}
		$this->load->model('informasi/m_function');
	}


	function get_data_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

			foreach ($this->m_function->get_data_kunjungan()->result() as $i) {
				# code...
				$row=array();
				$row[]=$i->norekammedis;
				$row[]=$i->nomor_kunjungan;
				$row[]=$i->nama_lengkap;
				$row[]=$i->nama_carabayar;
				$row[]=$i->nomor_sep;
				$row[]=tgl_biasa($i->tgl_daftar).' '.$i->jam_daftar;
				$row[]='Poliklinik '.$i->nama_poliklinik;
				$row[]=$i->status_kunjungan;
				$data[]=$row;
			}

			$respon=array(
					"draw"				=>  $this->input->post('draw'),
		            "recordsTotal"		=>  $this->m_function->count_all_reccord(),
		            "recordsFiltered"	=>  $this->m_function->count_record_filtered(),
		            "data"				=>	$data
		        );
		    echo json_encode($respon);
		}
	}
	
}