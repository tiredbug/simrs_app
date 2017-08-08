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
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Sisa stok kurang dari </label>
                        <div class="col-sm-1">
                            <input type="text" name="" class="form-control sisa">
                        </div>
                        <label class="control-label col-sm-1">%</label>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-alert"></i> Stok Kontrol
        </div>
    </div>

    <div class="panel-body body-form-gue">
        <table class="table table-bordered table-hover table_stok" style="width: 100%">
            <thead>
                <tr>
                    <th width='20' class="text-center" ></th>
                    <th width='30' class="text-center" >KODE</th>
                    <th>BARANG</th>
                    <th width='40' class="text-center" >MASUK</th>
                    <th width='40' class="text-center" >KELUAR</th>
                    <th width='40' class="text-center" >RETURN</th>
                    <th width='40' class="text-center" >STOK</th>
                    <th width='20' class="text-center" >%</th>
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
                url:base_url+'gudangobat/kontrol_api/get_data_stok',
                data:function(filter)
                {
                    filter.persen=$(".sisa").val();
                }
            }
        })
    }
    $(".sisa").keyup(function(){
        $(".table_stok").DataTable().ajax.reload();
    })
</script>