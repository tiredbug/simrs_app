<style type="text/css">
	.namars, .alamatrs, .kontakrs, .judul{
		margin: 0px;
	}
	.namars, .alamatrs, .kontakrs, .judul, .informasi, .hasil, .ket-ket, .ket, .tt, .rinci{
		font-family: 'arial'
	}
	.namars, .alamatrs
	{
		font-size: 14px;
		font-weight: bold;
	}
	.garis{
		border: dashed 1px #222;
	}
	.judul{
		text-align: center;
		font-size: 14px;
		margin-bottom: 10px;
	}
	.informasi, .ket-ket, .ket, .tt, .rinci
	{
		font-size: 12px;
	}
	.hasil
	{
		width: 100%;
		margin-top: 15px;
		font-size: 12px;
		border-collapse: collapse;
    	border-spacing: 0;
    	border: 1px solid #222;
    	margin-bottom: 15px;
	}
	.hasil > thead > tr > th, .hasil > tbody > tr > td
	{
		border: 1px solid #222;
		padding: 5px;
	}
	.hasil > thead > tr > th
	{
		padding-left: 5px;
	}
	.hasil > tbody > tr > td
	{
		padding-left: 5px;
		border: none;
		border-left: 1px solid #222;
	}
	.item{
		padding-left: 20px;
	}
	.tt{
		width: 220px;
		float: right !important;
	}
	.drp{
		padding-top: 40px;
		font-weight:bold;
	}
	.tabel-isi{
		width: 100%
	}
</style>
<h3 class="namars"><?php echo $nama_rs['value_profile']?></h3>
<h3 class="alamatrs"><?php echo $alamat_rs['value_profile']?></h3>
<h6 class="kontakrs">Tlf : <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?></h6>
<hr class="garis">
<h4 class="judul">PERINCIAN BIAYA PELAYANAN KESEHATAN RAWAT JALAN </h4>
<table width="100%" class="informasi">
	<tr>
		<td width="15%">
			No. Medrec
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['norekammedis']?></td>
		<td width="15%">
			Register Date
		</td>
		<td width="2%">:</td>
		<td width="23%">
			<?php echo tgl_biasa($info['tgl_daftar']).' '.$info['jam_daftar']?>
		</td>
	</tr>

	<tr>
		<td width="15%">
			No. Kunjungan
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['nomor_kunjungan']?></td>
		<td width="15%">
			CheckOut Date
		</td>
		<td width="2%">:</td>
		<td width="23%">
			<?php 
			echo tgl_biasa($info['tgl_checkout']).' ';
			echo $info['jam_checkout'];
			?>
		</td>
	</tr>

	<tr>
		<td width="15%">
			Nama
		</td>
		<td width="2%">:</td>
		<td width="43%">
			<?php 
			echo $info['nama_lengkap'];
			?>
		</td>
		<td width="15%">
			Umur
		</td>
		<td width="2%">:</td>
		<td width="23%">
			<?php 
			echo $info['umur_tahun']=='0'?'':$info['umur_tahun'].'th ';
			echo $info['umur_bulan']=='0'?'':$info['umur_bulan'].'bln ';
			echo $info['umur_hari']=='0'?'':$info['umur_hari'].'hr ';
			?>
		</td>
	</tr>

	<tr>
		<td width="15%">
			Alamat
		</td>
		<td width="2%">:</td>
		<td width="43%">
			<?php 
			echo $info['alamat_ktp'];
			echo 'Des.'.$info['nama_kelurahan'];
			echo ' Kec.'.$info['nama_kecamatan'];
			echo ' Kab.'.$info['nama_kota'];
			echo ' Prov.'.$info['nama_provinsi'];
			?>
		</td>
		<td width="15%">
			Metode Bayar
		</td>
		<td width="2%">:</td>
		<td width="23%">
			<?php 
			echo $info['nama_carabayar'];
			echo $info['nama_kelompok']==''?'':' / '.$info['nama_kelompok'];
			?>
		</td>
	</tr>
</table>
<hr class="garis"> 
<table class="rinci tabel-isi">
	<tbody style="margin-top: 10px">
	<?php 
	$total=0;
	foreach ($this->m_function->get_polirawat($_GET['no_kunjungan'])->result() as $poli) {
		# code...
		
		echo"<tr>
			<td colspan='4'>Biaya pelayanan poliklinik ".$poli->nama_poliklinik."</td>
		</tr>";
		if($this->m_function->get_tindakan($poli->id_kunjunganrajal)->num_rows() > 0)
		{
			foreach ($this->m_function->get_tindakan($poli->id_kunjunganrajal)->result() as $t) {
				# code...
				echo"
					<tr>
						<td style='padding-left:15px;font-style:italic;width:50%'>".$t->nama_tarif."</td>
						<td> @".$t->qty_tindakan."</td>
						<td>Rp. ".biasa_ke_rp($t->tarif_satuan)."</td>
						<td>Rp. ".biasa_ke_rp($t->tarif_total)."</td>
					</tr>
				";
				$total=$total+$t->tarif_total;
			}
		}
		else
		{
			echo"<tr>
				<td>
				-
				</td>
			</tr>";
		}
	}
	// periksa apakah ada kunjungan laboraturium
	$periksa_lab=$this->m_function->get_tindakan_lab($_GET['no_kunjungan']);
	if($periksa_lab->num_rows() > 0)
	{
		echo"<tr>
			<td colspan='4'>Pemeriksaan laboraturium</td>
		</tr>";
		$arr=$periksa_lab->row_array();
		// jika ada, ambil semua pemeriksaan dan tarif nya 
		$data_periksa_lab=$this->m_function->get_periksa_lab($arr['nomor_lab']);
		foreach ($data_periksa_lab->result() as $dtl) {
			# code...
			echo"
				<tr>
					<td style='padding-left:15px;font-style:italic;width:50%'>".$dtl->nama_produk."</td>
					<td> @1</td>
					<td>Rp. ".biasa_ke_rp($dtl->tarif)."</td>
					<td>Rp. ".biasa_ke_rp($dtl->tarif)."</td>
				</tr>
				";
			$total=$total+$dtl->tarif;
		}
	}

	echo"<tr>
		<td style='text-align:right;font-weight:bold' colspan='3'>Total Tagihan: </td>
		<td style='font-weight:bold'>Rp. ".biasa_ke_rp($total)."</td>
	</tr>";
	echo"<tr>
		<td style='text-align:right;font-weight:bold' colspan='3'>Sudah Dibayar: </td>
		<td style='font-weight:bold'>Rp. ".biasa_ke_rp($info['sudah_bayar'])."</td>
	</tr>";
	echo"<tr>
		<td style='text-align:right;font-weight:bold' colspan='3'>Sisa Tagihan: </td>
		<td style='font-weight:bold'>Rp. ".biasa_ke_rp($info['sisa_tagihan'])."</td>
	</tr>";
	echo"<tr>
		<td style='text-align:right;font-weight:bold' colspan='3'>Keterangan: </td>
		<td style='font-weight:bold'>Rp. ".$info['nama_metode']."</td>
	</tr>";
	?>
	<tr>
		<td colspan="3">
		</td>
		<td style="padding-top: 20px">
		<span style="margin-bottom: 5px;">Bireuen, <?php echo tgl_biasa(date("Y-m-d"))?></span>
		<br/>
		<span style="font-weight: bold;padding-top: 15px">PETUGAS KASIR</span>
		<br>
		<br>
		<br>
		<br>
		<span style="font-weight: bold;padding-top: 15px">
			<?php echo $this->session->userdata('nama_user')?>
		</span>
		</td>
	</tr>		
	</tbody>
</table>
