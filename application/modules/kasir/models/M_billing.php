<?php
/**
* 
*/
class M_billing extends ci_model
{
	
	function get_head($billing)
	{
		return $this->db->query("SELECT
				ps.nomor_rekammedis norek, ps.nama_lengkap nama, ps.jenis_kelamin jk, ps.alamat_ktp,
				kb.no_billing bill, kb.no_kunjungan no_k, kb.pasien pl, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok,'(',kls.nama_kelasperawatan,')') cb,
				CONCAT(DATE_FORMAT(pk.tgl_daftar,'%m-%d-%Y'),' s/d ',DATE_FORMAT(ik.tgl_masuk,'%m-%d-%Y')) tgl, kb.tagihan, kb.piutang
				FROM
				kasir_billing kb
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=kb.no_kunjungan
				INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=pk.nomor_kunjungan
				LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
				LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok
				LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=pk.kode_kelas
				WHERE kb.no_billing IN('".$billing."')");
	}

	function get_tindakan_igd($no_kunjungan)
	{
		return $this->db->query("SELECT 
						CONCAT(tr.kode_tarif,' - ',tr.nama_tarif) tr, it.tarif, it.qty, it.total
						FROM 
						igd_tindakan it
						LEFT JOIN admin_tarifigd tr ON tr.kode_tarif=it.kode_tindakan
						INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=it.nokunjungan
						WHERE ik.nomor_kunjungan IN('".$no_kunjungan."')");
	}
}