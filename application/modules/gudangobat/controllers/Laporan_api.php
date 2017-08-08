<?php if(! defined("BASEPATH")) exit("No direct access allowed.");
/**
* 
*/
class Laporan_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("login session expired");
		}
		$this->load->model('laporan/m_function');
		$this->load->model('login/m_master');
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
			$no=$_POST['start']+1;
			foreach ($this->m_function->get_data_stok()->result() as $s) {
				# code...
				$arr=array();
				$arr[]=$no;
				$arr[]=$s->kode_obat.'-'.$s->nama_obat;
				$arr[]=$s->jumlah_masuk.' '.$s->satuan_obat;
				$arr[]=$s->jumlah_keluar.' '.$s->satuan_obat;
				$arr[]=$s->jumlah_return.' '.$s->satuan_obat;
				$arr[]=$s->stok.' '.$s->satuan_obat;
				array_push($data,$arr);
				$no++;
			}
				
			$respon=array(
				'draw'				=>	$this->input->post('draw'),
				'recordsTotal'		=>	$this->m_function->count_obat_row_all(),
				'recordsFiltered'	=>	$this->m_function->count_obat_row_filtered(),
				'data'				=>	$data
			);
			echo json_encode($respon);
		}
		
	}

	function laporan_obat()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['stok']			=	$this->m_function->get_data_stok();
			$data['nama_rs']		=	$this->m_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']		=	$this->m_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']			=	$this->m_master->get_tlfrs()->row_array();
	    	$data['fax_rs']			=	$this->m_master->get_faxrs()->row_array();
			$this->load->view('laporan/laporan_obat',$data);
		}
	}
}