<!-- Primera parte de la cabecera, con metadatos, y enlaces a hojas de estilo y scripts -->
<!-- First part of the header, with metadata, and links to style sheets and scripts -->
<?php $language_cfg = require_once IDIOMA_DEFECTO ?>
<!DOCTYPE html>
<?php if (!isset($_COOKIE['idioma']) || $_COOKIE['idioma'] == "es") {
    $idioma = "es";
} else if ($_COOKIE['idioma'] == "en") {
    $idioma = "en";
}
?>
<html class="no-js" lang=<?php echo $idioma; ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $language_cfg["title"]; ?></title>
    <meta name="description" content="Página web para la visualización de los registros de un sensor de peso">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="aplicación web, visualización de datos, smart bin, registros, pesos, residuos, sensor de peso" />
    <meta name="author" content="Alberto Pons Buttazzo" />
    <meta name="copyright" content="Alberto Pons Buttazzo" />
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link href="assets/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/main.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>