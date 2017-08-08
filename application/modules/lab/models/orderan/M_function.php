<?php if(! defined("BASEPATH")) exit("No direct script access allowed.");
class M_function extends ci_model
{

	function total_record()
	{
		$this->db->where('periksa != ', 'Y');
		return $this->db->get('lab_order')->num_rows();
	}

	function get_orderan_aktif()
	{
		$value=$this->input->get('search[value]');
		$this->db->from('lab_order');
		$this->db->select('lab_order.no_orderan, pendaftaran_kunjungan.norekammedis, pendaftaran_pasien.nama_lengkap, lab_order.tgl_order, lab_order.unit_pengirim, admin_masterdokter.nama_dokter');

		$this->db->join('pendaftaran_kunjungan','pendaftaran_kunjungan.nomor_kunjungan=lab_order.no_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_kunjungan.norekammedis=pendaftaran_pasien.nomor_rekammedis');
		$this->db->join('admin_masterdokter','admin_masterdokter.kode_dokter=lab_order.dokter_pengirim');
		
		if($value !=''){
		$this->db->group_start();
		$this->db->like('pendaftaran_kunjungan.norekammedis',$value);
		$this->db->or_like('pendaftaran_pasien.nama_lengkap',$value);
		$this->db->or_like('lab_order.unit_pengirim',$value);
		$this->db->or_like('admin_masterdokter.nama_dokter',$value);
		$this->db->group_end();
		}
		$this->db->where('periksa','N');

	}

	function get_orderan_data()
	{
		$this->get_orderan_aktif();
		if($_GET['length'] != -1)
		$this->db->limit($_GET['length'], $_GET['start']);
		return $this->db->get();
	}

	function jumlah_rows_filter()
	{
		$this->get_orderan_aktif();
		return $this->db->get()->num_rows();
	}

	function delete_orderan($id)
	{
		$this->db->where('no_orderan',$id);
		return $this->db->delete('lab_order');
	}
	function cek_nomor_orderan($no_orderan)
	{
		$this->db->where('no_orderan',$no_orderan);
		return $this->db->get('lab_order')->num_rows();
	}
	function max_noreg_lab()
	{
		$this->db->select_max('nomor_lab');
		return $this->db->get('lab_kunjungan')->row_array();
	}

	function get_informasi_orderan($no_orderan)
	{
		$this->db->from('lab_order');
		$this->db->select('lab_order.no_orderan, lab_order.no_kunjungan, lab_order.dokter_pengirim, lab_order.unit_pengirim, pendaftaran_pasien.nomor_rekammedis, pendaftaran_pasien.nama_lengkap, lab_order.tgl_order, lab_order.unit_pengirim, admin_masterdokter.nama_dokter, admin_masterdokter.gelar');
		$this->db->join('pendaftaran_kunjungan','lab_order.no_kunjungan =  pendaftaran_kunjungan.nomor_kunjungan');
		$this->db->join('pendaftaran_pasien','pendaftaran_pasien.nomor_rekammedis = pendaftaran_kunjungan.norekammedis');
		$this->db->join('admin_masterdokter','admin_masterdokter.kode_dokter=lab_order.dokter_pengirim');
		$this->db->where('lab_order.no_orderan',$no_orderan);
		return $this->db->get();
	}

	function get_list_orderan($no_orderan)
	{
		$this->db->from('lab_orderlist');
		$this->db->select('lab_produk.kode_produk, lab_produk.nama_produk');
		$this->db->join('lab_produk','lab_produk.kode_produk=lab_orderlist.kode_produk');
		$this->db->where('lab_orderlist.no_orderan',$no_orderan);
		return $this->db->get();
	}

	function simpan_kunjungan($data_kunjungan)
	{
		$id_periksa=$this->get_id_periksa();

		$this->db->trans_start();
		$this->db->insert('lab_kunjungan',$data_kunjungan);
		$this->db->where('no_orderan',$this->input->post('no_orderan'));
		$this->db->update('lab_order',array('periksa'=>'Y'));
		$this->db->where('no_orderan',$this->input->post('no_orderan'));
		foreach ($this->db->get('lab_orderlist')->result()  as $l) {
			# code...
			$this->db->select_max('tgl_berlaku');
			$this->db->select('tarif');
			$this->db->where('tgl_berlaku <=',date("Y-m-d",strtotime($this->input->post('tgl_periksa'))));
			$this->db->where('kode_produk',$l->kode_produk);
			$data_tarif=$this->db->get('lab_produktarif')->row_array();

			$data_pemeriksaan=array(
				'id'			=>		$id_periksa,
				'nomor_lab'		=>		$this->input->post('no_register'),
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

	function get_id_periksa()
	{
		$this->db->select_max('id');
		$data=$this->db->get('lab_pemeriksaan')->row_array();
		return $data['id']+1;
	}
}