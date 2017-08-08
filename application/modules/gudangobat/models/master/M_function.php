<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
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

	// fungsi untuk mengahpuas data obat, sebenarnya hanya mengubah value delete dari 0 ke 1
	function delete_obat($kode)
	{
		$this->db->where('kode_obat',$kode);
		return $this->db->update('go_obat',array("delete"=>'1'));
	}

	// funcgsi untuk menyimpan data obat
	function insert_obat($data)
	{
		return $this->db->insert('go_obat',$data);
	}

	// ambil data bari tabel go_obat
	function get_rows_obat($kode)
	{
		$this->db->where('kode_obat',$kode);
		return $this->db->get('go_obat');
	}

	// fungsi update data obat
	function update_obat($data)
	{
		$this->db->where('kode_obat',$this->input->post('kode_obat'));
		return $this->db->update('go_obat',$data);
	}

	// fungsi untuk menyimpan data master supplier
	function insert_supplier($data)
	{
		return $this->db->insert('go_supplier',$data);
	}

	// fungsi ubah hapus supplier, inti proses ubah value delete dari 0 menjadi 1
	function delete_supplier()
	{
		$this->db->where('kode',$this->input->post('kode'));
		return $this->db->update('go_supplier',array('delete'=>'1'));
	}

	// ambil data bari tabel go_supplier
	function get_rows_supplier($kode)
	{
		$this->db->where('kode',$kode);
		return $this->db->get('go_supplier');
	}

	// fungsi update data supplier
	function update_supplier($data)
	{
		$this->db->where('kode',$this->input->post('kode'));
		return $this->db->update('go_supplier',$data);
	}
}