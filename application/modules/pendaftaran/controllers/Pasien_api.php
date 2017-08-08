<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pasien_api extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        if(! login_pendaftaran())
        {
            redirect(base_url().'pendaftaran');
        }
        // $this->load->model('register/m_master');
        $this->load->model('pasien/m_function');
        // $this->load->model('register/m_core');
    }

    function get_infopasien()
    {
        if(! $this->input->is_ajax_request())
        {
            exit("No direct script access allowed.");
        }
        else
        {
            $data=$this->m_function->get_infopasien();
            echo json_encode($data->row_array());
        }
    }
}