<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>


<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Keterangan pindah ruangan 
			</div>
		</div>
		<form class="form-horizontal form_pindah_ruangan">
		<input type="hidden" name="nokunjungan" value="<?php echo $this->uri->segment(5);?>">
		<input type="hidden" name="id_kunjungan" value="<?php echo $this->uri->segment(4);?>">
		<input type="hidden" name="ruangan_s" value='<?php 
		foreach($i_r->result() as $r_s){echo $r_s->id_ruangan==$_SESSION['ruang']?$r_s->nama_ruangan:'';}?>'>
		<div class="panel-body">
			<div class="col-sm-8">
				<div class="form-group">
					<label class="control-label col-sm-3">Tgl keluar :</label>
					<div class="col-sm-9">
						<input type="text" name="tgl_keluar" class="form-control datepicker tgl_keluar"  data-format='dd-mm-yy' value='<?php echo date("Y-m-d")?>'>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-3">Jam keluar :</label>
					<div class="col-sm-9">
						<input type="text" name="jam_keluar" class="form-control timepicker jam_keluar" data-template="dropdown" data-show-seconds="true" value='<?php echo date("H:i:s")?>' data-show-meridian="false">
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-sm-3">Ke ruang :</label>
					<div class="col-sm-9">
						<select name="ruangan_p" class="form-control ruangan_p">
							<option value="">-- Pilih --</option>
							<?php 
								foreach ($i_r->result() as $r) {
									# code...
									echo "<option value='".$r->id_ruangan."'>".$r->nama_ruangan."</option>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Kelas :</label>
					<div class="col-sm-9">
						<select name="kelas_p" class="form-control kelas_p">
							<option value=''>-- Pilih --</option>
							<?php 
								foreach ($i_kls->result() as $kls) {
									# code...
									echo "<option value='".$kls->id_kelasperawatan."'>".$kls->nama_kelasperawatan."</nama_kelasperawatanoption>";
								}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">Kamar :</label>
					<div class="col-sm-9">
						<select name="kamar_p" class="form-control kamar_p">
							<option value=''>-- Pilih --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3">No. Bed :</label>
					<div class="col-sm-9">
						<select name="bed_p" class="form-control bed_p">
							<option value=''>-- Pilih --</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<a href='<?php echo base_url().'e-ranap/penatajasa'?>' class="btn btn-blue  btn-icon icon-left" ><i class='entypo-back'></i> Batal pemindahan</a>
						<button class="btn btn-blue  btn_pindah_ruangan btn-icon icon-left " type="button"><i class='entypo-shareable'></i> Proses pemindahan </button> 
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="well well-sm">
				<span class="">
					<img src="<?php echo base_url()?>template/assets/img/pindah-ruangan.png">
					<br/>
					<p class="bold">Penting :<br/>
						Mengisi keterangna pasien keluar dapat membantu anda dalam memperoleh informasi pembukuan kunjungan ruangan dan sensus harian.
					</p>
				</span>
				</div>
			</div>

		</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(".kelas_p").change(function()
	{	
		if($(".ruangan_p").val()=='')
		{
			toastr.warning('Pilih ruangan dulu.')
			$(".kelas_p").val('')
		}
		else
		{
			loading_show();
			$.ajax({
				type:'post',
				url:base_url+'e-ranap/penatajasa_api/get_i_kmr',
				data:'ruang='+$(".ruangan_p").val()+'&kelas='+$(".kelas_p").val(),
				dataType:'json',
				success:function(json)
				{
					$(".kamar_p").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
					$.each(json,function(i, d){
						$(".kamar_p").append("<option value='"+d.id_kamar+"'>"+d.nama_kamar+"</option>")
					})
					loading_hide()
				}
			})
		}

	})


	$(".kamar_p").change(function(){
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_bed',
			data:'kamar='+$(".kamar_p").val(),
			dataType:'json',
			success:function(json)
			{
				$(".bed_p").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".bed_p").append("<option value='"+d.id_bed+"'>"+d.nomor_bed+"</option>")
				})
			}
		})
	})
	$(".ruang").change(function(){
		$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
		$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
	})
	function loading_show()
    {
        var $this = $(".panel");
        blockUI($this);
        $this.addClass('reloading');
    }
    
    function loading_hide()
    {
        var $this = $(".panel");
        unblockUI($this)
        $this.removeClass('reloading');
    }

    $(".btn_pindah_ruangan").click(function(){
    	swal({
    		title:'Pindahkan ?',
    		text:'setelah dipindahkan data pasien tidak dapat lagi diakses di ruangan ini, jika anda yakin lanjutkan pindah pasien',
    		type:'warning',
    		showCancelButton:true,
            confirmButtonText:'Ya, lanjutkan pindah.',
            confirmButtonColor:"#21a9e1",
            closeOnConfirm:false,
            showLoaderOnConfirm: true
    	},
	    	function(){
		    	loading_show();
		    	var $this=$(this);
		    	$this.html("<i class='entypo-shareable'></i> Proses pindah ruangan...").prop("disabled",true)
		    	$.ajax({
		    		type:'post',
		    		url:base_url+'e-ranap/penatajasa_api/pindah_ruangan',
		    		data:$(".form_pindah_ruangan").serialize(),
		    		dataType:'json',
		    		success:function(json)
		    		{
		    			if(json.success)
		    			{
		    				loading_hide();
		    				$this.html("Proses pemindahan").prop('disabled',false)
		    				$(".form-group")
		    				.removeClass('has-success')
		    				.removeClass('has-error')
		    				.find('.text-danger')
		    				.remove()
		    				.end()
		    				swal({
		    					title:'Berhsail',
		    					text:'Pasien berhasil dipindahkan keruangan lain.',
		    					type:'success'
		    				},function()
		    				{
		    					window.location.href=base_url+'e-ranap/penatajasa'
		    				})
		    			}
		    			else
		    			{
		    				loading_hide();
		    				$this.html("Proses pemindahan").prop('disabled',false)
		    				$.each(json.message,function(i, val){
		    					var el=$("."+i);
		    					el.closest('div.form-group')
		    					.removeClass('has-error')
		    					.addClass(val.length > 0 ?'has-error':'has-success')
		    					.find('.text-danger')
		    					.remove();
		    					el.after(val)
		    				})
		    				swal({
		    					title:'Belum lengkap',
		    					text:'Lengkapi form pemindahan pasien keruangan lain.',
		    					type:'error'
		    				})
		    			}
		    		}
		    	})
		    }
    	)
    })
</script>

