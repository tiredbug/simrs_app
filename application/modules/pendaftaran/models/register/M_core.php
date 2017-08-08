<?php if(! defined("BASEPATH")) exit("No direct script access allowed");
class M_core extends CI_Model{
    
    function void_registerrajal($data_kunjungan, $data_rajal, $data_auto)
    {
    	$this->db->trans_start();
		$this->db->insert('pendaftaran_kunjungan',$data_kunjungan);
		$this->db->insert('rajal_kunjungan',$data_rajal);
		foreach ($data_auto as $au) {
			# code...
			$this->db->insert('pendaftaran_biayaauto',array(
				'id'=>$au['id'],
				'nomor_kunjungan'=>$au['nomor_kunjungan'],
				'id_auto'=>$au['id_auto']
				));
		}
		$this->db->trans_complete();
		return $this->db->trans_status();
    }
    
}

