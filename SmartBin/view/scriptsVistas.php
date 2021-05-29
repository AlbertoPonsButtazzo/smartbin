<!-- Scripts de las gráficas de la ventana de Vistas -->
<!-- Views's window charts scripts -->

<script>
	window.onload = function() {

		/* Gráfica de Pesos medios de los registros */
		/* Average weights of records chart */
		var chart = new CanvasJS.Chart("chartContainer", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light1"
			<?php } else { ?> theme: "dark1"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle5"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX2"]; ?>"
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY2"]; ?>",
				includeZero: true
			},
			data: [{
				type: "column",
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",
				dataPoints: <?php echo json_encode($dataPointsGrafica1, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

		/* Gráfica de Pesos medios por fecha */
		/* Average weights by date chart */
		var chart2 = new CanvasJS.Chart("chartContainer2", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light1"
			<?php } else { ?> theme: "dark1"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle6"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX3"]; ?>",
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY2"]; ?>",
				includeZero: true,
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			toolTip: {
				enabled: false
			},
			data: [{
				type: "area",
				dataPoints: <?php echo json_encode($dataPointsGrafica2, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart2.render();

		/* Gráfica de Pesos totales de los registros */
		/* Total weights of records chart */
		var chart3 = new CanvasJS.Chart("chartContainer3", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light2"
			<?php } else { ?> theme: "dark2"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle7"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX2"]; ?>"
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY3"]; ?>",
				includeZero: true
			},
			data: [{
				type: "column",
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",
				dataPoints: <?php echo json_encode($dataPointsGrafica3, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart3.render();

		/* Gráfica de Pesos totales por fecha */
		/* Total weights by date chart */
		var chart4 = new CanvasJS.Chart("chartContainer4", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light2"
			<?php } else { ?> theme: "dark2"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle8"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX3"]; ?>",
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY3"]; ?>",
				includeZero: true,
				crosshair: {
					enabled: true,
					snapToDataPoint: true
				}
			},
			toolTip: {
				enabled: false
			},
			data: [{
				type: "area",
				dataPoints: <?php echo json_encode($dataPointsGrafica4, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart4.render();
	}
</script>