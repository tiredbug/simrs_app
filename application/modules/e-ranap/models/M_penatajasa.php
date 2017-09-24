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
								rk.kelas, rk.kamar, rk.bed, pk.tgl_daftar tgldaftar
								FROM 
								ranap_kunjungan rk 
								INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
								INNER JOIN admin_masterruanganinap mr ON mr.id_ruangan=rk.ruang
								LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis

								WHERE pk.status_kunjungan IN('Masih dirawat')
								AND rk.ruang IN('".$_SESSION['ruang']."')
								AND rk.checkout IN('N')
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
		$this->db->where(array('id_ruangan'=>$r,'id_kelas'=>$kls));
		return $this->db->get('admin_masterruanginapkamar');
	}

	function get_i_bed($kmr)
	{
		$this->db->select('id_bed, nomor_bed');
		$this->db->where(array('id_kamar'=>$kmr,'status_bed'=>'Y'));
		return $this->db->get('admin_masterruanginapkamarbed');
	}

	function get_i_all_bed($kmr)
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


	function cek_kunjungan($id)
	{
		$this->db->where(array(
			'id_kunjungan'=>$id,
			'checkout'=>'N'
		));
		return $this->db->get('ranap_kunjungan');
	}

	function pindah_ruangan()
	{
		$this->db->trans_start();
		$this->db->insert('ranap_kunjungan',array(
			'no_kunjungan'=>$_POST['nokunjungan'],
			'ruang'=>$_POST['ruangan_p'],
			'kelas'=>$_POST['kelas_p'],
			'kamar'=>$_POST['kamar_p'],
			'bed'=>$_POST['bed_p'],
			'tgl_masuk'=>date("Y-m-d",strtotime($_POST['tgl_keluar'])),
			'jam_masuk'=>date("H:i:s",strtotime($_POST['jam_keluar'])),
			'asal_masuk'=>$_POST['ruangan_s']
		));

		$this->db->where('id_kunjungan',$_POST['id_kunjungan']);
		$this->db->update('ranap_kunjungan',array(
			'tgl_keluar'=>date("Y-m-d",strtotime($_POST['tgl_keluar'])),
			'jam_keluar'=>date("H:i:s",strtotime($_POST['jam_keluar'])),
			'cara_keluar'=>'1',
			'checkout'=>'Y'
		));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function get_i_t()
	{
		return $this->db->query("SELECT t_r.nama_tarif, t_r.group_tindakan, IFNULL(d_t.total_tarif,0) tarif FROM admin_tarifranap t_r
								LEFT JOIN(
												SELECT 
												* 
												FROM admin_tarifranapdetail t_d
												WHERE t_d.tgl_berlaku<='".$this->input->post('i_tgldaftar_fpj')."' 
												AND t_d.kode_kelas IN('".$this->input->post('i_kelas_fpj')."')
												AND t_d.kode_tarif IN('".$this->input->post('kode')."')
												ORDER BY t_d.tgl_berlaku DESC LIMIT 1) d_t ON t_r.kode_tarif=d_t.kode_tarif
								WHERE t_r.kode_tarif IN('".$this->input->post('kode')."') ");
	}

	function search_dokter($like,$jenis)
	{
		return $this->db->query("SELECT 
								kode_dokter id, CONCAT(dr.nama_belakang,'. ',dr.nama_dokter,IF(dr.gelar!='',CONCAT(', ',dr.gelar),'')) slug
								FROM admin_masterdokter dr
								WHERE dr.nama_dokter LIKE '%".$like."%'
								AND dr.jenis_dokter='".$jenis."'");
	}


	function insert_tindakan($tarif)
	{
		return $this->db->insert('ranap_tindakan',array(
			'id_kunjunganranap'=>$_POST['id'],
			'tgl_tindakan'=>date("Y-m-d",strtotime($_POST['tgl_tindakan'])),
			'dokter'=>$_POST['dokter_vis'],
			'kode_tarif'=>$_POST['kode'],
			'qty_tindakan'=>$_POST['qty'],
			'tarif_satuan'=>$tarif,
			'tarif_total'=>$tarif*$_POST['qty']
		));
	}


	function load_data_penata_jasa()
	{
		return $this->db->query("SELECT
							rt.id id, DATE_FORMAT(rt.tgl_tindakan,'%d-%m-%Y') tgl, rt.kode_tarif kode, tr.nama_tarif tindakan,
							IF(tr.group_tindakan='vis_s' OR tr.group_tindakan='vis_u',
							CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar!='',CONCAT(', ',dok.gelar),''))
							,'-') dokter,
							rt.qty_tindakan qty, CONCAT('Rp. ',FORMAT(rt.tarif_satuan,0,'de_DE')) tarif, 
							CONCAT('Rp. ',FORMAT(rt.tarif_total,0,'de_DE')) total
							FROM 
							ranap_tindakan rt
							INNER JOIN admin_tarifranap tr ON tr.kode_tarif=rt.kode_tarif
							LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=rt.dokter
							WHERE rt.id_kunjunganranap IN('".$this->input->post('id')."')");
	}


	function total_penata_jasa()
	{
		return $this->db->query("SELECT CONCAT('Rp. ',FORMAT(SUM(a.tarif_total),0,'de_DE')) total FROM ranap_tindakan a WHERE a.id_kunjunganranap IN('".$this->input->post('id')."')");
	}

	function hapus_tindakan()
	{
		$this->db->where('id',$this->input->post('id'));
		return $this->db->delete('ranap_tindakan');
	}
	
}