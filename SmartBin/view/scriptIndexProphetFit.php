<!-- Script de las gráficas de la ventana de Inicio (IV) -->
<!-- Home's window charts script (IV) -->

<script>
	window.onload = function() {

		/* Gráfica con la variación de los pesos en el tiempo y los pesos con la predicción de Prophet (con Ajuste de Curva) */
		/* Chart with the variation of the weights over time per second and the weights with Prophet's prediction (with Curve Fitting) */
		var data = [{
			name: "<?php echo $language_cfg["lineName3"]; ?>",
			type: "spline",
			showInLegend: true,
			color: "#C24642",
			dataPoints: <?php echo json_encode($dataPointsProphet, JSON_NUMERIC_CHECK); ?>
		}, {
			name: "<?php echo $language_cfg["lineName4"]; ?>",
			type: "spline",
			showInLegend: true,
			color: "#369EAD", 
			dataPoints: <?php echo json_encode($dataPointsGraficabyIdBase, JSON_NUMERIC_CHECK); ?> 
		}, {
			name: "<?php echo $language_cfg["lineName5"]; ?>",
			type: "spline",
			showInLegend: true,
			color: "#00D33C",
			dataPoints: <?php echo json_encode($dataPointsFit, JSON_NUMERIC_CHECK); ?>
		}];

		var chart = new CanvasJS.Chart("chartContainer4", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light1"
			<?php } else { ?> theme: "dark1"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle4"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX1"]; ?>"
			},
			axisY: [{
					title: "<?php echo $language_cfg["lineName3"]; ?>",
					lineThickness: 1,
					lineColor: "#C24642",
					tickColor: "#C24642",
					labelFontColor: "#C24642",
					titleFontColor: "#C24642",
					includeZero: true
				},
				{
					title: "<?php echo $language_cfg["lineName4"]; ?>",
					lineThickness: 1,
					lineColor: "#369EAD",
					tickColor: "#369EAD",
					labelFontColor: "#369EAD",
					titleFontColor: "#369EAD",
					includeZero: true
				},
				{
					title: "<?php echo $language_cfg["lineName5"]; ?>",
					lineThickness: 1,
					lineColor: "#00D33C",
					tickColor: "#00D33C",
					labelFontColor: "#00D33C",
					titleFontColor: "#00D33C",
					includeZero: true
				}
			],
			legend: {
				cursor: "pointer",
				fontSize: 16,
				itemclick: toggleDataSeries
			},
			toolTip: {
				shared: true
			},
			data: data
		});
		chart.render();

		function toggleDataSeries(e) {
			if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
				e.dataSeries.visible = false;
			} else {
				e.dataSeries.visible = true;
			}
			chart.render();
		}
	}
</script>