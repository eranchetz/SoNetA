<?php
//add check for twitter_token if no, refer to twitter login on soneta.info
session_start();
$conn = new Mongo();
$db = $conn->soneta;
$personas = $db->personas;

$user_id = $_SESSION['id'];
?>
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
		#soneta { 	width : 100%px ; 
					margin-left:auto; 
					margin-right:auto; 
					text-align : center;
					}
		#draggable { width:30%;height: 450px;padding: 5px; border-style:solid; border-width:3px; border-radius: 15px;float:left}
		#draggable4{ width:33%;height: 450px;padding: 5px; border-style:solid; border-width:3px; border-radius: 15px;float:left}
		#tweets    { width:25%;height: 459px;float:left;border-style:solid; border-width:3px; border-radius: 15px; clear: right;"}
		#draggable3{ width:91%;padding: 0.1em; border-style:solid; border-width:3px; border-radius: 15px;float:left;}
		
					
	</style>
	
	<script type="text/javascript"> 
	
				$(function() {
						$("#draggable").draggable();
						
						$("#draggable2").draggable();
						
						$("#draggable3").draggable();
						
						$("#draggable4").draggable();
						
					
						
					
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
							categories: ['twitter', 'Facebook', 'Youtube', 'flickr'],
							title: {
								text: null
							}
						},
						yAxis: {
							min: 0,
							title: {
								text: '',
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
							name: 'Facebook',
							data: [0,13]},
							
							{
							name: 'flickr',
							data: [0,0,0]},
							
							{
							name: 'youtube',
							data: [0,0,0,0]
					
						}]
					});


				});

		
			
			
			
				var livechart;
				$(document).ready(function() {
				   livechart = new Highcharts.Chart({
				      chart: {
				         renderTo: 'liveChart',
				         defaultSeriesType: 'spline',
						 margin: [50, 50, 50, 150],
						width: 1000,
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
				         text: 'Social Trends',
				         style: {
				            margin: '5px 5px 0 0' // center it
				         }
				      },
						credits: {
						enabled: false,
						
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
				         name: 'Social data',
				         data: (function() {
				           
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
			
			
			
			
			
			
				var piechart;
				$(document).ready(function() {
				   piechart = new Highcharts.Chart({
				      chart: {
				         renderTo: 'pieChart',
				         margin: [50,0, 50, 0]
				      },
						credits: {
						enabled: false,
						},
				      title: {
				         text: 'SoNetA Calculated Social Characteristics'
				      },
				      plotArea: {
				         shadow: null,
				         borderWidth: null,
				         backgroundColor: null
				      },
				      tooltip: {
				         formatter: function() {
				            return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
				         }
				      },
				      plotOptions: {
				         pie: {
				            allowPointSelect: true,
				            cursor: 'pointer',
				            dataLabels: {
				               enabled: true,
				               formatter: function() {
				                  if (this.y > 5) return this.point.name;
				               },
				               color: 'white',
				               style: {
				                  font: '12px Trebuchet MS, Verdana, sans-serif'
				               }
				            }
				         }
				      },
				      exporting: {

					enabled: false,
					},
				       series: [{
				         type: 'pie',
				         name: 'Attributes',
				         data: [
				            ['Happy',   45.0],
				            ['Chatty',       26.8],
				            {
				               name: 'Talker',    
				               y: 12.8,
				               sliced: true,
				               selected: true
				            },
				            ['Working',    8.5],
				            ['Partying',     6.2],
				            ['Friendly',   16.7]
				         ]
				      }]
				   });
				});
			
			
				</script>

			

</head>

<body>

	<?php


	//Now lets check to see if the form has been filled out.
	if(isset($_SESSION['id']) )
	{

	//Ok the login worked
	?>
	
	<div id=soneta>
	<h1> 
		<?php  
			$name = $personas->findOne(array('id' => $_SESSION['id'] ), array('name'));
			print_r($name['name']); 
		?> 
	</h1>
	
	
	<div id="draggable" class="ui-widget-content">
			<p id="barChart" ></p> 
	</div>
	
	<div id="draggable4"  class="ui-widget-content">
		<div id="pieChart"></div>	
	</div>
	
	<div id="draggable2" class="ui-widget-content">
		<div class="monitter" id="tweets" title="twitter" lang="en" ></div>
	</div>

	<div id="draggable3" class="ui-widget-content">
		<p id="liveChart"></p>
	</div>
	
	
	</div>
	<?php
	}
	
	else
	{
	//Login Field was blank or user got here not from facebook login, display the login form
	?>
	<div id="login1">
		<h1>Login</h1>
		<form name="form" method="post" action="http://soneta.info/fb/index.php">
			<label for="txtUsername">Enter your name:</label>
			<input type="text" title="Enter your Username" name="txtUsername" /></p>
			<input type="submit" name="Enter" value="Login" /></p>
		</form>
	</div>
	<?php
	}
	?>

</body>
</html>
