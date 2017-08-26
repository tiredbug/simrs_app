<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
* 
*/
class Kunjungan_api extends ci_controller
{
	
	function __construct()
	{
		# code...

		parent::__construct();
		if(! login_coranap())
		{
			redirect(base_url().'coranap/login');
		}
		$this->load->model('kunjungan/m_function');
	}

	function get_kunjungan_igd()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array(
				'draw'=>$_POST['draw'],
				'data'=>array(),
				'recordsFiltered'=>$this->m_function->count_all_filtered_data_kunjungan_igd(),
				'recordsTotal'=>$this->m_function->count_all_data_kunjungan_igd()
				);


			foreach ($this->m_function->get_data_kunjungan_igd()->result() as $k) {
				# code...

				$row=array();
				$row[]=$k->no_kunjungan;
				$row[]=$k->norek;
				$row[]=$k->nama;
				$row[]=$k->alamat;
				$row[]=$k->jk;
				$row[]=$k->cb;
				$row[]=$k->stt;

				$respon['data'][]=$row;
			}


			echo json_encode($respon);
		}
	}


}