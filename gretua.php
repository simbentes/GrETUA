<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>
<body>
<?php include_once "components/navigation_bar.php" ?>
<main class="py-5">
    <section class="container-fluid pt-2 pb-4">
        <div class="row">
            <div class="col-12 py-3">
                <div class="card memoriafeed">
                    <img src="img/supernova.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="row row-cols-auto justify-content-between align-items-end">
                            <div class="col">
                                <h3 class="card-title mb-0">Supernova</h3>
                            </div>
                            <div class="col">
                                <a href="memoria.php" class="btn btn-memoriafeed">Ver Memória</a>
                            </div>
                            <div class="pt-3 pb-2">
                                <p class="card-text">Os Supernova em Aveiro. Um concerto incrível proporcionado pelo
                                    GrETUA.</p>
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
                                    <img src="img/josepereira.jpg" class="userbubble">
                                    <span class="utilizador">José Pereira</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <img src="img/ninguem.jpg" class="card-img-top" alt="...">
                    <button class="btn btn-like">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                             class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </button>
                    <div class="card-body">
                        <h5 class="card-title">Arte no seu estado mais puro</h5>
                        <p class="card-text">O virtuoso portuense veio para os palcos para ficar. O espectáculo
                            “Ninguém”,
                            cruza as linguagens da dança, do teatro e do circo contemporâneo.</p>
                        <hr>
                        <div class="row row-cols-auto">
                            <div class="col pe-0">
                                <img src="img/sikvi.jpg" class="userbubble">
                            </div>

                            <div class="col comentarform">
                                <form>
                                    <input type="text" class="form-control comentar" id="exampleInputEmail1"
                                           placeholder="Comentar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/da_chick.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h1 class="top-right mb-0">Da Chick</h1>
                            <div class="row">
                                <div class="col text-cinza">4 de junho</div>
                                <div class="col text-cinza text-center">21h00</div>
                                <div class="col text-cinza text-end">concerto</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center">
                    <div class="col-auto">
                        <h3 class="mb-0 ps-2">47 pessoas vão</h3>
                    </div>
                    <div class="col-auto">
                        <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
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
                                <img src="img/joaoalves.jpg" class="userbubble">
                                <span class="utilizador">João Alves</span>
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
                    <p class="card-text">Mais uma noite de Jam Sessions. Um concerto único.</p>

                    <hr>
                    <div class="row row-cols-auto">
                        <div class="col pe-0">
                            <img src="img/sikvi.jpg" class="userbubble">
                        </div>

                        <div class="col comentarform">
                            <form>
                                <input type="text" class="form-control comentar" id="exampleInputEmail1"
                                       placeholder="Comentar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</main>
<div class="position-relative">
    <section id="pub" class="py-4 container-fluid px-4 pub">

        <div class="text-end">
            <button id="btnfechar" class="btn btn-transparente btn-fechar">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 28 28">
                    <path d="M22.7,22.7c-4.8,4.8-12.5,4.8-17.3,0s-4.8-12.5,0-17.3s12.5-4.8,17.3,0S27.4,17.9,22.7,22.7z M23.9,23.9
               c5.5-5.5,5.5-14.3,0-19.8S9.6-1.4,4.1,4.1s-5.5,14.3,0,19.8S18.4,29.4,23.9,23.9z"/>
                    <path d="M9.1,9.1c0.3-0.3,0.9-0.3,1.2,0l3.7,3.7l3.7-3.7c0.3-0.3,0.9-0.3,1.2,0c0.3,0.3,0.3,0.9,0,1.2L15.2,14l3.7,3.7
               c0.3,0.3,0.3,0.9,0,1.2c-0.3,0.3-0.9,0.3-1.2,0L14,15.2l-3.7,3.7c-0.3,0.3-0.9,0.3-1.2,0c-0.3-0.3-0.3-0.9,0-1.2l3.7-3.7l-3.7-3.7
               C8.7,9.9,8.7,9.4,9.1,9.1z"/>
                </svg>
            </button>
        </div>
        <h2>Nova Publicação</h2>
        <hr>
        <form>
            <textarea id="textopub" class="form-control textopub" aria-label="With textarea"
                      placeholder="Conta-nos a tua memória..."></textarea>
        </form>
        <div class="row">
            <div class="col-12">
                <img class="fotoinput d-none" id="output"/>
            </div>
        </div>
        <div class="menu-pub">
            <div class="row align-items-center submenu g-3">
                <div class="col-auto">
                    <div class="text-end me-2">
                        <label for="avatar" id="maquina">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-camera h1 mb-0"></i></div>
                        </label>
                    </div>
                    <input type="file" id="avatar" class="d-none" name="avatar" accept="image/png, image/jpeg"
                           onchange="loadFile(event)">
                </div>
                <div class="col-auto">
                    <a class="btn btn-pub" href="gretua.php">Publicar</a>
                </div>
            </div>
        </div>


    </section>

</div>
<?php include_once "components/tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script type="text/javascript">
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
        document.getElementById('maquina').classList.add("d-none");
        document.getElementById('output').classList.remove("d-none");
        document.getElementById("textopub").rows = "3";

    };
</script>
</body>
</html>