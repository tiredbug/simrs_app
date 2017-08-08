<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_api extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if(! login_pendaftaran())
        {
            redirect(base_url().'pendaftaran');
        }
        $this->load->model('register/m_master');
        $this->load->model('register/m_function');
        $this->load->model('register/m_core');
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
    
    function cek_nrm()
        {
            if (!$this->input->is_ajax_request()) 
            {
                exit('No direct script access allowed');
            }
            else
            {
                $sukses=false;
                $pesan_err='';
                $nrm=  $this->input->post('nrm');
                $data=array();
                if($this->m_function->cek_kunjungan($nrm)->num_rows() > 0)
                {
                    $pesan_err='Pasien tersebut masih dirawat.';
                }
                else
                {
                    if($this->m_function->cek_norek($nrm)->num_rows() < 1 )
                    {
                        $pesan_err="Nomor rekam medis tidak dikenal.";
                    }
                    else
                    {
                        if($this->m_function->cek_hidup($nrm)->num_rows() > 0)
                        {
                            $pesan_err="Pasien sudah meninggal.";
                        }
                        else
                        {
                            $sukses=true;
                            $ps         =   $this->m_function->cek_norek($nrm)->row_array();
                            $kj         =   $this->m_function->get_info_kunjungan($nrm);
                            $ht_k       =   '';
                            $stt_l      =    false;

                            $this->load->helper('umur');
                            $umur       =   hitung_umur($ps['tgl_lahir']);
                            $umur_thn   =   $umur['tahun']=='0'?'':$umur['tahun'].'thn';
                            $umur_bln   =   $umur['bulan']=='0'?'':$umur['bulan'].'bln';
                            $umur_hr    =   $umur['hari']=='0'?'':$umur['hari'].'hri';
                            $umur       =   $umur_thn.' '.$umur_bln.' '.$umur_hr;

                            // kunjungan terakhir
                            if($kj->num_rows() > 0)
                            {   
                                $dt_kj      =   $kj->row_array();
                                $ht_k       =   hitung_umur($dt_kj['tgl']);
                                $ht_thn     =   $ht_k['tahun']=='0'?'':$ht_k['tahun'].'thn';
                                $ht_bln     =   $ht_k['bulan']=='0'?'':$ht_k['bulan'].'bln';
                                $ht_hr      =   $ht_k['hari']=='0'?'':$ht_k['hari'].'hri';
                                $ht_k       =   $ht_thn.' '.$ht_bln.' '.$ht_hr;
                                $stt_l      =   true;
                            }
                            
                            // end    
                            $row=array(
                                'bio'       =>  $ps,
                                'umur'      =>  $umur,
                                'ht_k'      =>  $ht_k,
                                'stt_las_k' =>  $stt_l
                            );
                            
                            $data=$row;
                        }
                    }
                
                }
                $json['success']=$sukses;
                $json['pesan_err']=$pesan_err;
                $json['data']=$data;
                echo json_encode($json);
            }
        }

    function get_drpiket()
    {
        if(! $this->input->is_ajax_request())
        {
            exit("No direct script access allowed");
        }
        else
        {
            $data=array();
            $html=array();

            foreach($this->m_master->get_drpiket($this->input->post('poli'))->result() as $dr)
            {
                $gelar=$dr->gelar==''?'':','.$dr->gelar;
                $row=array(
                    'id'=>$dr->kode_dokter,
                    'value'=>$dr->nama_belakang.' '.$dr->nama_dokter.$gelar
                    );
                $html[]=$row;
            }


            $json['data']=$data;
            $json['html']=$html;
            echo json_encode($json);
        }
    }

    function register_rajal()
    {
        if(!$this->input->is_ajax_request())
        {
            exit ("No direct script access allowed");
        }
        else
        {
            // variabel respon 
            $sukses=false;
            $pesan_err='';


            // variabel lain
            $nomor_kunjungan='';
            $sep='';
            $nomor_antrian='';



            // hitung umur pasien 
            $this->load->helper('umur');
            $tgl_lahir  =   $this->m_function->get_tgllahir($this->input->post('nrm'))->row_array();
            $umur       =   hitung_umur($tgl_lahir['tgl_lahir']);
            $umur_thn   =   $umur['tahun']=='0'?'0':$umur['tahun'];
            $umur_bln   =   $umur['bulan']=='0'?'0':$umur['bulan'];
            $umur_hr    =   $umur['hari']=='0'?'0':$umur['hari'];


            // membuat nomor kunjungan dan nomor antrian di poli 
            $nomor_kunjungan    =   $this->buat_nomorkunjungan();
            $nomor_antrian      =   $this->buat_nomorantrian($this->input->post('poli'));



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
                'jenis_kunjungan'       =>  'Rajal',
                'status_kunjungan'      =>  'Masih dirawat',
                'jenis_pasien'          =>  $this->input->post('j_p'),
                'umur_tahun'            =>  $umur_thn,
                'umur_bulan'            =>  $umur_bln,
                'umur_hari'             =>  $umur_hr,
                'deposito'              =>  $this->input->post('deposito')
                );



            // deklarasi field tabel rajal_kunjungan dan isi fieldnya
            $data_rajal=array(
                'nomor_antrian'     =>  $nomor_antrian,
                'nomor_kunjungan'   =>  $nomor_kunjungan,
                'kode_poliklinik'   =>  $this->input->post('poli'),
                'kode_dokter'       =>  $this->input->post('dokter')
                );


            // id paling besar terbaru
            $id=$this->create_id_tindakan_auto();
            // deklarasi data-data tindakan yang harus diinput secara otomatis oleh sistem 

            $data_auto=array();
            foreach ($this->m_function->get_biaya_auto()->result() as $au) {
                # code...
                $row=array();
                $row['id']=$id;
                $row['nomor_kunjungan']=$nomor_kunjungan;
                $row['id_auto']=$au->id_auto;
                $data_auto[]=$row;
                $id++;

            }

            $hasil_cek=$this->validasi_sebelum_register_rajal();
            if($hasil_cek['sukses']==true)
            {
                if($this->m_core->void_registerrajal($data_kunjungan,$data_rajal,$data_auto)==TRUE)
                {
                    $sukses=true;
                }
                else
                {
                    $pesan_err='Gagal mendaftar pasien untuk berobat jalan, periksa kembali data inputan anda.';
                }
            }
            else
            {
                $pesan_err=$hasil_cek['pesan_err'];
            }

            $json['success']=$sukses;
            $json['pesan_err']=$pesan_err;
            echo json_encode($json);
        }
    }



    //validasi data sebelum didaftara rawat jalan.
    function validasi_sebelum_register_rajal()
    {

        $sukses=false;
        $pesan_err='';

        // cek apakah masih dirawata 
        if($this->m_function->cek_kunjungan($this->input->post('nrm'))->num_rows() > 0)
        {
            // masih dirawat 
            $pesan_err='Pasien tersebut masih dirawat.';
        }
        else if($this->m_function->cek_norek($this->input->post('nrm'))->num_rows() < 1)
        {
            // tidak dikenal
            $pesan_err='Nomor rekam medis tidak dikenal, Masukkan nomor rekam medis kemudian tekan tombol enter.';
        }
        else if($this->m_function->cek_hidup($this->input->post('nrm'))->num_rows() > 0)
        {
            // sudah meninggal 
            $pesan_err="Pasien sudah meninggal.";
        }
        else
        {
            $sukses=true;
        }

        $respon=array(
            'sukses'=>$sukses,
            'pesan_err'=>$pesan_err
            );

        return $respon;
    }

    function buat_nomorkunjungan()
    {
        $hitung_kunjungan=  $this->m_function->max_nomorkunjungan();
        $jumlah=$hitung_kunjungan['nomor_kunjungan'];
        return sprintf("%09d",$jumlah+1);
    }

    function buat_nomorantrian($poli)
    {
        $max_antri=$this->m_function->max_antri($poli);
        $jumlah=$max_antri['nomor_antrian'];
        return sprintf("%03d",$jumlah+1);
    }

    // mencari id tindakan automatis paling besar 
    function create_id_tindakan_auto()
    {
        return $this->m_function->max_id_tindakan_auto()+1;
    }

    function tes()
    {
            $id=$this->create_id_tindakan_auto();
            // deklarasi data-data tindakan yang harus diinput secara otomatis oleh sistem 

            $data=array();
            foreach ($this->m_function->get_biaya_auto()->result() as $au) {
                # code...
                $row=array();
                $row['id']=$id;
                $row['nomor_kunjungan']='00';
                $row['id_auto']=$au->id_auto;
                $data[]=$row;
                $id++;

            }
            foreach ($data as $d => $value) {
                # code...
               echo $value['id'];
            }
            
    }
}