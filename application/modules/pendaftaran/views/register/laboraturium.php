
<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title bold">
			<i class="entypo-bookmarks"></i> FORM REGISTRASI KUNJUNGAN LABORATURIUM
		</div>
		<div class="panel-options">
			<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
	        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
	        <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
		</div>
	</div>

	<div class="panel-body">
	<form class="form-horizontal">
		<div class="row">
    		<div class="col-sm-7">
    			<div class="form-group">
    				<label class="control-label col-sm-3">Nomor Rekam Medis</label>
    				<div class="col-sm-9">
    					<input type="text" name="norek" class="form-control norek" autofocus="" placeholder="Nomor rekam medis pasien...">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Metode Pembayaran</label>
    				<div class="col-sm-9">
    					<select name="cb" class="form-control cb">
    						<option value=''>- Pilih -</option>
    						<?php 
    						foreach ($cb->result() as $c) {
    							# code...
    							echo "<option value='".$c->id_carabayar."'>".$c->nama_carabayar."</option>";
    						}
    						?>
    					</select>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Kelompok Peserta</label>
    				<div class="col-sm-9">
    					<select name="klp" class="form-control klp">
    					<option value=''>- Pilih -</option>
    					</select>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Kelas Perawatan</label>
    				<div class="col-sm-9">
    					<select name="kelas" class="form-control">
    						<?php 
    						foreach ($kelas->result() as $k) {
    							# code...
    							echo "<option value='".$k->id_kelasperawatan."'>Kelas ".$k->nama_kelasperawatan."</option>";
    						}
    						?>
    					</select>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Tgl dan Jam Daftar</label>
    				<div class="col-sm-5">
    					<div class="input-group">
    						<div class="input-group-addon">
	                            <a href="#"><i class="entypo-calendar"></i></a>
	                        </div>
	                        <input type="text" class="form-control datepicker" name="tgl_daftar" id="tgl_daftar" data-format="dd-mm-yyyy" value="<?php echo tgl_biasa(date("d-m-Y"))?>">
	                        
                        </div>
    				</div>
    				<div class="col-sm-4">
    					<div class="input-group">
    						<div class="input-group-addon">
								<a href="#"><i class="entypo-clock"></i></a>
							</div>
							<input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_daftar" name="jam_daftar" />			
						</div>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Cara Rujuk </label>
    				<div class="col-sm-9">
    					<select class="form-control input-sm" name="cr" id="cr">
    						<?php 
    						foreach($cara_rujuk->result() as $c_r)
    						{
    							echo"<option value='".$c_r->id_cararujuk."'>".$c_r->nama_cararujuk."</option>";
    						}
    						?>
    					</select>
    				</div>
    			</div>


    			<div class="form-group">
    				<label class="control-label col-sm-3">Asal Rujukan </label>
    				<div class="col-sm-9">
    					<input type="text" name="asal" class="form-control">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Nomor Rujukan </label>
    				<div class="col-sm-9">
    					<input type="text" name="norujuk" class="form-control">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Tgl dan Jam Rujukan </label>
    				<div class="col-sm-5">
    					<div class="input-group">
    						<div class="input-group-addon">
	                            <a href="#"><i class="entypo-calendar"></i></a>
	                        </div>
	                        <input type="text" class="form-control datepicker" name="tgl_rujuk" id="tgl_rujuk" data-format="dd-mm-yyyy" value="<?php echo tgl_biasa(date("d-m-Y"))?>">
	                        
                        </div>
    				</div>
    				<div class="col-sm-4">
    					<div class="input-group">
    						<div class="input-group-addon">
								<a href="#"><i class="entypo-clock"></i></a>
							</div>
							<input type="text" class="form-control timepicker" data-template="dropdown" data-show-seconds="true" data-default-time="<?php echo date("H:i:s")?>" data-show-meridian="false" data-minute-step="5" data-second-step="5"  id="jam_rujuk" name="jam_rujuk" />			
						</div>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">PPK Rujukan  </label>
    				<div class="col-sm-9">
    					<input type="text" name="ppk" class="form-control">
    				</div>
    			</div>

    			
    			<div class="form-group">
    				<label class="control-label col-sm-3">Jenis Pasien </label>
    				<div class="col-sm-9">
    					<input type="radio" value="Pasien Baru" name="j_p"  /> Pasien Baru
    					<input type="radio" value="Pasien Lama" name="j_p" checked="" /> Pasien Lama
    				</div>
    			</div>

    			
    			<div class="form-group">
    				<label class="control-label col-sm-3">Deposito </label>
    				<div class="col-sm-9">
    					<input type="text" name="deposit" class="form-control" placeholder="Rp...">
    				</div>
    			</div>

    			<div class="form-group">
    				<div class="col-sm-9 col-sm-offset-3">
    					<p class="">
	    					<button class="btn btn-success btn-register" type="button">Register kunjungan</button>
	    					<button class="btn btn-info btn-kembali" type="button">Kembali</button>
    					</p>
    				</div>
    			</div>

    		</div>

    		<div class="col-sm-5">
    			<div class="profile">
    			<div class="col-sm-3 col-sm-offset-4">
    				<img src="<?php echo base_url() ?>template/neon/images/avatar5.png" alt="" class="img-circle" width="100">
    			</div>
    			<div class="row col-sm-12">
    				<h6 class="bold"><i class='entypo-user'></i> BIODATA PASIEN</h6>
    			</div>
    			
    			<table class="table table-condesed">
    				<tr>
    					<th width="120">Nama Lengkap</th> 
    					<th>:</th>
    					<th class="nama"></th>
    				</tr>

    				<tr>
    					<th>Nomor NIK</th> 
    					<th>:</th>
    					<th class="nik"></th>
    				</tr>

    				<tr>
    					<th>Nomor Asuransi</th> 
    					<th>:</th>
    					<th class="as"></th>
    				</tr>

    				<tr>
    					<th>Jenis Kelamin</th> 
    					<th>:</th>
    					<th class="jkel"></th>
    				</tr>

    				<tr>
    					<th>Jenis Pasien</th> 
    					<th>:</th>
    					<th class="jnis"></th>
    				</tr>

    				<tr>
    					<th>Alamat</th> 
    					<th>:</th>
    					<th class="alamat"></th>
    				</tr>


    			</table>

    			<div class="bs-callout bs-callout-info nomargin-top nomargin-bottom">
    				<h4>Perhatian : </h4>
    				<p>Sebelum melakukan register masukkan nomor rekam medis lalu tekan enter, perhatikan data biodata pasien pastikan data-data tersebut benar.</p>
    				<ul>
    					<li><span class="bold">Deposito</span> diisi apila pasien melakukan deposit pembayaran.</li>
    				</ul>
    			</div>
    			</div>
    		</div>
    	</div>
    </form>
	</div>

