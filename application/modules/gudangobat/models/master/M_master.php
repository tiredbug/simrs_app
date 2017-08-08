<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");
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
			exit("Login session expired");
		}
	}

	// query untuk mengambil data pada tabel obat, berdasarkan aksi utama, atau setelah event tabel
	function __query_get_data_obat()
	{
		$this->db->from('go_obat');
		if($_GET['search']['value'])
		{
			$key=$_GET['search']['value'];
			$this->db->group_start();
			$this->db->like('kode_obat',$key);
			$this->db->or_like('nama_obat',$key);
			$this->db->group_end();
		}
		$this->db->where('delete','0');

	}

	// menghitung jumlah baris setelah event pada tabel
	function obat_count_filter_rows()
	{
		$this->__query_get_data_obat();
		$query = $this->db->get();
		return $query->num_rows();
	}
	// menghitung jumlah baris tanpa event pada tabel obat 
	function obat_count_all_rows()
	{
		$this->db->from('go_obat');
		return $this->db->count_all_results();
	}
	// mengambil data obat sesuai dengan event pda tabel obat
	function get_data_obat()
	{
		$this->__query_get_data_obat();
		if($_GET['length'] != -1)
		$this->db->limit($_GET['length'], $_GET['start']);
		return $this->db->get();
	}


	// query untuk mengambil data pada tabel obat, berdasarkan aksi utama, atau setelah event tabel
	function __query_get_data_supplier()
	{
		$this->db->from('go_supplier');
		if($_GET['search']['value'])
		{
			$key=$_GET['search']['value'];
			$this->db->group_start();
			$this->db->like('nama_supplier',$key);
			$this->db->group_end();
		}
		$this->db->where('delete','0');

	}

	// menghitung jumlah baris setelah event pada tabel
	function supplier_count_filter_rows()
	{
		$this->__query_get_data_supplier();
		$query = $this->db->get();
		return $query->num_rows();
	}
	// menghitung jumlah baris tanpa event pada tabel obat 
	function supplier_count_all_rows()
	{
		$this->db->from('go_supplier');
		return $this->db->count_all_results();
	}
	// mengambil data obat sesuai dengan event pda tabel obat
	function get_data_supplier()
	{
		$this->__query_get_data_supplier();
		if($_GET['length'] != -1)
		$this->db->limit($_GET['length'], $_GET['start']);
		return $this->db->get();
	}
}