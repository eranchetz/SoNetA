<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> SoNetA - we visualize social data </title>
	<meta name="author" content="Eran Chetzroni">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/monitter.css" />
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
	<script type="text/javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script> 
	<script type="text/javascript" src="js/raphael-min.js"></script>
	<script type="text/javascript" src="js/g.raphael-min.js"></script>
	<script type="text/javascript" src="js/g.pie-min.js"></script>
	<script type="text/javascript" src="js/highcharts.js"></script> 
	<script type="text/javascript" src="js/modules/exporting.js"></script>
	<script type="text/javascript" src="js/monitter.min.js"></script>
	
	<!-- Date: 2010-09-12 -->
	<style type="text/css" media="screen">
		h1 { font-family: 'Lobster', arial, serif; font-size:350%;}
		#login1 { width : 400px ; margin-left:auto; margin-right:auto; }
		#soneta { 	width : 900px ; 
					margin-left:auto; 
					margin-right:auto; 
					text-align : center;}
		#draggable { width: 150px; height: 150px; padding: 0.5em; }
		#resizable { width: 150px; height: 150px; padding: 0.5em; }
					
	</style>
	
	<script type="text/javascript"> 
	
				$(function() {
						$("#draggable").draggable();
						
						$("#draggable2").draggable();
						
						$("#draggable3").draggable();
						
					
						
						$("#resizable").resizable({
						aspectRatio: 16/9
						});
				});

				var chart;
				$(document).ready(function() {
					chart = new Highcharts.Chart({
						chart: {
							renderTo: 'barChart',
							defaultSeriesType: 'bar'
						},
						title: {
							text: 'Social Status'
						},
						subtitle: {
							text: 'Data provided by SoNetA'
						},
						xAxis: {
							categories: ['twitter', 'facebook', 'Youtube', 'flickr'],
							title: {
								text: null
							}
						},
						yAxis: {
							min: 0,
							title: {
								text: 'Updates',
								align: 'high'
							}
						},
						tooltip: {
							formatter: function() {
								return ''+
									 this.series.name +': '+ this.y +' updates';
							}
						},
						plotOptions: {
							bar: {
								lineWidth: 250,
								
								
							}
						},
					
						credits: {
							enabled: false
						},
					        series: [{
							name: 'tweets',
							data: [107]},
							
							{
							name: 'facebook',
							data: [0,13]},
							
							{
							name: 'flickr',
							data: [0,0,2]},
							
							{
							name: 'youtube',
							data: [0,0,0,14]
					
						}]
					});


				});

		
			
			
			
				var livechart;
				$(document).ready(function() {
				   livechart = new Highcharts.Chart({
				      chart: {
				         renderTo: 'liveChart',
				         defaultSeriesType: 'spline',
				         marginRight: 10,
				         events: {
				            load: function() {

				               // set up the updating of the chart each second
				               var series = this.series[0];
				               setInterval(function() {
				                  var x = (new Date()).getTime(), // current time
				                     y = Math.random();
				                  series.addPoint([x, y], true, true);
				               }, 1000);
				            }
				         }
				      },
				      title: {
				         text: 'Live random data',
				         style: {
				            margin: '10px 100px 0 0' // center it
				         }
				      },
				      xAxis: {
				         type: 'datetime',
				         tickPixelInterval: 150
				      },
				      yAxis: {
				         title: {
				            text: 'Value'
				         },
				         plotLines: [{
				            value: 0,
				            width: 1,
				            color: '#808080'
				         }]
				      },
				      tooltip: {
				         formatter: function() {
				                   return '<b>'+ this.series.name +'</b><br/>'+
				               Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+ 
				               Highcharts.numberFormat(this.y, 2);
				         }
				      },
				      legend: {
				         enabled: false
				      },
				      exporting: {
				         enabled: false
				      },
				      series: [{
				         name: 'Random data',
				         data: (function() {
				            // generate an array of random data
				            var data = [],
				               time = (new Date()).getTime(),
				               i;
				            for (i = -19; i <= 0; i++) {
				               data.push({
				                  x: time + i * 1000,
				                  y: Math.random()
				               });
				            }
				            return data;
				         })()
				      }]
				   });


				});
			
			
			
				</script>

			

</head>

<body>

	<?php
	// Define your username and password
	// need to sha1 this !!!
	$username = "eran";
	$password = "123";
	//Now lets check to see if the form has been filled out.
	if(isset($_POST['txtUsername']) && isset($_POST['txtPassword']))
	{
	//ok they are set lets see if they match.
	if($username == $_POST['txtUsername'] && $password == $_POST['txtPassword'])
	{
	//Ok the login worked
	?>
	<div id=pageframe>
	<div id=soneta>
	<h1> <?php echo $_POST['txtUsername']?> </h1>
	
	
	<div id="draggable" class="ui-widget-content">
			<div id="barChart" style="width: 350px; height: 350px; margin: 0 auto; float : left "></div> 
	</div>
	
	<div id="draggable2" class="ui-widget-content">
		<div class="monitter" id="tweets" title="facebook" lang="en"></div>
	</div>
	
	<div id="draggable3" class="ui-widget-content">
		<div id="liveChart"  style="height:350px; width: 800px; margin: 0 auto; clear:both"></div>
	</div>
	
	
	</div>
	<?php
	}
	else
	{
	//Login Failed, display error
	die("Your Login Information was Incorrect");
	}
	}
	else
	{
	//Login Field was blank, display the login form
	}
	?>
	
	
	</body>
</html>