</div>

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
	$(".norek").keypress(function(e){
        if(e.which=='13')
        {
            var data=$(this).val();
            loading('show')
            $.ajax({
                type:'post',
                url:base_url+'pendaftaran/register_api/cek_nrm',
                data:'nrm='+data,
                dataType:'json',
                error:function()
                {
                    toastr.error('Gagal mengambil informasi pasien dari server.');
                    loading('hide');
                },
                success:function(json)
                {
                    loading('hide');
                    if(json.success)
                    {
                        $(".nama").html(json.data.nama)
                        $(".nik").html(json.data.nik)
                        $(".as").html(json.data.asuransi)
                        $(".jkel").html(json.data.jk)
                        // $(".jnis").html(json.data.alamat)
                        $(".alamat").html(json.data.alamat)
                    }
                    else
                    {
                        $(".norek").val('').focus();
                        toastr.error(json.pesan_err)
                    }
                }
            })

        }
    })
    function loading(ket)
    {
        var $this=$(".panel");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass('reloading');
        }
        else
        {
            unblockUI($this);
            $this.removeClass('reloading');
        }
    }

    $(".cb").change(function(){
        loading('show');
        var cb=$(this).val();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/register_api/get_klp',
            data:'cb='+cb,
            error:function(xhr, desc, err)
            {
                alert('Gagal mengambil kelompok perserta dari server.')
                loading('show')
            },
            success:function(html)
            {
                $(".klp").html(html).focus();
                loading('hide');
            }
        })
    })

    $('.btn-kembali').click(function(){
    	window.location.href=base_url+'pendaftaran/home';
    })
</script>