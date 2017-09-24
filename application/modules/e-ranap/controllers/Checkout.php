<?php
/**
* 
*/
class Checkout extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_ranap())
		{
			redirect(base_url().'e-ranap/login');
		}
		$this->load->model('m_checkout');
	}

	function index()
	{
		$data['s_k']=$this->m_checkout->get_i_stt_ranap_keluar();
		$this->template->load('template','checkout',$data);
	}


	function get_i_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array('success'=>false,'data'=>array(),'pesan_err');
			$cek=$this->m_checkout->get_i_kunjungan();
			if($cek->num_rows() > 0)
			{
				$r['success']=true;
				$r['data']=$cek->row_array();
			}
			else
			{
				$r['pesan_err']='Kunjungan tidak ditemukan.';
			}
			echo json_encode($r);
		}
	}


	function proses_checkout()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array('success'=>false,'message'=>array());
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>",'</p>');
			$this->form_validation->set_rules('nrm','Nomor rekam medis','is_natural|callback_cek_norek_pasien',array(
                'is_natural'=>'%s harus angka.'
                ));

			$this->form_validation->set_rules('tgl_masuk','Tgl masuk','required',array('required'=>'%s wajib*'));
			$this->form_validation->set_rules('jam_masuk','Jam masuk','required',array('required'=>'%s wajib*'));
			$this->form_validation->set_rules('tgl_keluar','Tgl keluar','required',array('required'=>'%s wajib*'));
			$this->form_validation->set_rules('jam_keluar','Jam keluar','required',array('required'=>'%s wajib*'));
			$this->form_validation->set_rules('cara_keluar','Cara keluar','required',array('required'=>'%s wajib*'));
			if($this->form_validation->run())
			{
				$id=$this->get_id();
				$this->m_checkout->checkout_kunjungan($id);
				$respon['success']=true;
			}
			else
			{
				foreach ($_POST as $key => $value) {
                    # code...
                    $respon['message'][$key]=form_error($key);
                }
			}
			echo json_encode($respon);
		}
	}


	function cek_norek_pasien($norek)
    {

        $sukses=false;
        $pesan_err='';

        // cek apakah masih dirawata 
        if($norek=='')
        {
            $this->form_validation->set_message('cek_norek_pasien','No. Medrec tidak boleh kosong.');
                return false;
        }
        else
        {
        	if($this->m_checkout->cek_norek_pasien($norek)->num_rows() > 0)
        	{
        		return true;
        	}
        	else
        	{
        		$this->form_validation->set_message('cek_norek_pasien','Kunjungan tidak ditemukan.');
        		return false;
        	}
        }
    }

    function get_id()
    {
    	$cek_id=$this->m_checkout->cek_norek_pasien($_POST['nrm'])->row_array();
    	return $cek_id['id_kunjungan'];
    }
}