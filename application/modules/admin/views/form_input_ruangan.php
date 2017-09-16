
<div class="modal-header">
	<button type="button" class="close" data-dismiss='modal' aria-hidden='true'></button>
	<h4 class="modal-title"><i class='icon-list'></i> Form input ruang pelayanan rawat inap</h4>
</div>
<div class="modal-body">
	<form class="form-horizontal form_ruangan" role='form'>
		<input type="hidden" name="id" id="id" value='<?php echo $max['id_ruangan']+1?>'>
		<div class="form-body">
			<div class="form-group">
				<label class="control-label col-md-3">Kode Ruangan :</label>
				<div class="col-md-9">
					<input type="text" name="kode" class="form-control kode" disabled="" value='<?php echo $max['id_ruangan']+1?>'>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Nama Ruangan :</label>
				<div class="col-md-9">
					<input type="text" name="nama" class="form-control nama" autofocus="">
				</div>
			</div>
				
		</div>
	</form>
</div>
<div class="modal-footer">
	<button class="btn green-meadow" data-dismiss='modal'>Close</button>
	<button class="btn green-meadow btn_simpan_ruangan">Simpan ruangan</button>
</div>
<script type="text/javascript">
	$(".btn_simpan_ruangan").click(function(){
		
		Metronic.blockUI({
			target:'.modal-body',
			boxed:true,
			message:'Menyimpan...'
		});
		
		$.ajax({
			type:'post',
			url:base_url+'admin/datamaster_api/save_ruangan',
			data:$(".form_ruangan").serialize(),
			dataType:'json',
			success:function(json)
			{
				if(json.success)
				{
					Metronic.unblockUI('.modal-body');
					$("#id").val(json.id);
					$(".kode").val(json.id)
					$('.nama').val('').focus();
					load_tabel_data_ruangan();
				}
			}
		})

	})
</script>
