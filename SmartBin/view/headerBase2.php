<!-- Segunda parte de la cabecera, con el logo y la barra de navegación -->
<!-- Second part of the header, with the logo and the navigation bar -->
</head>

<body>
    <section class="wrapper">
        <header class="header">
            <figure><img alt="Logo Ucam" src="./assets/img/logo.png" alt="Banner Smart Bin" width="15%" style="margin-top: 12px;"></figure>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="?controller=index&action=index"><?php echo $language_cfg["home"]; ?><span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=vistas&action=index" id="navbarDropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $language_cfg["views"]; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=configuracion&action=index" id="navbarDropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false">
                            <?php echo $language_cfg["configuration"]; ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Formulario para cambiar el idioma -->
            <!-- Form to change the language -->
            <form class="form-horizontal" name="cambiarIdioma" id="cambiarIdioma" action="?controller=configuracion&action=cambiarIdioma&idioma=es&vista=<?php echo $vista ?>" method="post">
                <section class="input-row">
                    <input style="float:right;" type="image" src="./assets/img/spanish.png" name="submit" width="50" height="50" alt="submit" />
                </section>
            </form>
            <form class="form-horizontal" name="cambiarIdioma" id="cambiarIdioma" action="?controller=configuracion&action=cambiarIdioma&idioma=en&vista=<?php echo $vista ?>" method="post">
                <section class="input-row">
                    <input style="float:right;" type="image" src="./assets/img/english.png" name="submit" width="50" height="50" alt="submit" />
                </section>
            </form>
        </nav>