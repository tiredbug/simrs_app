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
			$r['i_bed']=$this->m_penatajasa->get_i_all_bed($r['i_p']['kamar'])->result();
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

	function get_i_all_bed()
	{
		echo json_encode($this->m_penatajasa->get_i_all_bed($_POST['kamar'])->result());
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

	function get_tindakan()
	{
		if(! $this->input->is_ajax_request()) 
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r = array(
				'success' => false,
				't_group'=>'',
				'tarif'=>'',
				'tarif_normal'=>'',
				'n_tindakan'=>''
			);

			$cek_ti=$this->m_penatajasa->get_i_t();
			if($cek_ti->num_rows() >0)
			{
				$data=$cek_ti->row_array();
				$r['success']=true;
				$r['t_group']=$data['group_tindakan'];
				$r['n_tindakan']=$data['nama_tarif'];
				$r['tarif']=number_format($data['tarif'],0,'.','.');
				$r['tarif_normal']=$data['tarif'];
			}

			echo json_encode($r);
		}
	}

	function search_dokter()
	{
		if(! $this->input->is_ajax_request()) 
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$respon=array('success'=>false,'data'=>array());
            foreach ($this->m_penatajasa->search_dokter($_GET['q'],$_GET['jenis'])->result() as $s) {
                # code...
                $row=array();
                $row['slug']=$s->slug;
                $row['id']=$s->id;
                $respon['data'][]=$row;
            }

            echo json_encode($respon);
		}
	}

	function insert_tindakan()
	{
		if(! $this->input->is_ajax_request()) 
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r = array('success' => false,'pesan_err' );
			$cek_ti=$this->m_penatajasa->get_i_t()->row_array();
			if($this->m_penatajasa->insert_tindakan($cek_ti['tarif']))
			{
				$r['success']=true;
			}
			else
			{
				$r['pesan_err']='gagal menyimpan tindakan, coba lagi.';
			}
			echo json_encode($r);
		}

	}

	function get_data_tindakan_jasa()
	{
		if(! $this->input->is_ajax_request()) 
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$r=array(
				'data'=>$this->m_penatajasa->load_data_penata_jasa()->result(),
				'total'=>$this->m_penatajasa->total_penata_jasa()->row_array()
			);
			echo json_encode($r);
		}
	}

	function hapus_tindakan()
	{
		if(! $this->input->is_ajax_request()) 
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$this->m_penatajasa->hapus_tindakan();
		}
	}

}