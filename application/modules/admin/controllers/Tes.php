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
		
		print $this->bpjs->rujukan('rujukan','RS','0012R0061016A000032');
	}

}