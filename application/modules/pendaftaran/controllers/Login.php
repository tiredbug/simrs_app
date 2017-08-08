<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if(login_pendaftaran()==true)
        {
            redirect(base_url().'pendaftaran');
        }
        $this->load->model('login/M_master');
        $this->load->model('login/M_function');
    }
    
    function index()
    {
    	$data['nama_rs']=$this->M_master->get_namars()->row_array();
    	$data['alamat_rs']=$this->M_master->get_alamatrs()->row_array();
    	$data['tlf_rs']=$this->M_master->get_tlfrs()->row_array();
    	$data['fax_rs']=$this->M_master->get_faxrs()->row_array();
        $this->load->view('login',$data);
    }

    function login_auth()
    {
        if(! $this->input->is_ajax_request())
        {
            exit("No direct script allowed access.");
        }
        else
        {
            $sukses=false;
            $pesan_err='';
            if($this->M_function->cek_login()->num_rows() > 0)
            {
                $sukses=true;
                $data=$this->M_function->cek_login()->row_array();
                $this->session->set_userdata($data);
                $this->session->set_userdata('login_pendaftaran',true);
            }
            else
            {
                $pesan_err="Gagal verifikasi login, coba lagi.";
            }

            $json['success']=$sukses;
            $json['pesan_err']=$pesan_err;
            echo json_encode($json);
        }
    }

}


