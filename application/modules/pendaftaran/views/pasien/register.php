<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title bold">
            <i class="entypo-user-add"></i> FORM REGISTRASI PASIEN
        </div>
        <!-- end panel titel -->
        <div class="panel-options">
            <a href="#" data-rel="close" class="bg"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body">
    <form class="form-horizontal form-data form-register-pasien">
        <h6 class="bold"><i class='entypo-sweden'></i> IDENTITAS</h6>
        <br>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">No. Medrec :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="norek" id="norek" data-validate="required" autofocus="" placeholder="Nomor rekam medis...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nomor NIK :</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control " name="nik" id="nik" placeholder="Nomor NIK sesuai KTP atau KK...">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn_get_nik_bpjs" type="button"><i class='entypo-shareable'></i>BPJS</button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">No Asuransi :</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control " name="noasuransi" id="noasuransi" placeholder="Nomor kartu asuransi...">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn_get_bpjs_bpjs" type="button"><i class='entypo-shareable'></i>BPJS</button>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Nama Lengkap :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="nama" id="nama" placeholder="Nama lengkap pasien...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Jenis Kelamin :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="jk" id="jk">
                            <option value=''>-- Pilih --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Agama :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="agama" id="agama">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($agama->result() as $ag)
                            {
                                echo"<option value='".$ag->id."'>".$ag->agama."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Tempat Lahir :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control " name="tp_lahir" id="tp_lahir" placeholder="Tempat lahir pasien...">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Tgl Lahir :</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="tgl_lahir" id="tgl_lahir" data-format="dd-mm-yyyy">
                            <div class="input-group-addon">
                                <a href="#"><i class="entypo-calendar"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Pendidikan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pdd" id="pdd">
                            <option value="">-- Pilih --</option>
                            <?php 
                            foreach ($pendidikan->result() as $pdd)
                            {
                                echo"<option value='".$pdd->id_pendidikan."'>".$pdd->nama_pendidikan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Pekerjaan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="pkj" id="pkj">
                            <option value=''>-- Pilih --</option>
                            <?php 
                            foreach ($pekerjaan->result() as $p)
                            {
                                echo"<option value='".$p->id_pekerjaan."'>".$p->nama_pekerjaan."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Status :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="stt" id="stt">
                            <option value=''>-- Pilih --</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Janda">Janda</option>
                            <option value="Duda">Duda</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>


        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI ALAMAT</h6>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Alamat KTP :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="alamatktp" id="alamatktp" placeholder="Alamat sesuai dengan kartu identitas..." />
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Provinsi :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="prov_ktp" id="prov_ktp">
                            <?php 
                            echo"<option value=''>-- Pilih --</option>";
                            foreach($provinsi->result() as $prov_ktp)
                            {
                                echo"<option value='".$prov_ktp->id_provinsi."'>".$prov_ktp->nama_provinsi."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Kabupaten :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kab_ktp" id="kab_ktp">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                </div>

            </div>


            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label col-sm-3">Kecamatan :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="kec_ktp" id="kec_ktp">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Desa :</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="desa_ktp" id="desa_ktp">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>


        <h6 class="bold"><i class='entypo-sweden'></i> INFORMASI LANJUTAN</h6>
        <br>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label class="control-label col-sm-3">No. Hp :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No hp pasien..." />
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Email :</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ketikkan email pasien..." />
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Keluarga :</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_k" id="nama_k" placeholder="Nama suami/istri atau orang tua..." />
                    </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-3">Kontak :</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="nohp_k" id="nohp_k" placeholder="No tlfn atau hp keluarga..." />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="">
                    <p class="pull-right">
                        <button type="button" class="btn btn-primary btn-cancel">Kembali</button>
                        <button type="reset" class="btn btn-danger btn-reset">Bersihkan</button>
                        <button type="button" class="btn btn-info btn-simpan">Register Pasien</button>
                    </p>
                </div>
                               
            </div>
        </div>

    </form>
    </div>

</div>

<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
<script>
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
    $(".form-register-pasien").submit(function(e){
        e.preventDefault();
    })
    
    
    $("#prov_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kab',
            data:'id_provinsi='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kabupaten dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#kab_ktp").html(respon);
            }
        })
    })
    
    $("#kab_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kec',
            data:'id_kab='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kecamatan dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#kec_ktp").html(respon);
            }
        })
    })
    
    $("#kec_ktp").change(function(){
        loading_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_desa',
            data:'id_kec='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kelurahan dari server.');
                loading_hide();
            },
            success:function(respon){
                loading_hide();
                $("#desa_ktp").html(respon);
            }
        })
    })
    
   
    $(".btn-simpan").click(function(e){
        var $this=$(this);
        $this.html("<i class='fa fa-spin fa-spinner'></i> Menyimpan data pasien...")
        var data_registrasi=$(".form-register-pasien").serialize();
        loading_show();
        swal({
            title:"Lanjutkan simpan ?",
            text:"Data pasien akan disimpan, pastikan semua data sudah benar klik tombol setuju apaila sudah benar.",
            type:"warning",
            showCancelButton:true,
            confirmButtonText:"Ya , saya setuju.",
            confirmButtonColor:"#21a9e1",
            closeOnConfirm:false
        },
        function(){
            $.ajax({
                type:"Post",
                url:base_url+'pendaftaran/ajax_api/void_register',
                data:data_registrasi,
                dataType:'json',
                error:function()
                {
                    loading_hide();
                    swal("Gagal terhubung ke server","periksa jaringan LAN atau koneksi jaringan anda dan coba kembali.",'error')
                    $this.html("Register pasien")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        $(".form-group").removeClass('has-error')
                                        .removeClass('has-success')
                        $('.text-danger').remove();
                        swal("Berhasil !",'pasien berhasil didaftarkan kedatabase server.','success')
                        loading_hide();
                        $this.html("Register pasien")
                        $(".form-register-pasien").trigger('reset');
                    }
                    else
                    {
                        $.each(json.message,function(i, val){
                            var elemen=$("#"+i);
                            elemen.closest('div.form-group')
                            .removeClass('has-error')
                            .addClass(val.length > 0 ?'has-error':'has-success')
                            .find('.text-danger').remove();
                            elemen.after(val)
                        })
                        swal("Gagal !",json.pesan_err,'error')
                        loading_hide();
                        $this.html("Register pasien")
                    }

                    
                    
                }
            })
        }
        )
    })

    $(".btn_get_nik_bpjs").click(function(){
        var $this=$(this);
        $this.html("<i class='fa fa-spin fa-spinner'></i> BPJS").prop('disabled',true);
        $.ajax({
            type:'POST',
            url:base_url+'pendaftaran/pasien_api/get_data_peserta_from_server_bpjs',
            data:'by=nik&id='+$("#nik").val(),
            dataType:'json',
            success:function(respon)
            {
                $this.html("<i class='entypo-shareable'></i>BPJS").prop('disabled',false);
                if(respon.metadata.code=='200')
                {
                    swal({
                        title:'Ditemukan',
                        text:'data peserta ditemukan di server bpjs, lanjutkan ?',
                        type:'success'
                    },function(){
                        $("#norek").val(respon.response.peserta.noMr)
                        $("#nik").val(respon.response.peserta.nik)
                        $("#noasuransi").val(respon.response.peserta.noKartu)
                        $("#nama").val(respon.response.peserta.nama)
                        $("#jk").val(respon.response.peserta.sex=='L'?'Laki-Laki':'Perempuan')
                        $("#tgl_lahir").val(parsing_tgl(respon.response.peserta.tglLahir))
                        
                    });
                }
                else
                {
                    swal('Gagal',respon.metadata.message,'error');
                    $("#norek").val('')
                    $("#nik").val('')
                    $("#noasuransi").val('')
                    $("#nama").val('')
                    $("#jk").val('')
                    $("#tgl_lahir").val('')
                }
            }
        })
    })

    $(".btn_get_bpjs_bpjs").click(function(){
        var $this=$(this);
        $this.html("<i class='fa fa-spin fa-spinner'></i> BPJS").prop('disabled',true);
        $.ajax({
            type:'POST',
            url:base_url+'pendaftaran/pasien_api/get_data_peserta_from_server_bpjs',
            data:'by=bpjs&id='+$("#noasuransi").val(),
            dataType:'json',
            success:function(respon)
            {
                $this.html("<i class='entypo-shareable'></i>BPJS").prop('disabled',false);
                if(respon.metadata.code=='200')
                {
                    swal({
                        title:'Ditemukan',
                        text:'data peserta ditemukan di server bpjs, lanjutkan ?',
                        type:'success'
                    },function(){
                        $("#norek").val(respon.response.peserta.noMr)
                        $("#nik").val(respon.response.peserta.nik)
                        $("#noasuransi").val(respon.response.peserta.noKartu)
                        $("#nama").val(respon.response.peserta.nama)
                        $("#jk").val(respon.response.peserta.sex=='L'?'Laki-Laki':'Perempuan')
                        $("#tgl_lahir").val(parsing_tgl(respon.response.peserta.tglLahir))
                    });
                }
                else
                {
                    swal('Gagal',respon.metadata.message,'error')
                    $("#norek").val('')
                    $("#nik").val('')
                    $("#noasuransi").val('')
                    $("#nama").val('')
                    $("#jk").val('')
                    $("#tgl_lahir").val('')
                }
            }
        })
    })

    function parsing_tgl(tgl)
    {
        var pat=/(.*?)\/(.*?)\/(.*?)$/;
        var result=tgl.replace(pat,function(match,p1,p2,p3){
            return (p3)+'-'+(p2)+'-'+(p1);
        })
        return result;
    }
</script>
