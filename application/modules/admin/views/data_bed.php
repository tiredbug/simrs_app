
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
			<a href="#">Ruang Rawat Inap</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Kamar</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Bed</a>
		</li>
	</ul>
	<div class="page-toolbar">
		
	</div>
</div>


<h3 class="page-title">
	Data Master <small>kelola &amp; ruangan, kamar dan tempat tidur</small>
</h3>

<div class="row">
	<input type="hidden" name="kamar" id="kamar" value="<?php echo $_GET['kamar']?>">
	<div class="col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-info font-grey-gallery"></i>
					<span class="caption-subject bold font-grey-gallery uppercase"><?php echo $i_k['nama_kamar']?></span>
					<span class="caption-helper">data tempat tidur</span>
				</div>

				<div class="actions">
					<a href="<?php echo base_url()?>admin/datamaster/kamar?ruang=<?php echo $_GET['ruang']?>&kls=<?php echo $_GET['kls']?>" class="btn btn-circle green-meadow" >
					<i class="fa fa-angle-double-left"></i> Kembali </a>
					<a href="<?php echo base_url()?>admin/datamaster/form_input_bed" class="btn btn-circle green-meadow" title="tambah tempat tidur." data-toggle="modal" data-target="#modal_add_bed">
					<i class="fa fa-plus-circle"></i> Bed </a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover" id="data_kamar_bed">
					<thead>
						<tr>
							<th>Id</th>
							<th>No. Bed</th>
							<th>Status</th>
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
<div class="modal fade" id="modal_add_bed" role='basic' aria-hidden='true'>
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

		$("#data_kamar_bed").dataTable({
			'ordering':false,
			'language':{
				'search':'Nomor bed : '
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'admin/datamaster_api/get_data_bed',
				data:function(filter)
				{
					filter.kamar=$("#kamar").val()
				}
			},
			rowCallback:function(row, data, index)
			{
				
				// $("td:eq(3)",row).html("<a href='"+base_url+"admin/datamaster/bed/"+data[3]+"' class='btn btn-xs green'><i class='icon-login'></i> Input tempat tidur</a>");
				if(data[2]=='Y')
				{
					$("td:eq(2)",row).html("<span class='badge badge-success'>tersedia</span>");
				}
				else if(data[2]=='N')
				{
					$("td:eq(2)",row).html("<span class='badge badge-warning'>digunakan</span>");
				}
				else
				{
					$("td:eq(2)",row).html("<span class='badge badge-danger'>tidak diketahui</span>");
				}
			}
		})
		$("#data_kamar_bed").find('.dataTables_length select').select2();


	})
	var load_tabel_data_bed=function()
	{
		$("#data_kamar_bed").DataTable().ajax.reload();
	}
</script>
