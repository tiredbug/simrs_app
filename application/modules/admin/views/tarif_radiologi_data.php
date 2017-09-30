
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
			<a href="#">Tarif</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Radiologi</a>
		</li>
	</ul>
	<div class="page-toolbar">
		
	</div>
</div>


<h3 class="page-title">
	Tarif Pelayanan <small>kelola tindakan &amp; tarif pelayanan radiologi</small>
</h3>

<div class="row">
	<div class="col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-info font-grey-gallery"></i>
					<span class="caption-subject bold font-grey-gallery uppercase">Tarif Pelayanan</span>
					<span class="caption-helper">Instalasi Radiologi</span>
				</div>

				<div class="actions">
					<a href="<?php echo base_url()?>admin/tarif/" class="btn btn-circle green-meadow" >
					<i class="fa fa-angle-double-left"></i> Kembali</a>

					<a href="<?php echo base_url()?>admin/tarif_api/form_input_tindakan_radiologi" class="btn btn-circle green-meadow" title="tambah tindakan pelayanan rawat inap." data-toggle="modal" data-target="#modal_add_tindakan">
					<i class="fa fa-plus-circle"></i> Tindakan </a>

					<a href="<?php echo base_url()?>admin/datamaster/form_input_ruangan" class="btn btn-circle green-meadow" title="tambah ruangan pelayanan rawat inap." data-toggle="modal" data-target="#modal_add_ruangan">
					<i class="fa fa-plus-circle"></i> Group</a>


					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>



			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover" id="data_ruangan_inap">
					<thead>
						<tr>
							<th>Kode Tindakan</th>
							<th>Tindakan</th>
							<th>Kategori</th>
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
<div class="modal fade" id="modal_add_tindakan" role='basic' aria-hidden='true'>
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

		// $("#data_ruangan_inap").dataTable({
		// 	'ordering':false,
		// 	'language':{
		// 		'search':'Nama ruangan : '
		// 	},
		// 	'serverSide':true,
		// 	'processing':true,
		// 	'ajax':{
		// 		type:'post',
		// 		url:base_url+'admin/datamaster_api/get_data_ruangan_inap',
		// 	},
		// 	rowCallback:function(row, data, index)
		// 	{
				
		// 		if(data[2]=='Y')
		// 		{
		// 			$("td:eq(2)",row).html("<span class='label label-sm label-success'>Aktif</span>");
		// 			$("td:eq(3)",row).html(data[3]);
		// 		}
		// 		else
		// 		{

		// 			$("td:eq(2)",row).html("<span class='label label-sm label-danger'>Tidak aktif</span>");
		// 			$("td:eq(3)",row).html("<a href='"+base_url+"admin/datamaster/aktifkankamar/"+data[0]+"' class='btn btn-xs yellow'><i class='icon-pin'></i> Aktif kembali</a>");
		// 		}
		// 	}
		// })
		// $("#data_co_rajal").find('.dataTables_length select').select2();


	})
	var load_tabel_data_ruangan=function()
	{
		$("#data_ruangan_inap").DataTable().ajax.reload();
	}
</script>
