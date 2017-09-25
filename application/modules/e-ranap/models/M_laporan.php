<?php 
/**
* 
*/
class M_laporan extends ci_model
{
	
	function __query_get_laporan()
	{
		$bulan=$this->input->post('bulan')==''?date("m"):$this->input->post('bulan');
		$norek='';
		if($this->input->post('search[value]') !='')
		{
			$norek="AND pk.norekammedis IN('".$this->input->post('search[value]')."')";
		}
		return $q="SELECT
			pk.norekammedis nomr, ps.nama_lengkap nama, ps.jenis_kelamin jk, cb.nama_carabayar cb,
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
			WHERE MONTH(rk.tgl_masuk) IN('".$bulan."')
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

}