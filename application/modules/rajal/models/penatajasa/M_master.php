<?php if(! defined("BASEPATH")) exit("No direct script access alllowed.");

class M_master extends ci_model{


	function get_carabayar()
	{
		return $this->db->get('admin_mastercarabayar');
	}


	function get_kelas()
	{
		return $this->db->get('admin_masterkelasperawatan');
	}

	function get_where_master_klp($cb)
	{
		$this->db->where('id_carabayar',$cb);
		return $this->db->get('admin_mastercarabayarklp');
	}

	function get_poli()
	{
		$this->db->select('id_poliklinik, nama_poliklinik');
		$this->db->where('status_poliklinik','Y');
		$this->db->where('id_poliklinik != ',$this->session->userdata('kode_poli'));
		return $this->db->get('admin_masterpoliklinik');
	}

	function get_klp_produk_lab()
	{
		$this->db->select('klp_produk');
		$this->db->group_by('klp_produk');
		return $this->db->get('lab_produk');
	}

	function get_dataproduklab($klp)
	{
		$this->db->where('klp_produk',$klp);
		$this->db->where('aktif','Y');
		return $this->db->get('lab_produk');
	}

	function unit_pengirim()
	{
		$this->db->where('id_poliklinik',$this->session->userdata('kode_poli'));
		return $this->db->get('admin_masterpoliklinik');
	}

	function get_dokter()
	{
		return $this->db->query("SELECT
								dok.kode_dokter kode, CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))) dokter
								FROM
								admin_masterdokter dok
								WHERE dok.status IN('Aktif') AND dok.jenis_dokter IN('Spesialis');
								");
	}
}