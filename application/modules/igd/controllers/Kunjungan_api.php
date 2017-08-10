<?php if(! defined("BASEPATH")) exit ("No direct script access allowed.");

class Kunjungan_api extends ci_controller{

	function __construct()
	{
		parent::__construct();
		if(! login_igd())
		{
			redirect(base_url().'igd/login');
		}
		$this->load->model('kunjungan/m_function');
		$this->load->model('kunjungan/m_master');
		
	}


	function cek_pasien()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array(
				'success'=>false,
				'pesan'=>array(
					'pesan'=>'',
					'isi'=>''
					),
				'data'=>array(
					'stt_k_last'=>false,
					'kunjungan_t'=>'',
					'umur'=>'',
					'nama'=>'',
					'nik'=>'',
					'asu'=>'',
					'jk'=>'',
					'alamat'=>''
					),
				);

			if($this->m_function->cek_norek($_POST['nrm'])->num_rows() > 0)
			{
				if($this->m_function->cek_kunjungan($_POST['nrm'])->num_rows() >0)
				{
					$data['pesan']['isi']='Pasien masih dirawat atau belum dicheckout pada kunjungan sebelumnya.';
					$data['pesan']['title']='Sedang dirawat !';
				}
				else
				{
					$data['success']=true;
					$data_pasien=$this->m_function->get_info_pasien($_POST['nrm'])->row_array();
					$data['data']['nama']=$data_pasien['nama'];
					$data['data']['nik']=$data_pasien['nik'];
					$data['data']['asu']=$data_pasien['asu'];
					$data['data']['jk']=$data_pasien['jk'];
					$data['data']['alamat']=$data_pasien['alamat'];

					$this->load->helper('umur');
                    $umur       =   hitung_umur($data_pasien['tgl_lahir']);
                    $umur_thn   =   $umur['tahun']=='0'?'':$umur['tahun'].'thn';
                    $umur_bln   =   $umur['bulan']=='0'?'':$umur['bulan'].'bln';
                    $umur_hr    =   $umur['hari']=='0'?'':$umur['hari'].'hri';
                    $data['data']['umur']       =   $umur_thn.' '.$umur_bln.' '.$umur_hr;


                    // cek kunjungan terakhir
                    if($this->m_function->get_info_kunjungan($_POST['nrm'])->num_rows() >0)
                    {
                    	$data['data']['stt_k_last']=true;
                    	$dt_kj      =   $this->m_function->get_info_kunjungan($_POST['nrm'])->row_array();
                        $ht_k       =   hitung_umur($dt_kj['tgl']);
                        $ht_thn     =   $ht_k['tahun']=='0'?'':$ht_k['tahun'].'thn';
                        $ht_bln     =   $ht_k['bulan']=='0'?'':$ht_k['bulan'].'bln';
                        $ht_hr      =   $ht_k['hari']=='0'?'':$ht_k['hari'].'hri';
                        $data['data']['kunjungan_t']       =   $ht_thn.' '.$ht_bln.' '.$ht_hr;
                    }
				}
			}
			else
			{
				$data['pesan']['isi']='Nomor rekam medis tidak ditemukan';
				$data['pesan']['title']='Not Found !';
			}
			echo json_encode($data);
		}
	}


	function get_klp()
    {
        if(!$this->input->is_ajax_request())
        {
            exit('No direct script access allowed');
        }
        else
        {
            $cb=$this->input->post('cb');
            foreach($this->m_master->get_klp($cb)->result() as $c)
            {
                    echo"<option value='".$c->id_kelompok."'>".$c->nama_kelompok."</option>";
            }
        }
    	
    }


}