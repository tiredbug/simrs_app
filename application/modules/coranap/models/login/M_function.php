<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class M_function extends ci_model{



	function cek_login()
	{
		$this->db->where(array(
			'username'				=>	$this->input->post('username'),
			'password_text'			=>	$this->input->post('password'),
			'password_md5'			=>	md5($this->input->post('password')),
			'aktif'					=>	'Y'
			));
		return $this->db->get('co_users');
	}
}