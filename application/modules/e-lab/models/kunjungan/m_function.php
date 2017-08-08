<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model{

	function cek_kunjungan_lab_langsung($norek,$asal)
	{
		return $this->db->query("SELECT
						a.nomor_kunjungan, b.nama_lengkap, b.nomor_nik, b.nomor_asuransi, b.jenis_kelamin, b.alamat_ktp,
						c.nama_carabayar, d.nama_kelurahan, e.nama_kecamatan, f.nama_kota, g.nama_provinsi
						FROM 
						pendaftaran_kunjungan a
						LEFT JOIN pendaftaran_pasien b ON b.nomor_rekammedis=a.norekammedis
						LEFT JOIN admin_mastercarabayar c ON a.kode_carabayar=c.id_carabayar
						LEFT JOIN admin_masterdesa d ON d.id_kelurahan=b.kode_desa
						LEFT JOIN admin_masterkecamatan e ON e.id_kecamatan=b.kode_kecamatan
						LEFT JOIN admin_masterkabupaten f ON f.id_kota=b.kode_kabupaten
						LEFT JOIN admin_masterprovinsi g ON g.id_provinsi=b.kode_provinsi
						WHERE
						a.jenis_kunjungan='".$asal."'
						AND a.status_kunjungan='Masih dirawat'
						AND a.norekammedis='".$norek."'");
	}


	function get_poli($nomor_kunjungan)
	{
		return $this->db->query("SELECT 
								CONCAT(a.id_kunjunganrajal,'-',a.kode_poliklinik) id, b.nama_poliklinik poli
								FROM 
								rajal_kunjungan a
								LEFT JOIN admin_masterpoliklinik b ON b.id_poliklinik=a.kode_poliklinik
								WHERE a.nomor_kunjungan='".$nomor_kunjungan."'
								");
	}


	function get_dokter_poli($id)
	{
		return $this->db->query("SELECT
									b.kode_dokter id,
									IF(b.gelar!='',
									CONCAT(b.nama_belakang,'. ',b.nama_dokter,', ',b.gelar),
									CONCAT(b.nama_belakang,'. ',b.nama_dokter)) as dokter
								FROM 
								rajal_kunjungan a
								LEFT JOIN admin_masterdokter b ON a.kode_dokter = b.kode_dokter
								WHERE a.id_kunjunganrajal='".$id."'");
	}


	function get_tab_head()
	{
		return $this->db->query("SELECT 
								a.produk produk, a.kode id
								FROM lab_produks a
								WHERE a.jenis='group'");
	}


	function get_tab_conten($kode)
	{
		return $this->db->query("SELECT * FROM (
									(
										select *,CONCAT('Rp. ',FORMAT(sum(tarif),0))as jum from (
												SELECT p.kode,p.tarif,p.produk,p.parent_paket,p.jenis,
												CASE WHEN p.parent_paket is NULL THEN p.kode ELSE p.parent_paket END AS parent
												FROM lab_produks AS p
												WHERE p.parent_group='".$kode."' AND p.jenis IN ('list','paket')
										) s GROUP by parent
									)
									
									UNION ALL
									(
										SELECT p.kode,p.tarif,
										p.produk,p.parent_paket,p.jenis, 
										p.parent_paket as parent, CONCAT('Rp. ',FORMAT(p.tarif,0)) as jum 
										from lab_produks as p
										where p.parent_group='".$kode."' AND p.jenis IN('list','paket') 
									)
									
								) b group by kode");
	}


	function cek_stt_check($kode,$norek)
	{
		$data=array(
			'norek'=>$norek,
			'kode'=>$kode,
			'sesi'=>$_SESSION['__ci_last_regenerate'],
			'id_user'=>$_SESSION['kode_user']
			);
		return $this->db->get_where('lab_cart',$data);
	}


	function get_dokter_lab()
	{
		return $this->db->query("
			SELECT 
				d.kode_dokter kode, 
				CASE 
					WHEN m.nama_belakang!='' 
					THEN 
						CONCAT(m.nama_belakang,'. ',m.nama_dokter,
							(CASE WHEN m.gelar!=''
								THEN CONCAT(', ',m.gelar)
							END)
							
						) 
					ELSE 
						CONCAT(m.nama_dokter,
							(CASE WHEN m.gelar!=''
							THEN CONCAT(', ',m.gelar)
							END)
						)
					END nama
				FROM lab_dokter d
				LEFT JOIN admin_masterdokter m ON m.kode_dokter=d.kode_dokter
				WHERE d.aktif='Y' AND m.`status`='Aktif'
			");
	}


	function cek_p($norek)
	{
		return $this->db->query("
			SELECT 
			c.id, p.kode, p.produk, p.tarif, p.jenis, p.parent_paket
			FROM 
			lab_cart c
			INNER JOIN lab_produks p ON p.kode=c.kode
			WHERE c.norek='".$norek."' AND c.sesi='".$_SESSION['__ci_last_regenerate']."' AND c.id_user='".$_SESSION['kode_user']."'
			"); 
	}



	function get_list($kode)
	{
		$this->db->where('parent_paket',$kode);
		return $this->db->get('lab_produks');
	}

	function max_noreg_lab()
	{
		$this->db->select_max('nomor_lab');
		return $this->db->get('lab_kunjungan')->row_array();
	}

	function hapus_kunjungan($id)
	{
		$this->db->where('nomor_lab',$id);
		return $this->db->delete('lab_kunjungan');
	}

	function get_data_pemeriksaan($nolab)
	{
		return $this->db->query("SELECT 
								pr.kode, pr.produk, p.tarif, pr.parent_paket, pr.jenis, pr.nilai_normal normal, pr.satuan, pr.jenis, p.hasil_periksa, p.metode_periksa, p.keterangan, p.id
								FROM lab_pemeriksaan p
								INNER JOIN lab_produks pr ON pr.kode=p.kode_produk
								WHERE p.nomor_lab='".$nolab."'
								group by pr.kode
								");
	}


	function __query_get_kunjungan_lab()
	{
		$w='';
		

		if($this->input->post('search[value]')!='')
		{
			$w=" AND pk.norekammedis='".$this->input->post('search[value]')."'";
		}
		return $query="SELECT
				k.nomor_lab no_lab, pk.norekammedis norek, ps.nama_lengkap nama, ps.jenis_kelamin jk,
				CONCAT(ps.alamat_ktp,
						CASE WHEN pv.nama_provinsi != '' THEN CONCAT(' Prov-',pv.nama_provinsi) END
						,CASE WHEN kb.nama_kota != '' THEN CONCAT(', Kab-',kb.nama_kota)END
						,CASE WHEN kec.nama_kecamatan!='' THEN CONCAT(', Kec-',kec.nama_kecamatan)END
						,CASE WHEN des.nama_kelurahan != '' THEN CONCAT(', Desa ',des.nama_kelurahan) END
						) alamat,
				CONCAT(
					CASE WHEN pk.umur_tahun=0 THEN '' ELSE CONCAT(pk.umur_tahun,'thn') END
					,CASE WHEN pk.umur_bulan=0 THEN '' ELSE CONCAT(' ',pk.umur_bulan,'bln')END
					,CASE WHEN pk.umur_hari=0 THEN '' ELSE CONCAT(' ',pk.umur_hari,'hri')END
				) umur,
				CONCAT(
						CASE pk.jenis_kunjungan
							WHEN 'lab' THEN 'Lab langsung'
							WHEN 'Rajal' THEN CONCAT('Rajal',' - Poliklinik ',pl.nama_poliklinik)
						END
						) asal,
				CONCAT(
						cb.nama_carabayar,'-',cbk.nama_kelompok
						)bayar
				FROM lab_kunjungan k
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=k.no_kunjungan
				INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_masterprovinsi pv ON pv.id_provinsi=ps.kode_provinsi
				LEFT JOIN admin_masterkabupaten kb ON kb.id_kota=ps.kode_kabupaten
				LEFT JOIN admin_masterkecamatan kec ON kec.id_kecamatan=ps.kode_kecamatan
				LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
				LEFT JOIN admin_masterpoliklinik pl ON pl.id_poliklinik=k.unit
				LEFT JOIN admin_mastercarabayar cb ON cb.id_carabayar=pk.kode_carabayar
				LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=pk.kode_kelompok 
				WHERE k.periksa='N' ".$w;
	}


	function get_kunjungan_lab()
	{
		$q=$this->__query_get_kunjungan_lab();
		if($_POST['length']!=1)
		{
			$q=$this->__query_get_kunjungan_lab();
		}
		return $this->db->query($q);
	}

	function get_total_kunjungan_lab()
	{
		$this->db->where('periksa','N');
		return $this->db->get('lab_kunjungan')->num_rows();
	}

	function get_total_filtered_kunjungan_lab()
	{
		return $this->db->query($this->__query_get_kunjungan_lab())->num_rows();
	}


	function get_kunjungan_lab_where($nolab,$w)
	{
		$w=$w=='Y'?" AND (k.periksa='Y' OR k.periksa='N')":" AND k.periksa='N'";
		return $this->db->query("SELECT
								k.keterangan, k.nomor_lab nolab, pk.norekammedis norek, ps.nama_lengkap nama, ps.jenis_kelamin jk, 
								CONCAT(ps.alamat_ktp,
									CASE WHEN pv.nama_provinsi != '' THEN CONCAT(' Prov-',pv.nama_provinsi) END
									,CASE WHEN kb.nama_kota != '' THEN CONCAT(', Kab-',kb.nama_kota)END
									,CASE WHEN kec.nama_kecamatan!='' THEN CONCAT(', Kec-',kec.nama_kecamatan)END
									,CASE WHEN des.nama_kelurahan != '' THEN CONCAT(', Desa ',des.nama_kelurahan) END
									) alamat,
								ps.alamat_ktp, CONCAT(DATE_FORMAT(k.tgl_register,'%d-%M-%Y'),' ',k.jam_register) tgl,
								CONCAT(
									CASE pk.jenis_kunjungan
										WHEN 'lab' THEN 'Lab langsung'
										WHEN 'Rajal' THEN CONCAT('Rajal',' - Poliklinik ',pl.nama_poliklinik)
									END
									) asal,
								CONCAT(
									cb.nama_carabayar,'-',cbk.nama_kelompok
									)bayar,
								CONCAT(
									CASE 
										WHEN dok.nama_belakang!='' THEN CONCAT(dok.nama_belakang,'. ') 
									END,dok.nama_dokter,
									CASE
										WHEN dok.gelar!='' THEN CONCAT(', ',dok.gelar)
									END
								) dokter,
								CONCAT(
									CASE 
										WHEN dokl.nama_belakang!='' THEN CONCAT(dokl.nama_belakang,'. ') 
									END,dokl.nama_dokter,
									CASE
										WHEN dokl.gelar!='' THEN CONCAT(', ',dokl.gelar)
									END
								) dokterp,
								us.nama_lengkap user, 
								CONCAT(DATE_FORMAT(ps.tgl_lahir,'%d-%m-%Y'),' (',
									CONCAT(
										CASE
											WHEN pk.umur_tahun=0 THEN '' ELSE CONCAT(pk.umur_tahun,'thn ')
										END,
										CASE
											WHEN pk.umur_bulan=0 THEN '' ELSE CONCAT(pk.umur_bulan,'bln ')
										END,
										CASE
											WHEN pk.umur_hari=0 THEN '' ELSE CONCAT(pk.umur_hari,'hri ')
										END
									),')'
								) tgl_lahir
								FROM 
								lab_kunjungan k
								INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=k.no_kunjungan
								INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
								LEFT JOIN admin_masterpoliklinik pl ON pl.id_poliklinik=k.unit
								LEFT JOIN admin_mastercarabayar cb ON pk.kode_carabayar=cb.id_carabayar
								LEFT JOIN admin_mastercarabayarklp cbk ON cbk.id_kelompok=pk.kode_kelompok
								LEFT JOIN admin_masterprovinsi pv ON pv.id_provinsi=ps.kode_provinsi
								LEFT JOIN admin_masterkabupaten kb ON kb.id_kota=ps.kode_kabupaten
								LEFT JOIN admin_masterkecamatan kec ON kec.id_kecamatan=ps.kode_kecamatan
								LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
								LEFT JOIN admin_masterdokter dok ON dok.kode_dokter=k.dokter_pengirim
								LEFT JOIN admin_masterdokter dokl ON dokl.kode_dokter=k.dokter_piket
								LEFT JOIN lab_users us ON us.kode_user=k.petugas_register
								WHERE k.nomor_lab='".$nolab."'".$w);
	}

	function cek_sub_list($kode)
	{
		$this->db->where('parent_list',$kode);
		return $this->db->get('lab_produks');
	}

	function cek_sub_list_join_produk($kode)
	{
		return $this->db->query("SELECT
								p.kode_produk,pr.produk, p.tarif, p.metode_periksa, p.hasil_periksa, p.keterangan, pr.satuan,p.id, pr.nilai_normal 
								FROM lab_pemeriksaan p
								LEFT JOIN lab_produks pr ON pr.kode=p.kode_produk
								WHERE pr.parent_list='".$kode."'");
	}


	function chekcout_pasien($nolab)
	{
		$this->db->where('nomor_lab',$nolab);
		return $this->db->update('lab_kunjungan',array('periksa'=>'Y'));
	}


	function __query_get_histori()
	{
		$w='';
		if($this->input->post('search[value]')!='')
		{
			$w=" AND pk.norekammedis='".$this->input->post('search[value]')."'";
		}

		$tgl="";
		// apabila difilter dengan tanggal
		if($this->input->post('tgl')!='' && $this->input->post('bln')!='' && $this->input->post('tahun')!='')
		{
			$tgl=" AND k.tgl_register='".$this->input->post('tahun')."-".$this->input->post('bln')."-".$this->input->post('tgl')."'";
		}
		// end

		return $q="SELECT
				k.nomor_lab no_lab, pk.norekammedis norek, ps.nama_lengkap nama, ps.jenis_kelamin jk,
				CONCAT(ps.alamat_ktp,
						CASE WHEN pv.nama_provinsi != '' THEN CONCAT(' Prov-',pv.nama_provinsi) END
						,CASE WHEN kb.nama_kota != '' THEN CONCAT(', Kab-',kb.nama_kota)END
						,CASE WHEN kec.nama_kecamatan!='' THEN CONCAT(', Kec-',kec.nama_kecamatan)END
						,CASE WHEN des.nama_kelurahan != '' THEN CONCAT(', Desa ',des.nama_kelurahan) END
						) alamat,CONCAT(DATE_FORMAT(k.tgl_register,'%d-%m-%Y'),SPACE(2),k.jam_register) tgl
				FROM lab_kunjungan k
				INNER JOIN pendaftaran_kunjungan pk ON pk.nomor_kunjungan=k.no_kunjungan
				INNER JOIN pendaftaran_pasien ps ON ps.nomor_rekammedis=pk.norekammedis
				LEFT JOIN admin_masterprovinsi pv ON pv.id_provinsi=ps.kode_provinsi
				LEFT JOIN admin_masterkabupaten kb ON kb.id_kota=ps.kode_kabupaten
				LEFT JOIN admin_masterkecamatan kec ON kec.id_kecamatan=ps.kode_kecamatan
				LEFT JOIN admin_masterdesa des ON des.id_kelurahan=ps.kode_desa
				WHERE k.periksa='Y' ".$w.$tgl;
	}


	function get_histori_lab()
	{
		$q=$this->__query_get_histori();
		if($_POST['length']!=1)
		{
			$q=$this->__query_get_histori();
		}
		return $this->db->query($q);
	}
}
