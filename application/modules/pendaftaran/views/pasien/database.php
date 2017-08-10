<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-database"></i> Database Pasien
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg" title="Klik disini untuk input data master obat lebih banyak lagi."><i class="entypo-plus"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form-horizontal">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Medrec</label>
                                <div class="col-sm-9">
                                   <input type="text" name="norec" class="form-control norec">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Nik</label>
                                <div class="col-sm-9">
                                   <input type="text" name="nik" class="form-control nik">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">No. Asuransi</label>
                                <div class="col-sm-9">
                                   <input type="text" name="asuransi" class="form-control asuransi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                   <input type="text" name="nama" class="form-control nama">
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Provinsi</label>
                                <div class="col-sm-9">
                                   <select name="prov" class="form-control prov">
                                   <option value="">Provinsi</option>
                                    <?php 
                                        foreach ($prov->result() as $p) {
                                            # code...
                                            echo "<option value='".$p->id_provinsi."'>".$p->nama_provinsi."</option>";
                                        }
                                    ?>
                                   </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kabupaten</label>
                                <div class="col-sm-9">
                                   <select name="kab" class="form-control kab">
                                   </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kecamatan</label>
                                <div class="col-sm-9">
                                   <select name="kec" class="form-control kec">
                                   </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Desa</label>
                                <div class="col-sm-9">
                                   <select name="desa" class="form-control desa">
                                   </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered datatable table-hover" id="table-3" style="width: 100%">
                    <thead>
                    <tr class="replace-inputs">
                            <th>No.Medrec</th>
                            <th>No.Nik</th>
                            <th>No. Asuransi</th>
                            <th>Nama Lengkap</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th></th>
                    </tr>
                    </thead>
                    <tbody>    
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

</div>
<div class="modal invert fade" id="modal_profile">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title bold"><i class="entypo-sweden"></i> INFORMASI LENGKAP DATA PASIEN </h4>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="row">
                                <img src="<?php echo base_url().'template/assets/img/user-icon.png'?>" >
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-block btn-primary"><i class='entypo-pencil'></i> Ubah Data</button>
                                    <button class="btn btn-block btn-orange"><i class='entypo-print'></i> Cetak Kartu</button>
                                    <button class="btn btn-block btn-info"><i class='entypo-cw'></i> Reload Informasi</button>
                                    <button class="btn btn-block btn-success"><i class='entypo-cancel'></i> Tutup Form</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="" class="norek-h">
                        <div class="col-sm-9">
                            <table class="table bold">
                                <tbody>
                                    <tr>
                                        <td>Nomor Medrec</td>
                                        <td width="1">:</td>
                                        <td class="no-rec"></td>
                                    </tr>

                                    <tr>
                                        <td>Nomor NIK</td>
                                        <td>:</td>
                                        <td class="no-nik"></td>
                                    </tr>

                                    <tr>
                                        <td>Nomor Asuransi</td>
                                        <td>:</td>
                                        <td class="no-asuransi"></td>
                                    </tr>

                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td>:</td>
                                        <td class="nama-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Jenis-Kelamin</td>
                                        <td>:</td>
                                        <td class="jk-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Agama</td>
                                        <td>:</td>
                                        <td class="ag-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Tempat dan Tgl Lahir</td>
                                        <td>:</td>
                                        <td class="t-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td class="a-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Keluarahan</td>
                                        <td>:</td>
                                        <td class="k-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td class="kec-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Kabupaten</td>
                                        <td>:</td>
                                        <td class="ka-c"></td>
                                    </tr>

                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td class="prov-c"></td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-info btn-simpan">Perubahan Data</button>
                    <button type="button" class="btn btn-orange btn-cetak">Kartu Berobat</button>
                </div> -->
            </div>
        </div>
    </div>

