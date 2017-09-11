
	<div class="col-sm-7">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><i class='entypo-chart-bar bold'></i> Statistik Kunjungan Hari Ini</div>
				<div class="panel-options">
					<a href="#" class="bg btn_toggle_search_dt_kunjungan"><i class="entypo-search"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row form_search_dt_kunjungan" style="display: none;">
					<div class="col-sm-12">
						<div class="well well-sm">
							<form class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-sm-3">Tgl Kunjungan :</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" name="tgl" class="form-control">
											<span class="input-group-btn">
												<button class="btn btn-success">
													<i class="entypo-search"></i>
												</button>
											</span>
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="chart_statistik_kunjungan" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-sm-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><i class='entypo-chart-bar bold'></i> Register Oleh Saya</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						
					</div>
				</div>
			</div>
		</div>
	</div>



<script src="template/plugin/highcharts/highcharts.js"></script>
<script src="template/plugin/highcharts/modules/exporting.js"></script>
<script type="text/javascript">
	$(document).ready(function(){


	statistik_kunjungan('2017-09-12')

	})
	$(".btn_toggle_search_dt_kunjungan").click(function(){
		$(".form_search_dt_kunjungan").toggle();
	})


	function statistik_kunjungan(tgl)
	{

		var options = {
						chart: {
							renderTo: 'chart_statistik_kunjungan',
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: ''
						},
						tooltip: {
							formatter: function() {
								return '<b>'+ this.point.name +'</b>: '+ this.point.y;
							}
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
									return '<b>'+ this.point.name +'</b>: '+ this.point.y;
								}
							}
						}
					},
					series: [{
						type: 'pie',
						name: '',
						data: []
					}]
				}

		$.getJSON(base_url+'pendaftaran/home_api/statistik_kunjungan', function(json) {
			options.series[0].data = json;
			chart = new Highcharts.Chart(options);
		});
	}

	
</script>