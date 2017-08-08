<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");

/**
* 
*/
class Returnobat_api extends ci_controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(! login_go())
		{
			exit("Session login time out");
		}
		$this->load->model('return/m_function');
		$this->load->model('login/m_master');
	}


	// fungsi ini untuk membuat isi table, dari data detail ttransaksi masuk, ketika diketikkan nomor transaksi masuk pada form transaksi return barang
	function get_data_penerimaan()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			foreach ($this->m_function->get_data_penerimaan()->result() as $p) {
				# code...
				echo "<tr>
					<td style='text-align:left'>	
					<b>".$p->nama_obat."</b><br/>
					<small style='color:#ccc'>Kode : ".$p->kode_obat."</small>
					</td>
					<td><b>".$p->jumlah_masuk." ".$p->satuan_obat."</b></td>
					<td><b>".$p->jumlah_keluar." ".$p->satuan_obat."</b></td>
					<td><b>".$p->stok." ".$p->satuan_obat."</b></td>
					<td >
						<input type='text' class='form-control' name='r_".$p->id."'/>
					</td>
				</tr>";
				
			}
	    }
	}


	function savereturn()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$sukses=false;
			$pesan_err='';
			$data=array();
			$valid=true;



			// mencari id paling tingggi pada tabel detail return 
			$max_id=$this->m_function->max_id_return()+1;
			foreach ($this->m_function->get_data_penerimaan()->result() as $d) {
				# code...
				if($this->input->post('r_'.$d->id) != '')
				{
					$arr=array(
						'id'			=> 	$max_id,
						'no_transaksi'	=>	$this->input->post('nota'),
						'id_masuk'		=>	$d->id,
						'jumlah_return'	=>	$this->input->post('r_'.$d->id),
					);
					$d->stok<$this->input->post('r_'.$d->id)?$valid=false:array_push($data, $arr);
				}
				$max_id++;
			}
			if($valid==false)
			{
				$pesan_err='Jumlah return tidak valid lebih dari sisa stok.';
			}
			else
			{
				if($this->m_function->savereturn($data))
				{
					$sukses=true;
				}
				else
				{
					$pesan_err='Gagal menyimpan proses return barang';
				}
			}

			

			$respon=array(
				'success'	=>	$sukses,
				'pesan_err'	=>	$pesan_err,
				'data'		=>	$data
				);
			echo json_encode($respon);
		}
	}


	function get_data_nota()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data=array();
			foreach ($this->m_function->get_data_nota()->result() as $n) {
				# code...
				$arr=array();
				$arr[]=$n->nota;
				$arr[]=tgl_biasa($n->tgl_return);
				$arr[]=$n->nota_masuk;
				$arr[]=$n->no_faktur;
				$arr[]=$n->penyerah;
				$arr[]=$n->penerima;
				$arr[]='';
				array_push($data, $arr);
			}


			$respon=array(
					"draw"				=>  $this->input->post('draw'),
		            "recordsTotal"		=>  $this->m_function->count_all_rows_nota(),
		            "recordsFiltered"	=>  $this->m_function->count_filtered(),
		            "data"				=>	$data
		        );
		    echo json_encode($respon);
		}
	}

	function cetak()
	{
		if( ! $this->input->is_ajax_request())
		{
			exit("No direct script access allowed.");
		}
		else
		{
			$data['nota']			=	$this->m_function->cek_nota($_GET['nota'])->row_array();
			$data['nama_rs']		=	$this->m_master->get_nama_rs_panjang()->row_array();
	    	$data['alamat_rs']		=	$this->m_master->get_alamatrs()->row_array();
	    	$data['tlf_rs']			=	$this->m_master->get_tlfrs()->row_array();
	    	$data['fax_rs']			=	$this->m_master->get_faxrs()->row_array();
	    	$data['list']			=	$this->m_function->get_detail_return($data['nota']['no_transaksi']);
			$this->load->view('return/cetak',$data);
		}
	}

}