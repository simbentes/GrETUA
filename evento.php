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
<div class="position-relative">
    <section class="container px-0 frame-img">
        <div class="position-relative">
            <img class="img-fluid framefotoevento" src="img/jose_valente.jpg"/>
            <div class="degrade-imagem"></div>
            <a href="eventos.php" class="voltar"><i class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
        </div>
    </section>
    <section class="container evento-text">
        <div>
            <div class="evento-titulo px-3">
                <h1>José Valente</h1>
                <div class="row">
                    <h6 class="col text-cinza">12 agosto</h6>
                    <h6 class="col text-cinza text-center">22h30</h6>
                    <h6 class="col text-cinza text-end">teatro</h6>
                </div>
                <div class="row">
                    <div class="col text-cinza text-center py-3">
                        <strong>Estudante: 3€ | Não Estudante: 5€</strong>
                    </div>
                </div>
            </div>
            <div class="container">
                <p>Sobre o espaço que habitamos e que nos habita, surgem 7 propostas dramatúrgicas feitas das histórias
                    que se passam em cada uma das 7 divisões de uma casa.</p>
            </div>
        </div>
        <div class="row">
            <div class="col pe-1 text-center">
                <button type="button" class="btn btn-pequeno w-100" data-bs-toggle="modal"
                        data-bs-target="#reservarBilheteModal"><i class="bi bi-pen d-block"></i><span
                        class="d-block">Reservar</span></button>
            </div>
            <div class="col ps-1 text-center">
                <button class="btn btn-pequeno w-100"><i class="bi bi-bookmark d-block"></i><span
                        class="d-block">Guardar</span></button>
            </div>
        </div>
        <!-- Modal -->
        <section class="modal fade" id="reservarBilheteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content p-0">
                    <div class="modal-body text-center">
                        <h5 class="mt-3">O teu bilhete foi reservado.</h5>
                        <i class="bi bi-check-circle fa-5x"></i>
                        <p class="py-2 m-0">Verifica na aba "Reservas" da tua conta.</p>
                    </div>
                    <div class="modal-footer p-0">
                        <a type="button" class="btn botaomodal py-3 m-0 w-100"
                           href="evento.php">CONTINUAR
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="container-fluid py-5 mb-5">
            <h3>Ficha Técnica</h3>
            <div><strong>Conceção e direção artística:</strong></div>
            <div>ALEXANDRA FILIPE</div>
            <div>FLOR DA MATA</div>
            <div> JOÃO SANTOS</div>
            <div> SARA GONÇALVES</div>
            <div class="pt-2"><strong>Interpretação: </strong></div>
            <div> "JOSÉ VALENTE"</div>
            <div class="pt-2"><strong>Elenco</strong>"Músicos a Brincar"</div>
            <div class="pt-2"><strong> Vozes:</strong> ALEXANDRA FILIPE, soprano</div>
            <div> BEATRIZ NUNES, soprano</div>
            <div> JOANA DINIS DA FONSECA, mezzo-soprano</div>
            <div> SARA GONÇALVES, soprano</div>
            <div class="pt-2"><strong>Instrumentistas:</strong> FLOR DA MATA, flauta</div>
            <div> DIOGO CHAVES, guitarra</div>
            <div> JOÃO SANTOS, guitarra</div>
        </div>
    </section>
</div>


<?php include_once "components/tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>