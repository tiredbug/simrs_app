<div class="panel panel-primary">
    <div class="panel-heading">
        <div class="panel-title">
            <i class="entypo-water"></i> Data Master Supplier
        </div>
        <div class="panel-options">
            <a href="#sample-modal" data-toggle="modal" data-target="#modal-supplier" class="bg" title="Klik disini untuk input data master supplier lebih banyak lagi."><i class="entypo-plus"></i></a>
            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
            <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
        </div>
    </div>
    <div class="panel-body no-padding">
        <table class="table table-bordered datatable table-hover tabel_supplier">
            <thead>
                <tr>
                    <th width='10'>NO.</th>
                    <th>SUPPLIER</th>
                    <th width="90" class="text-center">PILIHAN</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
    
    <!-- modal supplier -->
    <div class="modal invert fade" id="modal-supplier">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Form input data master supplier</h4>
                </div>
                
                <div class="modal-body">
                    <form class="form-horizontal form-modal">
                        <input type="hidden" name="method" id="method">
                        <input type="hidden" name="kode" id="kode">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Supplier</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control supplier" name="supplier" autofocus="">
                            </div>
                        </div>
                    </form> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="bs-callout bs-callout-info">
                                <h4>Keterangan :</h4>
                                Supllier adalah perusahaan yang bekerja sama dengan instansi/perusahaan anda, data master ini diperlukan pada pencatatan beberapa proses nantinya.
                                diharapkan untuk menyimpan data yang benar misalnya : <span class="bold text-info">PT. KLIK FARMASI</span>
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info btn-simpan">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function(){
        data_table()
    })

    function data_table()
    {
        $(".tabel_supplier").DataTable({
            "ordering"  : false,
            "processing": true,
            "serverSide": true,
            "ajax"      : base_url+'gudangobat/master_api/get_data_supplier',
            "language":{
                "search"    : "Pencarian"
            }
        })
        $(".tabel_supplier").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
            });
    }
    $(".supplier").keypress(function(e){
        if(e.which==13)
        {
            e.preventDefault();
            proses_data()
        }
    })

        function proses_data()
        {
            loading_show('.form-modal')
            $(".btn-simpan").html("<i class='fa fa-spinner fa-spin'></i> Menyimpan data...")
            var data=$(".form-modal").serialize();
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/master_api/supplier_proses',
                data:data,
                dataType:'json',
                error:function()
                {
                    toastr.error('Gagal terhubung ke server.');
                    loading_hide(".form-modal");
                    $(".btn-simpan").html("Simpan Data")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        toastr.info('Data berhasil disimpan.');
                        $(".form-modal").trigger('reset');
                        $(".supplier").focus();
                        $(".tabel_supplier").DataTable().ajax.reload();
                        if($("#method").val()=='update')
                        {
                            $("#modal-supplier").modal('hide')
                        }
                    }
                    else
                    {
                        toastr.error('Data gagal disimpan.');
                        $(".supplier").focus();
                    }
                    loading_hide(".form-modal")
                    $(".btn-simpan").html("Simpan Data")
                }
            })
        }
        function loading_show(elemen)
        {
            var $this = $(elemen);
            blockUI($this)
            $this.addClass('reloading');
        }

        function loading_hide(elemen)
        {
            var $this = $(elemen);
            unblockUI($this)
            $this.removeClass('reloading');
        }
        $('#modal-supplier').on('hidden.bs.modal', function () {
            // do something…
            $("#method").val('')
        })

        // fungsi tekan tombol simpan data
        $(".btn-simpan").click(function(){
            proses_data()
        })

        // fungsi untuk klik pilihan hapus
        function hapus(kode)
        {
            loading_show(".panel");
            var e=confirm("Hapus data master supplier ini ?");
            if(e)
            {
                $.ajax({
                    type:"POST",
                    url:base_url+'gudangobat/master_api/delete_supplier',
                    data:'kode='+kode,
                    dataType:'json',
                    error:function()
                    {
                        toastr.error('Gagal terhubung ke server.')
                        loading_hide(".panel")
                    },
                    success:function(json)
                    {
                        if(json.success)
                        {
                            $(".tabel_supplier").DataTable().ajax.reload();
                            toastr.info("Data master supplier dihapus.")
                        }
                        else
                        {
                            toastr.error(json.pesan_err)
                        }
                        loading_hide(".panel")
                    }
                })
            }
            else
            {
                loading_hide(".panel")
            }
        }

        // fungsi pilihan edit
        function edit(kode){
            loading_show(".panel");
            $.ajax({
                type:"POST",
                url:base_url+'gudangobat/master_api/get_row_supplier',
                data:'kode='+kode,
                dataType:'json',
                error:function()
                {
                    toastr.error("Gagal terhubung ke server.");
                    loading_hide(".panel")
                },
                success:function(json)
                {
                    if(json.success)
                    {
                        $("#method").val('update');
                        $("#modal-supplier").modal('show')
                        $("#kode").val(json.data.kode)
                        $(".supplier").val(json.data.nama_supplier);
                    }
                    else
                    {
                        toastr.error(json_pesan_err)
                    }
                    loading_hide(".panel");
                }
            })
        }
</script>