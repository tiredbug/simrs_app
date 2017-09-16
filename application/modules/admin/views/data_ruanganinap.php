
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="index.html">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Data Master</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Ruangan Rawat Inap</a>
		</li>
	</ul>
	<div class="page-toolbar">
		
	</div>
</div>


<h3 class="page-title">
	Data Master <small>kelola &amp; ruangan, kamar dan tempat tidur</small>
</h3>

<div class="row">
	<div class="col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-info font-grey-gallery"></i>
					<span class="caption-subject bold font-grey-gallery uppercase">DATABASE</span>
					<span class="caption-helper">ruangan pelayanan rawat inap.</span>
				</div>

				<div class="actions">
					<a href="https://google.com" class="btn btn-circle green-meadow" title="tambah ruangan pelayanan rawat inap." data-toggle="modal" data-target="#modal_add_ruangan">
					<i class="fa fa-plus"></i> Add ruangan </a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>



			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover" id="data_ruangan_inap">
					<thead>
						<tr>
							<th>Kode Ruangan</th>
							<th>Nama Ruangan</th>
							<th>Status</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- modal form input ruagnan -->
<div class="modal fade" id="modal_add_ruangan" role='basic' aria-hidden='true'>
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="moddal-body">
				<img src="<?php echo base_url()?>template/metro/assets/global/img/loading-spinner-grey.gif">
				<span>
					&nbsp;&nbsp;Loading....
				</span>
			</div>
		</div>
	</div>
</div>
<!-- end -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#data_ruangan_inap").dataTable({
			'ordering':false,
			'language':{
				'search':'Nama ruangan : '
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'admin/datamaster_api/get_data_ruangan_inap',
			},
			rowCallback:function(row, data, index)
			{
				
				if(data[2]=='Y')
				{
					$("td:eq(2)",row).html("<span class='label label-sm label-success'>Aktif</span>");
					$("td:eq(3)",row).html("<a href='"+base_url+"admin/datamaster/kamar/"+data[3]+"' class='btn btn-xs green'><i class='icon-login'></i> Input kamar</a>");
				}
				else
				{
					$("td:eq(2)",row).html("<span class='label label-sm label-danger'>Tidak aktif</span>");
					$("td:eq(3)",row).html("<a href='"+base_url+"admin/datamaster/aktifkankamar/"+data[3]+"' class='btn btn-xs yellow'><i class='icon-pin'></i> Aktif kembali</a>");
				}
			}
		})
		$("#data_co_rajal").find('.dataTables_length select').select2();
	})
</script>