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

	function get_data_penerimaan()
	{
		$this->db->select('go_detailmasuk.id, go_obat.nama_obat, go_obat.satuan_obat, go_detailmasuk.kode_obat, go_detailmasuk.jumlah_masuk, go_detailmasuk.jumlah_keluar, go_detailmasuk.stok');
		$this->db->from('go_detailmasuk');
		$this->db->join('go_obat','go_obat.kode_obat=go_detailmasuk.kode_obat');
		$this->db->where(array(
			'go_detailmasuk.no_transaksi'=>$this->input->post('notamasuk'),
			'go_detailmasuk.delete'=>'0'
			));
		return $this->db->get();
	}


	function savereturn($data)
	{
		$this->db->trans_start();
		$this->db->insert('go_return',
			array(
				'no_transaksi'		=>	$this->input->post('nota'),
				'nota_masuk'		=>	$this->input->post('notamasuk'),
				'tgl_return'		=>	$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl'),
				'penyerah'			=>	$this->input->post('serah'),
				'penerima'			=>	$this->input->post('terima'),
				'keterangan_lain'	=>	$this->input->post('keterangan')
				)
			);
		$this->db->insert_batch('go_detailreturn',$data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function max_id_return()
	{
		$this->db->select_max('id');
		$id=$this->db->get('go_detailreturn')->row_array();
		return $id['id'];
	}

	// fungsi untuk mengambil data nota transaksi
	function __query_get_nota()
	{
		$this->db->from('go_return');
		$this->db->select('go_return.no_transaksi as nota, go_masuk.no_transaksi as nota_masuk, go_masuk.no_faktur, go_return.penyerah, go_return.penerima, go_return.tgl_return');
		$this->db->join('go_masuk','go_masuk.no_transaksi = go_return.nota_masuk');
		$this->input->post('nota')!=''?$this->db->where('go_return.no_transaksi',$this->input->post('nota')):'';
		$this->input->post('tgl')!=''?$this->db->where('day(go_return.tgl_return)',$this->input->post('tgl')):'';
		$this->input->post('bln')!=''?$this->db->where('month(go_return.tgl_return)',$this->input->post('bln')):'';
		$this->input->post('tahun')!=''?$this->db->where('year(go_return.tgl_return)',$this->input->post('tahun')):'';
	}

	// mengambil data, sesuai dengan parameter limit
	function get_data_nota()
	{
		$this->__query_get_nota();
		if($this->input->post('length') != -1)
		{
			$this->db->limit($this->input->post('length'),$this->input->post('start'));
		}
		return $this->db->get();
	}


	function count_all_rows_nota()
	{
		$this->db->from('go_return');
		return $this->db->count_all_results();
	}

	function count_filtered()
	{
		$this->__query_get_nota();
		return $this->db->get()->num_rows();
	}


	function cek_nota($nota)
	{
		$this->db->from('go_return');
		$this->db->select('go_return.no_transaksi, go_return.tgl_return, go_return.penyerah, go_return.penerima, go_return.nota_masuk, go_return.keterangan_lain, go_supplier.nama_supplier, go_masuk.no_faktur');
		$this->db->join('go_masuk','go_return.nota_masuk = go_masuk.no_transaksi');
		$this->db->join('go_supplier','go_masuk.kode_supplier = go_supplier.kode');
		$this->db->where('go_return.no_transaksi',$nota);
		return $this->db->get();
	}

	function get_detail_return($nota)
	{
		$this->db->from('go_detailreturn');
		$this->db->select('go_obat.kode_obat, go_obat.nama_obat, go_detailmasuk.no_batch, go_detailmasuk.expired, go_obat.satuan_obat, go_detailreturn.jumlah_return');
		$this->db->join('go_detailmasuk','go_detailmasuk.id=go_detailreturn.id_masuk');
		$this->db->join('go_obat','go_obat.kode_obat = go_detailmasuk.kode_obat');
		$this->db->where('go_detailreturn.no_transaksi',$nota);
		return $this->db->get();
	}
}