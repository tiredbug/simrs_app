<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-upload"></i> Form Input Barang Keluar
        </div>
        <div class="panel-options">
            
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body body-form-gue body-form">
        <form class="form-data">
        <table class="table table-bordered table-form table-hover nomargin-bottom" >
            <tr>
                <th class="label-tabel" style="width: 30%">No. Transaksi</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;" >
                    <div class="col-sm-3 nopadding">
                        <input type="text" name="nota" id="nota"  class="form-control input-sm" style="font-size:12px;font-weight:bold" value="<?php echo $this->input->get('nota')==''?'':$this->input->get('nota')?>" >
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Kode Obat</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;" >
                    <div class="col-sm-3 nopadding">
                        <input type="text" name="kode-obat" id='kode-obat' class="form-control input-sm">
                    </div>
                    <div class="col-sm-9 ">
                        <input type="text" id="nama-obat"  class="form-control input-sm disabled">
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">No. Batch</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;" >
                    <div class="col-sm-5 nopadding">
                        <input type="text" name="nobatch" id='nobatch' class="form-control input-sm">
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Tgl Expired</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;">
                    <div class="col-sm-1 nopadding">
                        <select class="form-control input-sm" name="tgl" id="tgl">
                            <?php 
                            for ($i=1; $i < 31+1; $i++) { 
                                # code...
                                $i=$i<10?'0'.$i:$i;
                                echo"<option value='".$i."'";
                                echo$i==date("d")?'selected':'';
                                echo">".$i."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2 nopadding margin-left" >
                        <select class="form-control input-sm" name='bln' id="bln">
                            <?php 
                            for ($i=1; $i < 12+1; $i++) { 
                                # code...
                                $i=$i<10?'0'.$i:$i;
                                echo"<option value='".$i."'";
                                echo$i==date("m")?'selected':'';
                                echo">".bln($i)."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-2 nopadding margin-left" >
                        <select name="tahun" id="tahun" class="form-control input-sm">
                            <?php 
                            $thn=date("Y");
                            for ($i=$thn; $i >= $thn-2; $i--) { 
                                # code...
                                echo"<option value='".$i."'>".$i."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </th>
            </tr>

            <tr>
                <th class="label-tabel" style="width: 30%">Jumlah Barang</th>
                <th class="label-tabel" width="2">:</th>
                <th style="padding:0px;padding-left: 5px;padding-top: 2px;" >
                    <div class="col-sm-2 nopadding">
                        <input type="text" name="jumlah" id='jumlah' class="form-control input-sm">
                    </div>
                    <div class="col-sm-3 padding-left">
                        <input type="text" name="satuan" id="satuan"  class="form-control input-sm" style="font-size:12px;font-weight:bold"  >
                    </div>
                </th>
            </tr>

        </table>
        </form>
    </div>
    

     <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-water"></i> Data Barang Keluar
        </div>
        <div class="panel-title pull-right" style="padding:2px 5px;">
            <button class="btn btn-info btn-print"><i class='fa fa-print'></i> Print Nota Transaksi</button>
            <button class="btn btn-success btn-tambah">Tambah</button>
        </div>
    </div>


    <div class="panel-body body-form-gue">
        <table class="table table-bordered table-hover table-data" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KODE</th>
                    <th>NAMA OBAT</th>
                    <th>JUMLAH</th>
                    <th>NO BATCH</th>
                    <th>EXPIRED</th>
                    <th width='10px'>HAPUS</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<style type="text/css">
    .cetak {
        display: none;
    }
</style>
<div class="cetak ">
</div>

<script type="text/javascript">
    $(document).ready(function(){
        tabel_data();
        if($("#nota").val().length ==0)
        {
            $("#nota").focus();
        }  
        else
        {
            $("#kode-obat").focus();
        }   
    })

    $("#kode-obat").keypress(function(e)
    {
        var kode=$(this).val();
        if(e.which==13)
        {
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/masuk_api/get_nama_obat',
                data:'kode='+kode,
                dataType:'json',
                error:function()
                {
                    toastr.error("Gagal terhubung ke server.");
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        $("#nama-obat").val(json.data.nama_obat)
                        $("#satuan").val(json.data.satuan_obat)
                        $("#nobatch").focus();
                    }
                    else
                    {
                        toastr.error(json.pesan_err)
                        $("#nama-obat").val('')
                        $("#satuan").val('')
                    }
                }
            })
        }
    })
    $("#nobatch").keypress(function(e){
        if(e.which==13)
        {
            $("#tgl").focus()
        }
    })

    $("#tgl").change(function(){
        $("#bln").focus();
    })

    $("#bln").change(function(){
        $("#tahun").focus();
    })

    $("#tahun").change(function(){
        $("#jumlah").focus();
    })

    $("#jumlah").keypress(function(e){
        if(e.which==13)
        {
            $(".btn-tambah").focus();
        }
    })

    $(".btn-tambah").click(function(){
         $(this).html("<i class='fa fa-spinner fa-spin'></i> Menyimpan...")
        var $this=$(this)
        blok_form()
        var form_data=$(".form-data").serialize();
        $.ajax({
            type:"POST",
            url:base_url+'gudangobat/keluar_api/simpan_detail_keluar',
            data:form_data,
            dataType:'json',
            error:function()
            {
                toastr.error("Gagal terhubung ke server.");
                $this.html("Tambah");
                unblok_form();
            },
            success:function(json)
            {
                if(json.success)
                {
                    // jika sukes add atau menyimpan list detail barang masuk
                    unblok_form();
                    $this.html("Tambah");
                    toastr.info("Berhasil ditambahkan.")
                    var id=$("#nota").val();
                    $(".form-data").trigger('reset');
                    $("#nota").val(id)
                    $("#kode-obat").focus()
                    $(".table-data").DataTable().ajax.reload()
                }
                else
                {
                    toastr.error(json.pesan_err);
                    unblok_form();
                    $this.html("Tambah");
                }
            }
        })
    })

    function blok_form()
    {
        var $this=$(".body-form");
        blockUI($this)
        $this.addClass("reloading")
    }
    function unblok_form()
    {
        var $this=$(".body-form");
        unblockUI($this)
        $this.removeClass("reloading")
    }

    function tabel_data()
    {
        $(".table-data").DataTable({
            "ordering":false,
            "searching":false,
            "bLengthChange": false,
            "bPaginate": false,
            "processing":true,
            "rowCallback": function( row, data, index ) {
                $('td:eq(5)', row).html( "<a href='javascript:hapus(\""+data[0]+"\")' class=' btn btn-xs btn-danger' title='Hapus data'><i class='fa fa-trash'></i> hapus</a>");
            },
            "ajax":
            {
                url:base_url+'gudangobat/keluar_api/get_data_detail_keluar',
                type:"post",
                data:function(filter)
                {
                    filter.nota=$("#nota").val();
                }
            },
            "columnDefs":[
                {
                    "targets":[0],
                    "visible":false
                }
            ]

        })
    }

    $("#nota").keyup(function(e)
    {
       $(".table-data").DataTable().ajax.reload()
       if(e.which==13)
       {
            $("#kode-obat").focus()
       }
    })
    function hapus(ID)
    {
        var e=confirm("Hapus data ?");
        if(e)
        {
            $.post(base_url+'gudangobat/keluar_api/hapus_list_item_keluar',{id:ID},function(data){
                data.success==true ? $(".table-data").DataTable().ajax.reload():toastr.error(data.pesan_err)
            },"json")
        }
    }
    $(".btn-print").click(function(){
        var $this=$(this); 
        var nota=$("#nota").val();
        var url=base_url+'gudangobat/keluar_api/cetak?nota='+nota;
        blok_form();
        $this.html("<i class='fa fa-spin fa-spinner'></i> Membuat nota transaksi...");
        $(".cetak").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt=="success")
            {
                unblok_form();
                $("div.cetak").printArea(); 
                $this.html("Print Nota Transaksi")
            }
            else if(statusTxt=='error')
            {
                toastr.error("Gagal memuat laporan.")
                unblok_form();
                $this.html("Print Nota Transaksi")
            }
        })
    })
</script>