
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
		</li>
	</ul>
	<div class="page-toolbar">
		
	</div>
</div>


<h3 class="page-title">
	Data Master <small>kelola &amp; ruangan, kamar dan tempat tidur</small>
</h3>

<div class="row">
	<input type="hidden" name="ruangan" id="ruangan" value="<?php echo $this->encrypt_rs->encode($i_r['id_ruangan'])?>">
	<input type="hidden" name="kelas" id="kelas" value="<?php echo $this->encrypt_rs->encode($i_kls['id_kelasperawatan'])?>">
	<div class="col-sm-12">
		<div class="portlet light ">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-info font-grey-gallery"></i>
					<span class="caption-subject bold font-grey-gallery uppercase"><?php echo $i_r['nama_ruangan']?></span>
					<span class="caption-helper">data kamar kelas <?php echo $i_kls['nama_kelasperawatan']?></span>
				</div>

				<div class="actions">
					<a href="<?php echo base_url()?>admin/datamaster/ruanganinap" class="btn btn-circle green-meadow" >
					<i class="fa fa-angle-double-left"></i> Kembali </a>
					<a href="<?php echo base_url()?>admin/datamaster/form_input_kamar" class="btn btn-circle green-meadow" title="tambah kamar pelayanan rawat inap." data-toggle="modal" data-target="#modal_add_ruangan">
					<i class="fa fa-plus"></i> Add kamar </a>
					<a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-hover" id="data_kamar_inap">
					<thead>
						<tr>
							<th>Kode Kamar</th>
							<th>Nama Kamar</th>
							<th>Jumlah Bed</th>
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

		$("#data_kamar_inap").dataTable({
			'ordering':false,
			'language':{
				'search':'Nama kamar : '
			},
			'serverSide':true,
			'processing':true,
			'ajax':{
				type:'post',
				url:base_url+'admin/datamaster_api/get_data_kamar_inap',
				data:function(filter)
				{
					filter.ruang=$("#ruangan").val(),
					filter.kelas=$("#kelas").val()
				}
			},
			rowCallback:function(row, data, index)
			{
				
				$("td:eq(3)",row).html("<a href='"+base_url+"admin/datamaster/bed?kamar="+data[3]+"' class='btn btn-xs green'><i class='icon-login'></i> Input tempat tidur</a>");
				if(data[2]<6)
				{
					$("td:eq(2)",row).html("<span class='badge badge-danger'>"+data[2]+" tempat tidur</span>");
				}
				else if(data[2]<10 && data[2]>5)
				{
					$("td:eq(2)",row).html("<span class='badge badge-warning'>"+data[2]+" tempat tidur</span>");
				}
				else
				{
					$("td:eq(2)",row).html("<span class='badge badge-success'>"+data[2]+" tempat tidur</span>");
				}
			}
		})
		$("#data_kamar_inap").find('.dataTables_length select').select2();


	})
	var load_tabel_data_kamar=function()
	{
		$("#data_kamar_inap").DataTable().ajax.reload();
	}
</script>
