<div class="panel panel-primary konten">
	<div class="panel-heading">
		<div class="panel-title">
			<i class="fa fa-database"></i> Database Stok Barang
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel">
					<table class="table table-bordered table-head-center table-stok" width='100%'>
						<thead>
							<tr>
								<th rowspan="2" width='10'>NO</th>
								<th rowspan="2">KODE - BARANG</th>
								<th colspan="4">JUMLAH</th>
							</tr>
							<tr>
								<th>MASUK</th>
								<th>KELUAR</th>
								<th>RETURN</th>
								<th>STOK</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<!-- end rows untuk table data -->

		<div class="row">
			<div class="col-sm-12">
				<div class="well well-sm">
					<div class="row">
						<div class="col-sm-7 col-sm-offset-3">
							<p>
								<button class="btn btn-lg btn-primary btn-cetak"><i class='fa fa-print'></i> Cetak Laporan</button>
								<button class="btn btn-lg btn-orange"><i class='fa fa-file-pdf-o'></i> Download PDF</button>
								<button class="btn btn-lg btn-info"><i class='fa fa-file-excel-o'></i> Download Excel</button>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
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

<script type="text/javascript">
	$(document).ready(function(){
		
		data_tabel();
	})

	function data_tabel()
	{
		$(".table-stok").DataTable({
			"ordering":false,
			"processing":true,
			"serverSide":true,
			"ajax":
			{
				url:base_url+'gudangobat/laporan_api/get_data_stok',
				type:'post'
			}

		})

		$(".table-stok").closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
	}

	$(".btn-cetak").click(function()
    {
    	var $this=$(this);
    	$this.html("<i class='fa fa-spin fa-spinner'></i> Menyiapkan laporan...").prop('disabled',true)
        loading("show");
        var url=base_url+'gudangobat/laporan_api/laporan_obat';
        $(".cetak").load(url, function(responseTxt, statusTxt, xhr){
            if(statusTxt=="success")
            {
                loading('hide');
                $this.html("<i class='fa fa-print'></i> Cetak Laporan").prop('disabled',false)
                $("div.cetak").printArea(); 
            }
            else if(statusTxt=='error')
            {
                loading('hide');
                $this.html("<i class='fa fa-print'></i> Cetak Laporan").prop('disabled',false)
                toastr.error("Gagal memuat laporan.");
            }
        })
    })

    function loading(ket)
    {
        var $this=$(".table-stok");
        if(ket=='show')
        {
            blockUI($this);
            $this.addClass('reloading');
        }
        else
        {
            unblockUI($this);
            $this.removeClass("reloading");
        }
    }
</script>