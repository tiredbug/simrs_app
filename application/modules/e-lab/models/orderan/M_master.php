<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

class M_master extends ci_model
{

	function get_master_dokter_aktif()
	{
		$this->db->where('aktif','Y');
		return $this->db->get('lab_dokter');
	}

	function get_master_petugas_aktif()
	{
		$this->db->where('aktif','Y');
		return $this->db->get('lab_petugas');
	}
}