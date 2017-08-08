<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

class Hasil_api extends ci_controller{
	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			$json['pesan_err']='Login session time out.';
			echo json_encode($json);
			exit();
		}
		$this->load->model('hasil/m_function');
		$this->load->model('login/M_master');
	}

	function get_data_pemeriksaan()
	{

		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();

			foreach ($this->m_function->get_data_filter()->result() as $k) {
				# code...
				$btn="<a href='".base_url()."lab/hasil/input?nolab=".$k->nomor_lab."' title='Input hasil lab' class='btn btn-flat btn-xs btn-success'><i class='entypo-pencil'></i></a>";
				$row=array();
				$row[]=		sprintf("%010d",$k->nomor_lab);
				$row[]=		$k->norekammedis;
				$row[]=		$k->nama_pasien;
				$row[]=		tgl_biasa($k->tgl_periksa);
				$row[]=		$k->unit_pengirim;
				$row[]=		$k->nama_belakang.' '.$k->nama_dokter.', '.$k->gelar;
				$row[]=		$k->dokter_tanggung_jawab;
				$row[]=		$btn;

				$data[]=$row;
			}

			$json=array(
				'draw'				=>		$this->input->get('draw'),
				'recordsFiltered' 	=> 		$this->m_function->jumlah_record_filtered(),
				'recordsTotal'		=>		$this->m_function->jumlah_record_pemeriksaan(),
				'data'				=> 		$data
				);
			echo json_encode($json);
		}
	}


	function get_data_hasil_lab()
	{
		if(! $this->input->is_ajax_request())
		{
			exit ("No direct script access allowed.");
		}
		else
		{
			$data['hasil_lab']=$this->m_function->get_data_hasil($_GET['nolab']);
			$this->load->view('hasil/tabel_data_hasil_lab',$data);
		}
	}

	function simpan_hasil_lab()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$no=0;
			foreach ($_POST as $key => $val ) {
				# code...
				if($this->m_function->simpan_hasil_lab($key,$this->input->post($key)))
				{
					$sukses=true;
				}
				else
				{
					$err=$this->db->error();
					$pesan_err=$err['message'];
				}
			}
			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}

	function checkout()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=true;
			$pesan_err='';
			if($this->m_function->checkout())
			{
				$sukses=true;
			}
			else
			{
				$err=$this->db->error();
				$pesan_err=$err['message'];
			}
			$json['success']=$sukses;
			$json['pesan_err']=$pesan_err;
			echo json_encode($json);
		}
	}
	function update_keterangan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$this->m_function->update_keterangan();
		}
	}

	function lap_hasillab()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();
			$data['nama_rs']	=	$this->M_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']	=	$this->M_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']		=	$this->M_master->get_tlfrs()->row_array();
	    	$data['fax_rs']		=	$this->M_master->get_faxrs()->row_array();
	    	$data['info']		=	$this->m_function->get_informasi_form_hasil($_GET['nolab'])->row_array();
	    	$data['gr']			=	$this->m_function->get_group_hasil($_GET['nolab'])->result();
	    	    	
			$this->load->view('hasil/cetak_hasil_lab',$data);
		}
	}
	function tes()
	{
		$data=array();
		$data['nama_rs']	=	$this->M_master->get_nama_rs_panjang()->row_array();
    	$data['alamat_rs']	=	$this->M_master->get_alamatrs()->row_array();
    	$data['tlf_rs']		=	$this->M_master->get_tlfrs()->row_array();
    	$data['fax_rs']		=	$this->M_master->get_faxrs()->row_array();
    	$data['info']		=	$this->m_function->get_informasi_form_hasil('1')->row_array();
    	$data['gr']			=	$this->m_function->get_group_hasil('1')->result();
    	    	
		$this->load->view('hasil/cetak_hasil_lab',$data);
	}


}