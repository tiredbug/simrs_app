<?php  if(! defined("BASEPATH")) exit ("No direct script access allowed.");
class Hasil extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			redirect(base_url().'lab/login');
		}
		$this->load->model('hasil/m_function');
	}

	function index()
	{
		$this->template->load('template','hasil/form_hasil');
	}

	function input()
	{
		if(isset($_GET['nolab']))
		{
			if($this->m_function->cek_kunjungan_lab($_GET['nolab'])->num_rows()>0)
			{
				$data['info']=$this->m_function->get_informasi_form_hasil($_GET['nolab'])->row_array();
				//echo var_dump($data['info']);
				$this->template->load('template','hasil/form_input_hasil',$data);
			}
			else
			{
				echo"<script>alert('Kunjungan lab tidak ditemukan.');window.location.href='".base_url()."lab/hasil'</script>";
			}
		}
		else
		{
			redirect(base_url().'lab/hasil');
		}
	}

}