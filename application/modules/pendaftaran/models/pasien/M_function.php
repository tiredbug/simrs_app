<?php

class M_function extends CI_Model{
    
    
    function max_norek()
    {
        $this->db->select_max('nomor_rekammedis');
        return $this->db->get('pendaftaran_pasien')->row_array();
    }
    
    function cek_norek($norek)
    {
        $this->db->where('nomor_rekammedis',$norek);
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }
    
    function cek_nik($nik)
    {
        $this->db->where('nomor_nik',$nik);
        $this->db->where('nomor_nik !=','');
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }
    
    
    function cek_asuransi($noasuransi)
    {
        $this->db->where('nomor_asuransi',$noasuransi);
        $this->db->where('nomor_asuransi !=','');
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }
    
    function hitung_total_db_pasien()
    {
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }
    
    function cek_meninggal($nore)
    {
        $this->db->where('nomor_rekammedis',$nore);
        $this->db->where('meninggal','Y');
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }

    function cek_nik_update($norek, $nik)
    {
        $this->db->where('nomor_rekammedis !=',$norek);
        $this->db->where('nomor_nik',$nik);
        $this->db->where('nomor_nik  !=','');
        return $this->db->get('pendaftaran_pasien');
    }

    function cek_noasuransi_update($norek, $nomor_asuransi)
    {
        $this->db->where('nomor_rekammedis !=',$norek);
        $this->db->where('nomor_asuransi',$nomor_asuransi);
        $this->db->where('nomor_asuransi !=','');
        return $this->db->get('pendaftaran_pasien');
    }

    function get_infopasien()
    {
        return $this->db->query("SELECT 
                                a.nomor_rekammedis, a.nomor_nik, a.nomor_asuransi, a.nama_lengkap, a.jenis_kelamin, a.agama, a.tp_lahir, a.tgl_lahir, a.alamat_ktp,
                                b.nama_kelurahan, 
                                c.nama_kecamatan, 
                                d.nama_kota, 
                                e.nama_provinsi,
                                f.agama
                                FROM pendaftaran_pasien a
                                LEFT JOIN admin_masterdesa b ON a.kode_desa=b.id_kelurahan
                                LEFT JOIN admin_masterkecamatan c ON a.kode_kecamatan=c.id_kecamatan
                                LEFT JOIN admin_masterkabupaten d ON a.kode_kabupaten=d.id_kota
                                LEFT JOIN admin_masterprovinsi e ON a.kode_provinsi=e.id_provinsi
                                LEFT JOIN admin_masteragama f ON a.agama=f.id
                                WHERE a.nomor_rekammedis='".$this->input->post('norek')."'
                                ");
    }


    function get_datakartu($norek)
    {
        return $this->db->query("SELECT 
                                a.nomor_rekammedis, a.nama_lengkap, a.tgl_lahir, a.jenis_kelamin
                                FROM  pendaftaran_pasien a
                                WHERE a.nomor_rekammedis='".$norek."'");
    }

}