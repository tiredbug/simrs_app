<?php
/**
* 
*/
class M_function extends ci_model
{
	function __query_get_kontrol_stok()
	{
		// $this->db->from('go_obat');
		// $this->db->select('kode_obat, nama_obat, satuan_obat, jumlah_masuk, jumlah_keluar, jumlah_return, (jumlah_masuk-jumlah_keluar-jumlah_return) as stok, round((100/jumlah_masuk)*(jumlah_masuk-jumlah_keluar-jumlah_return)) as persen, stok-persen');
		// $this->db->where('delete','0');
		$persen=$this->input->post('persen')==''?'b.persen <= 30':'b.persen < '.$this->input->post('persen');
		return ("SELECT * FROM (SELECT
								kode_obat AS kode, 
								nama_obat AS obat,
								satuan_obat as satuan, 
								jumlah_masuk AS masuk, 
								jumlah_keluar AS keluar, 
								jumlah_return AS r, 
								(jumlah_masuk - jumlah_keluar - jumlah_return) AS stok, 
								ROUND( ( 100 / jumlah_masuk ) * ( jumlah_masuk - jumlah_keluar - jumlah_return ) ) AS persen
								FROM go_obat as a
								WHERE a.delete='0'
								) as b
							WHERE
							$persen 
							");
	}

	function get_data_stok()
	{
		$limit='';
		if($_POST['length'] != -1)
		{
			$limit=" LIMIT ".$_POST['start'].", ".$_POST['length'];
		}
		return $this->db->query($this->__query_get_kontrol_stok().$limit);
	}

	function count_all_rows_stok()
	{
		$this->db->where('delete','0');
		$this->db->from('go_obat');
		return $this->db->count_all_results();
	}

	function count_filtered_stok()
	{
		return $this->db->query($this->__query_get_kontrol_stok())->num_rows();
	}



	// proses pemeriksaan data tgl expired
	function __query_get_kontrol_expired()
	{
		$ex='';
		$before='';
		$default='';
		$a='';
		if($this->input->post('tahun')!='' && $this->input->post('bln')!='')
		{
			$ex="AND month(a.expired)='".$this->input->post('bln')."' AND year(a.expired)='".$this->input->post('tahun')."'";
		}
		if($this->input->post('expired')!='')
		{
			$before="AND a.expired < DATE_FORMAT((INTERVAL ".$this->input->post('expired')." MONTH + CURDATE()),'%Y-%m-%d')";
		}
		if($ex=='' && $before=='')
		{
			$default="AND a.expired < DATE_FORMAT((INTERVAL 3 MONTH + CURDATE()),'%Y-%m-%d')";
		}
		return ("
			SELECT 
			d.kode_obat as kode,
			d.nama_obat as barang,
			a.no_transaksi as nota,
			b.tgl_transaksi as tgl,
			c.nama_supplier as suplier,
			b.no_faktur as faktur,
			a.expired as expired

			FROM 
			go_detailmasuk as a 
			join go_masuk as b
			join go_supplier as c
			join go_obat as d

			WHERE
			a.no_transaksi = b.no_transaksi
			AND b.kode_supplier = c.kode
			AND a.kode_obat = d.kode_obat
			".$ex.' '.$before.' '.$default);
	}


	function get_data_expired()
	{
		$limit='';
		if($_POST['length'] != -1)
		{
			$limit=" LIMIT ".$_POST['start'].", ".$_POST['length'];
		}
		return $this->db->query($this->__query_get_kontrol_expired().$limit);
	}

	function count_all_rows_expired()
	{
		$this->db->where('delete','0');
		$this->db->from('go_detailmasuk');
		return $this->db->count_all_results();
	}

	function count_filtered_expired()
	{
		return $this->db->query($this->__query_get_kontrol_expired())->num_rows();
	}

}