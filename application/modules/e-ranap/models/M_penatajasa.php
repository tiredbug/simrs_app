<?php
/**
* 
*/
class M_penatajasa extends ci_model
{
	function get_informasi_kunjungan($norek)
	{
		return $this->db->query("SELECT
								rk.id_kunjungan id, pk.norekammedis norek, pk.nomor_kunjungan no_kunjungan, ps.nama_lengkap nama,
								ps.jenis_kelamin jk, ps.alamat_ktp alamat, pk.kode_carabayar cb, pk.kode_kelompok klp, rk.ruang, 
								rk.kelas, rk.kamar, rk.bed
								FROM 
								ranap_kunjungan rk 
								INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
								INNER JOIN admin_masterruanganinap mr ON mr.id_ruangan=rk.ruang
								LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis

								WHERE pk.status_kunjungan IN('Masih dirawat')
								AND rk.ruang IN('1')
								AND pk.norekammedis IN('".$norek."')");
	}

	function get_i_cb()
	{
		return $this->db->get('admin_mastercarabayar');
	}

	function get_i_klp($cb)
	{
		$this->db->where('id_carabayar',$cb);
		return $this->db->get('admin_mastercarabayarklp');
	}

	function get_i_r()
	{
		return $this->db->get('admin_masterruanganinap');
	}

	function get_i_kls()
	{
		return $this->db->get('admin_masterkelasperawatan');
	}

	function get_i_kmr($r,$kls)
	{
		$this->db->select('id_kamar, nama_kamar');
		$this->db->where(array('id_ruangan'=>$r,'id_ruangan'=>$kls));
		return $this->db->get('admin_masterruanginapkamar');
	}

	function get_i_bed($kmr)
	{
		$this->db->select('id_bed, nomor_bed');
		$this->db->where('id_kamar',$kmr);
		return $this->db->get('admin_masterruanginapkamarbed');
	}

	function update_ruangan()
	{
		$this->db->trans_start();
		$this->db->where('id_kunjungan',$_POST['i_id']);
		$this->db->update("ranap_kunjungan",array(
			'ruang'=>$_POST['ruang'],
			'kelas'=>$_POST['kelas'],
			'kamar'=>$_POST['kamar'],
			'bed'=>$_POST['bed']
			));

		$this->db->where('nomor_kunjungan',$_POST['i_nokunjungan']);
		$this->db->update('pendaftaran_kunjungan',array(
			'kode_carabayar'=>$_POST['cb'],
			'kode_kelompok'=>$_POST['klp']
			));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
}