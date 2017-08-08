<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");

class M_master extends ci_model{

	function get_poli()
	{
		$this->db->where('status_poliklinik','Y');
		return $this->db->get('admin_masterpoliklinik');
	}

	function get_dr_to_piket()
	{
		$this->db->select('nama_dokter');
		$this->db->select('gelar');
		$this->db->select('nama_belakang');
		$this->db->select('kode_dokter');
		$this->db->where('status','Aktif');
		return $this->db->get('admin_masterdokter');
	}

	function save_dokter_piket($tgl,$poli,$kode_dokter)
	{
		return $this->db->insert('pendaftaran_jadwaldokterrajal',array(
			'kode_dokter'	=>	$kode_dokter,
			'tgl'			=>	date("Y-m-d",strtotime($tgl)),
			'id_poliklinik'	=>	$poli
			));
	}
}