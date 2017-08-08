<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Masuk_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("Login session time out & expired, login again please.");
		}
		$this->load->model('masuk/m_function');
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
				'kode_supplier'=>$this->input->post('supplier'),
				'no_faktur'=>$this->input->post('faktur'),
				'tgl_faktur'=>$this->input->post('tahunf').'-'.$this->input->post('blnf').'-'.$this->input->post('tglf'),
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

	function get_nama_obat()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{

			$sukses=false;
			$pesan_err='';
			$nama_obat=$this->m_function->get_nama_obat($this->input->post('kode'));
			if($nama_obat->num_rows() > 0)
			{
				$sukses=true;
			}
			else
			{
				$pesan_err='Data obat tidak ditemukan.';
			}
			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['data']=$nama_obat->row_array();
			echo json_encode($respon);
		}
	}

	function simpan_detail_masuk()
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
				'kode_obat'		=> $this->input->post('kode-obat'),
				'no_transaksi'	=> $this->input->post('nota'),
				'jumlah_masuk'	=> $this->input->post('jumlah'),
				'stok'			=> $this->input->post('jumlah'),
				'harga_satuan'	=> $this->input->post('harga'),
				'no_batch'		=> $this->input->post('nobatch'),
				'expired'		=> $this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl')
				);
			if($this->m_function->simpan_detail_masuk($data))
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

	// fungsi untuk mengambil data, ketika diketik nomor nota
	function get_data_detail_masuk()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

				foreach ($this->m_function->get_data_detail_masuk($this->input->post('nota'))->result() as $l) {
					# code...
					$arr=array();
					$arr[]= $l->id;
					$arr[]=	$l->kode_obat;
					$arr[]= $l->nama_obat;
					$arr[]= $l->jumlah_masuk;
					$arr[]= $l->no_batch;
					$arr[]= tgl_biasa($l->expired);
					$arr[]= 'Rp. '.biasa_ke_rp($l->harga_satuan);
					array_push($data, $arr);
				}
				

			$respon=array(
	            "data"				=>	$data
	        );
	        echo json_encode($respon);
		}
	}

	function get_data_nota()
	{
		if(! $this->input->is_ajax_request())
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
				$arr[]=	$dn->nama_supplier;
				$arr[]=	$dn->no_faktur;
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
				'kode_supplier'=>$this->input->post('supplier'),
				'no_faktur'=>$this->input->post('faktur'),
				'tgl_faktur'=>$this->input->post('tahunf').'-'.$this->input->post('blnf').'-'.$this->input->post('tglf'),
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


	function cetak()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['nota']		=	$this->m_function->get_nota($_GET['nota'])->row_array();
			$data['nama_rs']	=	$this->m_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']	=	$this->m_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->m_master->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->m_master->get_faxrs()->row_array();
	    	$data['list_masuk']	=	$this->m_function->get_data_detail_masuk($data['nota']['no_transaksi']);
			$this->load->view('masuk/cetak',$data);
		}
	}
}