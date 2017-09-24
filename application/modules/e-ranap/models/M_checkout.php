<?php 
/**
* 
*/
class M_checkout extends ci_model
{


	function get_i_stt_ranap_keluar()
	{
		return $this->db->get('ranap_sttkeluar');
	}


	function get_i_kunjungan()
	{
		return $this->db->query("SELECT
								ps.nama_lengkap nama, ps.jenis_kelamin jk, rk.tgl_masuk, rk.jam_masuk, IFNULL(rk.tgl_keluar,DATE_FORMAT(NOW(),'%d-%m-%y')) tgl_keluar, IFNULL(rk.jam_keluar,DATE_FORMAT(NOW(),'%H:%i:%s')) jam_keluar,
								rk.cara_keluar ck
								FROM 
								ranap_kunjungan rk
								INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
								INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
								WHERE pk.status_kunjungan IN('Masih dirawat') AND rk.checkout IN('N')
								AND ps.nomor_rekammedis IN('".$_POST['nrm']."') AND rk.ruang IN('".$_SESSION['ruang']."')
								");
	}


	function cek_norek_pasien($norek)
	{
		return $this->db->query("SELECT * FROM pendaftaran_kunjungan pk 
								INNER JOIN ranap_kunjungan rk ON rk.no_kunjungan=pk.nomor_kunjungan

								WHERE 
								pk.status_kunjungan IN('Masih dirawat')
								AND rk.checkout IN('N')
								AND rk.ruang IN('".$_SESSION['ruang']."') 
								AND pk.norekammedis IN('".$norek."')
								");
	}


	function checkout_kunjungan($id)
	{
		$this->db->where('id_kunjungan',$id);
		return $this->db->update('ranap_kunjungan',array(
			'tgl_masuk'=>date("Y-m-d",strtotime($_POST['tgl_masuk'])),
			'jam_masuk'=>date("H:i:s",strtotime($_POST['jam_masuk'])),
			'tgl_keluar'=>date("Y-m-d",strtotime($_POST['tgl_keluar'])),
			'jam_keluar'=>date("H:i:s",strtotime($_POST['jam_keluar'])),
			'cara_keluar'=>$_POST['cara_keluar'],
			'checkout'=>'Y',
		));
	}



}