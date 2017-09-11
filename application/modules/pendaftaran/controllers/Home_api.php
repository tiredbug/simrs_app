<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Home_api extends CI_Controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_pendaftaran())
		{
			exit("No direct script access allowed.");
		}
		$this->load->model('m_home');
	}


	function statistik_kunjungan()
	{
		$r=array();		
		foreach ($this->m_home->get_i_statistik_kunjungan()->result() as $sk) {
			# code...
			$rw[0]=$sk->poli;
			$rw[1]=$sk->jumlah;
			// $rw['color']='#f45b5b';
			// $r[]=$rw;
			array_push($r,$rw);
		}
		echo json_encode($r,JSON_NUMERIC_CHECK);
	}
}
