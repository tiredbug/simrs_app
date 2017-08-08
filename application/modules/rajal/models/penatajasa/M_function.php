<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");

class M_function extends ci_model{
	
	function get_data_kunjungan($nrm)
	{
		// field select to display
		$this->db->select("pendaftaran_pasien.nomor_rekammedis, pendaftaran_pasien.nama_lengkap, pendaftaran_pasien.sebutan, pendaftaran_pasien.gelar, pendaftaran_pasien.nomor_nik, pendaftaran_pasien.nomor_asuransi, pendaftaran_pasien.alamat_ktp ");
		$this->db->select("pendaftaran_kunjungan.kode_carabayar, pendaftaran_kunjungan.kode_kelompok, pendaftaran_kunjungan.kode_kelas, pendaftaran_kunjungan.tgl_daftar, pendaftaran_kunjungan.nomor_kunjungan");
		$this->db->select("admin_masterprovinsi.nama_provinsi");
		$this->db->select("admin_masterkabupaten.nama_kota");
		$this->db->select("admin_masterkecamatan.nama_kecamatan");
		$this->db->select("admin_masterdesa.nama_kelurahan");
		$this->db->select("rajal_kunjungan.kode_dokter, rajal_kunjungan.id_kunjunganrajal");

		// tabel join 
		$this->db->from('pendaftaran_kunjungan');
		$this->db->join('rajal_kunjungan','rajal_kunjungan.nomor_kunjungan=pendaftaran_kunjungan.nomor_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_kunjungan.norekammedis = pendaftaran_pasien.nomor_rekammedis');
		$this->db->join('admin_masterprovinsi','pendaftaran_pasien.kode_provinsi=admin_masterprovinsi.id_provinsi');
		$this->db->join('admin_masterkabupaten','admin_masterkabupaten.id_kota=pendaftaran_pasien.kode_kabupaten');
		$this->db->join('admin_masterkecamatan','admin_masterkecamatan.id_kecamatan=pendaftaran_pasien.kode_kecamatan');
		$this->db->join('admin_masterdesa','admin_masterdesa.id_kelurahan=pendaftaran_pasien.kode_desa');
		$this->db->join('admin_mastercarabayar','pendaftaran_kunjungan.kode_carabayar=admin_mastercarabayar.id_carabayar');

		// field where 
		$this->db->where('pendaftaran_kunjungan.norekammedis',$nrm);
		$this->db->where('pendaftaran_kunjungan.status_kunjungan','Masih dirawat');
		$this->db->where('rajal_kunjungan.kode_poliklinik',$this->session->userdata('kode_poli'));
		$this->db->where('rajal_kunjungan.rujuk','N');

		return $this->db->get();
	}

	function get_where_dokter_piket($tgl)
	{
		$this->db->select('admin_masterdokter.nama_dokter');
		$this->db->select('admin_masterdokter.kode_dokter');

		$this->db->from('admin_masterdokter');
		$this->db->join('pendaftaran_jadwaldokterrajal','pendaftaran_jadwaldokterrajal.kode_dokter=admin_masterdokter.kode_dokter');

		$this->db->where('pendaftaran_jadwaldokterrajal.tgl',date("Y-m-d",strtotime($tgl)));
		$this->db->where('pendaftaran_jadwaldokterrajal.id_poliklinik',$this->session->userdata('kode_poli'));
		return $this->db->get();
	}


	function get_klp_where($cb)
	{
		$this->db->where('id_carabayar',$cb);
		return $this->db->get('admin_mastercarabayarklp');
	}

	function get_data_tindakan($id)
	{
		// field to dispaly
		$this->db->select('rajal_tindakan.id, rajal_tindakan.kode_tarif, rajal_tindakan.qty_tindakan, rajal_tindakan.tarif_satuan, rajal_tindakan.tarif_total');
		$this->db->select('admin_mastertarifrajal.nama_tarif');
		// file from 
		$this->db->from('rajal_tindakan');

		// file join
		$this->db->join('admin_mastertarifrajal','admin_mastertarifrajal.kode_tarif=rajal_tindakan.kode_tarif');
		$this->db->join('rajal_kunjungan','rajal_tindakan.id_kunjunganrajal=rajal_kunjungan.id_kunjunganrajal');

		// kondisi wehere
		$this->db->where('rajal_kunjungan.id_kunjunganrajal',$id);
		return $this->db->get();
	}


