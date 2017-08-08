<?php

class M_master extends CI_Model{
    
    function get_agama()
    {
        return $this->db->get('admin_masteragama');
    }
    
    function get_provinsi()
    {
        return $this->db->get('admin_masterprovinsi');
    }
    
    function get_kab($id_provinsi)
    {
        $this->db->where('id_provinsi',$id_provinsi);
        return $this->db->get('admin_masterkabupaten');
    }
    
    function get_kec($id_kota)
    {
        $this->db->where('id_kota',$id_kota);
        return $this->db->get('admin_masterkecamatan');
    }
    
    function get_desa($id_kec)
    {
        $this->db->where('id_kecamatan',$id_kec);
        return $this->db->get('admin_masterdesa');
    }

    function get_pekerjaan()
    {
        return $this->db->get('admin_masterpekerjaan');
    }

    function get_pendidikan()
    {
        return $this->db->get('admin_masterpendidikan');
    }
    
}