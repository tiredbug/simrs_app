<!DOCTYPE html>
<html>
<head>
	<title>Hasil pemeriksaan laboraturium</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/neon/css/print.css">
	<script src="<?php echo base_url()?>template/neon/js/jQuery-2.1.4.js"></script>
</head>
<body>
	<div class="form-btn">
		<button class="btn-print" onclick="print()"><img src="<?php echo base_url()?>template/assets/img/btn-print.png" width='20'></button>
	</div>
	<div class="page">
		<div class="title-rs"><?php echo $nama_rs['value_profile']?></div>
		<div class="alamat"><?php echo $alamat_rs['value_profile']?></div>
		<div class="tlp">Telf: <?php echo $tlf_rs['value_profile']?>, Fax : <?php echo $fax_rs['value_profile']?></div>
		<div class="ket_lap">Hasil pemeriksaan laboraturium</div>
		
		<div class="informasi">

			<div class="col-sm-6">
				<table width="100%">
					<tr>
						<td width="100">Nomor registrasi</td>
						<td>:</td>
						<td><?php echo $r['nolab']?></td>
					</tr>
					<tr>
						<td>Nomor medrec</td>
						<td>:</td>
						<td><?php echo $r['norek']?></td>
					</tr>
					<tr>
						<td>Nama lengkap</td>
						<td>:</td>
						<td><?php echo $r['nama']?></td>
					</tr>
					<tr>
						<td>Jenis-kelamin</td>
						<td>:</td>
						<td><?php echo $r['jk']?></td>
					</tr>
					<tr>
						<td>Tgl lahir - umur</td>
						<td>:</td>
						<td><?php echo $r['tgl_lahir']?></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo $r['alamat']?></td>
					</tr>
				</table>
			</div>

			<div class="col-sm-6">
				<table width="100%">
					<tr>
						<td>Tgl registrasi</td>
						<td>:</td>
						<td><?php echo $r['tgl']?></td>
					</tr>
					<tr>
						<td>Asal-unit</td>
						<td>:</td>
						<td><?php echo $r['asal']?></td>
					</tr>
					<tr>
						<td>M.Bayar</td>
						<td>:</td>
						<td><?php echo $r['bayar']?></td>
					</tr>
					<tr>
						<td>Dokter pengirim</td>
						<td>:</td>
						<td><?php echo $r['dokterp']?></td>
					</tr>
					<tr>
						<td>Dokter periksa</td>
						<td>:</td>
						<td><?php echo $r['dokter']?></td>
					</tr>
					<tr>
						<td>Register by</td>
						<td>:</td>
						<td><?php echo $r['user']?></td>
					</tr>
					

				</table>
			</div>
		</div>

		<div class="hasil">
			<table width="100%" class="table">
				<thead >
					<tr>
						<th>Pemeriksaan</th>
						<th>Normal</th>
						<th>Satuan</th>
						<th>Hasil</th>
						<th>Metode</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$this->db->where('jenis','group');
					$d_group=$this->db->get('lab_produks');
					foreach ($d_group->result() as $g) {
						# code...
						// cek apakah ada paket yang berkaitan dengan group
						$cek_list_group=$this->db->query("SELECT *
														FROM lab_pemeriksaan a
														INNER JOIN lab_produks b ON a.kode_produk=b.kode
														WHERE b.parent_group='".$g->kode."' AND (b.jenis='paket' OR b.jenis='list') AND a.nomor_lab='".$r['nolab']."'");

						// apabila ada
						$no=1;
						if($cek_list_group->num_rows() >0)
						{
							echo "<tr>
								<td><b>".$g->produk."</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>";
							$lst=$this->db->query("SELECT 
													pr.kode, pr.produk, p.tarif, pr.parent_paket, pr.jenis, pr.nilai_normal normal, pr.satuan, pr.jenis, p.hasil_periksa, p.metode_periksa, p.keterangan, p.id
													FROM lab_pemeriksaan p
													INNER JOIN lab_produks pr ON pr.kode=p.kode_produk
													WHERE p.nomor_lab='".$r['nolab']."' AND pr.parent_group='".$g->kode."'
													group by pr.kode");
							foreach ($lst->result() as $l) {
								# code...
								switch ($l->jenis) {
									case 'paket':
										# code...
										echo"
							 			<tr>
							 				<td class='bold'>&nbsp&nbsp&nbsp".$l->produk." :</td>
											<td>".$l->normal."</td>
											<td>".$l->satuan."</td>
											<td>".$l->hasil_periksa."</td>
											<td></td>
											<td></td>
							 			</tr>
							 			";
										break;
									
									case 'list':
										# code...
									// jka jenis list
										$cek_sub_list=$this->m_function->cek_sub_list_join_produk($l->kode);
										if($cek_sub_list->num_rows() > 0)
										{
											echo"
									 			<tr>
									 				<td><b>&nbsp&nbsp&nbsp&nbsp&nbsp".$l->produk." : </b></td>
													<td>".$l->normal."</td>
													<td>".$l->satuan."</td>
													<td>".$l->hasil_periksa."</td>
													<td></td>
													<td></td>
									 			</tr>
									 			";

									 		foreach ($cek_sub_list->result() as $sl) {
						 						echo"
									 			<tr>
									 				<td class='bold'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$sl->produk."</td>
													<td>".$sl->nilai_normal."</td>
													<td>".$sl->satuan."</td>
													<td>".$sl->hasil_periksa."</td>
													<td></td>
													<td></td>
									 			</tr>
									 			";

							 				}
										}
										else
										{echo"
									 			<tr>
									 				<td class='bold'>&nbsp&nbsp&nbsp&nbsp&nbsp".$l->produk."</td>
													<td>".$l->normal."</td>
													<td>".$l->satuan."</td>
													<td>".$l->hasil_periksa."</td>
													<td></td>
													<td></td>
									 			</tr>
									 			";
											// echo"
								 		// 	<tr>
								 				
								 		// 	</tr>
								 		// 	";
										}
										break;
								}
							}
							$no++;
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-sm-12">
			<div class="ttd">
				Bireuen, <?php echo date("d-m-Y")?>
				<br>DR PENANGGUNG JAWAB
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<?php echo $r['dokterp']?>
			</div>
		</div>
	</div>


</div>
<script type="text/javascript">
	function print_hasil() {
		// body...
		$("div.page").printArea(); 
	}
</script>
</body>
</html>