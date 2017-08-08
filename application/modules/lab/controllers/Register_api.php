<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class register_api extends ci_controller{
	function __construct()
	{
		parent::__construct();
		if(! login_lab() )
		{
			redirect(base_url().'lab/login');
		}
		$this->load->model('register/m_function');
	}

	function validasi_norek()
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
			if($this->m_function->validasi_norek($this->input->post('nrm'))->num_rows() > 0)
			{
				$row=$this->m_function->validasi_norek($this->input->post('nrm'))->row_array();
				$sukses=true;
				$data['nama']		=	$row['sebutan'].' '.$row['nama_lengkap'].', '.$row['gelar'];
				$data['card']		=	$row['nomor_nik'].' / '.$row['nomor_asuransi'];
				$data['alamat']		=	$row['alamat_ktp'].', Desa '.$row['nama_kelurahan'].' Kec. '.$row['nama_kecamatan'].' Kab. '.$row['nama_kota'].' Prov. '.$row['nama_provinsi'];
				$data['no_kunjungan']=	$row['nomor_kunjungan'];
			}
			else
			{
				$pesan_err='Pasien tidak ditemukan.';
			}
			$json['success']	=	$sukses;
			$json['pesan_err']	=	$pesan_err;
			$json['data']		=	$data;
			echo json_encode($json);
		}
	}

	function register()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$no_orderan 	=	$this->nomor_orderan();
			$nomor_lab 		=	$this->nomor_lab();

			$data_orderan=array(
				'no_orderan'		=>	$no_orderan,
				'no_kunjungan'		=>	$this->input->post('no_kunjungan'),
				'tgl_order'			=>	tgl_mysql(date("Y-m-d")),
				'unit_pengirim'		=>	$this->input->post('unit_pengirim'),
				'dokter_pengirim'	=>	$this->input->post('dokter_pengirim'),
				'periksa'			=>	'Y'
				);

			$data_kunjungan=array(
				'nomor_lab'				=>	$nomor_lab,
				'no_kunjungan'			=>	$this->input->post('no_kunjungan'),
				'nomor_orderan'			=>	$no_orderan,
				'tgl_periksa'			=>	tgl_mysql($this->input->post('tgl_kirim')),
				'jam_periksa'			=>	$this->input->post('jam_kirim'),
				'dokter_tanggung_jawab'	=>	$this->input->post('dokter_p'),
				'petugas_tanggung_jawab'=>	$this->input->post('petugas'),
				'unit_pengirim'			=>	$this->input->post('unit_pengirim'),
				'dokter_pengirim'		=>	$this->input->post('dokter_pengirim'),
				'periksa'				=>	'N'
				);

			if($this->m_function->proses_register($data_orderan, $data_kunjungan, $no_orderan,$nomor_lab)==true)
			{
				$sukses=true;
			}
			else
			{
				$pesan_err='Gagal registrasi kunjungan lab.';
			}

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}

	function nomor_orderan()
	{
		$max=$this->m_function->max_nomor_orderan_lab();
		$nomor_orderan=$max['no_orderan'];
		return $nomor_orderan+1;
	}

	function nomor_lab()
	{
		$max=$this->m_function->max_noreg_lab();
		return sprintf("%010d",$max['nomor_lab']+1);
	}

}