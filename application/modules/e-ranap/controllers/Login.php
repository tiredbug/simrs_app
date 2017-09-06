<?php 
/**
* 
*/
class Login extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(login_ranap())
		{
			redirect(base_url().'e-ranap/home');
		}
		$this->load->model("m_login");

	}

	function index()
	{
		$data['nama_rs']	=	$this->m_login->get_namars()->row_array();
    	$data['alamat_rs']	=	$this->m_login->get_alamatrs()->row_array();
    	$data['tlf_rs']		=	$this->m_login->get_tlfrs()->row_array();
    	$data['fax_rs']		=	$this->m_login->get_faxrs()->row_array();
		$this->load->view('login',$data);
	}

	function login_auth()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
            $pesan_err='';
            if($this->m_login->cek_login()->num_rows() > 0)
            {
                $sukses=true;
                $data=$this->m_login->cek_login()->row_array();
                $this->session->set_userdata($data);
                $this->session->set_userdata('login_ranap',true);
                $this->logapp->log_user($_SESSION['kode_users'],'masuk aplikasi.');
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