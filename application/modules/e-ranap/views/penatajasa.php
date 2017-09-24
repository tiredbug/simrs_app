<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Informasi pasien
			</div>
		</div>

		<div class="panel-body">
			<form class="form-horizontal form-data-1">
				<input type="hidden" value='' name="i_norek" id='i_norek'>
				<input type="hidden" value='' name="i_nokunjungan" id='i_nokunjungan'>
				<input type="hidden" value='' name="i_id" id='i_id'>
				<div class="form-group">
					<label class="col-sm-3 control-label">No Medrec :</label>
					<div class="col-sm-9">
						<input type="text" name="norek" class="form-control norek" autofocus="">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">No Kunjungan :</label>
					<div class="col-sm-9">
						<input type="text" name="nokunjungan" class="form-control nokunjungan">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Nama :</label>
					<div class="col-sm-9">
						<input type="text" name="nama" class="form-control nama">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Jenis Kelamin :</label>
					<div class="col-sm-9">
						<input type="text" name="jk" class="form-control jk">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Alamat :</label>
					<div class="col-sm-9">
						<input type="text" name="alamat"  class="form-control alamat">
					</div>
				</div>

			</form>
		</div>
	</div>
</div>


<div class="col-sm-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class="entypo-info"></i> Informasi pelayanan
			</div>
		</div>

		<div class="panel-body">
			<form class="form-horizontal form-data-2">
				<div class="form-group">
					<label class="col-sm-3 control-label">Cara Bayar :</label>
					<div class="col-sm-9">
						<select name="cb" class="form-control cb" id='cb'>
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kelompok :</label>
					<div class="col-sm-9">
						<select name="klp" class="form-control klp">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Ruang / Kelas :</label>
					<div class="col-sm-5">
						<select name="ruang" class="form-control ruang">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="kelas" class="form-control kelas">
							<option value="">-- Pilih--</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Kamar / Bed :</label>
					<div class="col-sm-5">
						<select name="kamar" class="form-control kamar">
							<option value="">-- Pilih--</option>
						</select>
					</div>
					<div class="col-sm-4">
						<select name="bed" class="form-control bed">
							<option value="">-- Pilih--</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-9 col-sm-offset-3">
						<button type="button" class="btn btn-blue btn-simpan-perubahan btn-icon icon-left"><i class='entypo-shareable'></i> Simpan perubahan</button>
						<button type="button" class="btn btn-blue btn-pindah-ruangan btn-icon icon-left"><i class='entypo-export'></i> Pindah ruangan</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<div class="col-sm-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title bold">
				<i class='fa fa-balance-scale'></i> Penata jasa pelayanan
			</div> 
		</div>
		<div class="panel-body">
			<div class="row">
				<form class="form-horizontal form_penata_jasa">
				<input type="hidden" name="stt_form_tindakan" value="" id='stt_form_tindakan'>
				<input type="hidden" name="i_kelas_fpj" id="i_kelas_fpj" value="">
				<input type="hidden" name="i_tgldaftar_fpj" id="i_tgldaftar_fpj" value="">
				<input type="hidden" name="i_tarif_normal" id="i_tarif_normal" value="">
				<input type="hidden" name="i_tarif_group" id="i_tarif_group" value="">
				<div class="col-sm-7">
						
						<div class="form-group">
							<label class="control-label col-sm-3 bold">Tgl Tindakan : </label>
							<div class="col-sm-9">
								<input type="text" class="form-control datepicker tgl_tindakan" name="tgl_tindakan" id="tgl_tindakan" data-format="dd-mm-yyyy" value="<?php echo tgl_biasa(date("d-m-Y"))?>">
								
							</div>
							
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3 bold">Kode : </label>
							<div class="col-sm-9">
								<input type="text" name="kode" class="form-control kode" placeholder="Kode tindakan...">
							</div>
							
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3 bold">Nama tindakan : </label>
							<div class="col-sm-9">
								<input type="text" name="tindakan" class="form-control tindakan" placeholder="Nama tindakan...">
							</div>
							
						</div>
					
				</div>
				<div class="col-sm-5">
					<div class="form-group">
						<label class="control-label col-sm-3 bold">Dokter : </label>
						<div class="col-sm-9">
							<input type="hidden" class="dokter_vis form-control" id='dokter_vis' name="dokter_vis"/>
						</div>
							
					</div>


					<div class="form-group">
						<label class="control-label col-sm-3 bold">Tarif : </label>
						<div class="col-sm-9">
							<input type="text" name="tarif" class="form-control tarif" placeholder="Rp...">
						</div>
							
					</div>

					<div class="form-group">
						<label class="control-label col-sm-3 bold">qty : </label>
						<div class="col-sm-9">
							<input type="text" name="qty" class="form-control qty" placeholder="qty">
						</div>
							
					</div>

				</div>
				</form>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered tabel_tindakan_jasa">
						<thead>
							<tr>
								<th width="30"></th>
								<th>TGL</th>
								<th>KODE</th>
								<th>TINDAKAN</th>
								<th>DOK</th>
								<th>@</th>
								<th>TARIF</th>
								<th>TOTAL</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
					<div class="well well-sm">
		                <div class="row">
		                	<div class="col-sm-9">
		                		<h3 class="bold">Sub total <div class="pull-right">:</div></h3><br>
		                	</div>
		                	<div class="col-sm-3">
		                		<h3 class="bold total">Rp. 0,00</h3>
		                	</div>
		                </div>
		            </div>
		        </div>
			</div>
		</div>
	</div>


