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


    function __query_get_db_pasien()
    {

        // parameter filter
        $norek      =   $this->input->post('norec');
        $nik        =   $this->input->post('nik');
        $asuransi   =   $this->input->post('asuransi');
        $nama       =   $this->input->post('nama');
        $prov       =   $this->input->post('prov');
        $kab        =   $this->input->post('kab');
        $kec        =   $this->input->post('kec');
        $desa       =   $this->input->post('desa');


        $where='';
        if($norek!='' || $nik!='' || $asuransi!=''|| $nama!=''|| $prov!=''|| $kab!=''|| $kec!=''|| $desa!='' )
        {
            $where=" WHERE a.nomor_rekammedis!= '' ";
        }

        

        // building querey where  filter
        $filter     =   ($norek!=''?" AND a.nomor_rekammedis='".$norek."'":'');
        $filter    .=   ($nik!=''?"AND a.nomor_nik='".$nik."'":'');
        $filter    .=   ($asuransi!=''?"AND a.nomor_asuransi='".$asuransi."'":'');
        $filter    .=   ($nama!=''?"AND a.nama_lengkap='".$nama."'":'');
        $filter    .=   ($prov!=''?"AND a.kode_provinsi='".$prov."'":'');
        $filter    .=   ($kab!=''?"AND a.kode_kabupaten='".$kab."'":'');
        $filter    .=   ($kec!=''?"AND a.kode_kecamatan='".$kec."'":'');
        $filter    .=   ($desa!=''?"AND a.kode_desa='".$desa."'":'');
        // query database pasien 
        $query="
        SELECT 

        a.nomor_rekammedis norec, a.nomor_nik nik, a.nomor_asuransi asuransi, a.nama_lengkap nama,
        b.nama_provinsi prov,
        c.nama_kota kab,
        d.nama_kecamatan kec,
        e.nama_kelurahan desa

        FROM pendaftaran_pasien a
        LEFT JOIN admin_masterprovinsi b ON a.kode_provinsi = b.id_provinsi
        LEFT JOIN admin_masterkabupaten c ON c.id_kota = a.kode_kabupaten
        LEFT JOIN admin_masterkecamatan d ON d.id_kecamatan = a.kode_kecamatan
        LEFT JOIN admin_masterdesa e ON e.id_kelurahan = a.kode_desa
        ".$where." 
        ".$filter."
        ";

        return $query;
    }

    function get_databasepasien()
    {

        $query=$this->__query_get_db_pasien();
        if($this->input->post('length')!=-1)
        {
            $query=$this->__query_get_db_pasien()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
        return $this->db->query($query);
    }

    function count_all_db_pasien()
    {
        return $this->db->get('pendaftaran_pasien')->num_rows();
    }
    function count_db_pasien_filtered()
    {
        $q=$this->__query_get_db_pasien();
        return $this->db->query($q)->num_rows();
    }

    function get_rows($norec)
    {
        $this->db->where('nomor_rekammedis',$norec);
        return $this->db->get("pendaftaran_pasien");
    }

    function submit_data($data)
    {
        return $this->db->insert('pendaftaran_pasien',$data);
    }

    function submit_update_data($data,$norek)
    {
        $this->db->where('nomor_rekammedis',$norek);
        return $this->db->update('pendaftaran_pasien',$data);
    }
}