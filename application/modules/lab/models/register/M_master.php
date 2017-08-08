<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");

class M_master extends ci_model{
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
	function get_dokter()
	{
		$this->db->where('status','Aktif');
		return $this->db->get('admin_masterdokter');
	}

	function get_petugas()
	{
		$this->db->where('aktif','Y');
		return $this->db->get('lab_petugas');
	}
	function get_dokter_lab()
	{
		$this->db->where('aktif','Y');
		return $this->db->get('lab_dokter');
	}
}