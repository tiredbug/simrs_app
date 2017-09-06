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
				WHERE ik.inap IN('N') AND (ik.tgl_masuk IN('".date('Y-m-d')."')
				OR  ik.tgl_masuk IN('".date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")))."'))
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


    function get_data_dokter_spesialis()
    {
        return $this->db->query("SELECT
                                d.kode_dokter id,
                                CONCAT(d.nama_belakang,'. ', d.nama_dokter,IF(d.gelar='','',CONCAT(', ',d.gelar))) nama
                                FROM
                                admin_masterdokter d
                                WHERE d.jenis_dokter IN('Spesialis') AND d.`status` IN('Aktif')");
    }


    function get_i_kunjungan_igd($nomor_kunjungan)
    {
        return $this->db->query("SELECT
                                pk.nomor_kunjungan no_kunjungan, pk.norekammedis norek, ps.nama_lengkap nama,
                                CONCAT(ps.tp_lahir,' / ', DATE_FORMAT(ps.tgl_lahir,'%d-%m-%Y')) tptg, ps.jenis_kelamin jk,
                                CONCAT(ps.alamat_ktp,' - desa ',des.nama_kelurahan) alamat,
                                CONCAT(ik.tgl_masuk,' ',ik.jam_masuk) tgl_masuk,
                                CONCAT(dok.nama_belakang,'. ',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))) dokter_pengirim,
                                pk.jenis_kunjungan asal,CONCAT(cb.nama_carabayar,' (',cbk.nama_kelompok,')') cb,
                                pk.deposito dp, pk.penanggung_jawab pj, pk.hubungan_denganpasien hub, pk.alamat_penanggungjawab alamat_p, pk.hp_penanggungjawab hp_p
                                FROM
                                igd_kunjungan ik
                                LEFT JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=ik.nomor_kunjungan
                                LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
                                LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
                                LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=ik.kode_dokter
                                LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
                                LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=pk.kode_kelompok
                                WHERE ik.nomor_kunjungan IN('".$nomor_kunjungan."')");
    }


    function get_ruang()
    {
        $this->db->where('status_ruangan','Y');
        return $this->db->get('admin_masterruanganinap');
    }

    function get_kelas()
    {
        return $this->db->get('admin_masterkelasperawatan');
    }


    function get_kamar($ruang,$kelas)
    {
        return $this->db->query("SELECT
                                km.id_kamar id,km.nama_kamar kamar
                                FROM
                                admin_masterruanginapkamar km
                                INNER JOIN admin_masterkelasperawatan kls ON kls.id_kelasperawatan=km.id_kelas
                                INNER JOIN admin_masterruanganinap r ON km.id_ruangan=r.id_ruangan
                                WHERE r.id_ruangan IN('".$ruang."') AND kls.id_kelasperawatan IN('".$kelas."')");
    }


		function get_bed($kamar)
		{
			return $this->db->query("SELECT
														b.id_bed id, b.nomor_bed nmr
														FROM admin_masterruanginapkamarbed b
														INNER JOIN admin_masterruanginapkamar r ON r.id_kamar=b.id_kamar
														WHERE b.status_bed IN('Y') AND r.id_kamar IN('".$kamar."')");
		}


		function search_icdx($like)
		{
			return $this->db->query("SELECT
															i.KODE id
															FROM
															admin_mastericdx i
															WHERE i.KODE LIKE '%".$like."%'
															LIMIT 0,25");
		}


		function get_m_hub()
		{
			return $this->db->get('admin_masterhubungankeluarga');
		}



        function simpan_ranap()
        {
            if(! $this->input->is_ajax_request() )
            {
                exit("No direct script access allowed.");
            }
            else
            {
                $this->db->trans_start();
                // daftar kunjungna co
                $this->db->insert('co_kunjungan',array(
                    'no_kunjungan'=>$_POST['no_kunjungan'],
                    'icdx_masuk'=>$_POST['icdx'],
                    'dokter'=>$_POST['dokter'],
                    'petugas_co'=>$_SESSION['id_users'],
                    'asal'=>$_POST['asal']
                    ));

                // // daftar ke ruang rawat inap
                $this->db->insert('ranap_kunjungan',array(
                    'no_kunjungan' =>$_POST['no_kunjungan'],
                    'ruang'=>$_POST['ruang'],
                    'kelas'=>$_POST['kelas'],
                    'kamar'=>$_POST['kamar'],
                    'bed'=>$_POST['bed'],
                    'tgl_masuk'=>date("Y-m-d"),
                    'jam_masuk'=>date("H:i:s")                    
                    ));

                // update data kunjungan
                $this->db->where('nomor_kunjungan',$_POST['no_kunjungan']);
                $this->db->update('pendaftaran_kunjungan',array(
                    'penanggung_jawab'=>$_POST['nama_p'],
                    'hubungan_denganpasien'=>$_POST['hub'],
                    'alamat_penanggungjawab'=>$_POST['alamat_p'],
                    'hp_penanggungjawab'=>$_POST['hp_p']
                    ));

                $this->db->trans_complete();
                return $this->db->trans_status();
            }
        }


        function __query_get_data_kunjungan_ranap()
        {
            $norek=$this->input->post('search[value]');
            $s=" ";
            if($norek !='')
            {
                $s=" AND k.norekammedis IN('".$this->input->post('search[value]')."')";
            }
            
            return $q="SELECT 
                        ck.no_kunjungan, k.norekammedis norek, ps.nama_lengkap nama, ps.alamat_ktp alamat, ps.jenis_kelamin jk,
                        CONCAT(cb.nama_carabayar,'/',klp.nama_kelompok) cb, ck.icdx_masuk icd, ck.asal
                        FROM co_kunjungan ck
                        INNER JOIN pendaftaran_kunjungan k ON k.nomor_kunjungan=ck.no_kunjungan
                        INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=k.norekammedis
                        LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=k.kode_carabayar
                        LEFT JOIN admin_mastercarabayarklp klp ON klp.id_kelompok=k.kode_kelompok
                        LEFT JOIN admin_mastericdx icd ON icd.KODE=ck.icdx_masuk
                        WHERE k.status_kunjungan='Masih dirawat' ".$s;
        }


        function get_data_kunjungan_ranap()
        {
            $q=$this->__query_get_data_kunjungan_ranap();
            if($_POST['length']!=-1)
            {
                $q=$this->__query_get_data_kunjungan_ranap().' LIMIT '.$_POST['start'].','.$_POST['length'];
            }
            return $this->db->query($q);
        }


        function count_record_total()
        {
            return $this->db->query("SELECT * FROM co_kunjungan ck 
                INNER JOIN pendaftaran_kunjungan k ON k.nomor_kunjungan=ck.no_kunjungan
                WHERE k.status_kunjungan='Masih dirawat'
                ")->num_rows();
        }

        function count_record_filtered()
        {
            return $this->db->query($this->__query_get_data_kunjungan_ranap())->num_rows();
        }


        function __query_get_kunjungan_rajal()
        {
            return $q="SELECT
                        rk.nomor_kunjungan no_kunjungan,pk.norekammedis norek, ps.nama_lengkap nama, ps.alamat_ktp alamat,
                        ps.jenis_kelamin jk,CONCAT(cb.nama_carabayar,' / ',cbk.nama_kelompok) cb
                        FROM 
                        rajal_kunjungan rk
                        INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=rk.nomor_kunjungan
                        LEFT JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
                        LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
                        LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=pk.kode_kelompok
                        WHERE rk.rujuk='N' AND pk.status_kunjungan='Masih dirawat' AND rk.inap='N'";
        }

        function get_data_kunjungan_rajal()
        {
            $q=$this->__query_get_kunjungan_rajal();
            if($_POST['length']!=-1)
            {
                $q=$this->__query_get_kunjungan_rajal().' LIMIT '.$_POST['start'].','.$_POST['length'];
            }
            return $this->db->query($q);
        }


        function get_i_kunjungan_rajal($no_kunjungan)
        {
            return $this->db->query("SELECT 
            pk.nomor_kunjungan no_kunjungan, pk.norekammedis norek, ps.nama_lengkap nama, ps.jenis_kelamin jk,
            ps.alamat_ktp alamat, CONCAT(ps.tp_lahir,'/',DATE_FORMAT(ps.tgl_lahir,'%Y-%m-%d')) tptg,
            pk.jenis_kunjungan asal,CONCAT(cb.nama_carabayar,'/',cbk.nama_kelompok) cb,
            DATE_FORMAT(pk.tgl_daftar,'%Y-%m-%d') tgl_masuk,
            CONCAT(dok.nama_belakang,'.',dok.nama_dokter,IF(dok.gelar='','',CONCAT(', ',dok.gelar))) dokter_pengirim,
            pk.deposito dp, pk.penanggung_jawab pj, pk.hubungan_denganpasien hub, pk.hp_penanggungjawab hp_p, pk.alamat_penanggungjawab alamat_p
            FROM pendaftaran_kunjungan pk
            INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
            INNER JOIN rajal_kunjungan rk ON rk.nomor_kunjungan=pk.nomor_kunjungan
            LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
            LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=pk.kode_kelompok
            LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=rk.kode_dokter
            WHERE pk.nomor_kunjungan IN('".$no_kunjungan."')");
        }
}
