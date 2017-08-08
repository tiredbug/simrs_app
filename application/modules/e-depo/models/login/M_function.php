<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class M_function extends ci_model{



	function cek_login()
	{
		$this->db->where(array(
			'username'				=>	$this->input->post('username'),
			'password'				=>	$this->input->post('password'),
			'passwordmd5'			=>	md5($this->input->post('password')),
			'aktif'					=>	'0'
			));
		$this->db->join('go_client','go_client.kode_client = depo_users.id_client');
		return $this->db->get('depo_users');
	}
}