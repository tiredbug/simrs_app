<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Checkout_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_kasirrajal())
		{
			redirect(base_url().'kasirrajal/login');
		}
		$this->load->model('checkout/m_function');
		$this->load->model('login/M_master');
	}
	
	// fungsi mencari informasi data kunjungan ketika di tekan enter pada halamanan checkout modul kasir rawat jalan, 
	function cek_norek()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$data=array();
			if($this->m_function->cek_norek($this->input->post('norek'))->num_rows() > 0)
			{
				$sukses			=	true;
				$arr 			=	$this->m_function->cek_norek($this->input->post('norek'))->row_array();
				$tagihan 		=	$this->jumlah_tagihan($arr['nomor_kunjungan']);
				$kembalian		=	'Rp. 0';
				$dt_kembali		=	'0';
				$dt_sisa 		=	'0';
				$sisa			=	'Rp. 0';

				if($arr['deposito']-$tagihan<0 )
				{
					$sisa='Rp. '.biasa_ke_rp($tagihan-$arr['deposito']);
					$dt_sisa=$tagihan-$arr['deposito'];
				}
				else
				{
					$kembalian='Rp. '.biasa_ke_rp($arr['deposito']-$tagihan);
					$dt_kembali=$arr['deposito']-$tagihan;
				}

				
				$gelar			=	$arr['gelar']==''?'':', '.$arr['gelar'];
				$alias			=	$arr['sebutan']==''?'':$arr['sebutan'];
				$asuransi 		=	$arr['nomor_asuransi']==''?'-':$arr['nomor_asuransi'];
				$data['nama']	=	$alias.' '.$arr['nama_lengkap'].$gelar;
				$data['card']	=	$arr['nomor_nik'].'  dan  '.$asuransi;
				$data['cb']		=	$arr['nama_carabayar'];
				$data['klp']	=	$arr['nama_kelompok'];
				$data['kls']	=	'Kelas '.$arr['nama_kelasperawatan'];
				$data['poli']	=	'Poliklinik '.$arr['nama_poliklinik'];
				$data['dr']		=	$arr['nama_belakang'].' '.$arr['nama_dokter'].', '.$arr['gelar'];
				$data['tjd']	=	tgl_biasa($arr['tgl_daftar']).', '.$arr['jam_daftar'];
				$data['tg']		=	'Rp. '.biasa_ke_rp($tagihan);
				$data['dp']		=	'Rp. '.biasa_ke_rp($arr['deposito']);
				$data['ss']		=	$sisa;
				$data['kmb']	=	$kembalian;
				$data['no_kunjungan']=$arr['nomor_kunjungan'];
				$data['dt_tg']	=	$dt_sisa;
				$data['dt_dp']	=	$arr['deposito'];
				$data['dt_kembali']=$dt_kembali;
			}
			else
			{
				$pesan_err='No. Medrec tidak ditemukan.';
			}

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			$json['data']	=$data;
			echo json_encode($json);
		}
	}

	function jumlah_tagihan($nomor_kunjungan)
	{
		$jumlah_tagihan_tindakan_rajal=$this->m_function->jumlah_tagihan_rajal($nomor_kunjungan);
		$jumlah_biaya_lainnya=$this->m_function->jumlah_tagihan_lain($nomor_kunjungan);

		return $jumlah_tagihan_tindakan_rajal+$jumlah_biaya_lainnya;
	}

	// function proses tombol check out pada form checkout kasir rawat jalan
	function checkout_proses()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';

			// deklarasi data untuk diinsert ke tabel billing kasir rawata jalan 
			$data_billing=array(
				'no_transaksi'		=>	$this->create_notran(),
				'no_kunjungan'		=>	$this->input->post('nomor_kunjungan'),
				'mtd_c'				=>	$this->input->post('mtd_c'),
				'jumlah_tagihan'	=>	$this->input->post('jumlah_tagihan'),
				'sudah_bayar'		=>	$this->input->post('jumlah_tagihan')-$this->input->post('sisa_byr'),
				'sisa_tagihan'		=>	$this->input->post('sisa_byr'),
				'tgl_checkout'		=>	$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
				'jam_checkout'		=>	$this->input->post('jam').':'.$this->input->post('menit').':'.$this->input->post('ss')
				);
			// periksa apakah sudah ada billing nomor konjungan tersebut 
			if($this->m_function->cek_kunjungan($this->input->post('nomor_kunjungan')) > 0)
			{
				// deklarasi data untuk update ke tabel billing kasir rawata jalan 
				$data_update=array(
					'no_kunjungan'		=>	$this->input->post('nomor_kunjungan'),
					'mtd_c'				=>	$this->input->post('mtd_c'),
					'jumlah_tagihan'	=>	$this->input->post('jumlah_tagihan')+$this->input->post('deposito'),
					'sudah_bayar'		=>	$this->input->post('jum_bayar')+$this->input->post('deposito')>$this->input->post('jumlah_tagihan')+$this->input->post('deposito')?$this->input->post('jumlah_tagihan')+$this->input->post('deposito'):$this->input->post('jum_bayar')+$this->input->post('deposito'),
					'sisa_tagihan'		=>	$this->input->post('sisa_byr'),
					'tgl_checkout'		=>	$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
					'jam_checkout'		=>	$this->input->post('jam').':'.$this->input->post('menit').':'.$this->input->post('ss')
					);
				// apabila sudah ada, updaet data lama
				if($this->m_function->update_checkout($data_update))
				{
					$sukses=true;
				}
				else
				{
					$pesan_err='Update checkout gagal.';
				} 
			}
			else
			{
				// apabila belum ada insert data baru
				if($this->m_function->insert_checkout($data_billing)==true)
				{
					$sukses=true;
				}
				else
				{
					$pesan_err='Checkout gagal.';
				}
			}
			
			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}


	// fungsi untuk membuat nomor no_transaksi
	function create_notran()
	{
		return $this->m_function->create_notran();
	}

	// fungsi untuk memmbuat halaman billing transaksi
	function billing()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$no_kunjungan=$this->input->get('no_kunjungan');

			$data['nama_rs']	=	$this->M_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']	=	$this->M_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->M_master->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->M_master->get_faxrs()->row_array();
	    	$data['info']		=	$this->m_function->get_info($no_kunjungan)->row_array();
	    	//print_r($data['info']);
			$this->load->view('checkout/billing',$data);
		}
	}




}