<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class Masuk extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}
		$this->load->model('masuk/m_master');
	}

	function nota()
	{
		$data['supplier']=$this->m_master->get_supplier();
		$this->template->load('template','masuk/nota',$data);
	}

	function listmasuk()
	{
		$this->template->load('template','masuk/listmasuk');
		
	}

	function datanotamasuk()
	{
		$data['tgl_transaksi']	=	$this->m_master->get_tgl();
		$data['supplier']	  	=	$this->m_master->get_supplier_transaksi();
		$data['penyerah']		=	$this->m_master->get_penyerah();
		$data['penerima']		=	$this->m_master->get_penerima();
		$this->template->load('template','masuk/datanotamasuk',$data);
	}

	function editnota()
	{
		if(isset($_GET['nota']))
		{
			$cek=$this->m_master->cek_nota($_GET['nota']);
			if($cek->num_rows() <= 0)
			{
				echo "<script>alert('Nomor nota tidak ditemukan.');
				window.location.href='".base_url()."gudangobat/masuk/datanotamasuk';</script>";
			}
			else
			{
				$data['row']=$cek->row_array();
				$data['supplier']=$this->m_master->get_supplier();
				$this->template->load('template','masuk/editnota',$data);
			}
		}
		else
		{
			echo "<script>alert('Halaman tidak ditemukan.');
			window.location.href='".base_url()."gudangobat/masuk/datanotamasuk';</script>";
		}
	}

}