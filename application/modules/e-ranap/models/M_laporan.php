<?php 
/**
* 
*/
class M_laporan extends ci_model
{
	
	function __query_get_laporan()
	{
		$bulan=$this->input->post('bulan')==''?date("m"):$this->input->post('bulan');
		$tahun=$this->input->post('tahun')==''?date("Y"):$this->input->post('tahun');
		$norek='';
		if($this->input->post('search[value]') !='')
		{
			$norek="AND pk.norekammedis IN('".$this->input->post('search[value]')."')";
		}
		return $q="SELECT
			pk.norekammedis nomr, ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok) cb,
			kls.nama_kelasperawatan kls, kmr.nama_kamar kamar, bed.nomor_bed bed, CONCAT(DATE_FORMAT(rk.tgl_masuk,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_masuk,'%H:%i:%s')) tgl_masuk,
			CONCAT(DATE_FORMAT(rk.tgl_keluar,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_keluar,'%H:%i:%s')) tgl_keluar,
			stt.stt, rk.asal_masuk

			FROM 
			ranap_kunjungan rk
			INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
			INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
			LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
			LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
			LEFT JOIN admin_masterruanginapkamar kmr ON kmr.id_kamar=rk.kamar
			LEFT JOIN admin_masterruanginapkamarbed bed ON bed.id_bed=rk.bed
			LEFT JOIN ranap_sttkeluar stt ON stt.kode_stt=rk.cara_keluar
			LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok 
			WHERE MONTH(rk.tgl_masuk) IN('".$bulan."')
			AND YEAR(rk.tgl_masuk) IN('".$tahun."')
			AND rk.ruang='".$_SESSION['ruang']."' ".$norek;
	}

	function get_data_laporan_bulanan()
	{
		$q=$this->__query_get_laporan();
		if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_laporan()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($q);
	}


	function count_lap_bulanan_filtered()
	{
		return $this->db->query($this->__query_get_laporan())->num_rows();
	}

	function count_lap_bulanan_total()
	{
		$bulan=$this->input->post('bulan')==''?date("m"):$this->input->post('bulan');
		$tahun=$this->input->post('tahun')==''?date("Y"):$this->input->post('tahun');
		return $this->db->get_where('ranap_kunjungan',
			array(
				'ruang'=>$_SESSION['ruang'],
				"MONTH('tgl_masuk')"=>$bulan,
				"YEAR('tgl_masuk')"=>$tahun
			)
		)->num_rows();
	}



	function __query_get_laporan_harian()
	{
		$tgl=$this->input->post('tgl')==''?date("Y-m-d"):date("Y-m-d",strtotime($this->input->post('tgl')));
		$norek='';
		if($this->input->post('search[value]') !='')
		{
			$norek="AND pk.norekammedis IN('".$this->input->post('search[value]')."')";
		}
		return $q="SELECT
			pk.norekammedis nomr, ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok) cb,
			kls.nama_kelasperawatan kls, kmr.nama_kamar kamar, bed.nomor_bed bed, CONCAT(DATE_FORMAT(rk.tgl_masuk,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_masuk,'%H:%i:%s')) tgl_masuk,
			CONCAT(DATE_FORMAT(rk.tgl_keluar,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_keluar,'%H:%i:%s')) tgl_keluar,
			stt.stt, rk.asal_masuk

			FROM 
			ranap_kunjungan rk
			INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
			INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
			LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
			LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
			LEFT JOIN admin_masterruanginapkamar kmr ON kmr.id_kamar=rk.kamar
			LEFT JOIN admin_masterruanginapkamarbed bed ON bed.id_bed=rk.bed
			LEFT JOIN ranap_sttkeluar stt ON stt.kode_stt=rk.cara_keluar
			LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok 
			WHERE rk.tgl_masuk IN('".$tgl."') 
			AND rk.ruang='".$_SESSION['ruang']."' ".$norek;
	}

	function get_data_laporan_harian()
	{
		$q=$this->__query_get_laporan_harian();
		if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_laporan_harian()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($q);
	}


	function count_lap_harian_filtered()
	{
		return $this->db->query($this->__query_get_laporan_harian())->num_rows();
	}

	function count_lap_harian_total()
	{
		$tgl=$this->input->post('tgl')==''?date("Y-m-d"):date("Y-m-d",strtotime($this->input->post('tgl')));
		return $this->db->get_where('ranap_kunjungan',array('ruang'=>$_SESSION['ruang'],'tgl_masuk'=>$tgl))->num_rows();
	}



	function get_data_laporan_bulanan_format()
	{
		$bulan=$this->input->get('bulan')==''?date("m"):$this->input->get('bulan');
		$tahun=$this->input->get('tahun')==''?date("Y"):$this->input->get('tahun');
		
		$q="SELECT
			pk.norekammedis nomr, ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok) cb,
			kls.nama_kelasperawatan kls, kmr.nama_kamar kamar, bed.nomor_bed bed, CONCAT(DATE_FORMAT(rk.tgl_masuk,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_masuk,'%H:%i:%s')) tgl_masuk,
			CONCAT(DATE_FORMAT(rk.tgl_keluar,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_keluar,'%H:%i:%s')) tgl_keluar,
			stt.stt, rk.asal_masuk

			FROM 
			ranap_kunjungan rk
			INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
			INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
			LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
			LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
			LEFT JOIN admin_masterruanginapkamar kmr ON kmr.id_kamar=rk.kamar
			LEFT JOIN admin_masterruanginapkamarbed bed ON bed.id_bed=rk.bed
			LEFT JOIN ranap_sttkeluar stt ON stt.kode_stt=rk.cara_keluar
			LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok 
			WHERE MONTH(rk.tgl_masuk) IN('".$bulan."')
			AND YEAR(rk.tgl_masuk) IN('".$tahun."')
			AND rk.ruang='".$_SESSION['ruang']."' ";

		return $this->db->query($q);
	}


	function get_data_laporan_harian_format()
	{
		$tgl=$this->input->get('tgl')==''?date("Y-m-d"):date("Y-m-d",strtotime($this->input->get('tgl')));
		
		$q="SELECT
			pk.norekammedis nomr, ps.nama_lengkap nama, ps.jenis_kelamin jk, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok) cb,
			kls.nama_kelasperawatan kls, kmr.nama_kamar kamar, bed.nomor_bed bed, CONCAT(DATE_FORMAT(rk.tgl_masuk,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_masuk,'%H:%i:%s')) tgl_masuk,
			CONCAT(DATE_FORMAT(rk.tgl_keluar,'%d-%m-%Y'),' ',DATE_FORMAT(rk.jam_keluar,'%H:%i:%s')) tgl_keluar,
			stt.stt, rk.asal_masuk

			FROM 
			ranap_kunjungan rk
			INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.no_kunjungan
			INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
			LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
			LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
			LEFT JOIN admin_masterruanginapkamar kmr ON kmr.id_kamar=rk.kamar
			LEFT JOIN admin_masterruanginapkamarbed bed ON bed.id_bed=rk.bed
			LEFT JOIN ranap_sttkeluar stt ON stt.kode_stt=rk.cara_keluar
			LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok 
			WHERE rk.tgl_masuk IN('".$tgl."') 
			AND rk.ruang='".$_SESSION['ruang']."' ";
		return $this->db->query($q);
	}


}