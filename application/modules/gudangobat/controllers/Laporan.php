<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Laporan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}
	}

	function stok()
	{
		$this->template->load('template','laporan/stok');
	}
}