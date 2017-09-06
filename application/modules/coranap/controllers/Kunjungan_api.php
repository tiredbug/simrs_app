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




	function get_data_ruang()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else {


			$respon=array('success'=>false,'data'=>array());
			foreach ($this->m_function->get_kamar($this->input->post('ruang'),$this->input->post('kelas'))->result() as $k) {
			// 	# code...
				$row=array();
				$row['id']=$k->id;
				$row['kamar']=$k->kamar;
				$respon['data'][]=$row;
			}
			echo json_encode($respon);
		}
	}


	function get_bed()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else {

			$respon=array('success'=>false,'data'=>array());
			foreach ($this->m_function->get_bed($this->input->post('id_kamar'))->result() as $b) {
				# code...
				$row=array();
				$row['id']=$b->id;
				$row['bed']=$b->nmr;
				$respon['data'][]=$row;
			}

			echo json_encode($respon);
		}
	}


	function search_icdx()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{

			$respon=array('success'=>false,'data'=>array());
			foreach ($this->m_function->search_icdx($_GET['q'])->result() as $s) {
				# code...
				$row=array();
				$row['slug']=$s->id;
				$row['id']=$s->id;
				$respon['data'][]=$row;
			}

			echo json_encode($respon);
		}
	}

	function save_kunjungan_ranap()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array('success'=>false,'message'=>array(),'pesan_err'=>'');
			$this->load->library("form_validation");
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

			// falidasi form input
			$this->form_validation->set_rules("ruang","Ruang rawat inap",'required',array('required'=>"%s wajib diisi."));
			$this->form_validation->set_rules("kelas","Kelas rawat",'required',array('required'=>"%s wajib diisi."));
			$this->form_validation->set_rules("icdx","ICDX masuk",'required',array('required'=>"%s wajib diisi."));
			$this->form_validation->set_rules("kamar","Kamar rawat",'required',array('required'=>"%s wajib diisi."));
			$this->form_validation->set_rules("bed","Tempat tidur",'required',array('required'=>"%s wajib diisi."));
			$this->form_validation->set_rules("dokter","Dokter",'required',array('required'=>"%s wajib diisi."));
			// end
			if($this->form_validation->run())
			{
				
				if($this->m_function->simpan_ranap())
				{
					$this->logapp->log_user($_SESSION['id_users'],'pindah kunjungan '.$_POST['no_kunjungan'].' ke rawat inap dari '.$_POST['asal']);
					$respon['success']=true;
				}
				else
				{
					$respon['pesan_err']='gagal memindahkan pasien ke rawat inap.';
				}
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


	function ranap()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$res=array(
				'draw'=>$_POST['draw'],
				'recordsTotal'=>$this->m_function->count_record_total(),
				'recordsFiltered'=>$this->m_function->count_record_filtered(),
				'data'=>array()
				);

			foreach ($this->m_function->get_data_kunjungan_ranap()->result() as $k) {
				# code...
				$row=array();
				$row[]='';
				$row[]=$k->no_kunjungan;
				$row[]=$k->norek;
				$row[]=$k->nama;
				$row[]=$k->alamat;
				$row[]=$k->jk;
				$row[]=$k->cb;
				$row[]=$k->icd;
				$row[]=$k->asal;
				$res['data'][]=$row;
			}

			echo json_encode($res);
		}
	}

	function get_data_kunjungan_rajal()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$rs=array(
				'draw'=>$_POST['draw'],
				'recordsFiltered'=>0,
				'recordsTotal'=>0,
				'data'=>array()
				);

			foreach ($this->m_function->get_data_kunjungan_rajal()->result() as $d) {
				# code...
				$r=array();
				$r[]=$d->no_kunjungan;
				$r[]=$d->norek;
				$r[]=$d->nama;
				$r[]=$d->alamat;
				$r[]=$d->jk;
				$r[]=$d->cb;
				$r[]='';
				$rs['data'][]=$r;
			}

			echo json_encode($rs);
		}
	}

}
