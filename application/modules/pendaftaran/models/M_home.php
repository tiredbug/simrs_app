<?php 

class M_home extends CI_Model{

	function get_i_statistik_kunjungan()
	{
		return $this->db->query("SELECT rk.kode_poliklinik k_pli,pl.nama_poliklinik poli, count(pk.nomor_kunjungan) jumlah FROM pendaftaran_kunjungan pk
INNER JOIN rajal_kunjungan rk ON rk.nomor_kunjungan=pk.nomor_kunjungan
INNER JOIN admin_masterpoliklinik pl ON pl.id_poliklinik=rk.kode_poliklinik
WHERE pk.jenis_kunjungan IN('Rajal')
GROUP BY rk.kode_poliklinik");
	}
}
