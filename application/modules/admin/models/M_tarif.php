<?php
/**
* 
*/
class M_tarif extends ci_model
{
	

	function get_group_tindakan_radiologi()
	{
		return $this->db->get('radiologi_groupproduk');
	}
	
}