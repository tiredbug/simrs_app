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



    function get_tgllahir($norek)
    {
        $this->db->select('tgl_lahir');
        $this->db->from('pendaftaran_pasien');
        $this->db->where('nomor_rekammedis',$norek);
        return $this->db->get();
    }


    function max_nomorkunjungan()
    {
        $this->db->select_max('nomor_kunjungan');
        return $this->db->get('pendaftaran_kunjungan')->row_array();
    }


    function void_registerrajal($kunjungan,$igd)
    {
    	$this->db->trans_start();
		$this->db->insert('pendaftaran_kunjungan',$kunjungan);
		$this->db->insert('igd_kunjungan',$igd);
		$this->db->trans_complete();
		return $this->db->trans_status();
    }

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
				) dokter, pk.diagnosa, pk.penanggung_jawab pj
				FROM igd_kunjungan ik
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=ik.nomor_kunjungan
				LEFT JOIN pendaftaran_pasien p ON p.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
				LEFT JOIN admin_mastercarabayarklp ckl ON ckl.id_kelompok=pk.kode_kelompok
				LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
				WHERE pk.status_kunjungan IN('Masih dirawat')
				AND ik.selesai_pelayanan IN('N')".$w_norek;
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

    // informasi pasien untuk form informasi lengkap 

    function get_informasi_pasien($id)
    {
        return $this->db->query("SELECT
                                k.norekammedis norek, ps.nama_lengkap nama, ps.nomor_nik nik, ps.nomor_asuransi asu, ps.jenis_kelamin jk,
                                ag.agama ag, DATE_FORMAT(ps.tgl_lahir,'%d-%m-%Y') tgllahir, ps.alamat_ktp alamat,
                                prov.nama_provinsi prov,
                                kab.nama_kota kab,
                                kec.nama_kecamatan kec,
                                des.nama_kelurahan des
                                FROM pendaftaran_kunjungan k
                                LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=k.norekammedis
                                LEFT JOIN admin_masteragama ag ON ag.id=ps.agama
                                LEFT JOIN admin_masterprovinsi prov ON prov.id_provinsi=ps.kode_provinsi
                                LEFT JOIN admin_masterkabupaten kab ON kab.id_kota=ps.kode_kabupaten
                                LEFT JOIN admin_masterkecamatan kec ON kec.id_kecamatan=ps.kode_kecamatan
                                LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
                                WHERE k.nomor_kunjungan IN('".$id."')");
    }
    // end

    // informasi kunjungan pada form informasi lengkap
    function get_informasi_kunjungan($id)
    {
        return $this->db->query("SELECT
                        k.nomor_kunjungan no_kunjungan, CONCAT(cb.nama_carabayar,' - ',cbk.nama_kelompok) cb, CONCAT('Kelas ',kls.nama_kelasperawatan) kls,
                        CONCAT(DATE_FORMAT(k.tgl_daftar,'%d-%m-%Y'),' ',k.jam_daftar) tgl_d, cr.nama_cararujuk cr,
                        k.nomor_rujukan norujuk,k.asal_rujukan asal,k.nomor_sep sep, k.diagnosa, k.jenis_pasien jp,
                        CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar!='',CONCAT(', ',dok.gelar),'')) dokter,
                        k.deposito,
                        IF(k.penanggung_jawab!='',CONCAT(k.penanggung_jawab,' (',hub.hubungan,')'),'') pjawab

                        FROM pendaftaran_kunjungan k
                        LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=k.kode_carabayar
                        LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=k.kode_kelompok
                        LEFT JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=k.kode_kelas
                        LEFT JOIN admin_mastercararujuk cr ON cr.id_cararujuk=k.kode_cararujuk
                        INNER JOIN igd_kunjungan ik ON ik.nomor_kunjungan=k.nomor_kunjungan
                        LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
                        LEFT JOIN admin_masterhubungankeluarga hub ON hub.id=k.hubungan_denganpasien
                        WHERE k.nomor_kunjungan IN('".$id."')");

    }
    // end


    function get_informasi_history_kunjungan($id)
    {
        return $this->db->query("SELECT
                                k.nomor_kunjungan no_kunjungan, CONCAT(DATE_FORMAT(k.tgl_daftar,'%d-%m-%Y'),' ',k.jam_daftar) tgl_daftar,
                                CONCAT(DATE_FORMAT(k.tgl_checkout,'%d-%m-%Y'),' ',k.jam_checkout) tgl_checkout,
                                CASE k.jenis_kunjungan
                                    WHEN 'Rajal' THEN 'Rawat jalan'
                                    WHEN 'Ranap' THEN 'Rawat inap'
                                    WHEN 'lab' THEN 'Lab langsung'
                                    WHEN 'igd' THEN 'Rawat jalan IGD'
                                    WHEN 'rad' THEN 'Radiologi langsung'
                                END jenis
                                FROM pendaftaran_kunjungan k 
                                INNER JOIN (
                                    SELECT 
                                    pk.norekammedis norek
                                    FROM 
                                    pendaftaran_kunjungan pk
                                    WHERE pk.nomor_kunjungan IN('".$id."')
                                    ) j ON j.norek=k.norekammedis
                                WHERE k.status_kunjungan='Selesai dirawat' ORDER BY k.tgl_daftar DESC, k.jam_daftar DESC");
    }


    function tutuptransaksi($nokunjungan)
    {
        $this->db->where('nomor_kunjungan',$nokunjungan);
        return $this->db->update('igd_kunjungan',array(
            'selesai_pelayanan'=>'Y'
            ));
    }

    function cek_kunjungan_igd($nokunjungan)
    {
        return $this->db->get_where('igd_kunjungan',array(
            'nomor_kunjungan'=>$nokunjungan,
            'selesai_pelayanan'=>'N'
            ));
    }

    function get_informasi_kunjungan_form_entry($nokunjungan)
    {
        return $this->db->query("SELECT 
                                pk.norekammedis norek, ik.nomor_kunjungan nokunjungan, ps.nama_lengkap, ps.jenis_kelamin jk,
                                ik.tgl_masuk tgl_daftar
                                FROM
                                igd_kunjungan ik
                                INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=ik.nomor_kunjungan
                                LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
                                WHERE ik.nomor_kunjungan IN('".$nokunjungan."')");
    }


    function i_tindakan()
    {
        return $this->db->query("SELECT 
                                ti.kode_tarif kode, ti.nama_tarif tindakan, IFNULL(dt.total_tarif,0) tarif
                                FROM admin_tarifigd ti
                                LEFT JOIN (SELECT * FROM admin_tarifigddetail tid WHERE tid.tgl_berlaku<='".$_POST['tgl_daftar']."' ORDER BY tid.tgl_berlaku DESC LIMIT 1) dt ON dt.kode_tarif=ti.kode_tarif
                                WHERE ti.kode_tarif IN('".$_POST['kode']."')");
    }


    function insert_tindakan()
    {
        return $this->db->insert('igd_tindakan',array(
            'nokunjungan'=>$_POST['nokunjungan'],
            'kode_tindakan'=>$_POST['kode'],
            'tarif'=>$_POST['tarif'],
            'qty'=>$_POST['q'],
            'total'=>$_POST['q']*$_POST['tarif']
            )
            );
    }

    function get_tindakan_in_igd($nokunjungan)
    {
        return $this->db->query("SELECT 
                t.id, tf.kode_tarif kode, tf.nama_tarif tindakan, t.tarif, t.qty, t.total
                FROM igd_tindakan t
                INNER JOIN admin_tarifigd tf ON tf.kode_tarif=t.kode_tindakan
                WHERE t.nokunjungan IN('".$nokunjungan."')");
    }
}