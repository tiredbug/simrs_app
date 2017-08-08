<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class Keluar extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}
		$this->load->model('keluar/m_master');
	}

	function nota()
	{
		$data['client']	=	$this->m_master->get_client();
		$this->template->load('template','Keluar/nota',$data);
	}

	function listkeluar()
	{
		$this->template->load('template','keluar/listkeluar');
		
	}

	function datanotakeluar()
	{
		$data['client']		=	$this->m_master->get_client();
		$this->template->load('template','keluar/datanotakeluar',$data);
	}

	function editnota()
	{
		if(isset($_GET['nota']))
		{
			$cek=$this->m_master->cek_nota($_GET['nota']);
			if($cek->num_rows() <= 0)
			{
				echo "<script>alert('Nomor nota tidak ditemukan.');
				window.location.href='".base_url()."gudangobat/keluar/datanotamasuk';</script>";
			}
			else
			{
				$data['row']=$cek->row_array();
				$data['client']		=	$this->m_master->get_client();
				$this->template->load('template','keluar/editnota',$data);
			}
		}
		else
		{
			echo "<script>alert('Halaman tidak ditemukan.');
			window.location.href='".base_url()."gudangobat/keluar/datanotamasuk';</script>";
		}
	}
}