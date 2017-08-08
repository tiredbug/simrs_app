<?php if(!defined("BASEPATH")) exit("No direct script access allowed.");
class M_core extends ci_model{


	function hapus_dokter($id)
	{
		$this->db->where('id_jadwaldokter',$id);
		return $this->db->delete('pendaftaran_jadwaldokterrajal');
	}
}