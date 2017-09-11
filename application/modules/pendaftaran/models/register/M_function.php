<?php if(! defined("BASEPATH")) exit("No direct script access allowed");
class M_function extends CI_Model{
    
    
    function cek_kunjungan($nrm)
    {
        $this->db->where('status_kunjungan','Masih dirawat');
        $this->db->where('norekammedis',$nrm);
        return $this->db->get('pendaftaran_kunjungan');
    }
    
    function cek_norek($nrm)
    {
        // $this->db->where('nomor_rekammedis',$nrm);
        // return $this->db->get('pendaftaran_pasien');
        return $this->db->query("SELECT
                                a.nama_lengkap nama, a.nomor_nik nik, a.nomor_asuransi asu, a.jenis_kelamin jk, a.tgl_lahir,
                                CONCAT(a.alamat_ktp,', Prov ',b.nama_provinsi,' Kab ',c.nama_kota,' Kec ',d.nama_kecamatan,' Kel ',e.nama_kelurahan)alamat
                                FROM pendaftaran_pasien a
                                LEFT JOIN admin_masterprovinsi b ON b.id_provinsi=a.kode_provinsi
                                LEFT JOIN admin_masterkabupaten c ON c.id_kota=a.kode_kabupaten
                                LEFT JOIN admin_masterkecamatan d ON d.id_kecamatan=a.kode_kecamatan
                                LEFT JOIN admin_masterdesa e ON e.id_kelurahan=a.kode_desa
                                WHERE a.nomor_rekammedis='".$nrm."'");
    }
    
    function cek_hidup($nrm)
    {
        $this->db->where('meninggal','Y');
        $this->db->where('nomor_rekammedis',$nrm);
        return $this->db->get('pendaftaran_pasien');
    }
    
    function get_prov($prov)
    {
        $this->db->select("nama_provinsi");
        $this->db->where('id_provinsi',$prov);
        return $this->db->get('admin_masterprovinsi')->row_array();
    }
    
    function get_kab($kab)
    {
        $this->db->select("nama_kota");
        $this->db->where('id_kota',$kab);
        return $this->db->get('admin_masterkabupaten')->row_array();
    }
    
    function get_kec($kec)
    {
        $this->db->select('nama_kecamatan');
        $this->db->where('id_kecamatan',$kec);
        return $this->db->get('admin_masterkecamatan')->row_array();
    }
    
    function get_desa($des)
    {
        $this->db->select("nama_kelurahan");
        $this->db->where('id_kelurahan',$des);
        return $this->db->get('admin_masterdesa')->row_array();
    }

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
    function max_antri($poli)
    {
        $this->db->select_max('nomor_antrian');
        $this->db->from('rajal_kunjungan');
        $this->db->join('pendaftaran_kunjungan','pendaftaran_kunjungan.nomor_kunjungan = rajal_kunjungan.nomor_kunjungan');
        $this->db->where('pendaftaran_kunjungan.status_kunjungan','Masih dirawat');
        $this->db->where('pendaftaran_kunjungan.tgl_daftar',date("Y-m-d"));
        $this->db->where('rajal_kunjungan.kode_poliklinik',$poli);
        return $this->db->get()->row_array();
    }

    // ambil id tindakana outo paling besar
    function max_id_tindakan_auto()
    {
        $this->db->select_max('id');
        $max=$this->db->get('pendaftaran_biayaauto')->row_array();
        return $max['id'];
    }

    // mencari biaya-biaya yang harus diinput automatis 
    function get_biaya_auto()
    {
        $this->db->where('aktif','Y');
        $this->db->where('auto_pada','rajal');
        $this->db->or_where('auto_pada','all');
        $this->db->select('id_auto');
        return $this->db->get('admin_tindakanauto');
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



    function search_icdx($like)
    {
        return $this->db->query("SELECT
                                i.KODE id, CONCAT(i.KODE,' - ',i.SUB) slug
                                FROM
                                admin_mastericdx i
                                WHERE i.KODE LIKE '%".$like."%' OR i.SUB LIKE '%".$like."%'
                                LIMIT 0,25");
    }
}

