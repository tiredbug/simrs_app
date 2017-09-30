<?php
/**
* 
*/
class Tes extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->library('bpjs');
	}


	function index()
	{
		$param=array(
					'noKartu'=>'',
					'tglSep'=>'',
					'tglRujukan'=>'',
					'noRujukan'=>'',
					'ppkRujukan'=>'',
					'ppkPelayanan'=>'',
					'jnsPelayanan'=>'',
					'catatan'=>'',
					'diagAwal'=>'',
					'poliTujuan'=>'',
					'klsRawat'=>'',
					'lakaLantas'=>'',
					'lokasiLaka'=>'',
					'noMr'=>''
		);
		print $this->bpjs->sep($param);
	}

}