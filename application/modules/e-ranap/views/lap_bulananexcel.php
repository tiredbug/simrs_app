<style type="text/css">
	.namars, .alamatrs, .kontakrs, .judul, .titlelap{
		margin: 0px;
	}
	.namars, .alamatrs, .kontakrs, .judul, .informasi, .hasil, .ket-ket, .ket, .tt, .titlelap{
		
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
		table-layout: fixed;
		margin-top: 15px;
		font-size: 12px;
		border-collapse: collapse;
    	border-spacing: 0;
    	border: solid 0.2mm #222222; 
    	margin-bottom: 15px;
	}
	td, th
	{
		border: solid 0.2mm #222222; 
		padding: 5px;
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
<page>
<h3 class="namars"><?php echo $nama_rs['value_profile']?></h3>
<h3 class="alamatrs"><?php echo $alamat_rs['value_profile']?></h3>
<h6 class="kontakrs">Tlf : <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?></h6>
<h4 class="titlelap">Laporan Kunjungan Bulan <?php echo $bulan?> Ruang <?php echo $_SESSION['nama_ruangan']?></h4>
<hr class="garis">

<table class="hasil">
	<thead>
		<tr>
			<th>No. MR</th>
			<th>Nama Lengkap</th>
			<th>Jenis Kelamin</th>
			<th>M.Bayar</th>
			<th>Kelas</th>
			<th>Kamar</th>
			<th>Bed</th>
			<th>Tgl Masuk</th>
			<th>Tgl Keluar</th>
			<th>Cara Keluar</th>
			<th>Asal</th>
		</tr>
		
	</thead>
	<tbody>
		<?php 
		$no=0;
		foreach ($data->result() as $d) {
			echo "<tr>
				<td>".$d->nomr."</td>
				<td>".$d->nama."</td>
				<td>".$d->jk."</td>
				<td>".$d->cb."</td>
				<td>".$d->kls."</td>
				<td>".$d->kamar."</td>
				<td>".$d->bed."</td>
				<td>".$d->tgl_masuk."</td>
				<td>".$d->tgl_keluar."</td>
				<td>".$d->stt."</td>
				<td>".$d->asal_masuk."</td>
			</tr>";
			# code...
			$no++;
		}
		echo "<tr>
			<td colspan='10'>Total Kunjungan :</td>
			<td >".$no."</td>
		</tr>";
		?>
	</tbody>
</table>
</page>