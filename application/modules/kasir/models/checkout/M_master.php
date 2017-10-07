<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

class M_master extends ci_model{

	function get_metodec()
	{
		return $this->db->get('admin_mastermetodecheckout');
	}
}