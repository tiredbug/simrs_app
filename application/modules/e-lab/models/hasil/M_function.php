<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
*  
*/
class M_function extends ci_model
{
	// query ambil data tabel pemeriksaan 
	function __query_get_data()
	{
		$value=$this->input->get('search[value]');
		// db from
		$this->db->from('lab_kunjungan');

		// db field select
		$this->db->select('lab_kunjungan.nomor_lab, pendaftaran_kunjungan.norekammedis, pendaftaran_pasien.nama_lengkap as nama_pasien, lab_kunjungan.tgl_periksa, lab_kunjungan.unit_pengirim, admin_masterdokter.nama_dokter, admin_masterdokter.gelar, admin_masterdokter.nama_belakang, lab_dokter.nama_lengkap as dokter_tanggung_jawab ');

		// db join tabel
		$this->db->join('pendaftaran_kunjungan','lab_kunjungan.no_kunjungan=pendaftaran_kunjungan.nomor_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_pasien.nomor_rekammedis=pendaftaran_kunjungan.norekammedis');
		$this->db->join('admin_masterdokter','admin_masterdokter.kode_dokter=lab_kunjungan.dokter_pengirim');
		$this->db->join('lab_dokter','lab_dokter.kode_dokter=lab_kunjungan.dokter_tanggung_jawab');
		// where field
		$this->db->where('periksa','N');
		// db group where field
		if($value!='')
		{
			$this->db->group_start();
			$this->db->like('pendaftaran_kunjungan.norekammedis',$value);
			$this->db->or_like('pendaftaran_pasien.nama_lengkap',$value);
			$this->db->or_like("lab_kunjungan.unit_pengirim",$value);
			$this->db->group_end();
		}
		$this->db->order_by('nomor_lab');

	}

	function get_data_filter()
	{
		$this->__query_get_data();
		if($_GET['length'] != -1)
		$this->db->limit($_GET['length'], $_GET['start']);
		return $this->db->get();
	}

	function jumlah_record_filtered()
	{
		$this->__query_get_data();
		return $this->db->get()->num_rows();
	}

	function jumlah_record_pemeriksaan()
	{
		$this->db->where('periksa',"N");
		return $this->db->get('lab_kunjungan')->num_rows();
	}

	function cek_kunjungan_lab($nolab)
	{
		$this->db->where('periksa','N');
		$this->db->where('nomor_lab',$nolab);
		return $this->db->get('lab_kunjungan');
	}

	// ambil data informasi form hasil 
	function get_informasi_form_hasil($nolab)
	{
		$this->db->from('lab_kunjungan');
		$this->db->select('pendaftaran_kunjungan.norekammedis, pendaftaran_pasien.nama_lengkap as nama_pasien, pendaftaran_pasien.alamat_ktp, admin_masterdesa.nama_kelurahan, admin_masterkecamatan.nama_kecamatan, admin_masterkabupaten.nama_kota, admin_masterprovinsi.nama_provinsi, admin_masterdokter.nama_dokter as dokter_pengirim, admin_masterdokter.gelar, admin_masterdokter.nama_belakang, lab_kunjungan.nomor_lab, lab_order.tgl_order, lab_kunjungan.tgl_periksa, lab_petugas.nama_petugas as petugas, lab_dokter.nama_lengkap as dokter, lab_kunjungan.unit_pengirim, lab_kunjungan.keterangan, lab_kunjungan.jam_periksa');

		$this->db->join('pendaftaran_kunjungan','pendaftaran_kunjungan.nomor_kunjungan=lab_kunjungan.no_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_kunjungan.norekammedis=pendaftaran_pasien.nomor_rekammedis');
		$this->db->join('admin_masterdesa','admin_masterdesa.id_kelurahan=pendaftaran_pasien.kode_desa');
		$this->db->join('admin_masterkecamatan','admin_masterkecamatan.id_kecamatan = pendaftaran_pasien.kode_kecamatan');
		$this->db->join('admin_masterkabupaten','admin_masterkabupaten.id_kota = pendaftaran_pasien.kode_kabupaten');
		$this->db->join('admin_masterprovinsi','admin_masterprovinsi.id_provinsi = pendaftaran_pasien.kode_provinsi');
		$this->db->join('admin_masterdokter','admin_masterdokter.kode_dokter = lab_kunjungan.dokter_pengirim');
		$this->db->join('lab_order','lab_order.no_orderan = lab_kunjungan.nomor_orderan');
		$this->db->join('lab_dokter','lab_dokter.kode_dokter = lab_kunjungan.dokter_tanggung_jawab');
		$this->db->join('lab_petugas','lab_petugas.kode_petugas = lab_kunjungan.petugas_tanggung_jawab');

		$this->db->where('lab_kunjungan.nomor_lab',$nolab);

		return $this->db->get();
	}

	function get_data_hasil($nolab)
	{
		$this->db->from('lab_hasil');
		$this->db->select('lab_hasil.id_hasil, lab_hasil.hasil, lab_pemeriksaan.nomor_lab, lab_produklistperiksa.nama_pemeriksaan, lab_produklistperiksa.nilai_normal, lab_produklistperiksa.satuan');
		$this->db->join('lab_pemeriksaan','lab_pemeriksaan.id = lab_hasil.id_pemeriksaan');
		$this->db->join('lab_produklistperiksa', 'lab_produklistperiksa.id_listperiksa = lab_hasil.id_listperiksa');

		$this->db->where('lab_pemeriksaan.nomor_lab',$nolab);
		return $this->db->get();
	}

	function simpan_hasil_lab($id, $value)
	{
		$this->db->where('id_hasil',$id);
		return $this->db->update('lab_hasil',array('hasil'=>$value));
	}

	function checkout()
	{
		$this->db->where('nomor_lab',$this->input->post('nolab'));
		return $this->db->update('lab_kunjungan',array('periksa'=>$this->input->post('periksa')));
	}

	function update_keterangan()
	{
		$this->db->where('nomor_lab',$this->input->post('nolab'));
		return $this->db->update('lab_kunjungan',array('keterangan'=>$this->input->post('ket')));
	}

	function get_group_hasil($nolab)
	{
		$this->db->from('lab_hasil');
		$this->db->select('lab_produk.klp_produk');
		$this->db->join('lab_pemeriksaan','lab_pemeriksaan.id = lab_hasil.id_pemeriksaan');
		$this->db->join('lab_produk','lab_pemeriksaan.kode_produk = lab_produk.kode_produk');

		$this->db->group_by('lab_produk.klp_produk');
		$this->db->where('lab_pemeriksaan.nomor_lab',$nolab);

		return $this->db->get();
	}
	function get_hasil_per_group($gr,$nolab)
	{
		$this->db->from('lab_hasil');

		$this->db->select('lab_hasil.id_hasil, lab_hasil.hasil, lab_pemeriksaan.nomor_lab, lab_produklistperiksa.nama_pemeriksaan, lab_produklistperiksa.nilai_normal, lab_produklistperiksa.satuan');

		$this->db->join('lab_pemeriksaan','lab_pemeriksaan.id = lab_hasil.id_pemeriksaan');
		$this->db->join('lab_produk','lab_pemeriksaan.kode_produk = lab_produk.kode_produk');
		$this->db->join('lab_produklistperiksa', 'lab_produklistperiksa.id_listperiksa = lab_hasil.id_listperiksa');

		$this->db->where('lab_pemeriksaan.nomor_lab',$nolab);
		$this->db->where('lab_produk.klp_produk',$gr);
		return $this->db->get();
	}
}