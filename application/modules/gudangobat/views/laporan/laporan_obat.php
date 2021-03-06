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
		text-align: center;
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
<h4 class="titlelap">Laporan Stok Barang</h4>
<hr class="garis">

<table class="hasil">
	<thead>
		<tr>
			<th rowspan="2" width='25'>No.</th>
			<th rowspan="2">Kode - Barang</th>
			<th colspan="4">Jumlah</th>
		</tr>
		<tr>
			<th>Masuk</th>
			<th>Keluar</th>
			<th>Return</th>
			<th>Stok</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no=1;
		foreach ($stok->result() as $s) {
			# code...
			echo "<tr>
				<td>".$no."</td>
				<td>".$s->kode_obat." - ".$s->nama_obat."</td>
				<td>".$s->jumlah_masuk." ".$s->satuan_obat."</td>
				<td>".$s->jumlah_keluar." ".$s->satuan_obat."</td>
				<td>".$s->jumlah_return." ".$s->satuan_obat."</td>
				<td>".$s->stok." ".$s->satuan_obat."</td>
			</tr>";
			$no++;
		}
		?>
	</tbody>
</table>