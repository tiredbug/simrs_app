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
		$this->load->model('login/M_master');
        $this->load->model('login/M_function');
        $this->load->model('m_billing');
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
		if(! isset($_GET['nobilling']))
		{
			echo "<script>alert('URL tidak valid.');window.location.href='".base_url()."kasir/home'</script>";
		}
		elseif($_GET['nobilling']=='')
		{
			echo "<script>alert('URL tidak valid.');window.location.href='".base_url()."kasir/home'</script>";
		}
		else
		{
			$this->load->library('libpdf');
			try {
				ob_start();
				$data['nama_rs']	=	$this->M_master->get_namars()->row_array();
		    	$data['alamat_rs']	=	$this->M_master->get_alamatrs()->row_array();
		    	$data['tlf_rs']		=	$this->M_master->get_tlfrs()->row_array();
		    	$data['fax_rs']		=	$this->M_master->get_faxrs()->row_array();
		    	$data['i_head']		=	$this->m_billing->get_head($_GET['nobilling'])->row_array();
		    	switch ($data['i_head']['pl']) {
		    		case 'igd':
		    			# code...
		    			$data['t']=$this->m_billing->get_tindakan_igd($data['i_head']['no_k']);
			    		$this->load->view('billing_igd_pdf',$data);
						$konten=ob_get_contents();
						ob_end_clean();
		    			break;
		    		default:
		    		echo "<script>alert('Billing rusak');window.location.href='".base_url()."kasir/home'</script>";
		    		break;
		    	}
				$html2pdf=new HTML2PDF("P",'A4','en');
				$html2pdf->setDefaultFont('courier');
				$html2pdf->writeHTML($konten);
				$html2pdf->output("Billing_".$_GET['nobilling'].".pdf");
						
			} catch (Exception $e) {
				$f=new ExceptionFormatter($e);
				echo $f->getHtmlMessage();
			}
		}
	}

}