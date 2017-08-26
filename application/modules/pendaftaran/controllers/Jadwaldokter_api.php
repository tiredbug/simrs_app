<?php if(!defined("BASEPATH")) exit ("No direct script access allowed.");

class Jadwaldokter_api extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_pendaftaran())
		{
			redirect(base_url().'pendaftaran/login');
		}
		$this->load->model('jadwaldokter/m_function');
		$this->load->model('jadwaldokter/m_core');
		$this->load->model('jadwaldokter/m_master');
	}

	function load_piket_rajal()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit ("No direct script allowed access.");
		}
		else
		{
			$bulan='';
			$tgl_akhir='';
			$poli='';

			// atur parameter bulan
			if(isset($_GET['bulan']))
			{
				if($_GET['bulan']==''){
					$tgl 		=	date("Y-m-d");
					$bulan 		=   date("m");
					$tgl_akhir	=	date("t",strtotime($tgl));
				}
				else
				{
					$bulan		=	$_GET['bulan'];
					$tahun		=	date("Y");
					$tgl_awal	=	$tahun."-".$bulan."-01";
					$tgl_akhir	=	date("t",strtotime($tgl_awal));
				}
			}
			else
			{
				$tgl 		=	date("Y-m-d");
				$bulan 		=   date("m");
				$tgl_akhir	=	date("t",strtotime($tgl));
			}

			if(isset($_GET['poli']))
			{
				$poli=$_GET['poli'];
			}

			if($poli=='')
			{
				echo"<blockquote class='blockquote-red'>
					<p>
						<strong>REQUEST BELUM LENGKAP.</strong>
					</p>
					<p>
						<small>
							PILIH POLIKLINIK DAN BULAN YANG AKAN DITAMPILKAN DAFTAR PIKET, APABILA BULAN TIDAK 
							DIPILIH MAKA JADWAL YANG DITAMPILKAN ADALAH JADWAL PADA BULAN AKTIF SEKARANG.
						</small>
					</p>
				</blockquote>";
			}
			else
			{
				$data['data']=array(
					'bulan'		=>	$bulan,
					'tgl_akhir'	=>	$tgl_akhir,
					'poli'		=>	$poli
					);

				$this->load->view('jadwaldokter/data_jadwal_dokter_rajal',$data);
			}
		}
	}


	function hapus_dokter()
	{
		if(! $this->input->is_ajax_request())
		{
			exit ("No direct sript access allowed.");
		}
		else
		{
			$id=$this->input->post('id');
			$this->m_core->hapus_dokter($id);
			$this->logapp->log_user($_SESSION['id'],'hapus data dokter piket id='.$_POST['id']);
		}
	}

	function form_add_dokter_piket()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['data']=array(
				'tgl'=>$this->input->get('tgl'),
				'poli'=>$this->input->get('poli')
				);
			$data['dokter']=$this->m_master->get_dr_to_piket();
			$this->load->view('jadwaldokter/form_add_dokter_piket',$data);
		}
	}
	function add_dokter_piket()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';


			$tgl=$this->input->post('tgl');
			$poli=$this->input->post('poli');
			foreach ($this->input->post('dokter') as $d) {
				# code...
				if($this->m_function->cek_dokter_piket($tgl,$poli,$d) == 0 )
				{
					$this->m_master->save_dokter_piket($tgl,$poli,$d);
				}
				$sukses=true;
				$this->logapp->log_user($_SESSION['id'],'tambah dokter piket poli '.$poli.' dokter '.$d);
			}

			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);

		}
	}



}