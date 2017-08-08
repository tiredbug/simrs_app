<?php 
if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Informasi extends CI_Controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_pendaftaran())
		{
			redirect(base_url().'pendaftaran/login');
		}
		$this->load->model('register/m_master');
	}

	function rajal()
	{
		$data['poli']			=	$this->m_master->get_poli();
		$this->template->load('template','informasi/rajal',$data);
	}

	function laboraturium()
	{
		$this->template->load('template','informasi/laboraturium');
	}
}