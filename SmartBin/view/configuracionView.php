<!-- Ventana de configuración -->
<!-- Configuration's window -->

<!-- Se incluyen las cabeceras -->
<!-- Headers are included -->
<?php $vista = "configuracion" ?>
<?php include "headerBase1.php"; ?>
<?php include "scriptConfiguracion.php"; ?>
<?php include "headerBase2.php"; ?>

<!-- Sección de configuración -->
<!-- Configuration section -->
<section class="configuracion">
    <article>
        <h2><a data-toggle="collapse" href="#collapseDatosGenerales" class="desplegableButtonMaster"><?php echo $language_cfg["configuration"]; ?></a></h2>
        <section id="collapseDatosGenerales" class="panel-collapse collapse show">

            <!-- Formulario para cambiar el modo de zoom de las gráficas -->
            <!-- Form to change the chart's zoom mode -->
            <form class="form-horizontal" name="cambiarZoom" id="cambiarZoom" action="?controller=configuracion&action=cambiarZoom&zoom=true#collapseEjemplo" method="post">
                <section class="input-row">
                    <figure><input class="zoomEnabled" type="image" src="./assets/img/zoom.png" name="submit" width="60" height="40" alt="submit" /></figure>
                </section>
            </form>
            <form class="form-horizontal" name="cambiarZoom" id="cambiarZoom" action="?controller=configuracion&action=cambiarZoom&zoom=false#collapseEjemplo" method="post">
                <section class="input-row">
                    <figure><input class="zoomDisabled" type="image" src="./assets/img/noZoom.png" name="submit" width="60" height="40" alt="submit" /></figure>
                </section>
            </form>

            <!-- Formulario para cambiar el fondo de las gráficas -->
            <!-- Form to change the chart's background -->
            <form class="form-horizontal" name="cambiarFondo" id="cambiarFondo" action="?controller=configuracion&action=cambiarFondo&fondo=false#collapseEjemplo" method="post">
                <section class="input-row">
                    <input class="backEnabled" type="image" src="./assets/img/sun.png" name="submit" width="60" height="40" alt="submit" />
                </section>
            </form>
            <form class="form-horizontal" name="cambiarFondo" id="cambiarFondo" action="?controller=configuracion&action=cambiarFondo&fondo=true#collapseEjemplo" method="post">
                <section class="input-row">
                    <input class="backDisabled" type="image" src="./assets/img/moon.png" name="submit" width="60" height="40" alt="submit" />
                </section>
            </form>

            <!-- Formulario para cambiar el modo de exportar de las gráficas -->
            <!-- Form to change the chart's export mode -->
            <form class="form-horizontal" name="cambiarExporte" id="cambiarExporte" action="?controller=configuracion&action=cambiarExporte&exporte=true#collapseEjemplo" method="post">
                <section class="input-row">
                    <input class="exportEnabled" type="image" src="./assets/img/export.png" name="submit" width="60" height="40" alt="submit" />
                </section>
            </form>
            <form class="form-horizontal" name="cambiarExporte" id="cambiarExporte" action="?controller=configuracion&action=cambiarExporte&exporte=false#collapseEjemplo" method="post">
                <section class="input-row">
                    <input class="exportDisabled" type="image" src="./assets/img/noExport.png" name="submit" width="60" height="40" alt="submit" />
                </section>
            </form>

        </section>
        <article>
</section>

<!-- Sección de la gráficas de ejemplo -->
<!-- Example chart section -->
<section class="ejemplo">
    <article>
        <h2><a data-toggle="collapse" href="#collapseEjemplo" class="desplegableButtonMaster"><?php echo $language_cfg["chartTitle9"]; ?></a></h2>
        <section id="collapseEjemplo" class="panel-collapse collapse show">
            <section class="chartContainer" id="chartContainer"></section>
        </section>
        <article>
</section>

<!-- Mensaje de alerta cuando se cambia la configuración de la gráfica -->
<!-- Alert message when the chart's configuration is changed -->
<?php if (isset($mensajeZoom) || isset($mensajeFondo) || isset($mensajeExporte)) { ?>
    <section class="alert alert-info alert-dismissible" role="alert">
        <?php if (isset($mensajeZoom) && !$mensajeZoom) { ?>
            <?php echo $language_cfg["alertZoomFail"]; ?>
        <?php } else if (isset($mensajeZoom) && $mensajeZoom) { ?>
            <?php echo $language_cfg["alertZoomSuccess"]; ?>
        <?php } ?>
        <?php if (isset($mensajeFondo) && !$mensajeFondo) { ?>
            <?php echo $language_cfg["alertBackFail"]; ?>
        <?php } else if (isset($mensajeFondo) && $mensajeFondo) { ?>
            <?php echo $language_cfg["alertBackSuccess"]; ?>
        <?php } ?>
        <?php if (isset($mensajeExporte) && !$mensajeExporte) { ?>
            <?php echo $language_cfg["alertExportFail"]; ?>
        <?php } else if (isset($mensajeExporte) && $mensajeExporte) { ?>
            <?php echo $language_cfg["alertExportSuccess"]; ?>
        <?php } ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </section>
<?php } ?>

<!-- Se incluye el pie de página -->
<!-- Footer is included -->
<?php include "footer.php"; ?>