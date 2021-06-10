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
<section class="container py-3">
    <form action="eventos.php">
        <input type="text" id="search-bar" name="pesquisa"
               class="form-control forminfo barrapesquisa"
               placeholder="Pesquisar">
    </form>
</section>

<section class="container px-3">
    <div class="botaomultiplo">

        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio0" autocomplete="off" checked>
            <label class="btn btn-multiplo-primary" for="btnradio0">Todos</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
            <label class="btn btn-multiplo-primary" for="btnradio1">Teatro</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-multiplo-primary" for="btnradio2">Música</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-multiplo-primary px-0" for="btnradio3">Workshops</label>
        </div>
    </div>
</section>
<section>
    <div class="container pt-5">
        <h2 class="mb-0">próximos eventos</h2>
    </div>
    <div class="container px-0">

        <div class="eventos text-black-50">
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/circo.jpg">
                    <div class="desc-evento container-fluid">
                        <h6>Circo Contemporâneo</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/jose.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">José Valente</h6>
                        <div class="row">
                            <div class="col text-cinza">12 agosto</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ruínas</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/jam_session.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Jam Sessions</h6>
                        <div class="row">
                            <div class="col text-cinza">16 de julho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>
<section>
    <div class="container pt-4">
        <h2 class="mb-0">os meus eventos</h2>
    </div>
    <div class="container px-0">

        <div class="eventos text-black-50">
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/da_chick.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Da Chick</h6>
                        <div class="row">
                            <div class="col text-cinza">4 junho</div>
                            <div class="col text-cinza text-center">21h00</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ruínas</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/palmieres.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">P A L M I E R E S</h6>
                        <div class="row">
                            <div class="col text-cinza">1 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/ninguem.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ninguém, de Deeogo Oliveira</h6>
                        <div class="row">
                            <div class="col text-cinza">8 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="evento.php">
                <div class="evento">
                    <img class="img-fluid img-evento" src="img/angelica.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Angélica Salvi - Phantone</h6>
                        <div class="row">
                            <div class="col text-cinza">25 de maio</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>


<?php include_once "components/tab_bar.php" ?>

<!-- Javascript -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
