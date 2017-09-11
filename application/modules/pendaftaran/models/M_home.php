<?php 

class M_home extends CI_Model{

	function get_i_statistik_kunjungan()
	{
		$tgl=$_GET['tgl']!=''?date("Y-m-d",strtotime($_GET['tgl'])):date("Y-m-d");
		
		return $this->db->query("SELECT 
								pli.nama_poliklinik poli, IFNULL(jn.jumlah,0) jumlah
								FROM admin_masterpoliklinik pli
								LEFT JOIN (
								SELECT rk.kode_poliklinik k_pli, count(pk.nomor_kunjungan) jumlah FROM pendaftaran_kunjungan pk
								INNER JOIN rajal_kunjungan rk ON rk.nomor_kunjungan=pk.nomor_kunjungan
								INNER JOIN admin_masterpoliklinik pl ON pl.id_poliklinik=rk.kode_poliklinik
								WHERE pk.jenis_kunjungan IN('Rajal') AND pk.tgl_daftar IN('".$tgl."')
								GROUP BY rk.kode_poliklinik) jn ON jn.k_pli=pli.id_poliklinik");
	}
}
