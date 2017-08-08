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
			exit("Login session time out");
		}
	}

	function simpan_nota($data)
	{
		return $this->db->insert('go_masuk',$data);
	}

	function get_nama_obat($kode)
	{
		$this->db->select('nama_obat, satuan_obat');
		$this->db->from('go_obat');
		$this->db->where('kode_obat',$kode);
		return $this->db->get();
	}

	// menyimpan data detail barang atau obat masuk
	function simpan_detail_masuk($data)
	{
		return $this->db->insert('go_detailmasuk',$data);
	}

	// mengambil data list barang masuk berdasarkan, nomor nota

	function get_data_detail_masuk($nota)
	{
		$this->db->from('go_detailmasuk');
		$this->db->select('go_obat.kode_obat, go_obat.nama_obat, go_detailmasuk.jumlah_masuk, go_detailmasuk.no_batch, go_detailmasuk.expired, go_detailmasuk.id, go_detailmasuk.harga_satuan, go_obat.satuan_obat, go_detailmasuk.harga_satuan');
		$this->db->join('go_masuk','go_masuk.no_transaksi = go_detailmasuk.no_transaksi');
		$this->db->join('go_obat','go_obat.kode_obat = go_detailmasuk.kode_obat');
		$this->db->where('go_masuk.no_transaksi',$nota);
		$this->db->where('go_detailmasuk.delete','0');
		return $this->db->get();
	}


	function __query_get_data_nota()
	{
		$this->db->from('go_masuk');
		$this->db->select('go_masuk.no_transaksi, go_masuk.tgl_transaksi, go_masuk.no_faktur, go_masuk.penyerah, go_masuk.penerima, go_supplier.nama_supplier');
		$this->db->join('go_supplier','go_supplier.kode = go_masuk.kode_supplier');
		$this->input->post('tgl_transaksi')!=''? $this->db->where('go_masuk.tgl_transaksi',$this->input->post('tgl_transaksi')):'';
		$this->input->post('supplier')!=''? $this->db->where('go_masuk.kode_supplier',$this->input->post('supplier')):'';
		$this->input->post('no_faktur')!=''? $this->db->where('go_masuk.no_faktur',$this->input->post('no_faktur')):'';
		$this->input->post('penyerah')!=''? $this->db->where('go_masuk.penyerah',$this->input->post('penyerah')):'';
		$this->input->post('penerima')!=''? $this->db->where('go_masuk.penerima',$this->input->post('penerima')):'';
		$this->input->post('no_transaksi')!=''? $this->db->where('go_masuk.no_transaksi',$this->input->post('no_transaksi')):'';
	}	

	function count_all_rows_nota()
	{
		$this->db->from('go_masuk');
		return $this->db->count_all_results();
	}

	function count_filtered()
	{
		$this->__query_get_data_nota();
		return $this->db->get()->num_rows();
	}

	function get_data_nota()
	{
		$this->__query_get_data_nota();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		return $this->db->get();
	}

	function update_nota($data)
	{
		$this->db->where('no_transaksi',$this->input->post('no_transaksi'));
		return $this->db->update('go_masuk',$data);
	}

	function get_nota($nota)
	{
		$this->db->from('go_masuk');
		$this->db->join('go_supplier','go_supplier.kode = go_masuk.kode_supplier');
		$this->db->where('go_masuk.no_transaksi',$nota);
		$this->db->where('go_masuk.delete','0');
		return $this->db->get();
	}
	
}