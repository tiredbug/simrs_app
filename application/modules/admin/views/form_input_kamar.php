
<div class="modal-header">
	<button type="button" class="close" data-dismiss='modal' aria-hidden='true'></button>
	<h4 class="modal-title"><i class='icon-list'></i> Form input kamar pelayanan rawat inap</h4>
</div>
<div class="modal-body">
	<form class="form-horizontal form_kamar" role='form'>
		<input type="hidden" name="id" id="id" value='<?php echo $max['id_kamar']+1?>'>

		<div class="form-body">
			<div class="form-group">
				<label class="control-label col-md-3">Kode Kamar :</label>
				<div class="col-md-9">
					<input type="text" name="kode" class="form-control kode" disabled="" value='<?php echo $max['id_kamar']+1?>'>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Nama Kamar :</label>
				<div class="col-md-9">
					<input type="text" name="nama" class="form-control nama" autofocus="">
				</div>
			</div>
				
		</div>
	</form>
</div>
<div class="modal-footer">
	<button class="btn green-meadow" data-dismiss='modal'>Close</button>
	<button class="btn green-meadow btn_simpan_ruangan">Simpan kamar</button>
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
			url:base_url+'admin/datamaster_api/save_kamar',
			data:$(".form_kamar").serialize()+'&kls='+$("#ruangan").val()+'&ruang='+$("#kelas").val(),
			dataType:'json',
			success:function(json)
			{
				if(json.success)
				{
					Metronic.unblockUI('.modal-body');
					$("#id").val(json.id);
					$(".kode").val(json.id)
					$('.nama').val('').focus();
					load_tabel_data_kamar();
				}
			}
		})

	})
</script>
