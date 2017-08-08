<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Master_api extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_go())
		{
			exit("Login session time out & expired, login again please.");
		}
		$this->load->model('master/m_master');
		$this->load->model('master/m_function');
	}

	// fungsi ini untuk membuat respon json ke tabel master obat,
	function get_dataobat()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$data=array();

			foreach ($this->m_master->get_data_obat()->result() as $do) {
				# code...
				$arr=array();
				$arr[]=$do->kode_obat;
				$arr[]=$do->nama_obat;
				$arr[]=$do->merk_type;
				$arr[]=$do->satuan_obat;
				$arr[]='';
				array_push($data, $arr);
			}
			$respon=array(
	            "draw"				=>  $this->input->get('draw'),
	            "recordsTotal"		=>  $this->m_master->obat_count_all_rows(),
	            "recordsFiltered"	=>  $this->m_master->obat_count_filter_rows(),
	            "data"				=>	$data
	        );
	        echo json_encode($respon);
		}
	}

	// fungsi ini untuk hapus data obat, sebenarnya hanya mengubah value delete dari 0 ke 1
	function delete_obat()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$kode=$this->input->post('kode');
			$sukses=false;
			$pesan_err='';

			if($this->m_function->delete_obat($kode))
			{
				$sukses=true;
			}
			else
			{
				$sukses=false;
				$error=$this->db->error();
				$pesan_err=$error['message'];
			}
		}
		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// fungsi untuk mengambil data baris obat, berdasarkan kode, ketika diklik edit pada tabel master obat
	function get_row_obat()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$kode=$this->input->post('kode');
			$sukses=true;
			$pesan_err='';
			if($data=$this->m_function->get_rows_obat($kode)->row_array())
			{
				$sukses=true;
			}
			else
			{
				$err=$this->db->error();
				$pesan_err=$err['message'];
			}

			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['data']=$data;
			echo json_encode($respon);
		}
	}

	// fungsi yang diakses oleh modal master obat
	function obat_proces()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			if($this->input->post('method')=='update')
			{
				$this->update_obat();
			}
			else
			{
				$this->insert_obat();
			}
		}
	}
	// fungsi untuk menyimpan data master obat
	function insert_obat()
	{
		$sukses=false;
		$pesan_err='';

		$data=array(
			'kode_obat'=>$this->input->post('kode_obat'),
			'nama_obat'=>$this->input->post('nama_obat'),
			'merk_type'=>$this->input->post('merk'),
			'satuan_obat'=>$this->input->post('satuan')
			);
		if($this->m_function->insert_obat($data))
		{
			$sukses=true;
		}
		else
		{
			$sukses=false;
			$error=$this->db->error();
			$pesan_err=$error['message'];
		}

		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// funcgsi edit obat
	function update_obat()
	{
		$sukses=false;
		$pesan_err='';

		$data=array(
			'kode_obat'=>$this->input->post('kode_obat'),
			'nama_obat'=>$this->input->post('nama_obat'),
			'merk_type'=>$this->input->post('merk'),
			'satuan_obat'=>$this->input->post('satuan')
			);
		if($this->m_function->update_obat($data))
		{
			$sukses=true;
		}
		else
		{
			$sukses=false;
			$error=$this->db->error();
			$pesan_err=$error['message'];
		}

		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// fungsi get data supplier untuk mengirim respon json ke data tabel tabel master supplier
	function get_data_supplier()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$data=array();
			$no=$this->input->get('start')+1;
			foreach ($this->m_master->get_data_supplier()->result() as $sp) {
				# code...
				$arr=array();
				$edit="<a href='javascript:edit(\"{$sp->kode}\")' class='text-success' title='Edit data'><i class='fa fa-tags'></i> edit</a>";
				$hapus="<a href='javascript:hapus(\"{$sp->kode}\")' class='text-red' title='Hapus data'><i class='fa fa-trash'></i> hapus</a>";
				$arr[]=$no;
				$arr[]=$sp->nama_supplier;
				$arr[]=$edit.' | '.$hapus;
				array_push($data, $arr);
				$no++;
			}
			$respon=array(
	            "draw"				=>  $this->input->get('draw'),
	            "recordsTotal"		=>  $this->m_master->supplier_count_all_rows(),
	            "recordsFiltered"	=>  $this->m_master->supplier_count_filter_rows(),
	            "data"				=>	$data
	        );
	        echo json_encode($respon);
		}
	}

	// fungsi yang diakses oleh proses simpan modal master supplier
	function supplier_proses()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			if($this->input->post('method')=='update')
			{
				$this->update_supplier();
			}
			else
			{
				$this->insert_supplier();
			}
		}
	}
	// fungsi untuk menyimpan data master obat
	function insert_supplier()
	{
		$sukses=false;
		$pesan_err='';

		$data=array(
			'nama_supplier'=>$this->input->post('supplier')
			);
		if($this->m_function->insert_supplier($data))
		{
			$sukses=true;
		}
		else
		{
			$sukses=false;
			$error=$this->db->error();
			$pesan_err=$error['message'];
		}

		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// funcgsi edit obat
	function update_supplier()
	{
		$sukses=false;
		$pesan_err='';

		$data=array(
			'nama_supplier'=>$this->input->post('supplier')
			);
		if($this->m_function->update_supplier($data))
		{
			$sukses=true;
		}
		else
		{
			$sukses=false;
			$error=$this->db->error();
			$pesan_err=$error['message'];
		}

		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// fungsi hapus data master supplier, inti proses ubah value delete dari 0 ke satu.
	function delete_supplier()
	{
		$sukses=false;
		$pesan_err='';

		if($this->m_function->delete_supplier())
		{
			$sukses=true;
		}
		else
		{
			$err=$this->db->error();
			$pesan_err=$err['message'];
		}
		$respon['success']=$sukses;
		$respon['pesan_err']=$pesan_err;
		echo json_encode($respon);
	}

	// fungsi untuk mengambil baris tabel master supplier 
	function get_row_supplier()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$kode=$this->input->post('kode');
			$sukses=true;
			$pesan_err='';
			if($data=$this->m_function->get_rows_supplier($kode)->row_array())
			{
				$sukses=true;
			}
			else
			{
				$err=$this->db->error();
				$pesan_err=$err['message'];
			}

			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['data']=$data;
			echo json_encode($respon);
		}
	}
}