<?php if(! defined("BASEPATH")) exit ("No direct script access allowed");?>
<div class="panel panel-primary konten ">
	<div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-user-add"></i> FORM REGISTRASI PASIEN IGD
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>


    <div class="panel-body">
        <form class="form-horizontal form-data">
    	
    	
    	<div class="row">
    		<div class="col-sm-7">
                <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI KUNJUNGAN</h6>
                <br>
    			<div class="form-group">
    				<label class="control-label col-sm-3">Nomor Rekam Medis</label>
    				<div class="col-sm-9">
    					<input type="text" name="norek" class="form-control norek" autofocus="" placeholder="Nomor rekam medis pasien...">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Metode Pembayaran</label>
    				<div class="col-sm-9">
    					<select name="cb" class="form-control">
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
    					<select name="klp" class="form-control">
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
    				<label class="control-label col-sm-3">Diagnosa </label>
    				<div class="col-sm-9">
    					<input type="text" name="diagnosa" class="form-control">
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
    				<label class="control-label col-sm-3">Nama Dokter </label>
    				<div class="col-sm-9">
    					<select class="form-control input-sm" name="cr" id="cr">
    						<!-- <?php 
    						foreach($cara_rujuk->result() as $c_r)
    						{
    							echo"<option value='".$c_r->id_cararujuk."'>".$c_r->nama_cararujuk."</option>";
    						}
    						?> -->
    					</select>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="control-label col-sm-3">Deposito </label>
    				<div class="col-sm-9">
    					<input type="text" name="deposit" class="form-control" placeholder="Rp...">
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
    	<div class="row">
    		<div class="col-sm-7">
    			<h6 class="bold"><i class='entypo-sweden'></i> INFORMASI PENANGGUNG JAWAB</h6>
                <br>
    			<div class="form-group">
    				<label class="col-sm-3 control-label">Nama Lengkap</label>
    				<div class="col-sm-9">
    					<input type="text" name="nama_p" class="form-control" placeholder="Nama penanggung jawab...">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="col-sm-3 control-label">Hubungan Keluarga</label>
    				<div class="col-sm-9">
    					<select class="form-control input-sm" name="hub_k" id="hub_k">
    						<?php 
                            foreach ($hub->result() as $h) {
                                # code...
                                echo"<option value='".$h->id."'>".$h->hubungan."</option>";
                            }
                            ?>
    					</select>
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="col-sm-3 control-label">No. HP</label>
    				<div class="col-sm-9">
    					<input type="text" name="hp_p" class="form-control" placeholder="Nomor handphone...">
    				</div>
    			</div>

    			<div class="form-group">
    				<label class="col-sm-3 control-label">Alamat Lengkap</label>
    				<div class="col-sm-9">
    					<textarea class="form-control" rows="3" name='alamat_p' placeholder="Ketikkan alamat penanggung jawab..."></textarea>
    				</div>
    			</div>

    			<!-- tombol aksi -->
    			<div class="row">
    				<div class="col-sm-12">
    					<p class="pull-right">
	    					<button type="button" class="btn btn-sm btn-info btn-kembali">Kembali</button>
	    					<button type="button" class="btn btn-sm btn-danger btn-clear">Clear</button>
	    					<button type="button" class="btn btn-sm btn-success btn-reg">Registrasi IGD</button>
    					</p>
    				</div>
    			</div>
    		</div>

    		<div class="col-sm-5">
    			<h6><i class="entypo-help-circled" title="Keterangan informasi"></i></h6>
	    			<div class="bs-callout bs-callout-warning nomargin-top nomargin-bottom">
	    			<p>Masukkan informasi penanggung jawab untuk membantu pihak rekam medis apabila membutuhkan bantuan keluarga dan sebagainya.</p>

    			</div>
    		</div>
    	</div>
    	</form>
    </div>

</div>

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>template/neon/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

	})

	$(".btn-kembali").click(function(){
		window.location.href=base_url+'pendaftaran';
	})
	$(".btn-clear").click(function(){
		$(".form-data").trigger('reset');
	})
	$(".btn-reg").click(function(){
		var e=confirm("Apakah semua data sudah benar, data akan disimpan. Lanjutkan ?");
		if(e)
		{
			var data=$(".form-data").serialize();
			alert(data)
		}
	})

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
                        alert(json.pesan_err);
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

</script>