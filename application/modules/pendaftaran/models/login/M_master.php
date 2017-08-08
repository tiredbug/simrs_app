<?php 
class M_master extends ci_model{

	function get_namars()
	{
		$this->db->where('nama_profile','nama_rs');
		return $this->db->get('admin_profilers');
	}


	function get_alamatrs()
	{
		$this->db->where('nama_profile','alamat_rs');
		return $this->db->get('admin_profilers');
	}

	function get_tlfrs()
	{
		$this->db->where('nama_profile','tlf_rs');
		return $this->db->get('admin_profilers');
	}

	function get_faxrs()
	{
		$this->db->where('nama_profile','fax_rs');
		return $this->db->get('admin_profilers');
	}
}