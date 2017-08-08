<style type="text/css">
	.select2-drop{
		z-index:10060;
	}
</style>
<form id="form-add-dokter-piket">
<input type="hidden" name="poli" value="<?php echo $data['poli']?>"/>
<input type="hidden" name="tgl" value="<?php echo $data['tgl']?>"/>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label for="field-1" class="control-label">Nama Dokter</label>
			<select name="dokter[]"   multiple id="select2">
				<?php 
				foreach($dokter->result() as $d)
				{
					echo"<option value='".$d->kode_dokter."'";
					echo $this->m_function->cek_dokter_piket($data['tgl'],$data['poli'],$d->kode_dokter)>0?'selected':'';
					echo">".$d->nama_belakang.' '.$d->nama_dokter.', '.$d->gelar."</option>";
				}
				?>
			</select>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	$(document).ready(function() {
		 $('#select2').select2();
	});
</script>