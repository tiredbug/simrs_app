<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-search"></i> Filter Data Yang Ditampilkan
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg" title="Klik disini untuk input data master obat lebih banyak lagi."><i class="entypo-plus"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>

    <div class="panel-body ">
        <form class="form-horizontal">
        <div class="well well-sm no-margin nopadding">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Expired dalam</label>
                        <div class="col-sm-8">
                            <select class="form-control input-sm" name='expired' id="expired">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 12+1; $i++) { 
                                    # code...
                                    $i=$i<10?''.$i:$i;
                                    echo"<option value='".$i."'>".$i." Bulan lagi</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Bulan Expired</label>
                        <div class="col-sm-5 nopadding-right">
                            <select class="form-control input-sm" name="bln" id="bln">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 12+1; $i++) 
                                { 
                                # code...
                                    $i=$i<10?'0'.$i:$i;
                                    echo"<option value='".$i."'";
                                    echo">".bln($i)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3 " >
                            <select name="tahun" id="tahun" class="form-control input-sm">
                                <option value="">Pilih</option>
                                <?php 
                                $thn=date("Y");
                                for ($i=$thn; $i <= $thn+4; $i++) { 
                                    # code...
                                    echo"<option value='".$i."'>".$i."</option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-calendar"></i> Expired Kontrol
        </div>
    </div>

    <div class="panel-body body-form-gue">
        <table class="table table-bordered table-hover table_stok" style="width: 100%">
            <thead>
                <tr>
                    <th width='20' class="text-center" ></th>
                    <th>KODE-BARANG</th>
                    <th>NOTA MASUK</th>
                    <th>TGL TRANSAKSI</th>
                    <th>SUPPLIER-FAKTUR</th>
                    <th>EXPIRED</th>
                </tr>
            </thead>
        </table>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        data_tabel();
    })

    function data_tabel()
    {
        $(".table_stok").DataTable({
            "ordering":false,
            "searching":false,
            "bLengthChange":false,
            "processing":true,
            "serverSide":true,
            "ajax":
            {
                type:"post",
                url:base_url+'gudangobat/kontrol_api/get_data_expired',
                data:function(filter)
                {
                    filter.expired=$("#expired").val();
                    filter.bln=$("#bln").val();
                    filter.tahun=$("#tahun").val();
                }
            }
        })
    }
    function refresh_tabel()
    {
        $(".table_stok").DataTable().ajax.reload();
    }
    $("#expired").change(function(){
        refresh_tabel();
    })
    $("#bln").change(function(){
        refresh_tabel();
    })
    $("#tahun").change(function(){
        refresh_tabel();
    })
</script>