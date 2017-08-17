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
            echo "<option value=''>-- Pilih --</option>";
            foreach($this->m_master->get_klp($cb)->result() as $c)
            {	
                echo"<option value='".$c->id_kelompok."'>".$c->nama_kelompok."</option>";
            }
        }
    	
    }


    function register_kunjungan()
    {
        if(!$this->input->is_ajax_request())
        {
            exit('No direct script access allowed');
        }
        else
        {
            $data=array('success'=>false,'message'=>array(),'pesan_err'=>'');


            // falidasi form input kunjungna igd
            $this->load->library("form_validation");
            $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
            $this->form_validation->set_rules('nrm','Nomor rekam medis','is_natural|callback_cek_norek_pasien',array(
                'is_natural'=>'%s harus angka.'
                ));
            $this->form_validation->set_rules("cb","Metode pembayaran",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("kelompok","Kelompok anggota",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("kelas","Kelas perawatan",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("tgl_daftar","Tgl daftar",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("jam_daftar","Jam daftar",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("cr","Cara rujuk",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("diagnosa","Diagnosa",'required',array('required'=>"%s wajib diisi."));
            $this->form_validation->set_rules("dokter","Dokter",'required',array('required'=>"%s wajib diisi."));

            if($this->form_validation->run())
            {

            	// hitung umur pasien 
	            $this->load->helper('umur');
	            $tgl_lahir  =   $this->m_function->get_tgllahir($this->input->post('nrm'))->row_array();
	            $umur       =   hitung_umur($tgl_lahir['tgl_lahir']);
	            $umur_thn   =   $umur['tahun']=='0'?'0':$umur['tahun'];
	            $umur_bln   =   $umur['bulan']=='0'?'0':$umur['bulan'];
	            $umur_hr    =   $umur['hari']=='0'?'0':$umur['hari'];

	            // nomor kunjungan 
	            $nomor_kunjungan    =   $this->buat_nomorkunjungan();

	            // nomor sep
	            $sep='';

            	// deklarasi field tabel pendaftaran_kunjungan dan isi field 
	            $data_kunjungan=array(
	                'nomor_kunjungan'       =>  $nomor_kunjungan,
	                'norekammedis'          =>  $this->input->post('nrm'),
	                'kode_carabayar'        =>  $this->input->post('cb'),
	                'kode_kelompok'         =>  $this->input->post('kelompok'),
	                'tgl_daftar'            =>  tgl_mysql($this->input->post('tgl_daftar')),
	                'jam_daftar'            =>  $this->input->post('jam_daftar'),
	                'kode_cararujuk'        =>  $this->input->post('cr'),
	                'asal_rujukan'          =>  $this->input->post('asal_rujuk'),
	                'nomor_rujukan'         =>  $this->input->post('nomor_rujukan'),
	                'tgl_rujukan'           =>  tgl_mysql($this->input->post('tgl_rujukan')),
	                'jam_rujukan'           =>  $this->input->post('jam_rujuk'),
	                'ppk_rujukan'           =>  $this->input->post('ppk_rujuk'),
	                'diagnosa'              =>  $this->input->post('diagnosa'),
	                'kode_kelas'            =>  $this->input->post('kelas'),
	                'nomor_sep'             =>  $sep,
	                'penanggung_jawab'      =>  $this->input->post('nm_k'),
	                'hubungan_denganpasien' =>  $this->input->post('hub_k'),
	                'alamat_penanggungjawab'=>  $this->input->post('alamat_k'),
	                'hp_penanggungjawab'    =>  $this->input->post('hp_k'),
	                'jenis_kunjungan'       =>  'igd',
	                'status_kunjungan'      =>  'Masih dirawat',
	                'jenis_pasien'          =>  $this->input->post('j_p'),
	                'umur_tahun'            =>  $umur_thn,
	                'umur_bulan'            =>  $umur_bln,
	                'umur_hari'             =>  $umur_hr,
	                'deposito'              =>  $this->input->post('deposito')
	                );
	            // deklasri informasi kunjungna igd
	            $igd=array(
	            	'kode_dokter'=>$_POST['dokter'],
	            	'nomor_kunjungan'=>$nomor_kunjungan,
	            	'tgl_masuk'=>tgl_mysql($_POST['tgl_daftar']),
	            	'jam_masuk'=>$_POST['jam_daftar']
	            	);



	            if($this->m_function->void_registerrajal($data_kunjungan,$igd))
	            {
	            	$data['success']=true;
	            }
	            else
	            {
	            	$data['pesan_err']="Gagal register kunjungan pasien.";
	            }

            }
            else
            {
            	foreach ($_POST as $key => $value) {
                    # code...
                    $data['message'][$key]=form_error($key);
                }
            }
            echo json_encode($data);
        }
    	
    }

    function buat_nomorkunjungan()
    {
        $hitung_kunjungan=  $this->m_function->max_nomorkunjungan();
        $jumlah=$hitung_kunjungan['nomor_kunjungan'];
        return sprintf("%09d",$jumlah+1);
    }


    function cek_norek_pasien($norek)
    {

    	if($norek=='')
    	{
    		$this->form_validation->set_message("cek_norek_pasien","No. Medrec wajib diisi.");
            return false;
    	}
    	elseif (strlen($norek)<6) 
    	{
    		# code...
    		$this->form_validation->set_message("cek_norek_pasien",'No.medrec kurang dari 6 digit.');
    		return false;
    	}
    	elseif($this->m_function->cek_norek($norek)->num_rows() > 0)
    	{
    		if($this->m_function->cek_kunjungan($norek)->num_rows() > 0)
	    	{
	    		$this->form_validation->set_message("cek_norek_pasien","Masih dirawat belum checkout.");
	    		return false;
	    	}
	    	else
	    	{
	    		return true;
	    	}
    	}
    	elseif($this->m_function->cek_norek($norek)->num_rows()==0)
    	{
    		$this->form_validation->set_message("cek_norek_pasien","No. Medrec tidak dikenal.");
    		return false;
    	}
    }


    function get_data_kunjungan_igd()
    {
    	if(!$this->input->is_ajax_request())
        {
            exit('No direct script access allowed');
        }
        else
        {
        	$data=array(
        		'draw'=>$_POST['draw'],
        		'recordsTotal'=>$this->m_function->count_all_data_kunjungan_igd(),
        		'recordsFiltered'=>$this->m_function->count_all_filtered_data_kunjungan_igd(),
        		'data'=>array()
        		);

        	$data_r=$this->m_function->get_data_kunjungan_igd();
        	foreach ($data_r->result() as $r) {
        		# code...
        		$row=array();
        		$row[]=$r->no_kunjungan;
        		$row[]=$r->no_kunjungan;
        		$row[]=$r->norek;
        		$row[]=$r->nama;
        		$row[]=$r->alamat;
        		$row[]=$r->jk;
        		$row[]=$r->cb;
        		$row[]=$r->dokter;
        		$row[]=$r->diagnosa;
        		$row[]=$r->pj;
        		$data['data'][]=$row;
        	}
        	echo json_encode($data);
        }
    }


    function hapus_kunjungan()
    {
        if(!$this->input->is_ajax_request())
        {
            exit('No direct script access allowed');
        }
        else
        {
            $data=array(
                'success'=>true,
                'pesan_sukses'=>'',
                'pesan_err'=>''
                );
            echo json_encode($data);
        }
    }


    function get_informasi_kunjungan_lengkap()
    {
        if(!$this->input->is_ajax_request())
        {
            exit('No direct script access allowed');
        }
        else
        {
            $respon=array(
                'success'=>false,
                'i_pasien'=>array(),
                'i_kunjungan'=>array(),
                'i_history'=>array()
                );
            $respon['i_pasien']=$this->m_function->get_informasi_pasien($_POST['id'])->row_array();
            $respon['i_kunjungan']=$this->m_function->get_informasi_kunjungan($_POST['id'])->row_array();
            $respon['i_history']=$this->m_function->get_informasi_history_kunjungan($_POST['id'])->result();
            echo json_encode($respon);
        }
    }


}