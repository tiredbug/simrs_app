<?php
/**
* 
*/
class Penatajasa_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('m_penatajasa');
	}


	function get_info_kunjungan()
	{
		$r= array(
			'success' => true, 
			'i_p'=>array(),
			'i_t'=>array(),
			'i_cb'=>$this->m_penatajasa->get_i_cb()->result(),
			'i_klp'=>array(),
			'i_r'=>array(),
			'i_kmr'=>array()
			);
		$cek=$this->m_penatajasa->get_informasi_kunjungan($_POST['norek']);
		if($cek->num_rows()>0)
		{
			$r['success']=true;
			$r['i_p']=$cek->row_array();
			$r['i_klp']=$this->m_penatajasa->get_i_klp($r['i_p']['cb'])->result();
			$r['i_r']=$this->m_penatajasa->get_i_r()->result();
			$r['i_kls']=$this->m_penatajasa->get_i_kls()->result();
			$r['i_kmr']=$this->m_penatajasa->get_i_kmr($r['i_p']['ruang'],$r['i_p']['kelas'])->result();
			$r['i_bed']=$this->m_penatajasa->get_i_bed($r['i_p']['kamar'])->result();
		}
		else
		{
			$r['success']=false;
		}

		echo json_encode($r);
	}

	function get_i_kelompok()
	{
		echo json_encode($this->m_penatajasa->get_i_klp($_POST['cb'])->result());
	}

	function get_i_kmr()
	{
		echo json_encode($this->m_penatajasa->get_i_kmr($_POST['ruang'],$_POST['kelas'])->result());
	}

	function get_i_bed()
	{
		echo json_encode($this->m_penatajasa->get_i_bed($_POST['kamar'])->result());
	}

	function ubah_ruangan()
	{

		$r=array('success'=>false,'message'=>array());

		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<p class='text-danger'>",'</p>');
        $this->form_validation->set_rules("cb",'Cara bayar','required',array('required'=>'%s wajib*'));
        $this->form_validation->set_rules("klp",'Kelompok peserta','required',array('required'=>'%s wajib*'));
        $this->form_validation->set_rules("ruang",'Ruang','required',array('required'=>'%s wajib*'));
        $this->form_validation->set_rules("kelas",'Kelas','required',array('required'=>'%s wajib*'));
        $this->form_validation->set_rules("kamar",'Kamar','required',array('required'=>'%s wajib*'));
        $this->form_validation->set_rules("bed",'No. Bed','required',array('required'=>'%s wajib*'));
        if($this->form_validation->run())
        {
        	
        	if($this->m_penatajasa->update_ruangan())
			{
				$r['success']=true;
			}
			else
			{
				$r['success']=false;
			}
        }
        else
        {
        	foreach ($_POST as $key => $value) {
            # code...
                $r['message'][$key]=form_error($key);
            }
        }
		echo json_encode($r);
	}

	function pindah_ruangan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r = array('success' =>false ,'message'=>array() );

			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters("<p class='text-danger'>",'</p>');
        	$this->form_validation->set_rules("tgl_keluar",'Tgl keluar','required',array('required'=>'%s wajib*'));
        	$this->form_validation->set_rules("jam_keluar",'Jam keluar','required',array('required'=>'%s wajib*'));
        	$this->form_validation->set_rules("ruangan_p",'Ruangan','required',array('required'=>'%s wajib*'));
        	$this->form_validation->set_rules("kelas_p",'Kelas','required',array('required'=>'%s wajib*'));
        	$this->form_validation->set_rules("kamar_p",'Kamar','required',array('required'=>'%s wajib*'));
        	$this->form_validation->set_rules("bed_p",'Nomor bed','required',array('required'=>'%s wajib*'));
        	if($this->form_validation->run())
        	{
        		
        		if($this->m_penatajasa->pindah_ruangan())
        		{
        			$r['success']=true;
        		}
        		else
        		{
        			$r['success']=false;
        		}
        	}
        	else
        	{
        		foreach ($_POST as $key => $value) {
        			# code...
        			$r['message'][$key]=form_error($key);
        		}
        	}
			echo json_encode($r);
		}
	}


}