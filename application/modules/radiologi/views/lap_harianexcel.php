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
<h4 class="titlelap">Laporan Kunjungan Instalasi Radiologi Tgl <?php echo $_GET['tgl']?></h4>
<hr class="garis">

<table class="hasil">
	<col style="width: 6%;">
	<col style="width: 7%;">
	<col style="width: 6%;">
	<col style="width: 10%;">
	<col style="width: 6%;"">
	<col style="width: 8%;">
	<col style="width: 13%;">
	<col style="width: 13%;">
	<col style="width: 8%;">
	<col style="width: 10%;">
	<col style="width: 12%;">
	<thead>
		<tr>
			<th>No. MR</th>
			<th>No. Kunjungan</th>
			<th>No. Radiologi</th>
			<th>Nama Lengkap</th>
			<th>Jenis Kelamin</th>
			<th>Tgl Permintaan</th>
			<th>Pengirim</th>
			<th>Dokter</th>
			<th>Register By</th>
			<th>Pemeriksaan</th>
			<th>Asal</th>
		</tr>
		
	</thead>
	<tbody>
		<?php 
		$no=0;
		foreach ($data->result() as $d) {
			$p='';
			foreach ($this->m_laporan->get_periksa($d->norad)->result() as $k) {
				# code...
				$p .='- '.$k->tindakan.'<br/>';
			}
			echo "<tr>
				<td>".$d->nomr."</td>
				<td>".$d->no_k."</td>
				<td>".$d->norad."</td>
				<td>".$d->nama."</td>
				<td>".$d->jk."</td>
				<td>".$d->tgl_order."</td>
				<td>".$d->dokter_pengirim."</td>
				<td>".$d->dokter_p."</td>
				<td>".$d->n_user."</td>
				<td>".$p."</td>
				<td>".$d->asal." ".$d->unit."</td>
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