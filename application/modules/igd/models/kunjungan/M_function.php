<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class M_function extends ci_model{

	function cek_kunjungan($norek)
	{
		$this->db->where(array(
			'norekammedis'=>$norek,
			'status_kunjungan'=>'Masih dirawat'
			));

		return $this->db->get('pendaftaran_kunjungan');
	}

	function cek_norek($norek)
	{
		$this->db->where('nomor_rekammedis',$norek);
		return $this->db->get('pendaftaran_pasien');
	}


	function get_info_pasien($norek)
	{
		return $this->db->query("SELECT
		ps.nama_lengkap nama, ps.nomor_nik nik, ps.nomor_asuransi asu, ps.jenis_kelamin jk,
		CONCAT(ps.alamat_ktp,' ','desa ', des.nama_kelurahan) alamat, ps.tgl_lahir
		FROM pendaftaran_pasien ps
		LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
		WHERE ps.nomor_rekammedis IN('".$norek."')
		");
	}


	// cek informasi kunjungan terakhir

    function get_info_kunjungan($nrm)
    {
        return $this->db->query("SELECT
                                    a.jenis_kunjungan, a.tgl_checkout tgl, a.jam_checkout jam
                                FROM 
                                pendaftaran_kunjungan a
                                WHERE a.norekammedis='".$nrm."'
                                ORDER BY a.tgl_checkout DESC LIMIT 1");
    }
    //end
}