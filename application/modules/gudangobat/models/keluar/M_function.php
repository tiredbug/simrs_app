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

	function simpan_nota($data)
	{
		return $this->db->insert('go_keluar',$data);
	}

	// cek rincian pada tabel detail masuk, untuk bisa dikeluarkan
	function cek_data_barang_masuk()
	{
		$this->db->where(array(
			'delete'		=>		'0',
			'kode_obat'		=>		$this->input->post('kode-obat'),
			'no_batch'		=>		$this->input->post('nobatch'),
			'expired'		=>		$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl')
			));
		return $this->db->get('go_detailmasuk');
	}


	function simpan_detail_keluar($id)
	{
		$data=array(
			'no_transaksi'		=>	$this->input->post('nota'),
			'id_barangmasuk	'	=>	$id,
			'jumlah_keluar'		=>	$this->input->post('jumlah'),
			);
		return $this->db->insert('go_detailkeluar',$data);
	}

	// mengambil data list barang keluar berdasarkan, nomor nota

	function get_data_detail_keluar($nota)
	{
		$this->db->from('go_detailkeluar');

		$this->db->select('go_detailkeluar.id, go_obat.kode_obat, go_obat.nama_obat, go_detailkeluar.jumlah_keluar, go_detailmasuk.no_batch, go_detailmasuk.expired, go_obat.satuan_obat');
		$this->db->join('go_detailmasuk','go_detailkeluar.id_barangmasuk = go_detailmasuk.id');
		$this->db->join('go_obat','go_obat.kode_obat = go_detailmasuk.kode_obat');

		$this->db->where('go_detailkeluar.no_transaksi',$nota);
		$this->db->where('go_detailkeluar.delete','0');
		return $this->db->get();
	}

	function hapus_list_item_keluar($id)
	{
		$this->db->where('id',$id);
		return $this->db->update('go_detailkeluar',array('delete'=>'1'));
	}

	function get_nota($nota)
	{
		$this->db->from('go_keluar');
		$this->db->join('go_client','go_client.kode_client = go_keluar.kode_client');
		$this->db->where('go_keluar.no_transaksi',$nota);
		return $this->db->get();
	}


	function __query_get_data_nota()
	{
		$this->db->from('go_keluar');
		$this->db->select('go_keluar.no_transaksi, go_keluar.tgl_transaksi, go_keluar.penyerah, go_keluar.penerima, go_client.unit_client');
		$this->db->join('go_client','go_client.kode_client = go_keluar.kode_client');
		$this->input->post('client')!=''? $this->db->where('go_keluar.kode_client',$this->input->post('client')):'';
		$this->input->post('no_transaksi')!=''? $this->db->where('go_keluar.no_transaksi',$this->input->post('no_transaksi')):'';
		$this->input->post('serah')!=''? $this->db->where('go_keluar.penyerah',$this->input->post('serah')):'';
		$this->input->post('terima')!=''? $this->db->where('go_keluar.penerima',$this->input->post('terima')):'';
		$this->input->post('bulan')!=''? $this->db->where('month(go_keluar.tgl_transaksi)',$this->input->post('bulan')):'';
		$this->input->post('tahun')!=''? $this->db->where('year(go_keluar.tgl_transaksi)',$this->input->post('tahun')):'';
		$this->input->post('tgl')!=''? $this->db->where('day(go_keluar.tgl_transaksi)',$this->input->post('tgl')):'';

	}	

	function count_all_rows_nota()
	{
		$this->db->from('go_keluar');
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
		return $this->db->update('go_keluar',$data);
	}

}