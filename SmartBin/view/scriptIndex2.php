<!-- Script de las gráficas de la ventana de Inicio (I) -->
<!-- Home's window charts script (I) -->

<script>
	window.onload = function() {

		/* Gráfica de Variación de pesos en el tiempo */
		/* Variation of weights over time chart */
		var data = [{
			type: "line",
			dataPoints: <?php echo json_encode($dataPointsGraficabyId, JSON_NUMERIC_CHECK); ?>
		}];

		var options = {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light1"
			<?php } else { ?> theme: "dark1"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle1"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX1"]; ?>"
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY1"]; ?>",
				lineThickness: 1,
				includeZero: true
			},
			data: data
		};

		var chart = new CanvasJS.Chart("chartContainer", options);
		var startTime = new Date();
		chart.render();
		var endTime = new Date();
		document.getElementById("timeToRender").innerHTML = "Time to Render: " + (endTime - startTime) + "ms";
	}
</script>
<style>
	#timeToRender {
		position: absolute;
		top: 10px;
		font-size: 20px;
		font-weight: bold;
		background-color: #d85757;
		padding: 0px 4px;
		color: #ffffff;
	}
</style>