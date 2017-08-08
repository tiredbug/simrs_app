<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* model untuk controller laporan dan laporan api
*/
class M_function extends ci_model
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


	function __query_get_data_stok_barang()
	{
		$this->db->from('go_obat as o');
		$this->db->select('o.kode_obat, o.satuan_obat, o.nama_obat, o.jumlah_masuk, o.jumlah_keluar, o.jumlah_return, (o.jumlah_masuk-o.jumlah_keluar-o.jumlah_return) as stok');
		$this->db->where('o.delete','0');
	}


	function get_data_stok()
	{
		$this->__query_get_data_stok_barang();
		if($this->input->post('length') != -1)
		$this->db->limit($this->input->post('length'), $this->input->post('start'));
		return $this->db->get();
	}

	function count_obat_row_filtered()
	{
		$this->__query_get_data_stok_barang();
		return $this->db->get()->num_rows();
	}

	function count_obat_row_all()
	{
		$this->db->from('go_obat');
		return $this->db->count_all_results();
	}
}