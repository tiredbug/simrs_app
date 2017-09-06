<?php 
/**
* 
*/
class M_login extends ci_model
{
	function auth()
	{
		$this->db->where(array(
			'username'=>$_POST['username'],
			'password'=>$_POST['password'],
			'passwordmd5'=>MD5($_POST['password']),
			'status_akun'=>'Y'
			));
		return $this->db->get('admin_users');
	}
}