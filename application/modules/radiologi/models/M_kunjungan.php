<?php 
/**
* 
*/
class M_kunjungan extends ci_model
{
	
	function get_dokter_radiologi()
	{
		return $this->db->query("SELECT
								rd.kode_dokter kode, CONCAT(md.nama_belakang,'. ',md.nama_dokter,IF(md.gelar='','',CONCAT(', ',md.gelar)))dokter
								FROM
								radiologi_dokter rd
								INNER JOIN admin_masterdokter md ON md.kode_dokter=rd.kode_dokter
								WHERE rd.aktif IN('Y')");
	}

	function cek_kunjungan_rad($norek,$asal)
	{
		return $this->db->query("SELECT
						a.nomor_kunjungan, b.nama_lengkap, b.nomor_nik, b.nomor_asuransi, b.jenis_kelamin, b.alamat_ktp,
						c.nama_carabayar, d.nama_kelurahan, e.nama_kecamatan, f.nama_kota, g.nama_provinsi
						FROM 
						pendaftaran_kunjungan a
						LEFT JOIN pendaftaran_pasien b ON b.nomor_rekammedis=a.norekammedis
						LEFT JOIN admin_mastercarabayar c ON a.kode_carabayar=c.id_carabayar
						LEFT JOIN admin_masterdesa d ON d.id_kelurahan=b.kode_desa
						LEFT JOIN admin_masterkecamatan e ON e.id_kecamatan=b.kode_kecamatan
						LEFT JOIN admin_masterkabupaten f ON f.id_kota=b.kode_kabupaten
						LEFT JOIN admin_masterprovinsi g ON g.id_provinsi=b.kode_provinsi
						WHERE
						a.jenis_kunjungan='".$asal."'
						AND a.status_kunjungan='Masih dirawat'
						AND a.norekammedis='".$norek."'");
	}


	function get_tab_head()
	{
		return $this->db->get('radiologi_groupproduk');
	}

	function get_tab_conten($id)
	{
		return $this->db->query("SELECT
								rp.kode_tindakan, rp.tindakan, CONCAT('Rp. ',FORMAT(rp.tarif,0)) tarif
								FROM
								radiologi_produks rp
								WHERE rp.`group` IN('".$id."')");
	}


	function get_dokter_igd($norek)
	{
		return $this->db->query("SELECT
								dok.kode_dokter kode,CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))) dokter
								FROM pendaftaran_kunjungan pk
								INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=pk.nomor_kunjungan
								LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
								WHERE pk.status_kunjungan IN('Masih dirawat')
								AND pk.norekammedis IN('".$norek."')");
	}

	function get_poli()
	{
		return $this->db->query('SELECT 
								mp.id_poliklinik id, mp.nama_poliklinik unit
								FROM
								admin_masterpoliklinik mp');
	}

	function get_ruang()
	{
		return $this->db->query('SELECT 
							mr.id_ruangan id, mr.nama_ruangan unit
							FROM
							admin_masterruanganinap mr');
	}

	function get_dokter()
	{
		return $this->db->query("SELECT
								dok.kode_dokter kode, CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))) dokter
								FROM
								admin_masterdokter dok
								");
	}


	function cek_stt_check($kode,$norek)
	{
		$data=array(
			'norek'=>$norek,
			'kode'=>$kode,
			'sesi'=>$_SESSION['__ci_last_regenerate'],
			'id_user'=>$_SESSION['kode_user']
			);
		return $this->db->get_where('radiologi_cart',$data);
	}

	function register_kunjungan()
	{
		$cek_billing=$this->max_billing();
		$cek_norad=$this->max_rad();

		$no_billing=$cek_billing['no_billing']+1;
		$no_rad=$cek_norad['nomor_rad']+1;

		$this->db->trans_start();
		$q=$this->db->query("SELECT
							rc.kode, p.tarif
							FROM radiologi_cart rc
							INNER JOIN radiologi_produks p ON p.kode_tindakan=rc.kode
							WHERE rc.sesi IN('".$_SESSION['__ci_last_regenerate']."')
							AND rc.id_user IN('".$_SESSION['kode_user']."')
							AND rc.norek IN('".$_POST['norek']."')");
		$bill=$no_billing;
		$rad=$no_rad;
		foreach ($q->result() as $c) {
			# code...
			$this->db->insert('radiologi_billing',array(
				'no_billing'=>$bill,
				'no_rad'=>$rad,
				'kode_produk'=>$c->kode,
				'tarif'=>$c->tarif
			));
			$bill++;
		}

		$this->db->query("DELETE FROM radiologi_cart 
							WHERE sesi IN('".$_SESSION['__ci_last_regenerate']."')
							AND id_user IN('".$_SESSION['kode_user']."')
							AND norek IN('".$_POST['norek']."')");

		$this->db->insert('radiologi_kunjungan',array(
			'nomor_rad'=>$no_rad,
			'no_kunjungan'=>$_POST['no_kunjungan'],
			'tgl_register'=>date("Y-m-d",strtotime($_POST['tgl_permintaan'])),
			'jam_register'=>$_POST['jam_daftar'],
			'dokter_pengirim'=>$_POST['dokter'],
			'dokter_piket'=>$_POST['dokterp'],
			'petugas_register'=>$_SESSION['kode_user'],
			'unit'=>$_POST['unit'],
			'asal'=>$_POST['asal']
		));
		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	function max_rad()
	{
		$this->db->select_max('nomor_rad');
        return $this->db->get('radiologi_kunjungan')->row_array();
	}

	function max_billing()
	{
		$this->db->select_max('no_billing');
        return $this->db->get('radiologi_billing')->row_array();
	}
}