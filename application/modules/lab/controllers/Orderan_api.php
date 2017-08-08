<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Orderan_api extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			redirect(base_url().'lab/login');
		}
		$this->load->model('orderan/m_function');
	}

	function get_data_orderan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

			foreach($this->m_function->get_orderan_data()->result() as $oa)
			{
				$tombol_hps="<a href='javascript:hapus(".$oa->no_orderan.")' class='btn btn-red btn-sm btn-icon icon-left'>Hapus<i class='entypo-cancel'></i></a>";
				$tombol_periksa="<a href='".base_url()."lab/orderan/periksa?nomororderan=".$oa->no_orderan."' class='btn btn-green btn-sm btn-icon icon-left'>Periksa<i class='entypo-check'></i></a>";
				$row=array();
				$row[]=sprintf("%09d",$oa->no_orderan);
				$row[]=$oa->norekammedis;
				$row[]=$oa->nama_lengkap;
				$row[]=tgl_biasa($oa->tgl_order);
				$row[]=$oa->unit_pengirim;
				$row[]=$oa->nama_dokter;
				$row[]=$tombol_hps.' '.$tombol_periksa;
				$data[]=$row;
			}

			$json=array(
				'draw'				=>$this->input->get('draw'),
				'recordsTotal'		=>$this->m_function->total_record(),
				'recordsFiltered'	=>$this->m_function->jumlah_rows_filter(),
				'data'				=>$data
				);
			echo json_encode($json);
		}
	}


	// proses delete orderan lab
	function delete_orderan()
	{
		$sukses=false;
		$pesan_err='';


		$id=$this->input->post('id');
		if($this->m_function->delete_orderan($id))
		{
			$sukses=true;
		}
		else
		{
			$err=$this->db->error();
			$pesan_err=$err['message'];
		}

		$json['success']=$sukses;
		$json['pesan_err']=$pesan_err;

		echo json_encode($json);
	}


	function get_tabel_list_orderan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$no_orderan=$this->input->get('noorderan');
			$data['list']=$this->m_function->get_list_orderan($no_orderan);
			$this->load->view('orderan/list_orderan',$data);
		}
	}


	function simpan_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			// deklarasi variabel 
			$sukses=true;
			$pesan_err='';

			// deklarasi data
			$data_kunjungan=array(
				'nomor_lab'				=>	$this->input->post('no_register'),
				'no_kunjungan'			=>	$this->input->post('no_kunjungan'),
				'nomor_orderan'			=>	$this->input->post('no_orderan'),
				'tgl_periksa'			=>	tgl_mysql($this->input->post('tgl_periksa')),
				'jam_periksa'			=>	$this->input->post('jam_periksa'),
				'dokter_tanggung_jawab'	=>	$this->input->post('dokter'),
				'petugas_tanggung_jawab'=>	$this->input->post('petugas'),
				'unit_pengirim'			=>	$this->input->post('unit_pengirim'),
				'dokter_pengirim'		=>	$this->input->post('dokter_pengirim'),
				'periksa'				=>	'N',
				);

			if($this->m_function->simpan_kunjungan($data_kunjungan))
			{
				$sukses=true;
			}
			// echo respon
			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;

			echo json_encode($json);
		}
	}



	
}

