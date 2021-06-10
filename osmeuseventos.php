<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="description" content="Grupo Experimental de Teatro da Universidade de Aveiro">
    <meta name="keywords" content="cultura, arte, música, teatro, dança">
    <meta name="author" content="Simão Bentes">
    <meta name="apple-mobile-web-app-title" content="GrETUA">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="manifest" href="manifest.json">
    <title>GrETUA</title>
</head>
<body>
<section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
    <div class="row gx-0 align-items-center">
        <div class="col-auto">
            <a href="conta.php" class="text-white"><i class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
        </div>
        <div class="col-auto ps-3">
            <h3 class="mb-0">Os meus eventos</h3>
        </div>
    </div>
</section>
<main>
    <section class="container-fluid py-5 mb-4">
        <div class="row">
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h2 class="top-right mb-0">Ruínas</h2>
                            <div class="row">
                                <div class="col text-cinza">28 abril</div>
                                <div class="col text-cinza text-center">22h30</div>
                                <div class="col text-cinza text-end">teatro</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center">
                    <div class="col-auto">
                        <h3 class="mb-0 ps-2">34 pessoas vão</h3>
                    </div>
                    <div class="col-auto">
                        <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
                    </div>
                </div>
            </div>
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/palmieres.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h2 class="top-right mb-0">P A L M I E R E S</h2>
                            <div class="row">
                                <div class="col text-cinza">1 junho</div>
                                <div class="col text-cinza text-center">22h30</div>
                                <div class="col text-cinza text-end">concerto</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center">
                    <div class="col-auto">
                        <h3 class="mb-0 ps-2">51 pessoas vão</h3>
                    </div>
                    <div class="col-auto">
                        <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
                    </div>
                </div>
            </div>
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/ninguem.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h2 class="top-right mb-0">Ninguém, Deeogo Oliveira</h2>
                            <div class="row">
                                <div class="col text-cinza">8 junho</div>
                                <div class="col text-cinza text-center">22h30</div>
                                <div class="col text-cinza text-end">concerto</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center">
                    <div class="col-auto">
                        <h3 class="mb-0 ps-2">38 pessoas vão</h3>
                    </div>
                    <div class="col-auto">
                        <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
                    </div>
                </div>
            </div>
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/angelica.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h2 class="top-right mb-0">Angélica Salvi - Phantone</h2>
                            <div class="row">
                                <div class="col text-cinza">25 maio</div>
                                <div class="col text-cinza text-center">22h30</div>
                                <div class="col text-cinza text-end">concerto</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center">
                    <div class="col-auto">
                        <h3 class="mb-0 ps-2">53 pessoas vão</h3>
                    </div>
                    <div class="col-auto">
                        <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>

<?php include_once "components/tab_bar.php" ?>


<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>