<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model{

	function __query_get_data_kunjungan()
	{
		$date=date("Y-m-d");
		$s='';
		$poli='';

		// apabila difilter dengan tanggal
		if($this->input->post('tgl')!='' && $this->input->post('bln')!='' && $this->input->post('tahun')!='')
		{
			$date=$this->input->post('tahun').'-'.$this->input->post('bln').'-'.$this->input->post('tgl');
		}
		// end
		
		// apabila diketikkan dikolom pencarian
		if($this->input->post("search[value]") !='')
		{
			$s=" AND (a.norekammedis = ".$this->input->post("search[value]").")";
		}
		// end
		// // apabila difilter denan nama_poliklinik
		if($this->input->post('poli') !='')
		{
			$poli="AND ( e.id_poliklinik = ".$this->input->post('poli').")";
		}
		// end
		$query="
			SELECT 
			a.norekammedis, a.nomor_kunjungan, a.nomor_sep, a.status_kunjungan, a.tgl_daftar, a.jam_daftar,
			b.nama_lengkap,
			c.nama_carabayar,
			e.nama_poliklinik

			FROM
			pendaftaran_kunjungan a 

			LEFT JOIN pendaftaran_pasien b ON a.norekammedis = b.nomor_rekammedis 
			LEFT JOIN admin_mastercarabayar c ON a.kode_carabayar = c.id_carabayar
			LEFT JOIN rajal_kunjungan d ON d.nomor_kunjungan=a.nomor_kunjungan
			LEFT JOIN admin_masterpoliklinik e ON e.id_poliklinik=d.kode_poliklinik
			WHERE (a.tgl_daftar ='".$date."'
			AND a.jenis_kunjungan='Rajal') ".$s." $poli
		";
		return $query;
	}

	function get_data_kunjungan()
	{
		$query=$this->__query_get_data_kunjungan();
		if($this->input->post('length')!=-1)
		{
			$query=$this->__query_get_data_kunjungan()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
		}
		return $this->db->query($query);
	}

	function count_record_filtered()
	{
		$q=$this->__query_get_data_kunjungan();
		return $this->db->query($q)->num_rows();
	}

	function count_all_reccord()
	{
		$this->db->where("jenis_kunjungan",'Rajal');
		return $this->db->get('pendaftaran_kunjungan')->num_rows();
	}
}