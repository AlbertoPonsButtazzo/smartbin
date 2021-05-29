<!-- Ventana de vistas -->
<!-- Views's window -->

<!-- Se incluyen las cabeceras y los scripts de las gráficas -->
<!-- Headers and charts scripts are included -->
<?php $vista = "vistas" ?>
<?php include "headerBase1.php"; ?>
<?php include "scriptsVistas.php"; ?>
<?php include "headerBase2.php"; ?>

<!-- Sección de los datos generales -->
<!-- General data section -->
<section class="datosGenerales">
  <article>
    <h2><a data-toggle="collapse" href="#collapseDatosGenerales" class="desplegableButtonMaster"><?php echo $language_cfg["general"]; ?></a></h2>
    <section id="collapseDatosGenerales" class="panel-collapse collapse show">
      <?php if (isset($allRegistrosCount) || isset($allRegistrosGetByBrewDataNULLCount) || isset($allRegistrosTotalWeightMax) || isset($allRegistrosBrewDataMin)) { ?>
        <p class="registrosTotales"><strong><data value="<?php echo $allRegistrosCount; ?>"><?php echo $language_cfg["total"]; ?><?php echo $allRegistrosCount; ?></data></strong></p>
        <p class="registrosSinPeso"><strong><data value="<?php echo $allRegistrosGetByBrewDataNULLCount; ?>"><?php echo $language_cfg["withoutWeight"]; ?><?php echo $allRegistrosGetByBrewDataNULLCount; ?></data></strong></p>
        <p class="pesoMasAlto"><strong><data value="<?php echo $allRegistrosTotalWeightMax; ?>"><?php echo $language_cfg["maxWeight"]; ?><?php echo $allRegistrosTotalWeightMax; ?></data></strong></p>
        <p class="pesoMasBajo"><strong><data value="<?php echo $allRegistrosBrewDataMin; ?>"><?php echo $language_cfg["minWeight"]; ?><?php echo $allRegistrosBrewDataMin; ?></data></strong></p>
      <?php } else {
      ?>
        <section class="alert alert-info" role="alert">
          <?php echo $language_cfg["alertGeneral"]; ?>
        </section>
      <?php
      } ?>
    </section>
    <article>
</section>

<!-- Sección de las gráficas con los pesos medios -->
<!-- Charts with average weights section -->
<section class="pesosMedios">
  <article>
    <h2><a data-toggle="collapse" href="#collapsePesosMedios" class="desplegableButtonMaster"><?php echo $language_cfg["averageWeights"]; ?></a></h2>
    <section id="collapsePesosMedios" class="panel-collapse collapse show">
      <?php if (isset($dataPointsGrafica1) || isset($dataPointsGrafica2)) { ?>
        <section class="chartContainer" id="chartContainer"></section>
        <section class="chartContainer" id="chartContainer2"></section>
      <?php } else {
      ?>
        <section class="alert alert-info" role="alert">
          <?php echo $language_cfg["alertChart"]; ?>
        </section>
      <?php
      } ?>
    </section>
    <article>
</section>

<!-- Sección de las gráficas con los pesos totales -->
<!-- Charts with total weights section -->
<section class="pesosTotales">
  <article>
    <h2><a data-toggle="collapse" href="#collapsePesosTotales" class="desplegableButtonMaster"><?php echo $language_cfg["totalWeights"]; ?></a></h2>
    <section id="collapsePesosTotales" class="panel-collapse collapse show">
      <?php if (isset($dataPointsGrafica1) || isset($dataPointsGrafica2)) { ?>
        <section class="chartContainer" id="chartContainer3"></section>
        <section class="chartContainer" id="chartContainer4"></section>
      <?php } else {
      ?>
        <section class="alert alert-info" role="alert">
          <?php echo $language_cfg["alertChart"]; ?>
        </section>
      <?php
      } ?>
    </section>
    <article>
</section>

<!-- Se incluye el pie de página -->
<!-- Footer is included -->
<?php include "footer.php"; ?>