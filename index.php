<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>fixture</title>
	<link rel="stylesheet" href="static/css/bootstrap.min.css">
	<style type="text/css">
		ul
		{
			font-size:2em;
			list-style: none;
		}
		ul li
		{
			margin:.25em 0 .25em;
		}
		#resultado
		{
			margin: 2em auto;
			width:1000px;
		}
		.pais
		{
			font-weight:bold;
		}
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		var fixtureAPP = {
			titulo:'',
			items:[],
			paises:['México','Perú','Colombia','Bolivia','Argentina','Uruguay','España'],
			getFixture: function(contenedorDOM) {
				var url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20html%20where%20url%3D%22http%3A%2F%2Fwww.aquehorajuega.net%2F2012%2F01%2Fbarcelona-vs-real-madrid-miercoles-25.html%22%20and%20xpath%3D'%2F%2Fh3%5B%40class%3D%22post-title%20entry-title%22%5D%20%7C%20%2F%2Fspan%5B%40style%3D%22font-size%3A%2085%25%3B%22%5D'&format=json&diagnostics=true&callback=";

				$.getJSON(url,function(data) {
					var json = data.query.results.span;
					fixtureAPP.titulo = data.query.results.h3.a.content;
					$.each(json, function(key,val) {
						fixtureAPP.items.push(val.content);
					});
					console.log(data.query.results.span[0].content);
				}).complete(function(data) {
					var	leHtml = '';
					$.each(fixtureAPP.items, function(key,val) {
						leHtml += '<li><span class="pais">'+fixtureAPP.paises[key]+'</span> : '+val+'</li>';
					});
					$(contenedorDOM).find('h1').html(fixtureAPP.titulo);
					$(contenedorDOM).find('ul').html(leHtml);
				});
				return false;
			}
		}
		$(function() {
			fixtureAPP.getFixture('#resultado');
		});
	</script>
</head>
<body>
	<div id="resultado">
		<h1></h1>
		<ul></ul>
	</div>
	
</body>
</html>