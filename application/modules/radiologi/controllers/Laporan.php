<?php
/**
* 
*/
class Laporan extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_radiologi())
		{
			redirect(base_url().'radiologi/login');
		}
		$this->load->model('m_laporan');
		$this->load->model("login/m_master");
	}

	
	function laporanharian_api()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array(
 				'draw'				=> $this->input->post('draw'),
 				'recordsTotal'		=> $this->m_laporan->count_total_laporan_harian(),
 				'recordsFiltered'	=> $this->m_laporan->count_filtered_laporan_harian(),
 				'data'				=> array()
 			);

			foreach ($this->m_laporan->get_data_laporan_harian_radiologi()->result() as $d) {
				# code...
				$p='';
				foreach ($this->m_laporan->get_periksa($d->norad)->result() as $k) {
					# code...
					$p .='- '.$k->tindakan.'<br/>';
				}
				$arr=array();
				$arr[]=$d->nomr;
				$arr[]=$d->no_k;
				$arr[]=$d->norad;
				$arr[]=$d->nama;
				$arr[]=$d->jk;
				$arr[]=$d->tgl_order;
				$arr[]=$d->dokter_pengirim.'-'.$d->unit;
				$arr[]=$d->dokter_p;
				$arr[]=$d->n_user;
				$arr[]=$p;
	 			array_push($respon['data'],$arr);
			}
 			
 			echo json_encode($respon);
		}
	}

	function laporanharian()
	{

			if(isset($_GET['format']))
			{
				$data['nama_rs']	=	$this->m_master->get_namars()->row_array();
		    	$data['alamat_rs']	=	$this->m_master->get_alamatrs()->row_array();
		    	$data['tlf_rs']		=	$this->m_master->get_tlfrs()->row_array();
		    	$data['fax_rs']		=	$this->m_master->get_faxrs()->row_array();
				switch ($_GET['format']) {
					case 'pdf':
						# code...
						if(isset($_GET['tgl']))
						{
							if(! empty($_GET['tgl']))
							{
								$this->load->library('libpdf');
								try {
									ob_start();
									$data['data']=$this->m_laporan->get_data_laporan_harian_pdf();
									$this->load->view('lap_harianpdf',$data);
									$konten=ob_get_contents();
									ob_end_clean();
									$html2pdf=new HTML2PDF("L",'A4','en');
									$html2pdf->setDefaultFont('Arial');
									$html2pdf->writeHTML($konten);
									$html2pdf->output('laporanharian.pdf');
									
								} catch (Exception $e) {
									$f=new ExceptionFormatter($e);
									echo $f->getHtmlMessage();
								}
							}
						}
						
						break;

					case 'excel':
						# code...
						if(isset($_GET['tgl']))
						{
							if(! empty($_GET['tgl']) )
							{
								header("Content-type=application/vnd.ms-excel");
								header("Content-disposition:attachment;filename=laporanharian.xls");
								$data['bulan']=bln($_GET['tgl']);
								$data['data']=$this->m_laporan->get_data_laporan_harian_pdf();
								$this->load->view('lap_harianexcel',$data);
							}
						}
						break;
					default;
					$this->template->load('template','laporanharian');
					break;
				}
			}
			else
			{
				$this->template->load('template','laporanharian');
			}
	}

	function laporanbulanan()
	{

			if(isset($_GET['format']))
			{
				$data['nama_rs']	=	$this->m_master->get_namars()->row_array();
		    	$data['alamat_rs']	=	$this->m_master->get_alamatrs()->row_array();
		    	$data['tlf_rs']		=	$this->m_master->get_tlfrs()->row_array();
		    	$data['fax_rs']		=	$this->m_master->get_faxrs()->row_array();
				switch ($_GET['format']) {
					case 'pdf':
						# code...
						if(isset($_GET['bulan']) && isset($_GET['tahun']))
						{
							if(! empty($_GET['bulan']) || ! empty($_GET['tahun']))
							{
								$this->load->library('libpdf');
								try {
									ob_start();
									$data['data']=$this->m_laporan->get_data_laporan_bulanan_format();
									$this->load->view('lap_bulananpdf',$data);
									$konten=ob_get_contents();
									ob_end_clean();
									$html2pdf=new HTML2PDF("L",'A4','en');
									$html2pdf->setDefaultFont('Arial');
									$html2pdf->writeHTML($konten);
									$html2pdf->output('laporanbulanan.pdf');
									
								} catch (Exception $e) {
									$f=new ExceptionFormatter($e);
									echo $f->getHtmlMessage();
								}
							}
						}
						
						break;

					case 'excel':
						# code...
						if(isset($_GET['bulan']) && isset($_GET['tahun']))
						{
							if(! empty($_GET['bulan']) || ! empty($_GET['tahun']))
							{
								$this->load->library('libpdf');
								try {
									ob_start();
									$data['data']=$this->m_laporan->get_data_laporan_bulanan_format();
									$this->load->view('lap_bulananpdf',$data);
									$konten=ob_get_contents();
									ob_end_clean();
									$html2pdf=new HTML2PDF("L",'A4','en');
									$html2pdf->setDefaultFont('Arial');
									$html2pdf->writeHTML($konten);
									$html2pdf->output('laporanbulanan.pdf');
									
								} catch (Exception $e) {
									$f=new ExceptionFormatter($e);
									echo $f->getHtmlMessage();
								}
							}
						}
						
						break;
				}
			}
			else
			{
				$this->template->load('template','laporanbulanan');
			}
	}



	function laporanbulanan_api()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array(
 				'draw'				=> $this->input->post('draw'),
 				'recordsTotal'		=> $this->m_laporan->count_total_laporan_bulanan(),
 				'recordsFiltered'	=> $this->m_laporan->count_filtered_laporan_bulanan(),
 				'data'				=> array()
 			);

			foreach ($this->m_laporan->get_data_laporan_bulanan_radiologi()->result() as $d) {
				# code...
				$p='';
				foreach ($this->m_laporan->get_periksa($d->norad)->result() as $k) {
					# code...
					$p .='- '.$k->tindakan.'<br/>';
				}
				$arr=array();
				$arr[]=$d->nomr;
				$arr[]=$d->no_k;
				$arr[]=$d->norad;
				$arr[]=$d->nama;
				$arr[]=$d->jk;
				$arr[]=$d->tgl_order;
				$arr[]=$d->dokter_pengirim.'-'.$d->unit;
				$arr[]=$d->dokter_p;
				$arr[]=$d->n_user;
				$arr[]=$p;
	 			array_push($respon['data'],$arr);
			}
 			
 			echo json_encode($respon);
		}
	}
		

}