<script type="text/javascript">
    
    function loadingw_show()
    {
        var $this = $(".well");
        blockUI($this);
        $this.addClass('reloading');
    }
    
    function loadingw_hide()
    {
        var $this = $(".well");
        unblockUI($this)
        $this.removeClass('reloading');
    }


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


    jQuery( document ).ready( function( $ ) {
        hide_sidebar_menu(false)
        var $table3 = jQuery("#table-3");
	
	var table3 = $table3.DataTable( {
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "processing":true,
            "serverSide":true,
            "ordering":false,
            "searching":false,
            "ajax":
            {
                type:'post',
                url:base_url+'pendaftaran/ajax_api/get_databasepasien',
                data:function(filter)
                {
                    filter.norec                    = $(".norec").val(),
                    filter.nik                      = $(".nik").val(),
                    filter.asuransi                 = $(".asuransi").val(),
                    filter.nama                     = $(".nama").val(),
                    filter.prov                     = $(".prov").val(),
                    filter.kab                      = $(".kab").val(),
                    filter.kec                      = $(".kec").val(),
                    filter.desa                     = $(".desa").val()
                }
            },
            "rowCallback":function(row, data, index)
            {
                $('td:eq(8)', row).html(
                    "<a href='javascript:profile(\""+data[0]+"\")'><img src='"+base_url+"/template/assets/img/icon-user.png' title='Lihat informasi lengkap pasien'></a>"
                    )
            }
	} );
        $table3.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
	});

    $(".norec").keyup(function(){
        $table3.DataTable().ajax.reload()
    })
    $(".nik").keyup(function(){
        $table3.DataTable().ajax.reload()
    })
    $(".asuransi").keyup(function(){
        $table3.DataTable().ajax.reload()
    })
    $(".nama").keyup(function(){
        $table3.DataTable().ajax.reload()
    })

    $(".prov").change(function(){
        $table3.DataTable().ajax.reload()
        loadingw_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kab',
            data:'id_provinsi='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kabupaten dari server.');
                loadingw_hide();
            },
            success:function(respon){
                loadingw_hide();
                $(".kab").html(respon);
            }
        })
    })


    $(".kab").change(function(){
        $table3.DataTable().ajax.reload()
        loadingw_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_kec',
            data:'id_kab='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kecamatan dari server.');
                loadingw_hide();
            },
            success:function(respon){
                loadingw_hide();
                $(".kec").html(respon);
            }
        })
    })


    $(".kec").change(function(){
        $table3.DataTable().ajax.reload()
        loadingw_show();
        $.ajax({
            type:"POST",
            url:base_url+'pendaftaran/ajax_api/get_desa',
            data:'id_kec='+$(this).val(),
            error:function(xhr, desc, err){
                alert('Gagal mengambil data kelurahan dari server.');
                loadingw_hide();
            },
            success:function(respon){
                loadingw_hide();
                $(".desa").html(respon);
            }
        })
    })

    $(".desa").change(function(){
        $table3.DataTable().ajax.reload()
    })

    });
    
    function profile(norek)
    {
        $("#modal_profile").modal('show');
        load_profile(norek);
        $('.norek-h').val(norek)
    }

    function load_profile(norek)
    {
        $this=$(".modal-body");
        blockUI($this)
        $this.addClass('reloading');

        $.ajax({
            type:'post',
            url:base_url+'pendaftaran/pasien_api/get_infopasien',
            data:'norek='+norek,
            dataType:'json',
            error:function()
            {
                unblockUI($this)
                $this.removeClass('reloading');
                toastr.error('Gagal mengambil informasi pasien dari server.');
            },
            success:function(json)
            {
                unblockUI($this)
                $this.removeClass('reloading');
                $(".no-rec").html(json.nomor_rekammedis);
                $(".no-nik").html(json.nomor_nik);
                $(".no-asuransi").html(json.nomor_asuransi);
                $(".nama-c").html(json.nama_lengkap);
                $(".jk-c").html(json.jenis_kelamin);
                $(".ag-c").html(json.agama);
                $(".t-c").html(json.tp_lahir+', '+json.tgl_lahir);
                $(".a-c").html(json.alamat_ktp);
                $(".k-c").html(json.nama_kelurahan);
                $(".kec-c").html(json.nama_kecamatan);
                $(".ka-c").html(json.nama_kota);
                $(".prov-c").html(json.nama_provinsi);
            }
        })
    }

    $(".btn-info").click(function(){
        load_profile($(".norek-h").val())
    })
    $(".btn-success").click(function(){
        $("#modal_profile").modal('hide');
    })
    $(".btn-primary").click(function(){
        window.location.href=base_url+'pendaftaran/pasien/edit_pasien?norec='+$(".norek-h").val()
    })
    $(".btn-orange").click(function(){
        var e=confirm("Apakah ingin mencetak kembali kartu berobat pasien ?");
        if(e)
        {
            window.open(base_url+'pendaftaran/pasien/kartu?norek='+$(".norek-h").val(),'_blank');
        }
    })
</script>
