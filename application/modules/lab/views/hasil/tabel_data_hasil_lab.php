<table class="table table-hover table-form nomargin table-datagrid nomargin-bottom tabel-hasil-lab">
	<!-- table header start -->
	<thead>
		<tr>
			<th class="label-tabel" style="width: 5%">NO.</th>
			<th class="label-tabel" style="width: 35%">PEMERIKSAAN</th>
			<th class="label-tabel" style="width: 25%">NORMAL</th>
			<th class="label-tabel" style="width: 10%">SATUAN</th>
			<th class="label-tabel" style="width: 25%">HASIL</th>
		</tr>
	</thead>
	
	<tbody>
		<?php
		$no=1;
		foreach ($hasil_lab->result() as $h) {
			# code...
			echo"<tr>
				<td>".$no."</td>
				<td>".$h->nama_pemeriksaan."</td>
				<td>".$h->nilai_normal."</td>
				<td >".$h->satuan."</td>
				<td style='padding:0px;padding-left: 5px;padding-top: 2px; padding-right:5px'>
					<input type='text' class='form-control input-sm' name='".$h->id_hasil."' value='".$h->hasil."' ";
					echo $no==1?'autofocus=':''; 
					echo"/>
				</td>
			</tr>";
			$no++;
		}
		?>
	</tbody>
	
</table>