<?php
require_once "connections/connection.php";


if (isset($_GET["memoria"])) {
    $memoriaid = $_GET["memoria"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT DATE(data_eventos.data), eventos.nome, fotos_eventos.foto, eventos.descricao FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND eventos.id_eventos = ? AND data_eventos.data < NOW() AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)
ORDER BY data_eventos.data DESC;";

    if (mysqli_stmt_prepare($stmt, $query)) {


        mysqli_stmt_bind_param($stmt, "i", $memoriaid);

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $data, $nome, $foto, $desc);

        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            /* fetch values */
            mysqli_stmt_fetch($stmt);
            if(!isset($foto)){
                $foto = "evento_default.png";
            }
            ?>

            <div class="position-relative">
                <section class="container px-0 frame-img">
                    <div id="framefotoevento" class="framefotoevento" style="background-image: url('img/eventos/<?= $foto ?>')">
                        <div class="degrade-imagem"></div>
                        <a id="voltar" href="memorias.php" class="voltar"><i class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                        <div id="share" class="share" onclick="partilharLink()"><i
                                    class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                        </div>
                    </div>
                    <script>
                        function partilharLink() {
                            if (navigator.share) {
                                navigator.share({
                                    title: '<?= $nome ?>',
                                    text: 'memorias... <?= $nome?>',
                                    url: window.location.href,
                                })
                                    .then(() => console.log('Successful share'))
                                    .catch((error) => console.log('Error sharing', error));
                            }
                        }
                    </script>
                </section>
                <section class="container g-0 evento-text">
                    <div>
                        <div class="evento-titulo px-3">
                            <h1><?= $nome ?></h1>
                            <p><?= $desc ?></p>
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
                            <h5 class="pt-1 text-center"><?= $data ?></h5>
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
                                                    <img src="img/users/joaoalves.jpg" class="userbubble">
                                                    <span class="utilizador">João Alves</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="img/eventos/publico.jpg" class="card-img-top" alt="...">
                                    <button class="btn btn-like">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor"
                                             class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </button>
                                    <div class="card-body">
                                        <h5 class="card-title">A melhor maneira de terminar o ano</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p>

                                        <hr>
                                        <div class="row row-cols-auto">
                                            <div class="col pe-0">
                                                <img src="img/users/sikvi.jpg" class="userbubble">
                                            </div>

                                            <div class="col comentarform">
                                                <form>
                                                    <input type="text" class="form-control comentar"
                                                           id="exampleInputEmail1" placeholder="Comentar">
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

            <?php

        } else {
            //não existe ou o seu vendedor está desativado
            header("Location: catalogo.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    //não existe nenhuma query string do album
    header("Location: gretua.php");
}


?>































