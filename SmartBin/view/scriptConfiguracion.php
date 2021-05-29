<!-- Script de la gráfica de la ventana de Configuración -->
<!-- Configuration's window chart script -->

<script>
    window.onload = function() {

        /* Gráfica de ejemplo */
        /* Exmaple chart */
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
                text: "<?php echo $language_cfg["chartTitle9"]; ?>"
            },
            axisX: {
                title: "<?php echo $language_cfg["chartX4"]; ?>"
            },
            axisY: {
                title: "<?php echo $language_cfg["chartY4"]; ?>"
            },
            data: [{
                name: "<?php echo $language_cfg["chartTitle9"]; ?>",
                type: "spline",
                showInLegend: true,
                dataPoints: [{
                        x: 1,
                        y: 1
                    },
                    {
                        x: 2,
                        y: 2
                    },
                    {
                        x: 3,
                        y: 3
                    },
                    {
                        x: 4,
                        y: 4
                    },
                    {
                        x: 5,
                        y: 5
                    },
                    {
                        x: 6,
                        y: 6
                    },
                    {
                        x: 7,
                        y: 7
                    },
                    {
                        x: 8,
                        y: 8
                    },
                    {
                        x: 9,
                        y: 9
                    },
                    {
                        x: 10,
                        y: 10
                    }
                ]
            }]
        });
        chart.render();
    }
</script>