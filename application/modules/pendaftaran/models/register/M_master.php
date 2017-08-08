<?php if(! defined("BASEPATH")) exit("No direct script access allowed");
class M_master extends CI_Model{
    
    
   
    function get_carabayar()
    {
        return $this->db->get('admin_mastercarabayar');
    }
    function get_kelas()
    {
        return $this->db->get('admin_masterkelasperawatan');
    }
    function get_cararujuk()
    {
        return $this->db->get('admin_mastercararujuk');
    }
    function get_klp($cb)
    {
        $this->db->where('id_carabayar',$cb);
        return $this->db->get('admin_mastercarabayarklp');
    }
    function get_hub()
    {
        return $this->db->get('admin_masterhubungankeluarga');
    }
    function get_poli()
    {
        $this->db->where('status_poliklinik','Y');
        return $this->db->get('admin_masterpoliklinik');
    }

    function get_drpiket($poli)
    {
        $this->db->select("admin_masterdokter.kode_dokter");
        $this->db->select("admin_masterdokter.nama_dokter");
        $this->db->select("admin_masterdokter.gelar");
        $this->db->select("admin_masterdokter.nama_belakang");
        $this->db->from('pendaftaran_jadwaldokterrajal');
        $this->db->join('admin_masterdokter','pendaftaran_jadwaldokterrajal.kode_dokter = admin_masterdokter.kode_dokter');
        $this->db->where('pendaftaran_jadwaldokterrajal.tgl',date("Y-m-d"));
        $this->db->where('pendaftaran_jadwaldokterrajal.id_poliklinik',$poli);
        return $this->db->get();

    }
}

