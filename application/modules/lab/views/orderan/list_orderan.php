<table class="table table-hover table-form nomargin table-datagrid" style="margin-bottom: 0px">
	<!-- table header start -->
	<thead>
		<tr>
			<th class="label-tabel" style="width: 10%">KODE</th>
			<th class="label-tabel" style="width: 80%">PEMERIKSAAN</th>
			<th class="label-tabel" style="width: 10%;text-align: center">DELETE</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($list->result() as $l) {
			# code...
			echo"<tr>
				<td>".$l->kode_produk."</td>
				<td>".$l->nama_produk."</td>
				<td><a href=javascript:hapus(2) class='btn btn-red btn-sm btn-icon icon-left'>Hapus<i class='entypo-cancel'></i></a></td>
			</tr>";
		}
		?>
	</tbody>
</table>
<script type="text/javascript">
	function hapus()
	{
		alert('Proses hapus list permintaan pemeriksaan masih dalam pengembangan.')
	}
</script>