<?php 
/**
* 
*/
class M_manageuser extends ci_model
{
	
	function __query_get_data_Co_rajal()
	{
		$w='';
		if($this->input->post('search[value]'))
		{
			$w="WHERE nama LIKE '%".$this->input->post('search[value]')."%'";
		}
		return $q="SELECT * FROM pendaftaran_users ".$w;
	}
	function get_data_user_co_rajal()
	{
		$q=$this->__query_get_data_Co_rajal();
		if($this->input->post('length')!=-1)
        {
            $q=$this->__query_get_data_Co_rajal()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
		return $this->db->query($q);
	}


	function get_data_user($modul,$id)
	{
		switch ($modul) {
			case 'corajal':
				# code...
			$this->db->where('id',$id);
			return $this->db->get('pendaftaran_users');
				break;
			
		}
	}

	function count_filtered_data_user_co_rajal()
	{
		return $this->db->query($this->__query_get_data_Co_rajal())->num_rows();
	}

	function count_total_data_user_co_rajal()
	{
		return $this->db->get('pendaftaran_users')->num_rows();
	}

	function get_data_log_user($modul,$id)
	{
		$this->db->where(array('modul'=>$modul,'user'=>$id));
		return $this->db->get('log_user');
	}
}