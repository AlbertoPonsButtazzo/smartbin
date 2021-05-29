<!-- Ventana de inicio -->
<!-- Home's window -->

<!-- Se incluyen las cabeceras y los scripts de las gráficas -->
<!-- Headers and charts scripts are included -->
<?php $vista = "index" ?>
<?php include "headerBase1.php"; ?>
<?php include "scriptIndex1.php"; ?>
<?php include "scriptIndex2.php"; ?>
<?php include "scriptIndexProphet.php"; ?>
<?php include "scriptIndexProphetFit.php"; ?>
<?php include "headerBase2.php"; ?>

<!-- Banner del inicio en castellano o inglés -->
<!-- Home's banner in Spanish or English -->
<?php if (!isset($_COOKIE['idioma']) || $_COOKIE['idioma'] == "es") {
  $banner = "./assets/img/bannerEs.png";
} else if ($_COOKIE['idioma'] == "en") {
  $banner = "./assets/img/bannerEn.png";
}
?>
<figure><img class="banner" src=<?php echo $banner; ?> alt="Banner Smart Bin" max-width="70%" style="margin-top: 12px; height: auto;"></figure>

<!-- Sección global de la ventana de inicio -->
<!-- Home's window global section -->
<section class="album py-5 bg-light">
  <section class="container">

    <!-- Mensaje de alerta cuando se busca -->
    <!-- Alert message when searching -->
    <?php if (isset($mensajeBuscar) && !$mensajeBuscar) { ?>
      <section class="alert alert-warning" role="alert">
        <?php echo $language_cfg["alertSearchFail"]; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
    <?php } else if (isset($mensajeBuscar) && $mensajeBuscar) { ?>
      <section class="alert alert-success" role="alert">
        <?php echo $language_cfg["alertSearchSuccess"]; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </section>
    <?php } ?>

    <!-- Formulario para la importación del CSV -->
    <!-- Form for CSV import -->
    <form class="form-horizontal" action="?controller=index&action=importar#collapseRegistros" method="post" name="frmCSVImport" enctype="multipart/form-data">
      <section class="input-row">
        <label><strong><?php echo $language_cfg["csv"]; ?></label> <input type="file" name="file" accept=".csv">
        <button type="submit" name="import" class="btn-submit"><?php echo $language_cfg["import"]; ?></button>
      </section>
    </form>

    <!-- Formulario para la búsqueda de un registro -->
    <!-- Form to search for a record -->
    <form class="buscar" action="index.php" method="get">
      <input type="hidden" value="index" name="controller">
      <input type="hidden" value="buscar" name="action">
      <input type="text" placeholder=<?php echo $language_cfg["search"]; ?> name="buscar">
    </form>

    <!-- Sección de la tabla con todos los registros importados -->
    <!-- Table section with all imported records -->
    <section class="registros">
      <h2><a data-toggle="collapse" href="#collapseRegistros" class="desplegableButtonMaster"><?php echo $language_cfg["records"]; ?></a></h2>
      <article>
        <section id="collapseRegistros" class="panel-collapse collapse show">
          <?php if (isset($allRegistros)) { ?>
            <form action="?controller=index&action=getGraficabyIds#collapseGraficaPesos2" method="POST">
              <table class="tableRegistros">
                <caption><?php echo $language_cfg["caption"]; ?></caption>
                <tr class="registrosColumnas">
                  <th class="text-center" scope="col"><?php echo $language_cfg["select"]; ?></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarId#collapseRegistros"><?php echo $language_cfg["id"]; ?></a></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarName#collapseRegistros"><?php echo $language_cfg["name"]; ?></a></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarCreatedAt#collapseRegistros"><?php echo $language_cfg["createdAt"]; ?></a></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarTotalTime#collapseRegistros"><?php echo $language_cfg["totalTime"]; ?></a></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarAverageFlowrate#collapseRegistros"><?php echo $language_cfg["averageFlowrate"]; ?></a></th>
                  <th class="text-center" scope="col"><a href="?controller=index&action=ordenarTotalWeight#collapseRegistros"><?php echo $language_cfg["totalWeight"]; ?></a></th>
                  <th class="text-center" scope="col"><?php echo $language_cfg["chart"]; ?></th>
                  <th class="text-center" scope="col"><?php echo $language_cfg["delete"]; ?></th>
                </tr>
                <?php foreach ($allRegistros as $r) { ?>
                  <tr class="registrosFilas">
                    <td><?php if ($r->brewData != NULL) { ?>
                        <input name="chk[]" type="checkbox" value="<?php echo $r->id; ?>">
                      <?php } else {
                          echo $language_cfg["noChart"];
                        }
                      ?>
                    </td>
                    <td><?php echo $r->id; ?></td>
                    <td><?php if ($r->name != NULL) {
                          echo $r->name;
                        } else {
                          echo "NaN";
                        }
                        ?></td>
                    <td><?php if ($r->createdAt != NULL) {
                          echo $r->createdAt;
                        } else {
                          echo "NaN";
                        }
                        ?></td>
                    <td><?php if ($r->totalTime != NULL) {
                          echo gmdate("H:i:s", $r->totalTime);
                        } else {
                          echo "NaN";
                        }
                        ?></td>
                    <td><?php if ($r->averageFlowrate != NULL) {
                          echo $r->averageFlowrate;
                        } else {
                          echo "NaN";
                        }
                        ?></td>
                    <td><?php if ($r->totalWeight != NULL) {
                          echo $r->totalWeight;
                        } else {
                          echo "NaN";
                        }
                        ?></td>
                    <td><?php if ($r->brewData != NULL) { ?>
                        <a href="?controller=index&action=getGraficabyId&id2=<?php echo $r->id; ?>#collapseGraficaPesos"><?php echo $language_cfg["chart"]; ?></a>
                      <?php } else {
                          echo $language_cfg["noChart"];
                        }
                      ?>
                    </td>
                    <td><a onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?controller=index&action=borrar&id=<?php echo $r->id; ?>#collapseRegistros"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                  </tr></strong>
                <?php } ?>
              </table>
              <button type="submit" name="charts" class="btn-submit"><?php echo $language_cfg["showChart"]; ?></button>
            </form>
          <?php } else {
          ?>
            <section class="alert alert-info" role="alert">
              <?php echo $language_cfg["alertRecords"]; ?>
            </section>
          <?php } ?>
        </section>
      </article>
    </section>

    <!-- Sección de la gráfica con la variación de los pesos en el tiempo -->
    <!-- Section of the chart with the variation of the weights over time -->
    <section class="graficaPesos">
      <article>
        <h2><a data-toggle="collapse" href="#collapseGraficaPesos" class="desplegableButtonMaster"><?php echo $language_cfg["weights"]; ?></a></h2>

        <!-- Formulario para cambiar el tipo de gráfica -->
        <!-- Form to change the type of chart -->
        <?php if (isset($dataPointsGraficabyId) || isset($dataPointsGraficabyIdSeconds) || isset($dataPointsGraficabyIdBase)) { ?>
          <form class="form-horizontal" name="getGraficabyId" id="getGraficabyId" action="" method="post">
            <section class="input-row">
              <label><strong><?php echo $language_cfg["charts"]; ?></strong></label>
              <?php if (isset($_POST["chartOption"])) {
                $chartOption = $_POST["chartOption"];
              } else {
                $chartOption = null;
              }
              ?>
              <select name="chartOption">
                <option value="?controller=index&action=getGraficabyId&id2=<?php echo $identificador; ?>#collapseGraficaPesos"><?php echo $language_cfg["charts1"]; ?></option>
                <option value="?controller=index&action=getGraficabyId2&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId2") {
                                                                                                                                  echo "selected";
                                                                                                                                } ?>><?php echo $language_cfg["charts2"]; ?></option>
                <option value="?controller=index&action=getGraficabyId3&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId3") {
                                                                                                                                  echo "selected";
                                                                                                                                } ?>><?php echo $language_cfg["charts3"]; ?></option>
                <option value="?controller=index&action=getGraficabyId4&franjas=10&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId4" && substr($chartOption, 49, 2) == "10") {
                                                                                                                                              echo "selected";
                                                                                                                                            } ?>><?php echo $language_cfg["charts4"]; ?></option>
                <option value="?controller=index&action=getGraficabyId4&franjas=20&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId4" && substr($chartOption, 49, 2) == "20") {
                                                                                                                                              echo "selected";
                                                                                                                                            } ?>><?php echo $language_cfg["charts5"]; ?></option>
                <option value="?controller=index&action=getGraficabyId4&franjas=50&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId4" && substr($chartOption, 49, 2) == "50") {
                                                                                                                                              echo "selected";
                                                                                                                                            } ?>><?php echo $language_cfg["charts6"]; ?></option>
                <option value="?controller=index&action=getGraficabyId4&franjas=100&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 15) == "getGraficabyId4" && substr($chartOption, 49, 3) == "100") {
                                                                                                                                              echo "selected";
                                                                                                                                            } ?>><?php echo $language_cfg["charts7"]; ?></option>
                <option value="?controller=index&action=getGraficabyIdProphet&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 21) == "getGraficabyIdProphet") {
                                                                                                                                        echo "selected";
                                                                                                                                      } ?>><?php echo $language_cfg["chartsProphet"]; ?></option>
                <option value="?controller=index&action=getGraficabyIdProphetFit&id2=<?php echo $identificador; ?>#collapseGraficaPesos" <?php if (isset($chartOption) && substr($chartOption, 25, 24) == "getGraficabyIdProphetFit") {
                                                                                                                                            echo "selected";
                                                                                                                                          } ?>><?php echo $language_cfg["chartsProphetFit"]; ?></option>
              </select>
              <button type="submit" class="btn-submit" onclick="showHide()"><?php echo $language_cfg["changeChart"]; ?></button>
            </section>
          </form>
          <div class="loader" id="loader" style="display:none"></div>
          <script type="text/javascript">
            document.getElementById('getGraficabyId').chartOption.onchange = function() {
              var newaction = this.value;
              document.getElementById('getGraficabyId').action = newaction;
            };
          </script>
          <script type="text/javascript">
            function showHide() {
              var div = document.getElementById("loader");
              if (div.style.display == 'none') {
                div.style.display = '';
              } else {
                div.style.display = 'none';
              }
            }
          </script>
        <?php } ?>

        <!-- Gráfica con la variación de los pesos en el tiempo -->
        <!-- Chart with the variation of weights over time -->
        <section id="collapseGraficaPesos" class="panel-collapse collapse show">
          <?php if (isset($dataPointsGraficabyId)) { ?>
            <section id="chartContainer" name="chartContainer" style="height: 370px; width: 100%;"></section>
            <?php } else if (isset($dataPointsGraficabyIdSeconds) || isset($dataPointsGraficabyIdBase)) {
            if (isset($dataPointsGraficabyIdSeconds)) { ?>
              <section id="chartContainer3" name="chartContainer3" style="height: 370px; width: 100%;"></section>
            <?php } else if (isset($dataPointsGraficabyIdBase)) { ?>
              <section id="chartContainer4" name="chartContainer4" style="height: 370px; width: 100%;"></section>
            <?php } ?>
            <section class="DatosProphet">
              <article>
                <h3><a data-toggle="collapse" href="#collapseDatosProphet" class="desplegableButtonMaster"><?php echo $language_cfg["+info"]; ?></a></h3>

                <!-- Sección de la tabla con todos los datos de Prophet -->
                <!-- Table section with all the Prophet data -->
                <section id="collapseDatosProphet" class="panel-collapse collapse show">
                  <?php if (isset($dataProphet)) { ?>
                    <table class="tableDatosProphet">
                      <caption><?php echo $language_cfg["caption2"]; ?></caption>
                      <tr class="registrosColumnas">
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet1"]; ?></th>
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet2"]; ?></th>
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet3"]; ?></th>
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet4"]; ?></th>
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet5"]; ?></th>
                        <th class="text-center" scope="col"><?php echo $language_cfg["dataProphet6"]; ?></th>
                      </tr>
                      <tr class="registrosFilas">
                        <td><?php echo $dataProphet[0] ?></td>
                        <td><?php echo $dataProphet[1] ?></td>
                        <td><?php echo $dataProphet[2] ?></td>
                        <td><?php echo $dataProphet[3] ?></td>
                        <td><?php echo $dataProphet[4] ?></td>
                        <td><?php echo $dataProphet[5] ?></td>
                      </tr>
                    </table>
                  <?php } ?>
                </section>
                <article>
            </section>
          <?php } else { ?>
            <section class="alert alert-info" role="alert">
              <?php echo $language_cfg["alertWeights"]; ?>
            </section>
          <?php } ?>
        </section>
        <article>
    </section>

    <!-- Sección de la gráfica con la variación de los pesos en el tiempo (con múltiples registros) -->
    <!-- Section of the chart with the variation of the weights over time (with multiple records) -->
    <section class="graficaPesos2">
      <article>
        <h2><a data-toggle="collapse" href="#collapseGraficaPesos2" class="desplegableButtonMaster"><?php echo $language_cfg["weights2"]; ?></a></h2>

        <!-- Gráfica con la variación de los pesos en el tiempo (con múltiples registros) -->
        <!-- Chart with the variation of weights over time (with multiple records) -->
        <section id="collapseGraficaPesos2" class="panel-collapse collapse show">
          <?php if (isset($dataPointsGraficabyIds)) { ?>
            <section id="chartContainer2" name="chartContainer2" style="height: 370px; width: 100%;"></section>
          <?php } else { ?>
            <section class="alert alert-info" role="alert">
              <?php echo $language_cfg["alertWeights"]; ?>
            </section>
          <?php } ?>
        </section>
        <article>
    </section>

  </section>
</section>

<!-- Se incluye el pie de página -->
<!-- Footer is included -->
<?php include "footer.php"; ?>