<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class M_function extends ci_model
{
	 function __query_get_kunjungan_igd()
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
				) dokter, pk.diagnosa, pk.penanggung_jawab pj, ik.selesai_pelayanan stt
				FROM igd_kunjungan ik
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=ik.nomor_kunjungan
				LEFT JOIN pendaftaran_pasien p ON p.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
				LEFT JOIN admin_mastercarabayarklp ckl ON ckl.id_kelompok=pk.kode_kelompok
				LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
				WHERE ik.tgl_masuk IN('".date('Y-m-d')."') 
				OR  ik.tgl_masuk IN('".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")))."')
				";
    }
    function get_data_kunjungan_igd()
    {
    	$query=$this->__query_get_kunjungan_igd();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_kunjungan_igd()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
    }


    function count_all_data_kunjungan_igd()
    {
    	return $this->db->get('igd_kunjungan')->num_rows();
    }

    function count_all_filtered_data_kunjungan_igd()
    {
    	$query=$this->__query_get_kunjungan_igd();
    	return $this->db->query($query)->num_rows();
    }
}