</div>


<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>

<script type="text/javascript">
	

	$(".norek").keypress(function(e){
		if(e.which==13)
		{
			loading_show();
			var norek=$(this).val()
			if(norek=='')
			{
				toastr.warning('Masukkan Nomor rekam medis dulu.');
				loading_hide();
			}
			else
			{
				$.ajax({
					type:'post',
					url:base_url+'e-ranap/penatajasa_api/get_info_kunjungan',
					data:'norek='+norek,
					dataType:'json',
					error:function()
					{
						swal({
							title:'Koneksi terputus',
							text:'gagal terhubung ke server mengambil informasi tindakan, periksa jaringan anda dan coba kembali.',
							imageUrl:base_url+'template/assets/img/diskonek.png',
						})
						loading_hide();
					},
					success:function(json)
					{
						if(json.success)
						{
							$("#i_norek").val(json.i_p.norek)
							$("#i_nokunjungan").val(json.i_p.no_kunjungan)
							$("#i_id").val(json.i_p.id)
							$(".nokunjungan").val(json.i_p.no_kunjungan).prop("disabled",true);
							$(".nama").val(json.i_p.nama).prop("disabled",true);
							$(".jk").val(json.i_p.jk).prop('disabled',true);
							$(".alamat").val(json.i_p.alamat).prop('disabled',true)			

							// append carabaray
							$(".cb").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_cb,function(index, data){
								$(".cb").append("<option value='"+data.id_carabayar+"'>"+data.nama_carabayar+"</option>")
							})

							$(".cb").val(json.i_p.cb)
							// end

							// append kelompok peserta
							$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_klp, function(i,d){
								$(".klp").append("<option value='"+d.id_kelompok+"'>"+d.nama_kelompok+"</option>")
							})
							$(".klp").val(json.i_p.klp)
							// end

							// append ruangan
							$(".ruang").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_r,function(i,d){
								$(".ruang").append("<option value='"+d.id_ruangan+"'>"+d.nama_ruangan+"</option>")
							})
							$(".ruang").val(json.i_p.ruang)
							// end


							// append kelas
							$(".kelas").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_kls,function(i,d){
								$(".kelas").append("<option value='"+d.id_kelasperawatan+"'>"+d.nama_kelasperawatan+"</option>")
							})
							$(".kelas").val(json.i_p.kelas)
							// end


							// append kamar
							$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_kmr,function(i,d){
								$(".kamar").append("<option value='"+d.id_kamar+"'>"+d.nama_kamar+"</option>")
							})
							$(".kamar").val(json.i_p.kamar);
							// end

							// append bed
							$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							$.each(json.i_bed,function(i,d){
								$(".bed").append("<option value='"+d.id_bed+"'>"+d.nomor_bed+"</option>")
							})
							$(".bed").val(json.i_p.bed)
							// end


							// append informasi ke form_penata_jasa

							$("#i_kelas_fpj").val(json.i_p.kelas);
							$("#i_tgldaftar_fpj").val(json.i_p.tgldaftar)
							loading_hide();
							loading_data_jasa();
						}
						else
						{
							swal("Tidak ditemukan",'data kunjungan tidak ditemukan pada ruangan ini.',"error");
							$("#i_norek").val('')
							$("#i_nokunjungan").val('')
							$("#i_id").val('')
							$(".nokunjungan").val('').prop("disabled",false);
							$(".nama").val('').prop("disabled",false);
							$(".jk").val('').prop('disabled',false);
							$(".alamat").val('').prop('disabled',false)			

							// append carabaray
							$(".cb").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append kelompok peserta
							$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append ruangan
							$(".ruang").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end


							// append kelas
							$(".kelas").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end


							// append kamar
							$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							// append bed
							$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
							// end

							$("#i_kelas_fpj").val('');
							$("#i_tgldaftar_fpj").val('')

							loading_hide();
						}
					}
				})
			}
		}


	})

	$(".btn-simpan-perubahan").click(function(){
		loading_show();
		var $this=$(this);
		if($("#i_nokunjungan").val()=='' && $("#i_norek").val()=='')
		{
			toastr.warning("Cari kunjungan terlebih dahulu.");
			loading_hide();
		}
		else
		{
			$this.html("<i class='entypo-shareable'></i> Menyimpan perubahan...").prop('disabled',true);
			$(".btn-pindah-ruangan").prop('disabled',true);
			$.ajax({
				type:'post',
				url:base_url+'e-ranap/penatajasa_api/ubah_ruangan',
				data:$(".form-data-1").serialize()+'&'+$('.form-data-2').serialize(),
				dataType:'json',
				success:function(json)
				{
					if(json.success)
					{
						loading_hide();
						swal({
							title:'Berhasil',
							text:'perubahan pada pelayanan kunjungan berhasil direkam dan disimpan.',
							type:'success'
						},function(){
							window.location.href=base_url+'e-ranap/penatajasa'
						})
					}
					else
					{
						loading_hide();
						$(".btn-pindah-ruangan").prop('disabled',false);
						$this.html("Simpan perubahan").prop('disabled',false);
						// alert('Gagal pindah ruangan, coba lagi.');
						// $(".btn-pindah-ruangan").prop('disabled',false);
						// $this.html("Simpan perubahan").prop('disabled',false);
						$.each(json.message,function(i, val){
							var el=$("."+i);
							el.closest('div.form-group')
							.removeClass('has-error')
							.addClass(val.length > 0 ?'has-error':'has-success')
							$("."+i).nextAll().remove();
							$("."+i).after(val)
						})
						swal({
							title:'Gagal',
							text:'Data ubah kamar belum lengkap, periksa dan coba lagi.',
							type:'error'
						})

					}
				}
			})
		}
	})

	$(".btn-pindah-ruangan").click(function(){
		var $this=$(this);
		if($("#i_nokunjungan").val()=='' && $("#i_norek").val()=='')
		{
			toastr.warning("Cari kunjungan terlebih dahulu.")
		}
		else
		{
			window.location.href=base_url+'e-ranap/penatajasa/pindahruangan/'+$("#i_id").val()+'/'+$("#i_nokunjungan").val();
		}
	})

	$(".cb").change(function(){
		loading_show();
		var cb=$(this).val();
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_kelompok',
			data:'cb='+cb,
			dataType:'json',
			success:function(json)
			{
				loading_hide();
				$(".klp").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".klp").append("<option value='"+d.id_kelompok+"'>"+d.nama_kelompok+"</option>")
				})
			}
		})
	})

	$(".kelas").change(function(){
		loading_show();
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_kmr',
			data:'ruang='+$(".ruang").val()+'&kelas='+$(".kelas").val(),
			dataType:'json',
			success:function(json)
			{
				loading_hide();
				$(".kamar").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".kamar").append("<option value='"+d.id_kamar+"'>"+d.nama_kamar+"</option>")
				})
			}
		})
	})

	$(".kamar").change(function(){
		loading_show();
		$.ajax({
			type:'post',
			url:base_url+'e-ranap/penatajasa_api/get_i_bed',
			data:'kamar='+$(".kamar").val(),
			dataType:'json',
			success:function(json)
			{
				loading_hide();
				$(".bed").find('option').remove().end().append("<option value=''>-- Pilih --</option>");
				$.each(json,function(i, d){
					$(".bed").append("<option value='"+d.id_bed+"'>"+d.nomor_bed+"</option>")
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
    $(".kode").keypress(function(e)
    {
    	var $this=$(this);

		if(e.which==13)
		{
			if($("#i_nokunjungan").val()=='' && $("#i_norek").val()=='')
			{
				toastr.warning("Cari kunjungan terlebih dahulu.")
			}
			else if($this.val() =='')
			{
				toastr.warning('Kode tindakan kosong !')
			}
			else
			{
				loading_show();
				$.ajax({
					type:'post',
					url:base_url+'e-ranap/penatajasa_api/get_tindakan',
					data:$(".form_penata_jasa").serialize(),
					dataType:'json',
					error:function()
					{
						loading_hide();
						swal({
							title:'Koneksi terputus !',
							text:'koneksi ke server terputus, periksa jaringan lalu coba kembali.',
							imageUrl:base_url+'template/assets/img/diskonek.png'
						})
					},
					success:function(json)
					{
						if(json.success)
						{
							if(json.t_group=='vis_u')
							{
								$(".tindakan").val(json.n_tindakan);
								$(".tarif").val(json.tarif)
								$(".qty").val('1');
								$("#i_tarif_normal").val(json.tarif_normal);
								$("#stt_form_tindakan").val('complete');
								$("#i_tarif_group").val(json.t_group)
								select2_dokter_vis('Umum')
							}
							else if(json.t_group=='vis_s')
							{
								$(".tindakan").val(json.n_tindakan);
								$(".tarif").val(json.tarif)
								$(".qty").val('1');
								$("#i_tarif_normal").val(json.tarif_normal);
								$("#stt_form_tindakan").val('complete');
								$("#i_tarif_group").val(json.t_group)
								select2_dokter_vis('Spesialis');
							}
							else
							{
								$(".tindakan").val(json.n_tindakan);
								$(".tarif").val(json.tarif)
								$(".qty").val('1').focus();
								$("#i_tarif_normal").val(json.tarif_normal);
								$("#stt_form_tindakan").val('complete');
								$("#i_tarif_group").val(json.t_group)
								$(".dokter_vis").show();
							}
						}
						else
						{
							toastr.warning('Kode tindakan tidak dikenal')
							$this.val("").focus();
							$(".tindakan").val('');
							$(".tarif").val('');
							$(".qty").val('');
							$("#i_tarif_normal").val('');
							$("#stt_form_tindakan").val('');

						}
						loading_hide();
						
					}
				})
			}
		}
    })
    $(".qty").keypress(function(e)
    {
    	var $this=$(this);
    	if(e.which==13)
    	{
    		if($this.val()=='')
    		{
    			toastr.error('Isi quantity tindakan.');
    		}
    		else
    		{
    			if($("#stt_form_tindakan").val()=='complete')
	    		{
	    			if($("#i_tarif_group").val()=='vis_s' || $("#i_tarif_group").val()=='vis_u')
    				{
    					if($("#dokter_vis").val()=='')
    					{
    						toastr.warning('Pilih dokter yang melakukan visit')
    					}
    					else
    					{
    						insert_tindakan();
    					}
    				}
    				else
    				{
    					insert_tindakan();
    				}
	    		}
	    		else
	    		{
	    			toastr.warning('Cari tarif dulu.')
	    		}
    		}
    		
    	}
    })


    function insert_tindakan()
    {
    	$.ajax({
    		type:'post',
    		url:base_url+'e-ranap/penatajasa_api/insert_tindakan',
    		data:$(".form_penata_jasa").serialize()+'&id='+$("#i_id").val(),
    		dataType:'json',
    		success:function(json)
    		{
    			if(json.success)
    			{
    				loading_data_jasa();
    				$('.form_penata_jasa').trigger('reset');
    				$(".kode").val('').focus();
    				$("#dokter_vis").val('')
    			}
    			else
    			{
    				toastr.error(jsone.pesan_err)
    			}
    		}
    	})
    }

    function loading_data_jasa()
    {
    	loading_show();
    	var ID=$("#i_id").val();
    	$.ajax({
    		type:'post',
    		url:base_url+'e-ranap/penatajasa_api/get_data_tindakan_jasa',
    		data:'id='+ID,
    		dataType:'json',
    		success:function(json)
    		{
    			$(".tabel_tindakan_jasa tbody").empty();
    			$.each(json.data,function(i,v){
    				$(".tabel_tindakan_jasa tbody").append("<tr id="+v['id']+">"+
                		"<td><a href='javascript:hapus(\""+v['id']+"\")' class='btn btn-xs btn-red btn-flat'>hapus</a></td>"+
                		"<td>"+v['tgl']+"</td>"+
                		"<td>"+v['kode']+"</td>"+
                		"<td>"+v['tindakan']+"</td>"+
                		"<td>"+v['dokter']+"</td>"+
                		"<td>"+v['qty']+"</td>"+
                		"<td>"+v['tarif']+"</td>"+
                		"<td>"+v['total']+"</td>"+
                	"</tr>")
    			})
    			$(".total").html(json.total.total);
    			loading_hide();

    		}
    	})
    }

    function select2_dokter_vis(J_dok)
    {
    	$(".dokter_vis").select2({
    		minimumInputLength: 1,
            ajax: {
                url: base_url+'e-ranap/penatajasa_api/search_dokter',
                type:'GET',
                dataType: 'json',
                delay: 50,
                data: function (query) {
                    return {
                        q: query,
                        jenis:J_dok
                    };
                },
                results: function (data) {
                    var parsed = [];
                    try {
                        parsed = _.chain(data.data)
                        .map(function (item, index) {
                            return {
                              id: item.id,
                              text: item.slug
                            };
                        })
                        .value();
                    } catch (e) { }
                    return {
	                    results: parsed
                    };
                },
                cache: true
            }
    	})
    }


    function hapus(ID)
    {
    	loading_show()
    	$.ajax({
    		type:'post',
    		url:base_url+'e-ranap/penatajasa_api/hapus_tindakan',
    		data:'id='+ID,
    		success:function()
    		{
    			loading_hide();
    			loading_data_jasa();
    		}
    	})
    }
</script>