
	<script src="<?php echo base_url()?>template/neon/js/bootstrap-datepicker.js"></script>
	<style type="text/css">
		.hr_pie{
			     margin-bottom: 1px; 
		}
	</style>
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
											<input type="text" name="tgl" class="form-control tgl datepicker" data-format="dd-mm-yyyy">
											<span class="input-group-btn">
												<button class="btn btn-success btn-refresh" type="button">
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


	statistik_kunjungan('')

	})
	$(".btn_toggle_search_dt_kunjungan").click(function(){
		$(".form_search_dt_kunjungan").toggle();
	})


	function statistik_kunjungan(tgl)
	{
		var total=0;

		var options = {
					// 	chart: {
					// 		renderTo: 'chart_statistik_kunjungan',
					// 		plotBackgroundColor: null,
					// 		plotBorderWidth: null,
					// 		plotShadow: false,
					// 		events: {
     //                			load: function(event) {
     //                    			$('.highcharts-legend-item').last().append('<br/><div style="width:200px"><hr/> <span style="float:left"> Total </span><span style="float:right"> ' + total + '</span> </div>')
     //                			}
     //              			}
					// 	},
					// 	credits:{enabled: false},
					// 	title: {
					// 		text: ''
					// 	},
					// 	tooltip: {
					// 		formatter: function() {
					// 			return '<b>'+ this.point.name +'</b>: '+ this.point.y;
					// 		}
					// 	},
					// 	plotOptions: {
					// 		pie: {
					// 			allowPointSelect: true,
					// 			showInLegend: true,
					// 			cursor: 'pointer',
					// 			dataLabels: {
					// 			enabled: false,
					// 			color: '#000000',
					// 			connectorColor: '#000000',
					// 			formatter: function() {
					// 				return '<b>'+ this.point.name +'</b>: '+ this.point.y;
					// 			}
					// 		},
					// 		legend: {
				 //                enabled: true,
				 //                layout: 'vertical',
				 //                align: 'right',
				 //                width: 220,
				 //                verticalAlign: 'top',
					// 			borderWidth: 0,
				 //                useHTML: true,
					// 			labelFormatter: function() {
				 //                    total += this.y;
					// 				return '<div style="width:200px"><span style="float:left">' + this.name + '</span><span style="float:right">' + this.y + '%</span></div>';
					// 			}
					// 		}
					// 	}

					// },
					// series: [{
					// 	type: 'pie',
					// 	name: '',
					// 	data: []
					// }]
	
			chart:{type:'pie',
					renderTo: 'chart_statistik_kunjungan',
                  events: {
                    load: function(event) {
                        $('.highcharts-legend-item').last().append("<br/><div style='width:200px'><hr class='hr_pie'/> <span style='float:left'> Total kunjungan : </span><span style='float:right'> "+ total + " Jiwa</span> </div>")
                    }
                  }
                  
                  },
			credits:{enabled: false},
            
            title:{text: null},
			tooltip:{
				enabled: true,
				animation: true
			},
			plotOptions: {
                pie: {
                    allowPointSelect: true,
					animation: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                        enabled: false,                        
                        formatter: function() {
                            return this.percentage.toFixed(2) + ' Jiwa';
                        }
                    } 									
                }
            },
            legend: {
                enabled: true,
                layout: 'vertical',
                align: 'right',
                width: 220,
                verticalAlign: 'top',
				borderWidth: 0,
                useHTML: true,
				labelFormatter: function() {
                    total += this.y;
					return '<div style="width:200px"><span style="float:left">' + this.name + '</span><span style="float:right">' + this.y + ' Jiwa</span></div>';
				},
				title: {
					text: 'Data kunjungan',
					style: {
						fontWeight: 'bold'
					}
				}
            },
			series: [{
				type: 'pie',
				data: []
			}]
		
				}

		$.getJSON(base_url+'pendaftaran/home_api/statistik_kunjungan?tgl='+tgl, function(json) {
			options.series[0].data = json;
			chart = new Highcharts.Chart(options);
		});
	}

	$(".btn-refresh").click(function(){
		statistik_kunjungan($(".tgl").val())
	})
</script>



    