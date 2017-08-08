<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model{

	// cek kunjungan berdasarkan nomor rekam medis, dan mengambil inormasi kunjungan. kunjungan yang divalidasi adalah kunjungan yang belum checkout 
	function cek_norek($norek)
	{
		$this->db->from('pendaftaran_kunjungan');

		$this->db->join('pendaftaran_pasien','pendaftaran_pasien.nomor_rekammedis = pendaftaran_kunjungan.norekammedis');
		$this->db->join('admin_mastercarabayar','admin_mastercarabayar.id_carabayar = pendaftaran_kunjungan.kode_carabayar');
		$this->db->join('admin_mastercarabayarklp','admin_mastercarabayarklp.id_kelompok = pendaftaran_kunjungan.kode_kelompok');
		$this->db->join('admin_masterkelasperawatan','admin_masterkelasperawatan.id_kelasperawatan = pendaftaran_kunjungan.kode_kelas');
		$this->db->join('rajal_kunjungan','rajal_kunjungan.nomor_kunjungan = pendaftaran_kunjungan.nomor_kunjungan');
		$this->db->join('admin_masterpoliklinik','rajal_kunjungan.kode_poliklinik = admin_masterpoliklinik.id_poliklinik');
		$this->db->join('admin_masterdokter','admin_masterdokter.kode_dokter = rajal_kunjungan.kode_dokter');

		$this->db->where('pendaftaran_kunjungan.status_kunjungan !=','Selesai dirawat');
		$this->db->where('pendaftaran_kunjungan.norekammedis',$norek);
		$this->db->where('rajal_kunjungan.rujuk','N');
		return $this->db->get();
	}

	// Menghitung jumlah total tagihan kunjungan tindakan pada poli rawat jalan , berdasarkan nomor kunjungan yang dikirim.
	function jumlah_tagihan_rajal($nomor_kunjungan)
	{
		$this->db->select_sum('tarif_total');
		$this->db->from('rajal_tindakan');
		$this->db->join('rajal_kunjungan','rajal_tindakan.id_kunjunganrajal = rajal_kunjungan.id_kunjunganrajal');
		$this->db->where('rajal_kunjungan.nomor_kunjungan',$nomor_kunjungan);
		$hasil= $this->db->get()->row_array();
		return $hasil['tarif_total'];
	}

	// menghitung jumlah total biaya tindakan auto
	function jumlah_tagihan_lain($nomor_kunjungan)
	{
		$this->db->select_sum('admin_tindakanauto.tarif');
		$this->db->from('admin_tindakanauto');
		$this->db->join('pendaftaran_biayaauto','admin_tindakanauto.id_auto = pendaftaran_biayaauto.id_auto');
		$this->db->where('pendaftaran_biayaauto.nomor_kunjungan',$nomor_kunjungan);
		$hasil= $this->db->get()->row_array();
		return $hasil['tarif'];
	}

	// cek apakah nomor kunjungan tersebut sudah dibuat dibilling atau belum 
	function cek_kunjungan($no_kunjungan)
	{
		$this->db->where('no_kunjungan',$no_kunjungan);
		return $this->db->get('kasrwj_billing')->num_rows();
	}


	// proses insert billing, update kunjungan menjadi sudah checkout.
	function insert_checkout($data)
	{
		$this->db->trans_start();
		$this->db->insert('kasrwj_billing',$data);
		$this->db->where('nomor_kunjungan',$this->input->post('nomor_kunjungan'));
		$this->db->update('pendaftaran_kunjungan',array('status_kunjungan'=>'Selesai dirawat'));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	// menghitung nomor billing terbesar, kemudian tambah satu untuk nomor billing baru 
	function create_notran()
	{
		$this->db->select_max('no_transaksi');
		$max=$this->db->get('kasrwj_billing')->row_array();
		return $max['no_transaksi']+1;
	}

	// update data chechout apabila sudah checkout
	function update_checkout($data)
	{
		$this->db->where('no_kunjungan',$this->input->post('nomor_kunjungan'));
		return $this->db->update('kasrwj_billing',$data);
	}


	// mengambil informasi biodata pada header billing 
	function get_info($no_kunjungan)
	{
		$this->db->select('pendaftaran_kunjungan.nomor_kunjungan, pendaftaran_kunjungan.norekammedis, pendaftaran_kunjungan.tgl_daftar, pendaftaran_kunjungan.jam_daftar, pendaftaran_kunjungan.umur_tahun, pendaftaran_kunjungan.umur_bulan, pendaftaran_kunjungan.umur_hari');

		$this->db->select('pendaftaran_pasien.nama_lengkap, pendaftaran_pasien.alamat_ktp');
		$this->db->select('admin_masterdesa.nama_kelurahan');
		$this->db->select('admin_masterkecamatan.nama_kecamatan');
		$this->db->select('admin_masterkabupaten.nama_kota');
		$this->db->select('admin_masterprovinsi.nama_provinsi');
		$this->db->select('admin_mastercarabayar.nama_carabayar');
		$this->db->select('admin_mastercarabayarklp.nama_kelompok');
		$this->db->select('kasrwj_billing.tgl_checkout, kasrwj_billing.jam_checkout, kasrwj_billing.sudah_bayar, kasrwj_billing.sisa_tagihan');
		$this->db->select('admin_mastermetodecheckout.nama_metode');

		$this->db->from('pendaftaran_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_pasien.nomor_rekammedis = pendaftaran_kunjungan.norekammedis');
		$this->db->join('admin_masterdesa','pendaftaran_pasien.kode_desa = admin_masterdesa.id_kelurahan');
		$this->db->join('admin_masterkecamatan', 'admin_masterkecamatan.id_kecamatan = pendaftaran_pasien.kode_kecamatan');
		$this->db->join('admin_masterkabupaten', 'admin_masterkabupaten.id_kota = pendaftaran_pasien.kode_kabupaten');
		$this->db->join('admin_masterprovinsi', 'admin_masterprovinsi.id_provinsi = pendaftaran_pasien.kode_provinsi');
		$this->db->join('admin_mastercarabayar','admin_mastercarabayar.id_carabayar = pendaftaran_kunjungan.kode_carabayar');
		$this->db->join('admin_mastercarabayarklp','admin_mastercarabayarklp.id_kelompok = pendaftaran_kunjungan.kode_kelompok');
		$this->db->join('kasrwj_billing','pendaftaran_kunjungan.nomor_kunjungan = kasrwj_billing.no_kunjungan');
		$this->db->join('admin_mastermetodecheckout','admin_mastermetodecheckout.id = kasrwj_billing.mtd_c');

		$this->db->where('pendaftaran_kunjungan.nomor_kunjungan',$no_kunjungan);
		return $this->db->get();
	}

	// mencari poliklinik yang pernah dirawat
	function get_polirawat($nomor_kunjungan)
	{
		
		$this->db->from('rajal_kunjungan');
		$this->db->select('admin_masterpoliklinik.nama_poliklinik, rajal_kunjungan.id_kunjunganrajal');
		$this->db->join('admin_masterpoliklinik','admin_masterpoliklinik.id_poliklinik = rajal_kunjungan.kode_poliklinik');
		$this->db->where('nomor_kunjungan',$nomor_kunjungan);
		return $this->db->get();
	}

	// mencari tindakan yang dilakukan pada poli
	function get_tindakan($id)
	{
		$this->db->from('rajal_tindakan');
		$this->db->select('admin_mastertarifrajal.nama_tarif');
		$this->db->select('rajal_tindakan.qty_tindakan, rajal_tindakan.tarif_satuan, rajal_tindakan.tarif_total');
		$this->db->join('admin_mastertarifrajal','rajal_tindakan.kode_tarif = admin_mastertarifrajal.kode_tarif');
		$this->db->where('rajal_tindakan.id_kunjunganrajal',$id);
		return $this->db->get();
	}

	// cek pemeriksaan pada laboraturium
	function get_tindakan_lab($no_kunjungan)
	{
		$this->db->select('nomor_lab');
		$this->db->where('no_kunjungan',$no_kunjungan);
		return $this->db->get('lab_kunjungan');
	}

	// ambil data pemeriksaan lab
	function get_periksa_lab($nomor_lab)
	{
		$this->db->select('lab_produk.nama_produk, lab_pemeriksaan.tarif');
		$this->db->from('lab_pemeriksaan');
		$this->db->join('lab_kunjungan','lab_kunjungan.nomor_lab = lab_pemeriksaan.nomor_lab');
		$this->db->join('lab_produk','lab_produk.kode_produk = lab_pemeriksaan.kode_produk');
		$this->db->where('lab_kunjungan.nomor_lab',$nomor_lab);
		return $this->db->get();
	}

}