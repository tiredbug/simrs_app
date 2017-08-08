<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class M_function extends ci_model{



	function cek_login()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password_text',$this->input->post('password'));
		$this->db->where('password_md5',md5($this->input->post('password')));
		$this->db->where('status_aktif','Y');
		return $this->db->get('lab_users');
	}
}