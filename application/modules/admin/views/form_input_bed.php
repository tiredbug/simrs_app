
<div class="modal-header">
	<button type="button" class="close" data-dismiss='modal' aria-hidden='true'></button>
	<h4 class="modal-title"><i class='icon-list'></i> Form input tempat tidur pelayanan rawat inap</h4>
</div>
<div class="modal-body">
	<form class="form-horizontal form_bed" role='form'>
		<input type="hidden" name="id" id="id" value='<?php echo $max['id_bed']+1?>'>

		<div class="form-body">
			<div class="form-group">
				<label class="control-label col-md-3">Kode Bed :</label>
				<div class="col-md-9">
					<input type="text" name="kode" class="form-control kode" disabled="" value='<?php echo $max['id_bed']+1?>'>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Nomor Bed :</label>
				<div class="col-md-9">
					<input type="text" name="nobed" class="form-control nobed" autofocus="">
				</div>
			</div>
				
		</div>
	</form>
</div>
<div class="modal-footer">
	<button class="btn green-meadow" data-dismiss='modal'>Close</button>
	<button class="btn green-meadow btn_simpan_bed">Simpan bed</button>
</div>
<script type="text/javascript">
	$(".btn_simpan_bed").click(function(){
		
		Metronic.blockUI({
			target:'.modal-body',
			boxed:true,
			message:'Menyimpan...'
		});
		
		$.ajax({
			type:'post',
			url:base_url+'admin/datamaster_api/save_bed',
			data:$(".form_bed").serialize()+'&kamar='+$("#kamar").val(),
			dataType:'json',
			success:function(json)
			{
				if(json.success)
				{
					Metronic.unblockUI('.modal-body');
					$("#id").val(json.id);
					$(".kode").val(json.id)
					$('.nobed').val('').focus();
					load_tabel_data_bed();
				}
			}
		})

	})
</script>
