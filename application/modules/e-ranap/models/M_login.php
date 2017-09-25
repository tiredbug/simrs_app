<?php
/**
* 
*/
class M_login extends ci_model
{
	
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
	function get_nama_rs_panjang()
	{
		$this->db->where('nama_profile','nama_rs_panjang');
		return $this->db->get('admin_profilers');
	}

	function cek_login()
	{
		
		return $this->db->query("SELECT * FROM
								ranap_users ru
								INNER JOIN admin_masterruanganinap r ON r.id_ruangan=ru.ruang
								WHERE
								ru.username IN('".$this->input->post('username')."')
								AND ru.password_text IN('".$this->input->post('password')."')
								AND ru.password_md5 IN('".md5($this->input->post('password'))."')
								AND ru.aktif IN('Y')");
	}
}