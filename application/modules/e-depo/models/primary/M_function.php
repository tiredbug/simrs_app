<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class M_function extends ci_model
{
	
	function __construct()
	{
		# code...
		if(! login_depo())
		{
			exit("Login session expired.");
		}
	}


	function __query_get_data_obat()
	{
		$query="SELECT
				a.kode_obat kode,
				a.nama_obat obat,
				a.satuan_obat satuan, 
				a.merk_type mt,
				b.id id,
					IF ((a.kode_obat=b.kode_obat AND b.del='0' AND b.id_client='".$this->session->userdata('id_client')."'),0,1) value
				FROM go_obat a
				LEFT JOIN depo_barang b ON a.kode_obat=b.kode_obat";
		return $query;
	}


	function get_data_obat()
	{
		$limit='';
		$query=$this->__query_get_data_obat();
		if($this->input->post('length')!= -1)
		{
			$limit="LIMIT ".$this->input->post('start').",".$this->input->post('length');
		}
		return $this->db->query($query.' '.$limit);
	}

	function get_all_record_obat()
	{
		$this->db->from('go_obat');
		$this->db->where('delete','0');
		return $this->db->count_all_results();
	}

	function get_filtered_record_obat()
	{
		return $this->db->query($this->__query_get_data_obat())->num_rows();
	}
}