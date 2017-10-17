<style type="text/css">
	.namars, .alamatrs, .kontakrs, .judul, .titlelap{
		margin: 0px;
	}
	.namars, .alamatrs, .kontakrs, .judul, .informasi, .hasil, .ket-ket, .ket, .tt, .titlelap{
		
	}
	.namars, .alamatrs
	{
		font-size: 13px;
		font-weight: bold;
	}
	.garis{
		border: dashed 1.0px #222;
	}
	.judul{
		text-align: center;
		font-size: 13px;
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
	.head{
		table-layout: fixed;
		margin-top: 15px;
		font-size: 12px;
		border-collapse: collapse;
		border: solid 0.0mm #222222; 

	}

	.hasil td, .hasil th
	{
		border: solid 0.0mm #222222; 
		padding: 5px;
	}
	.hasil thead
	{
		background: #DDD
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
	.head{
		width: 100%
	}
	
</style>
<page>
<h3 class="namars"><?php echo $nama_rs['value_profile']?></h3>
<h3 class="alamatrs"><?php echo $alamat_rs['value_profile']?></h3>
<h6 class="kontakrs">Tlf : <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?></h6>
<h4 class="titlelap">Billing Kunjungan IGD</h4>
<hr class="garis">

<table class="head">
	<col style="width: 50%;">
	<col style="width: 50%;">
	<tbody>
		<tr>
			<td>
				<table>
					<tr>
						<td>No MR</td>
						<td>:</td>
						<td><?php echo $i_head['norek']?></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><?php echo $i_head['nama']?></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td><?php echo $i_head['jk']?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo $i_head['alamat_ktp']?></td>
					</tr>
				</table>
			</td>
			<td>
				<table>
					<tr>
						<td>No Billing</td>
						<td>:</td>
						<td><?php echo $i_head['bill']?></td>
					</tr>
					<tr>
						<td>No Kunjungan</td>
						<td>:</td>
						<td><?php echo $i_head['no_k']?></td>
					</tr>
					<tr>
						<td>Pelayanan</td>
						<td>:</td>
						<td><?php echo $i_head['pl'].' ('.$i_head['cb'].') '?></td>
					</tr>
					<tr>
						<td>Tgl Pelayanan</td>
						<td>:</td>
						<td><?php echo $i_head['tgl']?></td>
					</tr>
				</table>
			</td>
		</tr>
	</tbody>

</table>


<table class="hasil">
	<col style="width: 70%">
	<col style="width: 10%">
	<col style="width: 5%">
	<col style="width: 15%">
	<thead>
		<tr>
			<th>Kode-Tindakan</th>
			<th>Tarif</th>
			<th>qty</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$total=0;
		foreach ($t->result() as $t) {
			# code...
			echo "<tr>
				<td>".$t->tr."</td>
				<td>".number_format($t->tarif,2,',','.')."</td>
				<td>".$t->qty."</td>
				<td>".number_format($t->total,2,',','.')."</td>
			</tr>";
			$total=$total+$t->total;
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<th style="text-align: right;">
				Total Tagihan
			</th>
			<th>:</th>
			<th colspan="2">Rp. 
				<?php echo number_format($total,2,',','.') ?>
			</th>
		</tr>
		<?php 
		if($i_head['piutang']>0)
		{
			echo "<tr>
				<th style='text-align: right;'>Pembayaran</th>
				<th>:</th>
				<th colspan='2'>Rp. ";
				echo number_format($i_head['tagihan']-$i_head['piutang'],2,',','.');
				echo"</th>
			</tr>";
		}
		?>
		<tr>
			<th style="text-align: right;">
				<?php 
				echo $i_head['piutang']==0?'Pembayaran':'Piutang';
				?>
			</th>
			<th>:</th>
			<th colspan="2">
				<?php 
				echo $i_head['piutang']==0?'Rp. '.number_format($i_head['tagihan'],2,',','.'):'Rp. '.number_format($i_head['piutang'],2,',','.');
				?>
			</th>
		</tr>

		
	</tfoot>
</table>

<table>
	
</table>
</page>