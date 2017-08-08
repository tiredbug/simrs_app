<?php 
/**
* 
*/
class Kontrol_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("session login time out.");
		}

		$this->load->model('kontrol/m_function');

	}


	function get_data_stok()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

				foreach ($this->m_function->get_data_stok()->result() as $s) {
					# code...
					$arr=array();
					$arr[]=$s->persen<'50'?"<img src='".base_url()."template/neon/images/alert.gif' />":"<img src='".base_url()."template/neon/images/warning.gif' />";
					$arr[]=$s->kode;
					$arr[]=$s->obat;
					$arr[]=$s->masuk.' '.$s->satuan;
					$arr[]=$s->keluar.' '.$s->satuan;
					$arr[]=$s->r.' '.$s->satuan;
					$arr[]=$s->stok.' '.$s->satuan;
					$arr[]=$s->persen;
					array_push($data, $arr);
				}
				

			$respon=array(
					"draw"				=>  $this->input->post('draw'),
		            "recordsTotal"		=>  $this->m_function->count_all_rows_stok(),
		            "recordsFiltered"	=>  $this->m_function->count_filtered_stok(),
		            "data"				=>	$data
		        );
		    echo json_encode($respon);
		}
	}

	function get_data_expired()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

				foreach ($this->m_function->get_data_expired()->result() as $s) {
					# code...
					$arr=array();
					$arr[]="<img src='".base_url()."template/neon/images/alert.gif' />";
					$arr[]=$s->kode.'-'.$s->barang;
					$arr[]=$s->nota;
					$arr[]=tgl_biasa($s->tgl);
					$arr[]=$s->suplier.'-'.$s->faktur;
					$arr[]=tgl_biasa($s->expired);
					array_push($data, $arr);
				}
				

			$respon=array(
					"draw"				=>  $this->input->post('draw'),
		            "recordsTotal"		=>  $this->m_function->count_all_rows_expired(),
		            "recordsFiltered"	=>  $this->m_function->count_filtered_expired(),
		            "data"				=>	$data
		        );
		    echo json_encode($respon);
		}
	}


	function cek_notif_stok()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			echo $this->m_function->count_filtered_stok();
		}
	}


}