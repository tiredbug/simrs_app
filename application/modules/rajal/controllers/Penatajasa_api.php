<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class Penatajasa_api extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_rajal())
		{
			exit("Login session time out");
		}
		$this->load->model('penatajasa/m_master');
		$this->load->model('penatajasa/m_function');
	}


	function get_data_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit ("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$data_pasien=array();
			$master_klp='';
			$data_dr='';
			$data_dokter_pengirim='';
			$tgl_daftar='';
			if($this->m_function->get_data_kunjungan($this->input->post('nrm'))->num_rows() > 0)
			{

				$data 		=	$this->m_function->get_data_kunjungan($this->input->post('nrm'))->row_array();
				$sukses		=	true;
				$gelar		=	$data['gelar']==''?'':', '.$data['gelar'];
				$prov		=	$data['nama_provinsi']==''?'':', Prov. '.$data['nama_provinsi'];
				$kab		=	$data['nama_kota']==''?'':', Kab. '.$data['nama_kota'];
				$kec		=	$data['nama_kecamatan']==''?'':', Kec. '.$data['nama_kecamatan'];
				$des 		=	$data['nama_kelurahan']==''?'':', Desa. '.$data['nama_kelurahan'];

				// ambil data master kelompok berdasarkan dataget_tindakan_jasa

				// variabel respon data pasien dan kunjungan
				$data_pasien=array(
					'nama'				=>	$data['sebutan'].' '.$data['nama_lengkap'].$gelar,
					'nik'				=>	$data['nomor_nik'],
					'asuransi'			=>	$data['nomor_asuransi'],
					'alamat'			=>	$data['alamat_ktp'].$prov.$kab.$kec.$des,
					'cb'				=>	$data['kode_carabayar'],
					'klp'				=>	$data['kode_kelompok'],
					'kelas'				=>	$data['kode_kelas'],
					'kode_dokter'		=>	$data['kode_dokter'],
					'id'				=> 	$data['id_kunjunganrajal'],
					'no_kunjungan'		=>	$data['nomor_kunjungan']
					);

				//variabel rujukan interen
				$get_profile_dokter		=	$this->m_function->get_data_dokter($data['kode_dokter'])->row_array();
				$nama_belakang_dokter	=	$get_profile_dokter['nama_belakang'];
				$gelar_dokter			=	$get_profile_dokter['gelar']==''?'':', '.$get_profile_dokter['gelar'];
				$data_dokter_pengirim	=	$get_profile_dokter['nama_belakang'].' '.$get_profile_dokter['nama_dokter'].$gelar;
				$tgl_daftar				=	$data['tgl_daftar'];

				$master_klp=$this->m_master->get_where_master_klp($data['kode_carabayar'])->result();
				$data_dr=$this->m_function->get_where_dokter_piket($data['tgl_daftar'])->result();


			}
			else
			{
				
				$pesan_err='Kunjungan tidak ditemukan.';
			}
			$json['master_klp']		=	$master_klp;
			$json['data_dr']		=	$data_dr;
			$json['data_pasien']	=	$data_pasien;
			$json['success']		=	$sukses;
			$json['pesan_err']		=	$pesan_err;
			$json['dokter_pengirim']=	$data_dokter_pengirim;
			$json['tgl_daftar']		=	$tgl_daftar;

			echo json_encode($json);
		}
	}

	// mengambil data kelompok berdasarkan jenis pembayaran yang dipilih 
	function get_klp()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$klp=array();

			foreach ($this->m_function->get_klp_where($this->input->post('cb'))->result() as $k) {
				# code...
				$row=array(
					'id'=>$k->id_kelompok,
					'value'=>$k->nama_kelompok
					);
				$klp[]=$row;
				$sukses=true;
			}

			$json['success']=$sukses;
			$json['pesan_err']='';
			$json['klp']=$klp;

			echo json_encode($json);
		}
	}

	function load_tabel_data_penata_jasa()
	{
		if(! $this->input->is_ajax_request() )
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$id=$_GET['id'];
			$data['tindakan']=$this->m_function->get_data_tindakan($id);
			$this->load->view('tabel_data_penata_jasa',$data);

		}
	}

	// funsi untuk tombol simpan perubahan 
	function update_data_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$data_kunjungan=array(
				'kode_carabayar'=>$this->input->post('cb'),
				'kode_kelompok'=>$this->input->post('klp'),
				'kode_kelas'	=>$this->input->post('kelas')
				);
			$data_dokter=array(
				'kode_dokter'=>$this->input->post('dokter')
				);
			if($this->m_function->perubahan_kunjungan($data_kunjungan,$data_dokter))
			{
				$sukses=true;
			}
			else
			{
				$err=$this->db->error();
				$pesan_err=$err['message'];
				$sukses=false;
			}

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}

	// mengambil informasi tindakan ketika ditekan enter pada input kode tindakan 
	function get_tindakan_jasa()
	{
		if(! $this->input->is_ajax_request())
		{
			exit ("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$nama_tindakan='';
			$tarif='0';

			$kode=$this->input->post('kode');
			if($this->m_function->get_nama_tindakan($kode)->num_rows()>0)
			{
				$sukses=true;
				$get_nama_tindakan=$this->m_function->get_nama_tindakan($kode)->row_array();
				$nama_tindakan=$get_nama_tindakan['nama_tarif'];
				$get_tarif_terbaru=$this->m_function->get_tarif_terbaru($kode, $this->input->post('nokunjungan'))->row_array();
				$tarif=$get_tarif_terbaru['total_tarif'];
			}
			else
			{
				$pesan_err='Kode tindakan tidak dikenal.';
			}
			

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			$json['nama_tindakan']=$nama_tindakan;
			$json['tarif']=$tarif;
			echo json_encode($json);
		}
	}

	// fungsi simpan tindakan ketika ditekan enter pada kolom qty
	function simpan_tindakan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No script direct access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			if($this->m_function->simpan_tindakan())
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
	}


	// fungsi hapus jasa dan tindakan
	function hapus_tindakan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No script direct access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			if($this->m_function->hapus_tindakan($this->input->post('id')))
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
	}

	// ambil informasi data dokter piket 
	function get_dokter_piket()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$tgl=$this->input->post('tgl_daftar');
			$poli=$this->input->post('polirujuk');
			$data=array();
			foreach ($this->m_function->get_dokter_piket_untuk_data_rujuk($poli,$tgl)->result() as $d) {
				# code...
				$row=array(
					'id'=>$d->kode_dokter,
					'value'=>$d->nama_dokter
					);
				$data[]=$row;
			}
			echo json_encode($data);
		}
	}


	function kirim_rujukan_interent()
	{
		if(! $this->input->is_ajax_request())
		{
			exit ("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';

			// ambil data kunjungan sekarang 
			$id_kunjunganrajal=$this->input->post('id_kunjunganrajal');
			$dt_kunjunganrajal=$this->m_function->get_informasi_kunjungan_rajal($id_kunjunganrajal)->row_array();

			$nomor_kunjungan 	= 	$dt_kunjunganrajal['nomor_kunjungan'];
			$jumlah_rujukan 	= 	$dt_kunjunganrajal['jumlah_rujukan_interen'];
			$dokter_pengirim 	= 	$dt_kunjunganrajal['kode_dokter'];

			// jika sudah dua kali rujuk interen 
			if($jumlah_rujukan>=2)
			{
				$pesan_err='Jumlah rujukan maksimal 2 kali.';
				$json['pesan_err']=$pesan_err;

				echo json_encode($json);
				exit;
			}

			$nomor_rujukan_interen=$this->buat_nomor_rujukan_interen();

			$data_rujukan=array(
				'nomor_antrian'			=>	$this->buat_nomor_antrian($this->input->post('polirujuk')),
				'nomor_kunjungan'		=>	$nomor_kunjungan,
				'kode_poliklinik'		=>	$this->input->post('polirujuk'),
				'kode_dokter'			=>	$this->input->post('dokterrujuk'),
				'jumlah_rujukan_interen'=>	$jumlah_rujukan+1,
				'rujuk'					=> 	"N",
				'dari'					=> 	'Rujukan Interen',
				'nomor_rujukan_interen'	=> 	$nomor_rujukan_interen
				);

			$data_keterangan_rujuk=array(
				'nomor_rujukan_interen'	=>	$nomor_rujukan_interen,
				'dokter_pengirim'		=>	$dokter_pengirim,
				'poli_asal'				=>	$this->session->userdata('kode_poli'),
				'poli_tujuan'			=>	$this->input->post('polirujuk'),
				'dokter_tujuan'			=>	$this->input->post('dokterrujuk'),
				'keterangan_rujukan'	=>	$this->input->post('ctt_pengantar')
				);

			$data_update=array(
				'rujuk'					=>	'Y',
				'nomor_rujukan_interen'	=>	$nomor_rujukan_interen
				);

			if($this->m_function->proses_rujukan_interen($data_keterangan_rujuk,$data_rujukan,$id_kunjunganrajal,$data_update)==true)
			{
				$sukses=true;
			}
			else
			{
				$pesan_err='Gagal mengirim data rujukan';
			}
			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;

			echo json_encode($json);
		}
	}

	function buat_nomor_antrian($poli)
	{
		$max_antri=$this->m_function->max_antri($poli);
        $jumlah=$max_antri['nomor_antrian'];
        return sprintf("%03d",$jumlah+1);
	}

	function buat_nomor_rujukan_interen()
	{
		$max_norujuk=$this->m_function->max_norujuk();
		$no_rujuk=$max_norujuk['nomor_rujukan_interen'];
		return $no_rujuk+1;
	}

	function kirim_orderan_lab()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';

			$nokunjungan 		= 	$this->input->post('nokunjungan');
			$no_orderan 		= 	$this->buat_nomor_orderan();
			$unit_pengirim		= 	$this->unit_pengirim();
			$id_kunjunganrajal	=	$this->input->post('id_kunjunganrajal');
			$dt_kunjunganrajal	=	$this->m_function->get_informasi_kunjungan_rajal($id_kunjunganrajal)->row_array();

			$dokter_pengirim 	= 	$dt_kunjunganrajal['kode_dokter'];


			$data_orderan=array(
				'no_orderan'		=>	$no_orderan,
				'no_kunjungan'		=>	$nokunjungan,
				'tgl_order'			=>	date("Y-m-d"),
				'unit_pengirim'		=>	$unit_pengirim,
				'dokter_pengirim'	=>	$dokter_pengirim
				);
			if($this->m_function->kirim_orderan_lab($data_orderan,$no_orderan))
			{
				$sukses=true;
			}
			else
			{
				$pesan_err='gagal mengirim orderan';
			}

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}

	function buat_nomor_orderan()
	{
		$max=$this->m_function->max_nomor_orderan_lab();
		$nomor_orderan=$max['no_orderan'];
		return $nomor_orderan+1;
	}

	function unit_pengirim()
	{
		$dt_unit=$this->m_master->unit_pengirim()->row_array();
		return 'Poliklinik '.$dt_unit['nama_poliklinik'];
	}

}