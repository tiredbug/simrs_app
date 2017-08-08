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


}

