<!DOCTYPE html>
<html lang="pt">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="description" content="Grupo Experimental de Teatro da Universidade de Aveiro">
    <meta name="keywords" content="cultura, arte, música, teatro, dança">
    <meta name="author" content="Simão Bentes">
    <meta name="apple-mobile-web-app-title" content="GrETUA">
    <meta name="theme-color" content="#111111">
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
    <link rel="apple-touch-icon" href="img/logos/maskable_icon_x192.png">
    <title>GrETUA</title>
</head>
<body>
<div class="botaoperfil">
    <button type="button" class="btn btn-transparente" id="botaoperfil">
        <i class="bi bi-three-dots-vertical h2"></i>
    </button>
</div>

<section class="container pt-4">
    <div class="row justify-content-center align-items-center">
        <div class="col-4">
            <img class="img-fluid rounded-circle" src="img/sikvi.jpg">
        </div>
        <div class="col-auto">
            <h2 class="mb-0">Joana Silva</h2>
            <span class="badge bg-success">ENCENADORA</span>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div type="button" class="btn btn-outline-light w-100 editar-perfil">
        Editar perfil
    </div>
</section>
<section class="py-3">
    <!--
        <div class="text-center small">MEMBRO DESDE</div>
    -->
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.12 27.37">
            <defs>
                <style>.cls-1 {
                        fill: none;
                        stroke-width: 4px;
                    }

                    .cls-1, .cls-3 {
                        stroke: #fff;
                        stroke-miterlimit: 10;
                    }

                    .cls-2, .cls-3 {
                        fill: #fff;
                    }</style>
            </defs>
            <g id="Layer_2" data-name="Layer 2">
                <g id="Layer_1-2" data-name="Layer 1">
                    <line class="cls-1" y1="13.69" x2="483.12" y2="13.69"/>
                    <line class="cls-2" y1="13.69" x2="483.12" y2="13.69"/>
                    <circle class="cls-3" cx="241.56" cy="13.69" r="13.19"/>
                </g>
            </g>
        </svg>
    </div>
    <h5 class="pt-1 text-center">17 abril 2021</h5>
</section>


<section class="container-fluid">
    <div class="evento-text"></div>

    <h2>Juntei-me ao GrETUA</h2>

</section>
<div class="container-fluid">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lacinia suscipit neque a tempus. Donec eu
        elementum nisl, tempus tincidunt velit. Duis varius hendrerit neque eleifend sagittis. <span
                id="dots">... </span><span id="more">Curabitur fermentum
            fermentum pellentesque.Curabitur fermentum
            fermentum pellentesque.</span></p>
    <p onclick="readMore()" id="myBtn" class="ler">Ler mais</p>
</div>

<section class="container-fluid pt-4 px-5 contactos">
    <div class="btn btn-light w-100">Contactos</div>
    <a href="https://instagram.com/" target="_blank">
        <div class="row g-0 justify-content-center py-3 pb-2">
            <div class="col-auto">
                <i class="bi bi-instagram h3"></i>
            </div>
            <div class="col-auto ps-2">
                Instagram
            </div>
        </div>
    </a>
    <a href="https://web.whatsapp.com/" target="_blank">
        <div class="row g-0 justify-content-center py-2">
            <div class="col-auto">
                <i class="bi bi-whatsapp h3"></i>
            </div>
            <div class="col-auto ps-2">
                WhatsApp
            </div>
        </div>
    </a>
    <a href="mailto:joana@gmail.com">
        <div class="row g-0 justify-content-center py-2">
            <div class="col-auto ps-2">
                joana@gmail.com
            </div>
        </div>
    </a>
</section>


<section id="perfilbottom" class="perfil-bottom container">
    <div class="pb-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="reservas.php">
                    <div class="row g-0 align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="row g-0 align-items-center">
                                <div class="col-auto pe-2">
                                    <i class="bi bi-pen h1"></i>
                                </div>
                                <div class="col-auto mb-1">
                                    Reservas
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chevron-right h6"></i>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="osmeuseventos.php">
                    <div class="row g-0 align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="row g-0 align-items-center">
                                <div class="col-auto pe-2">
                                    <i class="bi bi-calendar-check h1"></i>
                                </div>
                                <div class="col-auto mb-1">
                                    Os meus eventos
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chevron-right h6"></i>
                        </div>
                    </div>
                </a>
            </li>
            <li class="list-group-item">
                <a href="index.php">
                    <div class="row g-0 align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="row g-0 align-items-center">
                                <div class="col-auto pe-2">
                                    <i class="bi bi-box-arrow-right h1"></i>
                                </div>
                                <div class="col-auto mb-1">
                                    Terminar Sessão
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chevron-right h6"></i>
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</section>

<?php include_once "components/tab_bar.php" ?>


<!-- Javascript -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">

    document.getElementById("botaoperfil").onclick = function () {
        console.log("clickads")
        document.getElementById("perfilbottom").classList.toggle("animaperfil");

    }

</script>
</body>
</html>
