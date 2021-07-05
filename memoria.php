<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>
<body>
<div class="position-relative">
    <section class="container px-0 frame-img">
        <div class="position-relative">
            <img class="img-fluid framefotoevento" src="img/jam_session.jpg"/>
            <div class="degrade-imagem"></div>
            <a href="memorias.php" class="voltar"><i class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
        </div>
    </section>
    <section class="container g-0 evento-text">
        <div>
            <div class="evento-titulo px-3">
                <h1>Jam Session</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lacinia suscipit neque a tempus.
                    Donec eu
                    elementum nisl, tempus tincidunt velit. Duis varius hendrerit neque eleifend sagittis. Curabitur
                    fermentum
                    fermentum pellentesque.</p>
            </div>
            <div class="pb-4">
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
                <h5 class="pt-1 text-center">outubro 2017</h5>
            </div>
        </div>
        <section class="container-fluid px-4">
            <h5 class="text-center">conta-nos as tuas memórias</h5>
            <button class="btn btn-grande w-100">Publicar</button>
        </section>
        <section class="container-fluid px-3 pt-4 pb-5 mb-4">
            <div class="row">

                <div class="col-12 py-3">
                    <div class="card pubfeed">
                        <div class="card-body">
                            <div class="row row-cols-auto justify-content-between">
                                <div class="col">
                                    <div class="infouser">
                                        <img src="img/users/espacos_gretua_2.jpg" class="userbubble">
                                        <span class="utilizador">José Manuel</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="img/jam.jpeg" class="card-img-top" alt="...">
                        <button class="btn btn-like">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </button>
                        <div class="card-body">
                            <h5 class="card-title">Concerto memorável</h5>
                            <p class="card-text">Mais uma Jam Sessions a deixar memórias únicas.</p>

                            <hr>
                            <div class="row row-cols-auto">
                                <div class="col pe-0">
                                    <img src="img/users/sikvi.jpg" class="userbubble">
                                </div>

                                <div class="col comentarform">
                                    <form>
                                        <input type="text" class="form-control comentar" id="exampleInputEmail1" placeholder="Comentar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 py-3">
                    <div class="card pubfeed">
                        <div class="card-body">
                            <div class="row row-cols-auto justify-content-between">
                                <div class="col">
                                    <div class="infouser">
                                        <img src="img/users/joaoalves.jpg" class="userbubble">
                                        <span class="utilizador">João Alves</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="img/publico.jpg" class="card-img-top" alt="...">
                        <button class="btn btn-like">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </button>
                        <div class="card-body">
                            <h5 class="card-title">A melhor maneira de terminar o ano</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                            <hr>
                            <div class="row row-cols-auto">
                                <div class="col pe-0">
                                    <img src="img/users/sikvi.jpg" class="userbubble">
                                </div>

                                <div class="col comentarform">
                                    <form>
                                        <input type="text" class="form-control comentar" id="exampleInputEmail1" placeholder="Comentar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>

<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>