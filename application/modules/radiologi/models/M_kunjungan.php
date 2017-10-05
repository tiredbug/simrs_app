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
			'unit_rajal'=>$_POST['asal']=='rajal'?$_POST['unit']:'',
			'unit_ranap'=>$_POST['asal']=='inap'?$_POST['unit']:'',
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

	function __query_get_data_radiologi_kunjungan()
	{
		$w=$this->input->post('search[value]')!=''?" AND ps.nomor_rekammedis IN('".$this->input->post('search[value]')."')":'';
		return $q="SELECT
			ps.nomor_rekammedis nomr, pk.nomor_kunjungan no_k, rk.nomor_rad norad,
			ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(rk.tgl_register,' ',rk.jam_register) tgl_order,
			IFNULL(CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))),rk.asal) dokter_pengirim,
			CONCAT(dok_p.nama_belakang,'. ',dok_p.nama_dokter,IF(dok_p.gelar='','',CONCAT(', ',dok_p.gelar))) dokter_p,
			us.nama_lengkap n_user,
			(CASE
				WHEN rk.asal='rajal' THEN CONCAT('Poli ',poli.nama_poliklinik)
				WHEN rk.asal='inap' THEN CONCAT('R. ',rg.nama_ruangan)
				ELSE rk.asal
			END) unit
			FROM
			radiologi_kunjungan rk
			LEFT JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
			LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
			LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=rk.dokter_pengirim
			LEFT JOIN admin_masterdokter dok_p ON dok_p.kode_dokter=rk.dokter_piket
			LEFT JOIN radiologi_users us ON us.kode_user=rk.petugas_register
			LEFT JOIN admin_masterpoliklinik poli ON poli.id_poliklinik=rk.unit_rajal
			LEFT JOIN admin_masterruanganinap rg ON rg.id_ruangan=rk.unit_ranap
			WHERE rk.checkout IN('N')".$w;
	}


	function get_data_radiologi_kunjungan()
	{
		$query=$this->__query_get_data_radiologi_kunjungan();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_data_radiologi_kunjungan()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
	}


	function count_filtered_row()
	{
		return $this->db->query($this->__query_get_data_radiologi_kunjungan())->num_rows();
	}

	function count_all_row()
	{
		return $this->db->query("SELECT * FROM radiologi_kunjungan rk WHERE rk.checkout IN('N')")->num_rows();
	}

	function get_detail_i_kunjungan($q)
	{
		return $this->db->query("SELECT
							pk.nomor_kunjungan no_k, CONCAT(pk.tgl_daftar,' ',pk.jam_daftar) tgl_daftar, 
							CONCAT(cb.nama_carabayar,' - ',klp.nama_kelompok) cb, cr.nama_cararujuk c_r, pk.asal_rujukan asal_rujuk,
							pk.nomor_rujukan no_r, kls.nama_kelasperawatan kls, CONCAT(pk.diagnosa,'-',icd.SUB) icd,
							pk.nomor_sep sep, pk.jenis_pasien j_p, CONCAT(pk.umur_tahun,'thn ',pk.umur_bulan,'bln ',pk.umur_hari,'hri') umur,
							ps.nomor_rekammedis norek, ps.nomor_nik nik, ps.nomor_asuransi no_as, ps.nama_lengkap nama,
							ps.jenis_kelamin jk, ag.agama, ps.agama ag, CONCAT(ps.tp_lahir,'/',DATE_FORMAT(ps.tgl_lahir,'%d-%m-%Y')) tp_tgllahir,
							ps.status_pasien stt, ps.hp_pasien, ps.alamat_ktp
							FROM 
							radiologi_kunjungan rk
							LEFT JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
							LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
							LEFT JOIN admin_mastercarabayarklp klp ON klp.id_carabayar=pk.kode_kelompok
							LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
							LEFT JOIN admin_mastericdx icd ON icd.KODE=pk.diagnosa
							LEFT JOIN admin_mastercararujuk cr ON cr.id_cararujuk=pk.kode_cararujuk
							LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
							LEFT JOIN admin_masteragama ag ON ag.id=ps.agama
							WHERE rk.nomor_rad IN('".$q."')");
	}

	function checkout_kunjungan()
	{
		$this->db->where('nomor_rad',$this->input->post('id'));
		return $this->db->update('radiologi_kunjungan',array('checkout'=>'Y'));
	}


	function get_periksa($id)
	{
		return $this->db->query("SELECT
								p.tindakan
								FROM
								radiologi_billing bil
								LEFT JOIN radiologi_produks p ON p.kode_tindakan=bil.kode_produk
								WHERE bil.no_rad IN('".$id."')");
	}


	

}