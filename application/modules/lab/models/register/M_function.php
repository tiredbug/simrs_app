<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model{

	function validasi_norek($nrm)
	{
		$this->db->from('pendaftaran_kunjungan');
		$this->db->select('pendaftaran_pasien.nama_lengkap, pendaftaran_pasien.nomor_nik, pendaftaran_pasien.nomor_asuransi, pendaftaran_pasien.sebutan, pendaftaran_pasien.gelar, pendaftaran_pasien.alamat_ktp, admin_masterdesa.nama_kelurahan, admin_masterkecamatan.nama_kecamatan, admin_masterkabupaten.nama_kota, admin_masterprovinsi.nama_provinsi, pendaftaran_kunjungan.nomor_kunjungan');

		$this->db->join('pendaftaran_pasien','pendaftaran_pasien.nomor_rekammedis = pendaftaran_kunjungan.norekammedis');
		$this->db->join('admin_masterdesa','admin_masterdesa.id_kelurahan = pendaftaran_pasien.kode_desa');
		$this->db->join('admin_masterkecamatan','admin_masterkecamatan.id_kecamatan = pendaftaran_pasien.kode_kecamatan');
		$this->db->join('admin_masterkabupaten','admin_masterkabupaten.id_kota = pendaftaran_pasien.kode_kabupaten');
		$this->db->join('admin_masterprovinsi','admin_masterprovinsi.id_provinsi = pendaftaran_pasien.kode_provinsi');
		$this->db->where('pendaftaran_kunjungan.norekammedis',$nrm);
		$this->db->where('pendaftaran_kunjungan.status_kunjungan','Masih dirawat');
		return $this->db->get();
	}

	function proses_register($data_orderan,$data_kunjungan,$no_orderan,$nolab)
	{
		$id_periksa=$this->get_id_periksa();

		$this->db->trans_start();
		$this->db->insert('lab_order',$data_orderan);
		$this->db->insert('lab_kunjungan',$data_kunjungan);
		foreach($this->input->post('list') as $l)
    	{
    		$lis=array(
    			'no_orderan'	=>	$no_orderan,
    			'kode_produk'	=>	$l
    			);

    		$this->db->insert('lab_orderlist',$lis);
    	}

    	$this->db->where('no_orderan',$no_orderan);
		foreach ($this->db->get('lab_orderlist')->result()  as $l) {
			# code...
			$this->db->select_max('tgl_berlaku');
			$this->db->select('tarif');
			$this->db->where('tgl_berlaku <=',date("Y-m-d",strtotime($this->input->post('tgl_kirim'))));
			$this->db->where('kode_produk',$l->kode_produk);
			$data_tarif=$this->db->get('lab_produktarif')->row_array();

			$data_pemeriksaan=array(
				'id'			=>		$id_periksa,
				'nomor_lab'		=>		$nolab,
				'kode_produk'	=>		$l->kode_produk,
				'tarif'			=>		$data_tarif['tarif']==''?'0':$data_tarif['tarif']
				);
			$this->db->insert('lab_pemeriksaan',$data_pemeriksaan);
			

			$this->db->where('kode_produk',$l->kode_produk);
			foreach ($this->db->get('lab_produklistperiksa')->result() as $lp) {
				# code...
				$data_listhasil=array(
					'id_pemeriksaan'=>$id_periksa,
					'id_listperiksa'=>$lp->id_listperiksa
					);
				$this->db->insert('lab_hasil',$data_listhasil);
			}

			$id_periksa=$id_periksa+1;
		}

		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	function max_nomor_orderan_lab()
    {
    	$this->db->select_max('no_orderan');
    	$this->db->from('lab_order');
    	return $this->db->get()->row_array();
    }

    function max_noreg_lab()
	{
		$this->db->select_max('nomor_lab');
		return $this->db->get('lab_kunjungan')->row_array();
	}
	function get_id_periksa()
	{
		$this->db->select_max('id');
		$data=$this->db->get('lab_pemeriksaan')->row_array();
		return $data['id']+1;
	}
}