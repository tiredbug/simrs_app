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
		font-weight: bold;
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
<h4 class="titlelap">Nota transaksi return barang gudang farmasi</h4>
<hr class="garis">
<table width="100%" class="informasi">
	<tr>
		<td width="150">
			No. Transaksi
		</td>
		<td >:</td>
		<td ><?php echo $nota['no_transaksi']?></td>
	</tr>
	<tr>
		<td width="150">
			Tgl Return
		</td>
		<td >:</td>
		<td ><?php echo tgl_biasa($nota['tgl_return'])?></td>
	</tr>

	<tr>
		<td width="150">
			Supplier - No.Faktur
		</td>
		<td >:</td>
		<td ><?php echo $nota['nama_supplier'].' - '.$nota['no_faktur']?></td>
	</tr>
	<tr>
		<td width="150">
			Diserahkan Oleh :
		</td>
		<td >:</td>
		<td ><?php echo $nota['penyerah']?></td>
	</tr>
	<tr>
		<td width="150">
			Diterima Oleh :
		</td>
		<td >:</td>
		<td ><?php echo $nota['penerima']?></td>
	</tr>
	

</table>

<table class="hasil">
	<thead>
		<tr>
			<th style='text-align:center'>No.</th>
			<th>Kode</th>
			<th>Nama Barang</th>
			<th>No. Batch</th>
			<th>Tgl Expired</th>
			<th>Jumlah Return</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1;
		foreach ($list->result() as $l) {
			# code...
			echo "<tr>
			<td style='text-align:center'>".$no."</td>
			<td>".$l->kode_obat."</td>
			<td>".$l->nama_obat."</td>
			<td>".$l->no_batch."</td>
			<td>".tgl_biasa($l->expired)."</td>
			<td>".$l->jumlah_return." ".$l->satuan_obat."</td>
			</tr>";
			$no++;
		}
		?>
	</tbody>
	
</table>
Keterangan : <?php echo $nota['keterangan_lain']?>