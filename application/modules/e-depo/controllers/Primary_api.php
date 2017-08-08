<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
/**
 * 
 */
 class Primary_api extends ci_controller
 {
 	
 	function __construct()
 	{
 		# code...
 		parent::__construct();
 		if(! login_depo())
 		{
 			exit("Login session expired.");
 		}
 		$this->load->model('primary/m_function');
 	}


 	function get_data_obat()
 	{
 		if(! $this->input->is_ajax_request())
 		{
 			exit("No direct script access allowed.");
 		}
 		else
 		{
 			$data=array();

 			foreach ($this->m_function->get_data_obat()->result() as $do) {
 				# code...
 				$arr=array();
 				$arr[]=$do->kode;
 				$arr[]=$do->kode.' - '.$do->obat;
 				$arr[]=$do->satuan;
 				$arr[]=$do->value;
 				array_push($data,$arr);
 			}

 			$respon=array(
 				'draw'				=>	$this->input->post('draw'),
 				'recordsTotal'		=>	$this->m_function->get_all_record_obat(),
 				'recordsFiltered'	=>	$this->m_function->get_filtered_record_obat(),
 				'data'				=>	$data
 				);
 			echo json_encode($respon);
 		}
 	}
 } 