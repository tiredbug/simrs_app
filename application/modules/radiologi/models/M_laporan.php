<?php
/**
* 
*/
class M_laporan extends ci_model
{
	
	function __query_get_data_laporan_harian_radiologi()
	{
		$w=$this->input->post('search[value]')!=''?" AND ps.nomor_rekammedis IN('".$this->input->post('search[value]')."')":'';
		$tgl=$this->input->post('tgl')!=''?" AND rk.tgl_register IN('".date("Y-m-d",strtotime($this->input->post('tgl')))."')":"AND rk.tgl_register IN('".date("Y-m-d")."')";
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
			WHERE rk.checkout IN('N')".$w.$tgl;
	}

	function get_data_laporan_harian_radiologi()
	{
		$query=$this->__query_get_data_laporan_harian_radiologi();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_data_laporan_harian_radiologi()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
	}

	function count_filtered_laporan_harian()
	{
		return $this->db->query($this->__query_get_data_laporan_harian_radiologi())->num_rows();
	}

	function count_total_laporan_harian()
	{
		$tgl=$this->input->post('tgl')!=''?date("Y-m-d",strtotime($this->input->post('tgl'))):date("Y-m-d");
		$this->db->where('tgl_register',$tgl);
		return $this->db->get('radiologi_kunjungan')->num_rows();
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

	function get_data_laporan_harian_pdf()
	{
		$tgl=$this->input->get('tgl')!=''?" AND rk.tgl_register IN('".date("Y-m-d",strtotime($this->input->get('tgl')))."')":"AND rk.tgl_register IN('".date("Y-m-d")."')";
		$q="SELECT
			ps.nomor_rekammedis nomr, pk.nomor_kunjungan no_k, rk.nomor_rad norad,
			ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(rk.tgl_register,' ',rk.jam_register) tgl_order,
			IFNULL(CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))),rk.asal) dokter_pengirim,
			CONCAT(dok_p.nama_belakang,'. ',dok_p.nama_dokter,IF(dok_p.gelar='','',CONCAT(', ',dok_p.gelar))) dokter_p,
			us.nama_lengkap n_user, rk.asal,
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
			WHERE rk.checkout IN('N')".$tgl;
		return $this->db->query($q);
	}




	function __query_get_data_laporan_bulanan_radiologi()
	{
		$w=$this->input->post('search[value]')!=''?" AND ps.nomor_rekammedis IN('".$this->input->post('search[value]')."')":'';
		$bulan=$this->input->post('bulan')==''?date("m"):$this->input->post('bulan');
		$tahun=$this->input->post('tahun')==''?date("Y"):$this->input->post('tahun');

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
			WHERE MONTH(rk.tgl_register) IN('".$bulan."') AND YEAR(rk.tgl_register) IN('".$tahun."')".$w;
	}

	function get_data_laporan_bulanan_radiologi()
	{
		$query=$this->__query_get_data_laporan_bulanan_radiologi();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_data_laporan_bulanan_radiologi()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
	}

	function count_filtered_laporan_bulanan()
	{
		return $this->db->query($this->__query_get_data_laporan_bulanan_radiologi())->num_rows();
	}

	function count_total_laporan_bulanan()
	{
		$bulan=$this->input->post('bulan')==''?date("m"):$this->input->post('bulan');
		$tahun=$this->input->post('tahun')==''?date("Y"):$this->input->post('tahun');
		return $this->db->query("SELECT * FROM radiologi_kunjungan rk WHERE MONTH(rk.tgl_register) IN('".$bulan."') AND YEAR(rk.tgl_register) IN('".$tahun."')")->num_rows();
	}

	function get_data_laporan_bulanan_format()
	{
		$bulan=$this->input->get('bulan')==''?date("m"):$this->input->get('bulan');
		$tahun=$this->input->get('tahun')==''?date("Y"):$this->input->get('tahun');

		$q="SELECT
			ps.nomor_rekammedis nomr, pk.nomor_kunjungan no_k, rk.nomor_rad norad,
			ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(rk.tgl_register,' ',rk.jam_register) tgl_order,
			IFNULL(CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))),rk.asal) dokter_pengirim,
			CONCAT(dok_p.nama_belakang,'. ',dok_p.nama_dokter,IF(dok_p.gelar='','',CONCAT(', ',dok_p.gelar))) dokter_p,
			us.nama_lengkap n_user, rk.asal,
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
			WHERE MONTH(rk.tgl_register) IN('".$bulan."') AND YEAR(rk.tgl_register) IN('".$tahun."')";
		return $this->db->query($q);
	}

}