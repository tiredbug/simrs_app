<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class Keluar_api extends ci_controller
{
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("Login session time out");
		}
		$this->load->model('keluar/m_function');
		$this->load->model('login/m_master');
	}


	function simpan_nota()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$nota='';

			$data=array(
				'no_transaksi'=>$this->input->post('nota'),
				'tgl_transaksi'=>$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
				'kode_client'=>$this->input->post('client'),
				'penyerah'=>$this->input->post('serah'),
				'penerima'=>$this->input->post('terima'),
				'keterangan_lain'=>$this->input->post('keterangan')
				);
			if($this->m_function->simpan_nota($data))
			{
				$sukses=true;
				$nota=$this->input->post('nota');
			}
			else
			{
				$error=$this->db->error();
				$pesan_err=$error['message'];
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['nota']=$nota;
			echo json_encode($respon);
		}
	}

	// fungsi simpan detail keluar pada form barang keluar 
	function simpan_detail_keluar()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{

			$sukses=false;
			$pesan_err='';
			
			// cek barang, pada list barang masuk, berdasarkan kode barang, no batch, tgl expired.
			// informasi barang yang ditemukan, untuk validasi stok dll.

			$cek=$this->m_function->cek_data_barang_masuk();
			if($cek->num_rows() >0 )
			{
				$data=$cek->row_array();
				if($data['expired']<=date("Y-m-d"))
				{
					$pesan_err='Barang sudah expired, periksa dan lakukan return barang tersebut.';
				}
				else
				{
					if($data['stok'] < $this->input->post('jumlah'))
					{
						$pesan_err='Stok barang dengan periode transaksi masuk tersebut tidak cukup. <br/>sisa stok : '.$data['stok'];
					}
					else
					{
						if($this->m_function->simpan_detail_keluar($data['id']))
						{
							$sukses=true;
						}
						else
						{
							$err=$this->db->error();
							$pesan_err=$err['message'];
						}
					}
				}
			}
			else
			{
				$pesan_err='Data tidak ditemukan.';
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			echo json_encode($respon);
		}
	}

	// fungsi untuk mengambil data, ketika diketik nomor nota
	function get_data_detail_keluar()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

				foreach ($this->m_function->get_data_detail_keluar($this->input->post('nota'))->result() as $l) {
					# code...
					$arr=array();
					$arr[]= $l->id;
					$arr[]=	$l->kode_obat;
					$arr[]= $l->nama_obat;
					$arr[]= $l->jumlah_keluar.' '.$l->satuan_obat;
					$arr[]= $l->no_batch;
					$arr[]= tgl_biasa($l->expired);
					$arr[]='';
					array_push($data, $arr);
				}
				

			$respon=array(
	            "data"				=>	$data
	        );
	        echo json_encode($respon);
		}
	}


	function hapus_list_item_keluar()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=true;
			$pesan_err='';
			if($this->m_function->hapus_list_item_keluar($this->input->post('id')))
			{
				$sukses=true;
			}
			else
			{
				$err=$this->db->error();
				$pesan_err=$err['message'];
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			echo json_encode($respon);

		}
	}

	function cetak()
	{
		if(!  $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['nota']			=	$this->m_function->get_nota($_GET['nota'])->row_array();
			$data['nama_rs']		=	$this->m_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']		=	$this->m_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']			=	$this->m_master->get_tlfrs()->row_array();
	    	$data['fax_rs']			=	$this->m_master->get_faxrs()->row_array();
	    	$data['list_keluar']	=	$this->m_function->get_data_detail_keluar($data['nota']['no_transaksi']);
			$this->load->view('keluar/cetak',$data);
		}
	}


	function get_data_nota()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();
			foreach ($this->m_function->get_data_nota()->result() as $dn) {
				# code...
				$arr=array();
				$arr[]=	$dn->no_transaksi;
				$arr[]=	tgl_biasa($dn->tgl_transaksi);
				$arr[]=	$dn->unit_client;
				$arr[]=	$dn->penyerah;
				$arr[]=	$dn->penerima;
				$arr[]=	'';
				array_push($data,$arr);
			}
			$respon=array(
					"draw"				=>  $this->input->post('draw'),
		            "recordsTotal"		=>  $this->m_function->count_all_rows_nota(),
		            "recordsFiltered"	=>  $this->m_function->count_filtered(),
		            "data"				=>	$data
		        );
		    echo json_encode($respon);
		}
	}

	function update_nota()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';

			$data=array(
				'tgl_transaksi'=>$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
				'kode_client'=>$this->input->post('client'),
				'penyerah'=>$this->input->post('serah'),
				'penerima'=>$this->input->post('terima'),
				'keterangan_lain'=>$this->input->post('keterangan')
				);
			if($this->m_function->update_nota($data))
			{
				$sukses=true;
			}
			else
			{
				$error=$this->db->error();
				$pesan_err=$error['message'];
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			echo json_encode($respon);
		}
	}


}