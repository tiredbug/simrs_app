<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class Returnobat extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			redirect(base_url().'gudangobat/login');
		}
		$this->load->model('return/m_function');
	}

	function nota()
	{
		$this->template->load('template','return/nota');
	}


	function data()
	{
		$this->template->load('template','return/data');
	}

	function detail()
	{
		if(isset($_GET['nota']))
		{
			$cek=$this->m_function->cek_nota($_GET['nota']);
			if($cek->num_rows() >0)
			{
				$data['row']=$cek->row_array();
				$data['list']=$this->m_function->get_detail_return($data['row']['no_transaksi']);

				$this->template->load('template','return/detail',$data);
			}
			else
			{
				echo "<script>alert('Nomor nota tidak ditemukan.');window.location.href='".base_url()."gudangobat/returnobat/data'</script>";
			}
		}
		else
		{
			echo "<script>alert('Nomor nota tidak valid.');window.location.href='".base_url()."gudangobat/returnobat/data'</script>";
		}
	}
}