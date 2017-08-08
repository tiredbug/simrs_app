<div class="panel panel-primary konten">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-layout"></i> Form Input Barang Masuk
        </div>
        <div class="panel-options">
            
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <form class="form-horizontal form-data">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="control-label col-sm-2">No. Transaksi</label>
                        <div class="col-sm-10">
                            <input type="text" name="nota" id="nota"  class="form-control bold" value="<?php echo $this->input->get('nota')==''?'':$this->input->get('nota')?>">
                        </div>
                    </div>

                    <!-- < start form group > -->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="kode-obat" id='kode-obat' class="form-control">
                        </div>
                    </div>
                    <!-- < end form group > -->

                    <!-- < start form group > -->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nomor Batch</label>
                        <div class="col-sm-10">
                            <input type="text" name="nobatch" id='nobatch' class="form-control">
                        </div>
                    </div>
                    <!-- < end form group > -->

                    <!-- < start form group > -->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tgl Expired</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">Tgl
                                </span>
                                <select class="form-control" name="tgl" id="tgl">
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
                        </div>

                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-addon">Bln</span>
                                <select class="form-control " name='bln' id="bln">
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
                        </div>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <span class="input-group-addon">Thn</span>
                                <select name="tahun" id="tahun" class="form-control ">
                                    <?php 
                                    $thn=date("Y");
                                    for ($i=$thn; $i <= $thn+5; $i++) { 
                                        # code...
                                        echo"<option value='".$i."'>".$i."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- < end form group > -->

                    <!-- < start form group > -->
                    <div class="form-group">
                        <label class="control-label col-sm-2">Jumlah</label>
                        <div class="col-sm-5">
                            <input type="text" name="jumlah" id='jumlah' class="form-control">
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <span class="input-group-addon bold">Harga Satuan : Rp. </span>
                                <input type="text" name="harga" id='harga' class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- < end form group > -->                  
                </div>
                <div class="col-sm-4 hidden-xs">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table">
                                <tr>
                                    <td>Nama Barang</td>
                                    <td>:</td>
                                    <td class="nama-barang"></td>
                                </tr>
                                <tr>
                                    <td>Satuan</td>
                                    <td>:</td>
                                    <td class="satuan"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bs-callout bs-callout-info nomargin-top nomargin-bottom">
                                <h4>Penjelasan :</h4>
                                <ul>
                                    <li>Untuk nominal harga satuan tidak perlu pemisah bacaan, tetapi gunakan pemisah <span class="bold">titik(.)</span> untuk nominal mengandung desimal, contoh : 54034,23</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            <div class="row">
                <div class="col-sm-8">
                    <p class="pull-right">
                        <button class="btn btn-info btn-print"><i class='fa fa-print'></i> Print Nota Transaksi</button>
                        <button class="btn btn-success btn-tambah">Tambah</button>
                    </p>
                </div>
            </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <table class="table table-bordered  table-data table-hover" style="width: 100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>KODE</th>
                            <th>NAMA OBAT</th>
                            <th>JUMLAH</th>
                            <th>NO BATCH</th>
                            <th>EXPIRED</th>
                            <th>HARGA</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
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
        tabel_data()
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
                        $(".nama-barang").html(json.data.nama_obat)
                        $(".satuan").html(json.data.satuan_obat)
                        $("#nobatch").focus();
                    }
                    else
                    {
                        toastr.error(json.pesan_err)
                        $("#nama-obat").val('')
                    }
                }
            })
        }
    })
    $("#jumlah").keypress(function(e){
        if(e.which==13)
        {
            $("#harga").focus();
        }
    })
    $("#harga").keypress(function(e){
        if(e.which==13)
        {
            $(".btn-tambah").focus();
        }
    })
    $("#nobatch").keypress(function(e){
        if(e.which==13)
        {
            $("#tgl").focus();
        }
    })
    $("#tgl").change(function(e){
        $("#bln").focus();
    })
    $("#bln").change(function(e){
        $("#tahun").focus();
    })
    $("#tahun").change(function(){
        $("#jumlah").focus()
    })
    $(".btn-tambah").click(function(){
        $(this).html("<i class='fa fa-spinner fa-spin'></i> Menyimpan...")
        var $this=$(this)
        blok_form()
        var form_data=$(".form-data").serialize();
        $.ajax({
            type:"POST",
            url:base_url+'gudangobat/masuk_api/simpan_detail_masuk',
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
            "ajax":
            {
                url:base_url+'gudangobat/masuk_api/get_data_detail_masuk',
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

    $(".btn-print").click(function(){
        var $this=$(this); 
        var nota=$("#nota").val();
        var url=base_url+'gudangobat/masuk_api/cetak?nota='+nota;
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
    $(".table-data").on( 'click', 'tbody td:not(:first-child)', function (e){

    })
</script>