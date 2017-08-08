<style type="text/css">
	.namars, .alamatrs, .kontakrs, .judul, .titlelap{
		margin: 0px;
	}
	.namars, .alamatrs, .kontakrs, .judul, .informasi, .hasil, .ket-ket, .ket, .tt, .titlelap{
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
	.informasi, .ket-ket, .ket, .tt, .titlelap
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
<h4 class="titlelap">Nota transaksi barang keluar gudang farmasi</h4>
<hr class="garis">
<table width="100%" class="informasi">
	<tr>
		<td width="100">
			No. Transaksi
		</td>
		<td >:</td>
		<td ><?php echo $nota['no_transaksi']?></td>
	</tr>

	<tr>
		<td>
			Tgl Transaksi
		</td>
		<td >:</td>
		<td ><?php echo tgl_biasa($nota['tgl_transaksi'])?></td>
	</tr>

	<tr>
		<td width="">
			Kode - Client
		</td>
		<td >:</td>
		<td ><?php echo $nota['kode_client'].' - '.$nota['unit_client']?></td>
	</tr>


	<tr>
		<td >
			Serah - Terima
		</td>
		<td >:</td>
		<td ><?php echo $nota['penyerah'].' - '.$nota['penerima']?></td>
	</tr>

</table>

<table class="hasil">
	<thead>
		<tr>
			<th>No.</th>
			<th>Kode</th>
			<th>Nama Barang</th>
			<th>Jumlah</th>
			<th>No. Batch</th>
			<th>Tgl Expired</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1;
		foreach ($list_keluar->result() as $lk) {
			# code...
			echo "<tr>
				<td>".$no."</td>
				<td>".$lk->kode_obat."</td>
				<td>".$lk->nama_obat."</td>
				<td>".$lk->jumlah_keluar." ".$lk->satuan_obat."</td>
				<td>".$lk->no_batch."</td>
				<td>".tgl_biasa($lk->expired)."</td>
			</tr>";
			$no++;
		}
		?>
	</tbody>
</table>
Keterangan : <?php echo $nota['keterangan_lain']?>