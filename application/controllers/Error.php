<?php 
class Error extends ci_controller{
	function __construc()
	{
		parent::__construc();

	}

	function index()
	{
		$this->load->view('error');
	}
}