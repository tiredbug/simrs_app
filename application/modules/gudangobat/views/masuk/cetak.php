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
<h4 class="titlelap">Nota transaksi barang masuk gudang farmasi</h4>
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
			Kode - Supllier
		</td>
		<td >:</td>
		<td ><?php echo $nota['kode_supplier'].' - '.$nota['nama_supplier']?></td>
	</tr>

	<tr>
		<td >
			No, Tgl Faktur
		</td>
		<td >:</td>
		<td ><?php echo $nota['no_faktur'].' - '.tgl_biasa($nota['tgl_faktur'])?></td>
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
			<th>No. Batch</th>
			<th>Tgl Expired</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1;
		$total=0;
		foreach ($list_masuk->result() as $lm) {
			# code...
			echo "<tr>
				<td>".$no."</td>
				<td>".$lm->kode_obat."</td>
				<td>".$lm->nama_obat."</td>
				<td>".$lm->no_batch."</td>
				<td>".tgl_biasa($lm->expired)."</td>
				<td>".biasa_ke_rp($lm->harga_satuan)."</td>
				<td>".$lm->jumlah_masuk.' '.$lm->satuan_obat."</td>
				<td>".biasa_ke_rp($lm->harga_satuan*$lm->jumlah_masuk)."</td>
			</tr>";
			$no++;
			$total=$total+($lm->harga_satuan*$lm->jumlah_masuk);
		}
		?>
		<tr>
			<td colspan="7">Sub Total : </td>
			<td><?php echo biasa_ke_rp($total);?></td>
		</tr>
	</tbody>
</table>
Keterangan : <?php echo $nota['keterangan_lain']?>