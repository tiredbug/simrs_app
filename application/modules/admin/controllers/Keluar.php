<?php
/**
* 
*/
class Keluar extends ci_controller
{
	
	function index()
	{
		$this->logapp->log_user($_SESSION['id_admin'],'keluar dari aplikasi.');
		$this->session->sess_destroy();
		redirect(base_url().'/admin/login');
	}
}