	function perubahan_kunjungan($data_kunjungan,$data_dokter)
	{
		$this->db->trans_start();
		$this->db->where('nomor_kunjungan',$this->input->post('no_kunjungan'));
		$this->db->update('pendaftaran_kunjungan',$data_kunjungan);
		$this->db->where('nomor_kunjungan',$this->input->post('no_kunjungan'));
		$this->db->update('rajal_kunjungan',$data_dokter);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function get_nama_tindakan($kode)
	{

		return $this->db->query("SELECT * FROM admin_mastertarifrajal t 
								WHERE t.kode_poliklinik IN('".$_SESSION['kode_poli']."')
								AND t.kode_tarif IN('".$kode."')");
	}

	function get_tarif_terbaru($kode,$nokunjungan)
	{
		// mencari data kelas, dan tgl daftar kunjungan
		$this->db->select('kode_kelas, tgl_daftar');
		$this->db->where('nomor_kunjungan',$nokunjungan);
		$data_kunjungan=$this->db->get('pendaftaran_kunjungan')->row_array();
		$tgl_daftar=$data_kunjungan['tgl_daftar'];
		$kode_kelas=$data_kunjungan['kode_kelas'];


		// mencari tgl berlaku terbaru 
		$this->db->select_max('tgl_berlaku');
		$this->db->where('tgl_berlaku <=',date("Y-m-d",strtotime($tgl_daftar)));
		$this->db->where('kode_tarif',$kode);
		$this->db->where('kode_kelas',$kode_kelas);
		$dt_tgl_max=$this->db->get('admin_mastertarifrajaldetail')->row_array();
		$tgl_max=$dt_tgl_max['tgl_berlaku'];

		// ambil tarif total
		$this->db->select('total_tarif');
		$this->db->where('tgl_berlaku =',date("Y-m-d",strtotime($tgl_max)));
		$this->db->where('kode_tarif',$kode);
		return $this->db->get('admin_mastertarifrajaldetail');
	}

	function simpan_tindakan()
	{
		$data=array(
			'id_kunjunganrajal'	=>	$this->input->post('id_kunjunganrajal'),
			'kode_tarif'		=>	$this->input->post('kode'),
			'qty_tindakan'		=>	$this->input->post('qty'),
			'tarif_satuan'		=>	$this->input->post('tarif'),
			'tarif_total'		=>	$this->input->post('tarif')*$this->input->post('qty')
			);
		return $this->db->insert('rajal_tindakan',$data);
	}

	function hapus_tindakan($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete('rajal_tindakan');
	}

	function get_data_dokter($kode_dokter)
	{
		$this->db->where('kode_dokter',$kode_dokter);
		return $this->db->get('admin_masterdokter');
	}


	function get_dokter_piket_untuk_data_rujuk($poli,$tgl)
	{
		$this->db->select('admin_masterdokter.nama_dokter');
		$this->db->select('admin_masterdokter.kode_dokter');

		$this->db->from('admin_masterdokter');
		$this->db->join('pendaftaran_jadwaldokterrajal','pendaftaran_jadwaldokterrajal.kode_dokter=admin_masterdokter.kode_dokter');

		$this->db->where('pendaftaran_jadwaldokterrajal.tgl',date("Y-m-d",strtotime($tgl)));
		$this->db->where('pendaftaran_jadwaldokterrajal.id_poliklinik',$poli);
		return $this->db->get();
	}

	function get_informasi_kunjungan_rajal($id)
	{
		$this->db->where('id_kunjunganrajal',$id);
		return $this->db->get('rajal_kunjungan');
	}

	function max_antri($poli)
    {
        $this->db->select_max('nomor_antrian');
        $this->db->from('rajal_kunjungan');
        $this->db->join('pendaftaran_kunjungan','pendaftaran_kunjungan.nomor_kunjungan = rajal_kunjungan.nomor_kunjungan');
        $this->db->where('pendaftaran_kunjungan.status_kunjungan','Masih dirawat');
        $this->db->where('pendaftaran_kunjungan.tgl_daftar',date("Y-m-d"));
        $this->db->where('rajal_kunjungan.kode_poliklinik',$poli);
        return $this->db->get()->row_array();
    }

    function max_norujuk()
    {
    	$this->db->select_max('nomor_rujukan_interen');
    	$this->db->from('rajal_kunjunganrujuk');
    	return $this->db->get()->row_array();
    }

    function proses_rujukan_interen($data_keterangan_rujuk,$data_rujukan,$id_kunjunganrajal,$data_update)
    {
    	$this->db->trans_start();
    	$this->db->insert('rajal_kunjunganrujuk',$data_keterangan_rujuk);
    	$this->db->insert('rajal_kunjungan',$data_rujukan);
    	$this->db->where('id_kunjunganrajal',$id_kunjunganrajal);
    	$this->db->update('rajal_kunjungan',$data_update);
    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

    function max_nomor_orderan_lab()
    {
    	$this->db->select_max('no_orderan');
    	$this->db->from('lab_order');
    	return $this->db->get()->row_array();
    }

    function kirim_orderan_lab($data_orderan,$no_orderan)
    {
    	$this->db->trans_start();
    	$this->db->insert('lab_order',$data_orderan);
    	foreach($this->input->post('list') as $l)
    	{
    		$lis=array(
    			'no_orderan'	=>	$no_orderan,
    			'kode_produk'	=>	$l
    			);

    		$this->db->insert('lab_orderlist',$lis);
    	}
    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }
}