<?php
/**
* 
*/
class Datamaster_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! cek_login('admin'))
		{
			redirect(base_url().'admin/login');
		}
		$this->load->model('m_datamaster');
	}

	function get_data_ruangan_inap()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$rs=array(
				'draw'=>$_POST['draw'],
				'data'=>array(),
				'recordsFiltered'=>$this->m_datamaster->count_filtered_data_ruangan_inap(),
				'recordsTotal'=>$this->m_datamaster->count_total_data_ruangan_inap(),
				);
			
			foreach ($this->m_datamaster->get_data_ruangan_inap()->result() as $r_i) {
				# code...
				// generete button
				$btn='';
				foreach ($this->m_datamaster->get_i_kls()->result() as $kls) {
					# code...
					$btn .="<a href='".base_url()."admin/datamaster/kamar?ruang=".$this->encrypt_rs->encode($r_i->id_ruangan)."&kls=".$this->encrypt_rs->encode($kls->id_kelasperawatan)."' class='btn btn-xs ".$kls->warna."'>".$kls->nama_kelasperawatan."</a>";
				}
				// end
				$r=array();
				$r[]=$r_i->id_ruangan;
				$r[]=$r_i->nama_ruangan;
				$r[]=$r_i->status_ruangan;
				$r[]=$btn;
				
				$rs['data'][]=$r;
			}
			echo json_encode($rs);
		}
	}

	function save_ruangan()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array('success'=>true,'id'=>'');
			if($this->m_datamaster->save_ruangan())
			{
				$r['success']=true;
				$r['id']=$_POST['id']+1;
			}
			echo json_encode($r);
		}
	}

	function get_data_kamar_inap()
	{
		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$rs=array(
				'draw'=>$_POST['draw'],
				'data'=>array(),
				'recordsFiltered'=>$this->m_datamaster->count_filtered_data_kamar_inap(),
				'recordsTotal'=>$this->m_datamaster->count_total_data_kamar_inap(),
				);
			
			foreach ($this->m_datamaster->get_data_kamar_inap()->result() as $k_i) {
				# code...
				$r=array();
				$r[]=$k_i->id;
				$r[]=$k_i->nama_kamar;
				$r[]=$k_i->jml;
				$r[]=$this->encrypt_rs->encode($k_i->id);
				
				$rs['data'][]=$r;
			}
			echo json_encode($rs);
		}
	}


	function save_kamar()
	{

		if(!$this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array('success'=>true,'id'=>'');
			if($this->m_datamaster->save_kamar())
			{
				$r['success']=true;
				$r['id']=$_POST['id']+1;
			}
			echo json_encode($r);
		}
	}
}