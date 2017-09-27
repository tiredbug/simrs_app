<?php 
/**
* 
*/
class Laporan extends ci_controller
{
	
	function __construct()
	{
		parent::__construct();
		if(! login_ranap())
		{
			redirect(base_url().'e-ranap/login');
		}
		$this->load->model('m_laporan');
		$this->load->model("m_login");
	}

	function laporanbulanan_api()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			//proses.....
			$r=array(
				'draw'=>$_POST['draw'],
				'recordsTotal'=>$this->m_laporan->count_lap_bulanan_total(),
				'recordsFiltered'=>$this->m_laporan->count_lap_bulanan_filtered(),
				'data'=>array(),
			);

			foreach ($this->m_laporan->get_data_laporan_bulanan()->result() as $lp) {
				# code...
				$row=array();
				$row[]=$lp->nomr;
				$row[]=$lp->nama;
				$row[]=$lp->jk;
				$row[]=$lp->cb;
				$row[]=$lp->kls;
				$row[]=$lp->kamar;
				$row[]=$lp->bed;
				$row[]=$lp->tgl_masuk;
				$row[]=$lp->tgl_keluar;
				$row[]=$lp->stt;
				$row[]=$lp->asal_masuk;
				$r['data'][]=$row;
			}


			echo json_encode($r);
		}
	}

	function laporanbulanan()
	{
		if(isset($_GET['format']))
		{
			$data['nama_rs']	=	$this->m_login->get_namars()->row_array();
	    	$data['alamat_rs']	=	$this->m_login->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->m_login->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->m_login->get_faxrs()->row_array();
			switch ($_GET['format']) {
				case 'pdf':
					# code...
					if(isset($_GET['bulan']) && isset($_GET['tahun']))
					{
						if(! empty($_GET['bulan']) && ! empty($_GET['tahun']))
						{
							$this->load->library('libpdf');
							try {
								ob_start();
								$data['bulan']=bln($_GET['bulan']);
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
						if(! empty($_GET['bulan']) && ! empty($_GET['tahun']))
						{
							header("Content-type=application/vnd.ms-excel");
							header("Content-disposition:attachment;filename=laporanbulanan.xls");
							$data['bulan']=bln($_GET['bulan']);
							$data['data']=$this->m_laporan->get_data_laporan_bulanan_format();
							$this->load->view('lap_bulananexcel',$data);
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

	function laporanharian_api()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			//proses.....
			$r=array(
				'draw'=>$_POST['draw'],
				'recordsTotal'=>$this->m_laporan->count_lap_harian_total(),
				'recordsFiltered'=>$this->m_laporan->count_lap_harian_filtered(),
				'data'=>array(),
			);

			foreach ($this->m_laporan->get_data_laporan_harian()->result() as $lp) {
				# code...
				$row=array();
				$row[]=$lp->nomr;
				$row[]=$lp->nama;
				$row[]=$lp->jk;
				$row[]=$lp->cb;
				$row[]=$lp->kls;
				$row[]=$lp->kamar;
				$row[]=$lp->bed;
				$row[]=$lp->tgl_masuk;
				$row[]=$lp->tgl_keluar;
				$row[]=$lp->stt;
				$row[]=$lp->asal_masuk;
				$r['data'][]=$row;
			}


			echo json_encode($r);
		}
	}


	function laporanharian()
	{
		if(isset($_GET['format']))
		{
			$data['nama_rs']	=	$this->m_login->get_namars()->row_array();
	    	$data['alamat_rs']	=	$this->m_login->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->m_login->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->m_login->get_faxrs()->row_array();
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
								$data['data']=$this->m_laporan->get_data_laporan_harian_format();
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
					if(isset($_GET['bulan']) && isset($_GET['tahun']))
					{
						if(! empty($_GET['bulan']) && ! empty($_GET['tahun']))
						{
							header("Content-type=application/vnd.ms-excel");
							header("Content-disposition:attachment;filename=laporanbulanan.xls");
							$data['bulan']=bln($_GET['bulan']);
							$data['data']=$this->m_laporan->get_data_laporan_bulanan();
							$this->load->view('lap_bulananexcel',$data);
						}
					}
					break;
				
			}
		}
		else
		{
			$this->template->load('template','laporanharian');
		}
		
	}

}