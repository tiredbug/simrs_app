<style type="text/css">
	.namars, .alamatrs, .kontakrs, .judul{
		margin: 0px;
	}
	.namars, .alamatrs, .kontakrs, .judul, .informasi, .hasil, .ket-ket, .ket, .tt{
		font-family: 'arial'
	}
	.namars, .alamatrs
	{
		font-size: 14px;
		font-weight: bold;
	}
	.garis{
		border: solid 1.5px #222;
	}
	.judul{
		text-align: center;
		font-size: 14px;
		margin-bottom: 10px;
	}
	.informasi, .ket-ket, .ket, .tt
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
</style>
<h3 class="namars"><?php echo $nama_rs['value_profile']?></h3>
<h3 class="alamatrs"><?php echo $alamat_rs['value_profile']?></h3>
<h6 class="kontakrs">Tlf : <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?></h6>
<hr class="garis">
<h4 class="judul">HASIL PEMERIKSAAN LABORATURIUM</h4>
<table width="100%" class="informasi">
	<tr>
		<td width="15%">
			No. Medrec
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['norekammedis']?></td>
		<td width="15%">
			No. Register
		</td>
		<td width="2%">:</td>
		<td width="23%"><?php echo sprintf("%010d",$info['nomor_lab'])?></td>
	</tr>

	<tr>
		<td width="15%">
			Nama Lengkap
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['nama_pasien']?></td>
		<td width="15%">
			Tgl Order
		</td>
		<td width="2%">:</td>
		<td width="23%"><?php echo tgl_biasa($info['tgl_order'])?></td>
	</tr>

	<tr>
		<td width="15%">
			Unit Pengirim
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['unit_pengirim']?></td>
		<td width="15%">
			Tgl Periksa
		</td>
		<td width="2%">:</td>
		<td width="23%"><?php echo tgl_biasa($info['tgl_periksa']).' '.$info['jam_periksa']?></td>
	</tr>

	<tr>
		<td width="15%">
			Dokter Pengirim
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['nama_belakang'].' '.$info['dokter_pengirim'].', '.$info['gelar']?></td>
		<td width="15%">
			Petugas Lab
		</td>
		<td width="2%">:</td>
		<td width="23%"><?php echo $info['petugas']?></td>
	</tr>

	<tr>
		<td width="15%">
			Alamat
		</td>
		<td width="2%">:</td>
		<td width="43%"><?php echo $info['alamat_ktp'].' Desa .'.$info['nama_kelurahan'].' Kec.'.$info['nama_kecamatan'].' Kab.'.$info['nama_kota'].' Prov.'.$info['nama_provinsi']?></td>
		<td width="15%">
			Dokter P.Jawab
		</td>
		<td width="2%">:</td>
		<td width="23%"><?php echo $info['dokter']?></td>
	</tr>
</table>

<table class="hasil">
	<thead>
		<tr>
			<th class="label-tabel" style="width: 40%">PEMERIKSAAN</th>
			<th class="label-tabel" style="width: 25%">NORMAL</th>
			<th class="label-tabel" style="width: 10%">SATUAN</th>
			<th class="label-tabel" style="width: 25%">HASIL</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($gr as $group) {
			# code...
			echo"<tr>
					<td><b>".$group->klp_produk."</b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>";
				foreach ($this->m_function->get_hasil_per_group($group->klp_produk,'1')->result() as $lg) {
					# code...
					echo"<tr>
						<td><span class='item'>".$lg->nama_pemeriksaan."</span></td>
						<td>".$lg->nilai_normal."</td>
						<td>".$lg->satuan."</td>
						<td>".$lg->hasil."</td>
					</tr>";
				}
		}
		?>
	</tbody>
</table>
<span class='ket-ket'>Keterangan :</span>
<?php echo"<p class='ket'>".$info['keterangan']."</p>"?>
<table class="tt">
	<tr>
		<td>
			Bireuen, <?php echo tgl_biasa($info['tgl_order'])?>
		</td>
	</tr>	
	<tr>
		<td>
			Dokter Penanggung Jawab
		</td>
	</tr>
	<tr>
		<td class="drp">
			<?php echo $info['dokter']?>
		</td>
	</tr>
</table>