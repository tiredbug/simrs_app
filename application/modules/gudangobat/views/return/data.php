<div class="panel panel-warning konten ">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-search"></i> Filter Data Yang Ditampilkan
        </div>
    </div>

    <div class="panel-body ">
        <form class="form-horizontal">
        <div class="well well-sm no-margin nopadding">
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nomor Transaksi</label>
                        <div class="col-sm-8">
                            <input type="text" name="no_transaksi" class="form-control no_transaksi">
                        </div>
                    </div>
                </div>

                <div class='col-sm-6'>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Tgl Return</label>
                        <div class="col-sm-2 nopadding-right">
                            <select class="form-control " name="tgl" id="tgl">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 31+1; $i++) { 
                                    # code...
                                    $i=$i<10?'0'.$i:$i;
                                    echo"<option value='".$i."'>".$i."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-3 nopadding-right" >
                            <select class="form-control" name='bln' id="bln">
                                <option value="">Pilih</option>
                                <?php 
                                for ($i=1; $i < 12+1; $i++) { 
                                    # code...
                                    $i=$i<10?'0'.$i:$i;
                                    echo"<option value='".$i."'>".bln($i)."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-3 " >
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">Pilih</option>
                                <?php 
                                $thn=date("Y");
                                for ($i=$thn; $i >= $thn-15; $i--) { 
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
            <i class="entypo-docs"></i> Data Nota Transaksi Return Barang
        </div>
    </div>

    <div class="panel-body no-padding">
        <table class="table table-bordered tabel_nota">
            <thead>
                <tr>
                    <th>NO. TRASKASI</th>
                    <th>TGL TRANSAKSI</th>
                    <th>NOTA TERIMA</th>
                    <th>NO. FAKTUR</th>
                    <th>SERAH</th>
                    <th>TERIMA</th>
                    <th width="110" class="text-center">PILIHAN</th>
                </tr>
            </thead>
        </table>
    </div>

</div>


<!-- // tag untuk menampung output nota transaksi -->

<style type="text/css">
    .cetak {
        display: none;
    }
</style>
<div class="cetak ">
</div>

<!-- end -->



<script type="text/javascript">
    $(document).ready(function(){
        data_tabel();
    })

    function data_tabel(){
        $(".tabel_nota").DataTable({
            "ordering":false,
            "searching":false,
            "serverSide":true,
            "processing":true,
            "language":{
                "info"       : "Menampilkan _START_ s/d _END_ baris data dari _TOTAL_ data",
                "infoEmpty"  : "Tidak Ada Data",
                "emptyTable" : "Tidak Ada Data",
                "lengthMenu" : "Tampilkan _MENU_ Baris per laman.",
                "sZeroRecords": "Tidak ada data."
            },
            "ajax":{
                type:"post",
                url:base_url+'gudangobat/returnobat_api/get_data_nota',
                data:function(filter)
                {
                    filter.nota=$(".no_transaksi").val();
                    filter.tgl=$("#tgl").val();
                    filter.bln=$("#bln").val();
                    filter.tahun=$("#tahun").val();
                }
            },
            "rowCallback":function(row, data, index)
            {
                $('td:eq(6)', row).html(
                    "<a href='javascript:edit(\""+data[0]+"\")' class='btn btn-xs btn-info '><i class='fa fa-tags'></i> Detail</a>"
                    +' | '+
                    "<a href='javascript:cetak(\""+data[0]+"\")' class='btn btn-xs btn-danger'><i class='fa fa-print'></i> Print</a>"
                    )
            },

        })
        $('.tabel_nota').closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch:-1
        })
    }

    function refresh_tabel()
    {
        $(".tabel_nota").DataTable().ajax.reload();
    }
    $(".no_transaksi").keyup(function(){
        refresh_tabel();
    })
    $("#tgl").change(function(){
        refresh_tabel();
    })
    $("#bln").change(function()
    {
        refresh_tabel();
    })
    $("#tahun").change(function()
    {
        refresh_tabel();
    })

    function edit(ID)
    {
        window.location.href=base_url+'gudangobat/returnobat/detail?nota='+ID
    }
    function cetak(nota)
    {
        loading("show");
        var url=base_url+'gudangobat/returnobat_api/cetak?nota='+nota;
        $(".cetak").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt=="success")
            {
                loading('hide');
                $("div.cetak").printArea(); 
            }
            else if(statusTxt=='error')
            {
                loading('hide');
                toastr.error("Gagal memuat laporan.");
            }
        })
    }
    function loading(ket)
    {
        var $this=$(".panel");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass('reloading')
        }
        else
        {
            unblockUI($this);
            $this.removeClass('reloading')
        }
    }
</script>