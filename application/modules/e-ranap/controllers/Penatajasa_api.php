<?php
/**
* 
*/
class Penatajasa_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('m_penatajasa');
	}


	function get_info_kunjungan()
	{
		$r= array(
			'success' => true, 
			'i_p'=>array(),
			'i_t'=>array(),
			'i_cb'=>$this->m_penatajasa->get_i_cb()->result(),
			'i_klp'=>array(),
			'i_r'=>array(),
			'i_kmr'=>array()
			);
		$cek=$this->m_penatajasa->get_informasi_kunjungan($_POST['norek']);
		if($cek->num_rows()>0)
		{
			$r['success']=true;
			$r['i_p']=$cek->row_array();
			$r['i_klp']=$this->m_penatajasa->get_i_klp($r['i_p']['cb'])->result();
			$r['i_r']=$this->m_penatajasa->get_i_r()->result();
			$r['i_kls']=$this->m_penatajasa->get_i_kls()->result();
			$r['i_kmr']=$this->m_penatajasa->get_i_kmr($r['i_p']['ruang'],$r['i_p']['kelas'])->result();
			$r['i_bed']=$this->m_penatajasa->get_i_bed($r['i_p']['kamar'])->result();
		}
		else
		{
			$r['success']=false;
		}

		echo json_encode($r);
	}

	function get_i_kelompok()
	{
		echo json_encode($this->m_penatajasa->get_i_klp($_POST['cb'])->result());
	}

	function get_i_kmr()
	{
		echo json_encode($this->m_penatajasa->get_i_kmr($_POST['ruang'],$_POST['kelas'])->result());
	}

	function get_i_bed()
	{
		echo json_encode($this->m_penatajasa->get_i_bed($_POST['kamar'])->result());
	}

	function pindah_ruangan()
	{

		$r=array('success'=>false,'message'=>array());


		echo json_encode($r);
		// $r=array('success'=>false);
		// if($this->m_penatajasa->update_ruangan())
		// {
		// 	$r['success']=true;
		// }
		// else
		// {
		// 	$r['success']=false;
		// }
		// echo json_encode($r);
	}


}