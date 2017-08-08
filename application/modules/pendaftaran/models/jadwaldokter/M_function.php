<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model{

	function get_dokterpiket($tgl,$poli)
	{
		$this->db->select('pendaftaran_jadwaldokterrajal.id_jadwaldokter');
		$this->db->select('admin_masterdokter.nama_dokter');
		$this->db->select('admin_masterdokter.gelar');
		$this->db->select('admin_masterdokter.nama_belakang');
		$this->db->from('pendaftaran_jadwaldokterrajal');
		$this->db->join('admin_masterdokter','pendaftaran_jadwaldokterrajal.kode_dokter = admin_masterdokter.kode_dokter');
		$this->db->where('pendaftaran_jadwaldokterrajal.tgl',date("Y-m-d",strtotime($tgl)));
		$this->db->where('pendaftaran_jadwaldokterrajal.id_poliklinik',$poli);
		return $this->db->get();
	}


	function cek_dokter_piket($tgl,$poli,$kode_dokter)
	{
		$this->db->where('tgl',date("Y-m-d",strtotime($tgl)));
		$this->db->where('id_poliklinik',$poli);
		$this->db->where('kode_dokter',$kode_dokter);
		return $this->db->get('pendaftaran_jadwaldokterrajal')->num_rows();
	}
}