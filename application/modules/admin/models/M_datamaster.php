<?php 
/**
* 
*/
class M_datamaster extends ci_model
{
	function __query_get_data_ruangan_inap()
	{
		$w='';
		if($this->input->post('search[value]'))
		{
			$w="WHERE nama_ruangan LIKE '%".$this->input->post('search[value]')."%'";
		}
		return $q="SELECT * FROM admin_masterruanganinap ".$w;
	}
	function get_data_ruangan_inap()
	{
		$q=$this->__query_get_data_ruangan_inap();
		if($this->input->post('length')!=-1)
        {
            $q=$this->__query_get_data_ruangan_inap()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
		return $this->db->query($q);
	}

	function count_filtered_data_ruangan_inap()
	{
		return $this->db->query($this->__query_get_data_ruangan_inap())->num_rows();
	}

	function count_total_data_ruangan_inap()
	{
		return $this->db->get('admin_masterruanganinap')->num_rows();
	}


	
}