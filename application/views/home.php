<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta charset="UTF-8"/>

		<meta name="description"	content=""/>
		<meta name="keywords"		content=""/>
		<meta name="author"			content=""/>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=1000"/>

		<title></title>

		<link href="/public/admin_d-0.0.54.min.css" rel="stylesheet"/>
		<script src="/public/admin_d-0.0.54.min.js"></script>

		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css"/>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

		<link href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.0.4/css/highcharts.min.css"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.0.4/css/stocktools/gui.min.css"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.0.4/highcharts.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/8.0.4/highstock.min.js"></script>
	</head>
	<body>
		<div class="head">
			<div class="container">
				<div class="navigation">
					<ul>
						<li><a href="">Home</a></li>
						<li><a href="js.html">JS Examples</a></li>
					</ul>
				</div>
			</div>
			<!--/.container-->
		</div>
		<!--/.head-->

		<div class="body">
			<div class="container">
				<div class="panel">
					<div class="panel-header">
						<h1>Member Table</h1>
					</div>	
					<!--/.panel-header-->

					<div class="panel-block">
						<div id="chart"></div>
					</div>
					<!--/.panel-block-->

					<form method="GET" action="/">
						<div class="panel-body">
							<?php foreach($dates as $date) { ?>
								<div class="row-col">
									<div class="col-3">
										<label>Start Date</label>
										<input type="text" name="start_date[]" class="input inputdate" value="<?php echo $date["start"]; ?>" />
									</div>
									<!--/.col-3-->
									<div class="col-3">
										<label>End Date</label>
										<input type="text" name="end_date[]" class="input inputdate" value="<?php echo $date["end"];?>" />
									</div>
									<!--/.col-3-->
									<div class="col-3"></div>
									<!--/.col-3-->
								</div>
								<!--/.row-col-->
								<br />
							<?php } ?>

							<div class="row-col">
								<div class="col-3">
									<label>Start Date</label>
									<input type="text" name="start_date[]" class="input inputdate" value="" />
								</div>
								<!--/.col-3-->
								<div class="col-3">
									<label>End Date</label>
									<input type="text" name="end_date[]" class="input inputdate" value="" />
								</div>
								<!--/.col-3-->
								<div class="col-3"></div>
								<!--/.col-3-->
							</div>
							<!--/.row-col-->

							<br />

							<div class="row-col">
								<div class="col-2">
									<div class="btn btn-default" onclick="onclick_clear">초기화</div>
								</div>
								<div class="col-2 text-right">								
									<button type="submit" class="btn btn-primary">Search</button>
								</div>
							</div>
							<!--/.row-->
						</div>
						<!--/.panel-body-->
					</form>
					
					<div class="panel-footer">

					</div>
					<!--/.panel-footer-->
				</div>
				<!--/.panel-->
			</div>
			<!--/.container-->
		</div>
		<!--/.body-->

		<div class="foot">
		
		</div>
		<!--/.foot-->
	</body>
	<script>
		var onclick_clear = function() {
			$(".inputdate").each(function() {
				$(this).val("");
			});
		};
		(function() {

			$(".inputdate").datepicker({ "dateFormat" : "yy-mm-dd"  });

			Highcharts.chart('chart', {
				title: { text: null },
				subtitle: { text: null },
				yAxis: {
					title: {
						text: 'Price '
					}
				},
				xAxis: {
				},
				legend: {
					layout: 'vertical',
					align: 'right',
					verticalAlign: 'middle'
				},
				plotOptions: {
					series: {
						label: {
							connectorAllowed: false
						},
						pointStart: 1
					}
				},

				series: <?php echo json_encode($series); ?>,

				responsive: {
					rules: [{
						condition: {
							maxWidth: 500
						},
						chartOptions: {
							legend: {
								layout: 'horizontal',
								align: 'center',
								verticalAlign: 'bottom'
							}
						}
					}]
				}

			});	
		})()
	</script>
</html>

