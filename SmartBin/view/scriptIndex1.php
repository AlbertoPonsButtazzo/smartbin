<!-- Script de las gráficas de la ventana de Inicio (II) -->
<!-- Home's window charts script (II) -->

<script>
	window.onload = function() {

		/* Gráfica de Variación de pesos en el tiempo (con múltiples registros) */
		/* Variation of weights over time chart (with multiple records) */
		var chart = new CanvasJS.Chart("chartContainer2", {
			<?php if ($_COOKIE['zoom'] == "true") { ?> zoomEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['exporte'] == "true") { ?> exportEnabled: true,
			<?php } ?>
			<?php if ($_COOKIE['fondo'] == "false") { ?> theme: "light1"
			<?php } else { ?> theme: "dark1"
			<?php } ?>,
			animationEnabled: true,
			title: {
				text: "<?php echo $language_cfg["chartTitle2"]; ?>"
			},
			axisX: {
				title: "<?php echo $language_cfg["chartX1"]; ?>"
			},
			axisY: {
				title: "<?php echo $language_cfg["chartY1"]; ?>",
				lineThickness: 1,
				includeZero: true
			},
			legend: {
				cursor: "pointer",
				fontSize: 16,
				itemclick: toggleDataSeries
			},
			toolTip: {
				shared: true
			},
			data: [
				<?php if (isset($identificadores) && isset($nombres) && isset($dataPointsGraficabyIds)) {
					for ($i = 0; $i < count($identificadores); $i++) { ?> {
							name: "<?php echo $nombres[$i]; ?>",
							type: "line",
							showInLegend: true,
							dataPoints: [
								<?php for ($j = 0; $j < count($dataPointsGraficabyIds[$i]) - 1; $j++) { ?> {
										x: <?php echo $dataPointsGraficabyIds[$i][$j]['x']; ?>,
										y: <?php echo $dataPointsGraficabyIds[$i][$j]['y']; ?>
									}
									<?php if ($i != count($dataPointsGraficabyIds[$i]) - 1) { ?>,
									<?php } ?>
								<?php } ?>
							]
						}
						<?php if ($i != count($identificadores) - 1) { ?>,
						<?php } ?>
				<?php }
				} ?>
			]
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