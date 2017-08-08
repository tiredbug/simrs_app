<table class="table table-hover table-form nomargin table-datagrid">
	<!-- table header start -->
	<thead>
		<tr>
			<th class="label-tabel" style="width: 5%"></th>
			<th class="label-tabel" style="width: 10%">KODE</th>
			<th class="label-tabel" style="width: 60%">TINDAKAN </th>
			<th class="label-tabel" style="width: 5%">QTY</th>
			<th class="label-tabel" style="width: 10%">TARIF</th>
			<th class="label-tabel" style="width: 10%">TOTAL</th>
		</tr>
	</thead>
	<!-- table header end -->

	<!-- table body start -->
	<tbody>
		<?php
		$total=0;
		foreach ($tindakan->result() as $t) {
			# code...
			$total=$total+$t->tarif_total;
			echo"
				<tr>
					<td><a href='javascript:hapus(".$t->id.")' class='btn btn-red btn-xs'>DELETE</a></td>
					<td>".$t->kode_tarif."</td>
					<td>".$t->nama_tarif."</td>
					<td>".$t->qty_tindakan."</td>
					<td>".biasa_ke_rp($t->tarif_satuan)."</td>
					<td>".biasa_ke_rp($t->tarif_total)."</td>
				</tr>
			";
		}
		?>
	</tbody>
	<!-- table body end -->

	<!-- table foter start -->
	<tfoot>
		<tr>
			<th class="label-tabel" colspan="4">SUB TOTAL</th>
			<th class="label-tabel" colspan="2"><?php echo biasa_ke_rp($total)?></th>
		</tr>
	</tfoot>
	<!-- table foter end -->
</table>