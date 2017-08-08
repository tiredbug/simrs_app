<?php if(!defined("BASEPATH")) exit("No direct scripts access allowed.");

class Kunjungan_api extends ci_controller
{
	function __construct()
	{
		parent::__construct();
		if(! login_lab())
		{
			exit("Session login expired");
		}
		$this->load->model('kunjungan/m_function');
	}

	function get_informasi_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{	
			$sukses=false;
			$pesan_err='';
			$valid=array();
			$ruang='';
			$data='';

			$asal=$this->input->post('asal');
			switch ($asal) {
				case 'langsung':
					# code...

					// cek pasien langsung ke lab
					$cek=$this->m_function->cek_kunjungan_lab_langsung($this->input->post('norek'),'lab');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					// end 

					break;
				
				case 'rajal':
					# code...
					// cek pasien rawat jalan
					$cek=$this->m_function->cek_kunjungan_lab_langsung($this->input->post('norek'),'Rajal');
					if($cek->num_rows() > 0 )
					{
						$sukses=true;
						$data=$cek->row_array();
						$ruang=$this->m_function->get_poli($data['nomor_kunjungan'])->result();
					}
					else
					{
						$pesan_err="Data kunjungan tidak ditemukan.";
					}
					// end cek
					break;
			}


			$respon['success']=$sukses;
			$respon['pesan_err']=$pesan_err;
			$respon['data']=$data;
			$respon['ruang']=$ruang;
			echo json_encode($respon);
		}
	}


	function get_dokter_poli()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$sukses=false;
			$data=array();
			$cek=$this->m_function->get_dokter_poli($_POST['id']);
			if($cek->num_rows() > 0)
			{
				$data=$cek->result();
				$sukses=true;
			}
			else
			{
				$data=array(
					'id'=>'',
					'dokter'=>'-- Kosong --'
					);
				$sukses=true;
			}
			$respon=array(
				'success'=>$sukses,
				'data'=>$data
				);
			echo json_encode($respon);
		}
	}



	function register_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$data=array('success'=>false,'message'=>array(),'pesan'=>'');
			// load librari form
			$this->load->library('form_validation');
			// atur awalan dan akhiran respon message
			$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
			// end
			$asal=$this->input->post('asal');
			switch ($asal) {
				case 'langsung':
				break;


				case 'rajal':
					# code...
					$this->form_validation->set_rules('norek','No. medrec ','required',array('required'=>'%s harus diisi.'));
					$this->form_validation->set_rules('tgl_permintaan','Tgl permintaan ','required',array('required'=>'%s harus diisi.'));
					$this->form_validation->set_rules('jam_daftar','Jam daftar ','required',array('required'=>'%s harus diisi.'));
					$this->form_validation->set_rules('unit','Unit pengirim ','required',array('required'=>'%s harus dipilih.'));
					$this->form_validation->set_rules('dokter','Dokter pengirim ','required',array('required'=>'%s harus dipilih.'));
					$this->form_validation->set_rules('dokterp','Dokter piket ','required',array('required'=>'%s harus dipilih.'));
					if($this->form_validation->run())
					{
						// periksa data yang dipilih 
						// jika tidak dipilih, tampilkan pesan, data pemeriksaan Kosong
						$cek_p=$this->m_function->cek_p($_POST['norek']);
						if($cek_p->num_rows() > 0)
						{
							$nomor_lab=$this->nomor_lab();
							$valu=$_POST['unit'];
							$id=explode('-',$valu);
							$d_l=array(
								'nomor_lab'			=> $nomor_lab,
								'no_kunjungan'		=> $_POST['no_kunjungan'],
								'tgl_register'		=> tgl_mysql($_POST['tgl_permintaan']),
								'jam_register'		=> $_POST['jam_daftar'],
								'dokter_pengirim'	=> $_POST['dokter'],
								'dokter_piket'		=> $_POST['dokterp'],
								'petugas_register'	=> $_SESSION['kode_user'],
								'unit'				=> $id[1]
								);
							$this->db->insert('lab_kunjungan',$d_l);
							foreach ($cek_p->result() as $c_p) {
								# code...
								switch ($c_p->jenis) {
									case 'paket':
										// apabila jenis produknya paket
										$d_ls=array(
											'nomor_lab'=>$nomor_lab,
											'kode_produk'=>$c_p->kode,
										);
										// insert kedalam tabel_pemeriksaa
										$this->db->insert('lab_pemeriksaan',$d_ls);
										// mencari list dari paket tersebut
										$list=$this->m_function->get_list($c_p->kode);
										// apabila list ditemukan diinsert kedalam tabel pemeriksaan juga.
										if($list->num_rows() > 0)
										{
											foreach ($list->result() as $l) {
												# code...
												$d_ls=array(
													'nomor_lab'=>$nomor_lab,
													'kode_produk'=>$l->kode,
													'tarif'=>$l->tarif,
													);
												$this->db->insert('lab_pemeriksaan',$d_ls);

												// mencari data sub list paket
												foreach ($this->m_function->cek_sub_list($l->kode)->result() as $sub) {
													# code... menambahkan semua sub list kedalam tabel pemeriksaan.
													$d_ls=array(
														'nomor_lab'=>$nomor_lab,
														'kode_produk'=>$sub->kode,
													);
													$this->db->insert('lab_pemeriksaan',$d_ls);
												}
												// end
											}
										}

										// mengosongkan tabel cart
										$array=array(
											'norek'		=>$_POST['norek'],
											'sesi'		=>$_SESSION['__ci_last_regenerate'],
											'id_user'	=>$_SESSION['kode_user']
											);
										$this->db->where($array);
										$this->db->delete('lab_cart');
										// end

										$data['success']=true;
										break;
									
									case 'list':
										// apabila jenis produknya list
										// 1. tambahkan data master paketnya kedalam tabel pemeriksaa.
										$d_ls=array(
											'nomor_lab'=>$nomor_lab,
											'kode_produk'=>$c_p->parent_paket,
										);
										$this->db->insert('lab_pemeriksaan',$d_ls);
										// end

										// 2. deklarasi dia sebagai list, dan insert kedalam tabel pemeriksaan
										$d_ls=array(
											'nomor_lab'=>$nomor_lab,
											'kode_produk'=>$c_p->kode,
											'tarif'	=>$c_p->tarif
										);
										$this->db->insert('lab_pemeriksaan',$d_ls);
										// end

										// mencari data sub list paket
										foreach ($this->m_function->cek_sub_list($c_p->kode)->result() as $sub) {
											# code... menambahkan semua sub list kedalam tabel pemeriksaan.
											$d_ls=array(
												'nomor_lab'=>$nomor_lab,
												'kode_produk'=>$sub->kode,
											);
											$this->db->insert('lab_pemeriksaan',$d_ls);
										}
										// end

										// mengosongkan tabel cart
										$array=array(
											'norek'		=>$_POST['norek'],
											'sesi'		=>$_SESSION['__ci_last_regenerate'],
											'id_user'	=>$_SESSION['kode_user']
											);
										$this->db->where($array);
										$this->db->delete('lab_cart');
										// end

										$data['success']=true;
										break;
								}
							}
						}
						else
						{
							$data['pesan']='Paket pemeriksaan kosong.';
						}

					}
					else
					{
						foreach ($_POST as $key => $value) {
							# code...
							$data['message'][$key]=form_error($key);
						}
					}
					break;
			}

			echo json_encode($data);
		}
	}



	function get_produk_lab_html()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$data['norek']=$_POST['norek'];
			$data['tab']=$this->m_function->get_tab_head();
			$this->load->view('kunjungan/form_list_produk_lab',$data);
		}
	}


	// fungsi untuk menambahkan dan menghapus list pelayana, ketika di conteng dan 
	// diunconteng, pada form produk layana
	function chart_layanan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$sukses=false;
			$data_r=array();
			switch ($_POST['stt']) {
				case 'c':
					# code...
					$data = array(
				        'norek'      		=> $_POST['norek'],
				        'kode'     			=> $_POST['kode'],
				        'sesi'				=> $_SESSION['__ci_last_regenerate'],
				        'id_user'			=> $_SESSION['kode_user']
					);
					if( $this->db->get_where('lab_cart',$data)->num_rows() >0)
					{
						$sukses=true;
					}
					else
					{
						if($this->db->insert('lab_cart',$data))
						{
							$sukses=true;
						}
					}
					$data_r=$this->db->query("
						SELECT 
						p.produk 
						FROM lab_produks p
						WHERE p.kode='".$_POST['kode']."'
						")->row_array();
					break;
				
				case 'uc':
					# code...
					$data = array(
				        'norek'      		=> $_POST['norek'],
				        'kode'     			=> $_POST['kode'],
				        'sesi'				=> $_SESSION['__ci_last_regenerate'],
				        'id_user'			=> $_SESSION['kode_user']
					);
					$this->db->where($data);
					if($this->db->delete('lab_cart'))
					{
						$sukses=true;
					}
					break;
			}

			$respon=array(
				'success'=>$sukses,
				'data'	=>$data_r
				);

			echo json_encode($respon);
		}
	}


	function nomor_lab()
	{
		$max=$this->m_function->max_noreg_lab();
		return sprintf("%010d",$max['nomor_lab']+1);
	}


	function hapus_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$id=$_POST['id'];
			$respon=array(
				'success'=>true,
				'data'=>array(),
				'pesan_err'=>'',
				);

			if($this->m_function->hapus_kunjungan($id))
			{
				$data['success']=true;
			}
			else
			{
				$data['pesan_err']='Terjadi kesalahan ketika kami mencoba menghapus data kunjungan dari server, coba lagi.';
			}
			echo json_encode($respon);
		}
	}

	function get_kunjungan_lab()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$data_r=array(
				'data'=>array(),
				'draw'=>$_POST['draw'],
				'recordsTotal'=>$this->m_function->get_total_kunjungan_lab(),
				'recordsFiltered'=>$this->m_function->get_total_filtered_kunjungan_lab()
				);

			foreach ($this->m_function->get_kunjungan_lab()->result() as $k) {
				# code...
				$row=array();
				$row[]='';
				$row[]=$k->no_lab;
				$row[]=$k->norek;
				$row[]=$k->nama;
				$row[]=$k->jk;
				$row[]=$k->alamat;
				$row[]=$k->umur;
				$row[]=$k->asal;
				$row[]=$k->bayar;
				
				$data_r['data'][]=$row;
			}

			echo json_encode($data_r);
		}
	}



	function checkout_kunjungan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$respon=array(
				'success'=>false,
				'pesan_err'=>'',
				);

			$id=$_POST['id'];
			if($this->m_function->chekcout_pasien($id))
			{
				$respon['success']=true;
			}
			else
			{
				$respon['pesan_err']='Gagal ketika kami checkout kunjungan, coba lagi.';
			}
			echo json_encode($respon);
		}
	}


	function simpan_hasil()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed");
		}
		else
		{
			$respon=array(
				'success'=>false,
				'pesan_err'=>'',
				);


			foreach ($this->m_function->get_data_pemeriksaan($_POST['nolab'])->result() as $l) {
				# code...
				$this->db->where('id',$l->id);
				$this->db->update('lab_pemeriksaan',array(
					'hasil_periksa'=>$this->input->post('hasil_'.$l->id),
					'metode_periksa'=>$this->input->post('metode_'.$l->id),
					'keterangan'=>$this->input->post('ket_'.$l->id)
					));
				$respon['success']=true;
			}

			$this->db->where('nomor_lab',$_POST['nolab']);
			if($this->db->update('lab_kunjungan',array(
				'keterangan'=>$_POST['keterangan']
				))){
				$respon['success']=true;
			}
			else
			{
				$respon['success']=false;
				$respon['pesan_err']='Gagal menyimpan hasil pemeriksaan laboraturium, coba lagi.';
			}
			
			if(isset($_POST['c']))
			{
				$this->m_function->chekcout_pasien($_POST['nolab']);
			}
			
			echo json_encode($respon);
		}
	}

	function histori_layanan()
	{
		if(! $this->input->is_ajax_request())
		{
			exit("No direct scripts access allowed.");
		}
		else
		{
			$data_r=array(
				'data'=>array(),
				'draw'=>$_POST['draw'],
				'recordsTotal'=>$this->m_function->get_total_kunjungan_lab(),
				'recordsFiltered'=>$this->m_function->get_total_filtered_kunjungan_lab()
				);

			foreach ($this->m_function->get_histori_lab()->result() as $k) {
				# code...
				$row=array();
				$row[]='';
				$row[]=$k->no_lab;
				$row[]=$k->norek;
				$row[]=$k->nama;
				$row[]=$k->jk;
				$row[]=$k->alamat;
				$row[]=$k->tgl;
				
				$data_r['data'][]=$row;
			}

			echo json_encode($data_r);
		}
	}

}