<!-- 
	<div class="col-sm-7">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><i class='entypo-chart-bar bold'></i> Statistik Kunjungan Hari Ini</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-12">
						<div id="chart6" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
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
	Highcharts.chart('chart6', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: ''
	    },
	    tooltip: {
	        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: true,
	                format: '<b>{point.name}</b>: {point.percentage:.1f} jiwa',
	                style: {
	                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                }
	            }
	        }
	    },
	    colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#aaeeee', '#ff0066'],
	    series: [{
	        name: 'THT',
	        data: [{
	            name: 'Radiologi langsung',
	            y: 56.33
	        }, {
	            name: 'Mata',
	            y: 24.03,
	            sliced: true,
	            selected: true
	        }, {
	            name: 'Anak',
	            y: 10.38
	        }, {
	            name: 'Dalam',
	            y: 4.77
	        }, {
	            name: 'Umum',
	            y: 0.91
	        }, {
	            name: 'Lab',
	            y: 0.2
	        }]
    	}],
	});
</script> -->