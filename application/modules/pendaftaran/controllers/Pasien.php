<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pasien extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        if(! login_pendaftaran())
        {
            redirect(base_url().'pendaftaran/login');
        }
        $this->load->model('pasien/m_core');
        $this->load->model('pasien/m_function');
        $this->load->model('pasien/m_master');
    }
    
    function index()
    {
        $this->template->load('template','pasien/database');
    }
    
    function register()
    {
        $data['agama']      =   $this->m_master->get_agama();
        $data['provinsi']   =   $this->m_master->get_provinsi();
        $data['pekerjaan']  =   $this->m_master->get_pekerjaan();
        $data['pendidikan'] =   $this->m_master->get_pendidikan();
        $this->template->load('template','pasien/register',$data);
    }
    
        
    function database()
    {
        $data['prov']       =   $this->m_master->get_provinsi();
        $this->template->load('template','pasien/database',$data);
    }

    function edit_pasien()
    {
        if(isset($_GET['norec']))
        {
            if($this->m_function->cek_norek($_GET['norec']) > 0)
            {
                if($this->m_function->cek_meninggal($_GET['norec'])>0)
                {
                    $this->pesan_pasien_sudah_meninggal();
                }
                else
                {
                    //Proses get row aktif dan data master data 
                    $data['agama']      =   $this->m_master->get_agama();
                    $data['provinsi']   =   $this->m_master->get_provinsi();
                    $data['pekerjaan']  =   $this->m_master->get_pekerjaan();
                    $data['pendidikan'] =   $this->m_master->get_pendidikan();
                    $data['row']        =   $this->m_core->get_rows($_GET['norec'])->row_array();
                    //passing data master berdasarkan data pada row aktif kedalam variabel
                    $data['kab_ktp']    = $this->m_master->get_kab($data['row']['kode_provinsi']);
                    $data['kec_ktp']    = $this->m_master->get_kec($data['row']['kode_kabupaten']); 
                    $data['des_ktp']    = $this->m_master->get_desa($data['row']['kode_kecamatan']);
                    $data['kab_dmsl']   = $this->m_master->get_kab($data['row']['provinsi_domisili']);
                    $data['kec_dmsl']   = $this->m_master->get_kec($data['row']['kabupaten_domisili']);
                    $data['des_dmsl']   = $this->m_master->get_desa($data['row']['kecamatan_domisili']);
                    
                    $this->template->load('template','pasien/edit_pasien',$data);
                }
            }
            else
            {
                $this->pesan_kesalahan_edit_pasien();
            }
        }
        else
        {
            $this->pesan_kesalahan_edit_pasien();
        }
    }
    
    function pesan_kesalahan_edit_pasien()
    {
        echo"<script>alert('URL tidak valid atau No.Medrec tidak ditemukan !');window.location.href='".base_url()."pendaftaran/pasien/database'</script>";
    }
    
    function pesan_pasien_sudah_meninggal()
    {
        echo"<script>alert('Pasien sudah meninggal, keseluruhan data tidak dapat diubah lagi. Hubungi Administrator IT Server!');window.location.href='".base_url()."pendaftaran/pasien/database'</script>";
    }


    function kartu()
    {
        if(isset($_GET['norek']))
        {
            if($this->m_function->cek_norek($_GET['norek']) > 0)
            {
                $data=$this->m_function->get_datakartu($_GET['norek']);
                if($data->num_rows() > 0)
                {
                    $bio=$data->row_array();
                    $this->load->library('cfpdf');
                    $this->load->library('barcode');

                    $this->barcode->buat($bio['nomor_rekammedis']);
                    $img=base_url()."template/assets/barcode/".$bio['nomor_rekammedis'].".png";
                    $kode=$this->barcode->buat('123456');
                    $fpdf=new FPDF("L", "mm", array(85.5,53.6));
                    $fpdf->SetAutoPageBreak(false);
                    $fpdf->AddPage();

                    $fpdf->SetFont("Arial","","8");

                    $fpdf->SetFont("Arial","B","8");
                    $fpdf->cell(2,13,'',0,1,'');
                    $fpdf->setX(1);
                    // $fpdf->SetMargins(0,0,0);


                    $fpdf->cell(20,3,'No.Medrec ',0,0,'L');
                    $fpdf->cell(3,3,':',0,0);

                   

                    $fpdf->SetFont("Arial","B","7");
                    $fpdf->cell(15,3,$bio['nomor_rekammedis'],0,1);

                    $fpdf->SetFont("Arial","B","8");

                    $fpdf->setX(1);
                    $fpdf->cell(20,3,'Nama Lengkap ',0,0,'L');
                    $fpdf->cell(3,3,':',0,0);
                    $fpdf->cell(15,3,$bio['nama_lengkap'],0,1,'L');

                    $fpdf->setX(1);
                    $fpdf->cell(20,3,'Tgl Lahir',0,0,'L');
                    $fpdf->cell(3,3,':',0,0);
                    $fpdf->cell(15,3,tgl_biasa($bio['tgl_lahir']),0,1,'L');

                    $fpdf->setX(1);
                    $fpdf->cell(20,3,'Jenis Kelamin',0,0,'L');
                    $fpdf->cell(3,3,':',0,0);
                    $fpdf->cell(15,3,$bio['jenis_kelamin'],0,1,'L');
                   


                    // $fpdf->cell(25,5,'Nama',0,0,'L');
                    $fpdf->Image($img,2,40,'PNG');
                    $fpdf->Output();
                }
                else
                {
                    echo "<script>alert('Nomor rekam medis tidak dikenal, kartu tidak dapat dicetak.');window.close()</script>";
                }
                
            }
            else
            {
               $this->pesan_kesalahan_edit_pasien();
            }
        }
        else
        {
             echo"<script>alert('URL tidak valid atau No.Medrec tidak ditemukan !');window.close()</script>";
        }
    }
}