<?php
/**
* 
*/
class Kunjungan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_kasir())
		{
			redirect(base_url().'kasir/home');
		}
		$this->load->model('m_kunjungan');
	}


	function igd()
	{
		$this->template->load('template','data_kunjungan_igd');
	}

	function checkout()
	{
		switch ($_GET['asal']) {
			case 'igd':
				# code...
				if($this->m_kunjungan->get_i_kunjungan_asal_igd()->num_rows() >0)
				{
					$data['i']=$this->m_kunjungan->get_i_kunjungan_asal_igd()->row_array();
					$data['i_t_igd']=$this->m_kunjungan->get_i_t_igd();
					$data['i_k']=$this->m_kunjungan->get_keterangan_checkout_igd();
					$this->template->load('template','billing_igd',$data);
				}
				else
				{
					echo "<script>alert('Kunjungan tidak ditemukan.');window.location.href='".base_url()."kasir/kunjungan/igd'</script>";
				}
				break;
			
		}
	}


	function cetakbilling()
	{
		$no_billing=$_GET['nobilling'];
		echo $no_billing;
	}
}