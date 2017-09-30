<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Kunjungan_api extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_radiologi())
		{
			exit("Session login expired");
		}
		$this->load->model('m_kunjungan');
	}

	function get_informasi_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{	
			
			$sukses=false;
			$pesan_err='';
			$valid=array();
			$unit='';
			$data='';
			$dokter='';
			$dokter_igd='';

			$asal=$this->input->post('asal');
			switch ($asal) {
				case 'langsung':
					# code...

					// cek pasien langsung ke lab
					$cek=$this->m_kunjungan->cek_kunjungan_rad($this->input->post('norek'),'rad');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					// end 

					break;
				
				case 'igd':
					# code...
					// cek pasien rawat jalan
					$cek=$this->m_kunjungan->cek_kunjungan_rad($this->input->post('norek'),'igd');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
						$respon['dokter_igd']=$this->m_kunjungan->get_dokter_igd($this->input->post('norek'))->row_array();
						
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					// end cek
					break;

				case 'rajal':
					# code...
					$cek=$this->m_kunjungan->cek_kunjungan_rad($this->input->post('norek'),'Rajal');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
						$data['unit']=$this->m_kunjungan->get_poli()->result();
						$data['dokter']=$this->m_kunjungan->get_dokter()->result();
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					break;

				case 'inap':
					# code...
					$cek=$this->m_kunjungan->cek_kunjungan_rad($this->input->post('norek'),'igd');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
						$data['unit']=$this->m_kunjungan->get_ruang()->result();
						$data['dokter']=$this->m_kunjungan->get_dokter()->result();
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					break;
			}


			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['data']=$data;
			$respon['uni']=$unit;

			echo json_encode($respon);
		}
	}



	function get_produk_radiologi_html()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$data['norek']=$_POST['norek'];
			$data['tab']=$this->m_kunjungan->get_tab_head();
			$this->load->view('form_list_produk_radiologi',$data);
		}
	}


	function chart_layanan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$sukses=false;
			$data_r=array();
			switch ($_POST['stt']) {
				case 'c':
					# code...
					$data = array(
				        'norek'      		=> $_POST['norek'],
				        'kode'     			=> $_POST['kode'],
				        'sesi'				=> $_SESSION['__ci_last_regenerate'],
				        'id_user'			=> $_SESSION['kode_user']
					);
					if( $this->db->get_where('radiologi_cart',$data)->num_rows() >0)
					{
						$sukses=true;
					}
					else
					{
						if($this->db->insert('radiologi_cart',$data))
						{
							$sukses=true;
						}
					}
					$data_r=$this->db->query("
						SELECT 
						p.tindakan produk 
						FROM radiologi_produks p
						WHERE p.kode_tindakan='".$_POST['kode']."'
						")->row_array();
					break;
				
				case 'uc':
					# code...
					$data = array(
				        'norek'      		=> $_POST['norek'],
				        'kode'     			=> $_POST['kode'],
				        'sesi'				=> $_SESSION['__ci_last_regenerate'],
				        'id_user'			=> $_SESSION['kode_user']
					);
					$this->db->where($data);
					if($this->db->delete('radiologi_cart'))
					{
						$sukses=true;
					}
					break;
			}

			$respon=array(
				'success'=>$sukses,
				'data'	=>$data_r
				);

			echo json_encode($respon);
		}
	}


	function register_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$r=array('success'=>false,'message'=>array());
			if($this->m_kunjungan->register_kunjungan())
			{
				$r['success']=true;
				
			}

			echo json_encode($r);
		}
	}

}