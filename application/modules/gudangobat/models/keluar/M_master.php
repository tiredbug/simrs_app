<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class M_master extends ci_model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("Session login time out");
		}
	}

	function get_client()
	{
		$this->db->where('delete','0');
		return $this->db->get('go_client');
	}

	function cek_nota($nota)
	{
		$this->db->where('no_transaksi',$nota);
		return $this->db->get('go_keluar');
	}

}