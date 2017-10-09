<?php 
/**
* 
*/
class M_kunjungan extends ci_model
{
	
	function __query_get_data_kunjungan_igd()
	{
		$norek=$this->input->post('search[value]');
    	$w_norek=" ";
    	if($norek !='')
    	{
    		$w_norek=" AND pk.norekammedis ='".$norek."'";
    	}
    	return $query="SELECT 
				ik.nomor_kunjungan no_kunjungan, pk.norekammedis norek, p.nama_lengkap nama,
				p.alamat_ktp alamat, p.jenis_kelamin jk,
				CONCAT(cb.nama_carabayar,'/',ckl.nama_kelompok) cb,
				CONCAT(
					dok.nama_belakang,'.',dok.nama_dokter,
					IF(dok.gelar!='',CONCAT(', ',dok.gelar),'')
				) dokter, pk.diagnosa, pk.penanggung_jawab pj
				FROM igd_kunjungan ik
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=ik.nomor_kunjungan
				LEFT JOIN pendaftaran_pasien p ON p.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
				LEFT JOIN admin_mastercarabayarklp ckl ON ckl.id_kelompok=pk.kode_kelompok
				LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
				WHERE pk.status_kunjungan IN('Masih dirawat')
				AND ik.selesai_pelayanan IN('Y') AND ik.inap IN('N')".$w_norek;
	}


	function get_data_kunjungan_igd()
    {
    	$query=$this->__query_get_data_kunjungan_igd();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_data_kunjungan_igd()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
    }


    function get_i_kunjungan_asal_igd()
    {
    	return $this->db->query("SELECT
								ps.nomor_rekammedis nomr, ps.nomor_asuransi no_as, ps.nomor_nik nik, ps.nama_lengkap nama, ps.jenis_kelamin jk,
								pk.nomor_kunjungan no_k, CONCAT(ik.tgl_masuk,' ',ik.jam_masuk) jam_masuk, CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar)))dokter,
								CONCAT(icd.KODE,' - ',icd.SUB) icd, CONCAT(cb.nama_carabayar,'-',klp.nama_kelompok) cb, pk.deposito
								FROM 
								pendaftaran_kunjungan pk
								INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=pk.nomor_kunjungan
								LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
								LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
								LEFT JOIN admin_mastericdx icd ON icd.KODE=pk.diagnosa
								LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
								LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=pk.kode_kelompok
								WHERE ik.nomor_kunjungan IN('".$_GET['nokunjungan']."') AND ik.inap IN('N') AND pk.status_kunjungan IN('Masih dirawat')
								AND ik.selesai_pelayanan IN('Y')");
    }


    function get_i_t_igd()
    {
    	return $this->db->query("SELECT
								it.kode_tindakan kode, trf.nama_tarif tndk, it.tarif, it.qty, it.total
								FROM 
								igd_tindakan it
								INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=it.nokunjungan
								LEFT JOIN admin_tarifigd trf ON trf.kode_tarif=it.kode_tindakan
								WHERE it.nokunjungan IN('".$_GET['nokunjungan']."')");
    }

    function get_keterangan_checkout_igd()
    {
    	return $this->db->get('igd_sttkeluar');
    }

    function proses_checkout($no_billing)
    {
    	$this->db->trans_start();
    	$this->db->where('nomor_kunjungan',$_POST['no_k']);
    	$this->db->update('igd_kunjungan',array(
    		'tgl_keluar'=>date("Y-d-m"),
    		'jam_keluar'=>date("H:i:s"),
    		'status_keluar'=>$_POST['keterangan']
    	));
    	$this->db->where('nomor_kunjungan',$_POST['no_k']);
    	$this->db->update('pendaftaran_kunjungan',array(
    		'tgl_checkout'=>date("Y-d-m",strtotime($_POST['tgl_keluar'])),
    		'jam_checkout'=>$_POST['jam_keluar'],
    		'status_kunjungan'=>'Selesai dirawat'
    	));
    	$this->db->insert('kasir_billing',array(
    		'no_billing'=>$no_billing,
    		'no_kunjungan'=>$_POST['no_k'],
    		'tagihan'=>$_POST['tagihan'],
    		'deposit'=>$_POST['deposit'],
    		'saldo'=>$_POST['saldo'],
    		'piutang'=>$_POST['piutang'],
    		'tgl_billing'=>date("Y-d-m H:i:s")
    	));
    	$this->db->trans_complete();
    	return $this->db->trans_status();
    }

    function get_max_billing($tgl_billing)
    {
    	return $this->db->query("SELECT
								count('no_billing') jml
								FROM kasir_billing kb
								WHERE DATE(kb.tgl_billing) IN('".$tgl_billing."')")->row_array();
    }
}