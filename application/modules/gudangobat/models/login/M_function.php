<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class M_function extends ci_model{



	function cek_login()
	{
		$this->db->where('username',$this->input->post('username'));
		$this->db->where('password',$this->input->post('password'));
		$this->db->where('passwordmd5',md5($this->input->post('password')));
		$this->db->where('aktif','0');
		return $this->db->get('go_users');
	}
}