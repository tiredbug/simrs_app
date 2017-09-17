<?php 
/**
* 
*/
class M_datamaster extends ci_model
{
	function __query_get_data_ruangan_inap()
	{
		$w='';
		if($this->input->post('search[value]'))
		{
			$w="WHERE nama_ruangan LIKE '%".$this->input->post('search[value]')."%'";
		}
		return $q="SELECT * FROM admin_masterruanganinap ".$w;
	}
	function get_data_ruangan_inap()
	{
		$q=$this->__query_get_data_ruangan_inap();
		if($this->input->post('length')!=-1)
        {
            $q=$this->__query_get_data_ruangan_inap()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
		return $this->db->query($q);
	}

	function count_filtered_data_ruangan_inap()
	{
		return $this->db->query($this->__query_get_data_ruangan_inap())->num_rows();
	}

	function count_total_data_ruangan_inap()
	{
		return $this->db->get('admin_masterruanganinap')->num_rows();
	}

	function get_max_kode_ruangan()
	{
		$this->db->select_max('id_ruangan');
		return $this->db->get('admin_masterruanganinap');
	}

	function save_ruangan()
	{
		return $this->db->insert('admin_masterruanganinap',array('nama_ruangan'=>$_POST['nama']));
	}

	function aktifkankamar()
	{
		$id=$this->encrypt_rs->decode($this->uri->segment(4));
		$this->db->where('id_ruangan',$id);
		return $this->db->update('admin_masterruanganinap',array('status_ruangan'=>'Y'));
	}
	function cek_ruang($id)
	{
		return $this->db->get_where('admin_masterruanganinap',array('id_ruangan'=>$id));
	}
	
	function get_i_kls()
	{
		return $this->db->get('admin_masterkelasperawatan');
	}

	function cek_kls($id)
	{
		return $this->db->get_where('admin_masterkelasperawatan',array('id_kelasperawatan'=>$id));
	}

	function __query_get_data_kamar_inap()
	{
		$w=" WHERE kmr.id_ruangan IN('".$this->encrypt_rs->decode($this->input->post('ruang'))."') AND kmr.id_kelas IN('".$this->encrypt_rs->decode($this->input->post('kelas'))."')";
		if($this->input->post('search[value]'))
		{
			$w.=" AND kmr.nama_kamar LIKE '%".$this->input->post('search[value]')."%'";
		}
		return $q="SELECT 
					kmr.id_kamar id,kmr.nama_kamar,IFNULL(bed.jml,'0') jml, kmr.id_kelas, kmr.id_ruangan
					FROM admin_masterruanginapkamar kmr
					LEFT JOIN (SELECT *,count(k.id_bed)jml FROM admin_masterruanginapkamarbed k
					GROUP BY k.id_kamar) bed ON bed.id_kamar=kmr.id_kamar".$w;
	}
	function get_data_kamar_inap()
	{
		$q=$this->__query_get_data_kamar_inap();
		if($this->input->post('length')!=-1)
        {
            $q=$this->__query_get_data_kamar_inap()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
		return $this->db->query($q);
	}

	function count_filtered_data_kamar_inap()
	{
		return $this->db->query($this->__query_get_data_kamar_inap())->num_rows();
	}

	function count_total_data_kamar_inap()
	{
		return $this->db->get_where('admin_masterruanginapkamar',array(
			'id_ruangan'=>$this->encrypt_rs->decode($this->input->post('ruang')),
			'id_kelas'=>$this->encrypt_rs->decode($this->input->post('kelas'))
		))->num_rows();
	}

	function cek_kamar($id)
	{
		return $this->db->get_where('admin_masterruanginapkamar',array('id_kamar'=>$id));
	}

	function save_kamar()
	{
		return $this->db->insert('admin_masterruanginapkamar',array(
			'id_ruangan'=>$this->encrypt_rs->decode($_POST['ruang']),
			'id_kelas'=>$this->encrypt_rs->decode($_POST['kls']),
			'nama_kamar'=>$_POST['nama']
		));
	}

	function get_max_kode_kamar()
	{
		$this->db->select_max('id_kamar');
		return $this->db->get('admin_masterruanginapkamar');
	}

	function get_max_kode_bed()
	{
		$this->db->select_max('id_bed');
		return $this->db->get('admin_masterruanginapkamarbed');
	}


	function save_bed()
	{
		return $this->db->insert('admin_masterruanginapkamarbed',array(
			'id_kamar'=>$this->encrypt_rs->decode($_POST['kamar']),
			'nomor_bed'=>$_POST['nobed'],
			'status_bed'=>'Y'
		));

	}


	function __query_get_data_bed()
	{
		$w=" WHERE b.id_kamar IN('".$this->encrypt_rs->decode($_POST['kamar'])."')";
		if($this->input->post('search[value]'))
		{
			$w.=" AND b.nomor_bed LIKE '%".$this->input->post('search[value]')."%'";
		}
		return $q="SELECT * FROM admin_masterruanginapkamarbed b".$w;
	}
	function get_data_kamar_bed()
	{
		$q=$this->__query_get_data_bed();
		if($this->input->post('length')!=-1)
        {
            $q=$this->__query_get_data_bed()." LIMIT ".$this->input->post('start').",".$this->input->post('length');
        }
		return $this->db->query($q);
	}

	function count_filtered_data_bed()
	{
		return $this->db->query($this->__query_get_data_bed())->num_rows();
	}

	function count_total_data_bed()
	{
		return $this->db->get_where('admin_masterruanginapkamarbed',array(
			'id_kamar'=>$this->encrypt_rs->decode($this->input->post('kamar'))
		))->num_rows();
	}
	
}