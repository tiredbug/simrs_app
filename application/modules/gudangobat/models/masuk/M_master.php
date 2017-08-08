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
			exit("Login session time out.");
		}
	}

	function get_supplier()
	{
		$this->db->where('delete','0');
		return $this->db->get('go_supplier');
	}

	function __query()
	{
		$this->db->from('go_masuk');
	}

	function get_tgl()
	{
		$this->__query();
		$this->db->select('tgl_transaksi');
		$this->db->group_by('tgl_transaksi');
		$this->db->where('delete','0');
		return $this->db->get();
	}

	function get_supplier_transaksi()
	{
		$this->__query();
		$this->db->select('go_masuk.kode_supplier, go_supplier.nama_supplier');
		$this->db->join('go_supplier','go_supplier.kode = go_masuk.kode_supplier');
		$this->db->group_by('go_masuk.kode_supplier');
		$this->db->where('go_masuk.delete','0');
		return $this->db->get();
	}

	function get_penyerah()
	{
		$this->__query();
		$this->db->select('penyerah');
		$this->db->group_by('penyerah');
		$this->db->where('delete','0');
		return $this->db->get();
	}

	function get_penerima()
	{
		$this->__query();
		$this->db->select('penerima');
		$this->db->group_by('penerima');
		$this->db->where('delete','0');
		return $this->db->get();
	}

	function cek_nota($nota)
	{
		$this->db->where('no_transaksi',$nota);
		$this->db->where('delete','0');
		return $this->db->get('go_masuk');
	}
}