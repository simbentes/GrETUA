<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:


    if (isset($_GET["memoria"])) {
        $memoriaid = $_GET["memoria"];

        require_once "connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT DATE_FORMAT(DATE(data_eventos.data),'%d!%m-%Y'), eventos.nome, ficha_tecnica, fotos_eventos.foto, descricao_curta, eventos.descricao, classificacao_etaria, duracao, id_artistas, artistas.nome FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
INNER JOIN artistas
ON artistas.id_artistas = eventos.ref_id_artistas
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND eventos.id_eventos = ? AND data_eventos.data < NOW() AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)
ORDER BY data_eventos.data DESC;";

        if (mysqli_stmt_prepare($stmt, $query)) {


            mysqli_stmt_bind_param($stmt, "i", $memoriaid);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $data_memoria, $nome, $f_tecnica, $foto, $desc_curta, $desc, $c_etaria, $duracao, $id_artista, $artista);

            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                /* fetch values */
                mysqli_stmt_fetch($stmt);
                if (!isset($foto)) {
                    $foto = "evento_default.png";
                }

                $meses = array("!01-", "!02-", "!03-", "!04-", "!05-", "!06-", "!07-", "!08-", "!09-", "!10-", "!11-", "!12-");
                $str_meses = array(" de janeiro de ", " de fevereiro de ", " de março de ", " de abril de ", " de maio de ", " de junho de ", " de julho de ", " de agosto de ", " de setembro de ", " de outubro de ", " de novembro de ", " de dezembro de ");
                $data_str = str_replace($meses, $str_meses, $data_memoria);
                ?>
                <div class="position-relative">
                    <section class="container px-0 frame-img">
                        <div id="framefotoevento" class="framefotoevento"
                             style="background-image: url('img/eventos/<?= htmlspecialchars($foto) ?>')">
                            <div class="degrade-imagem"></div>
                            <a id="voltar" href="memorias.php" class="voltar"><i
                                        class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                            <div id="share" class="share" onclick="partilharLink()"><i
                                        class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                            </div>
                        </div>
                        <script>
                            function partilharLink() {
                                if (navigator.share) {
                                    navigator.share({
                                        title: '<?= htmlspecialchars($nome) ?>',
                                        text: 'memorias... <?= htmlspecialchars($nome)?>',
                                        url: window.location.href,
                                    })
                                        .then(() => console.log('Successful share'))
                                        .catch((error) => console.log('Error sharing', error));
                                }
                            }
                        </script>

                        <section class="memoria-text">
                            <div class="container-fluid">
                                <div class="evento-titulo px-2">
                                    <div class="evento-titulo">
                                        <h1><?= htmlspecialchars($nome) ?></h1>
                                        <p><?= htmlspecialchars($desc_curta) ?></p>
                                    </div>

                                </div>
                                <div class="row justify-content-center align-items-center py-3">
                                    <div class="col-auto">
                                        <a href="artista.php?artista=<?= htmlspecialchars($id_artista) ?>" class="artistabtn">
                                            <div class="row align-items-center g-2">
                                                <div class="col-auto">
                                                    <img src="img/eventos/<?php

                                                    $query = "SELECT foto FROM `fotos_eventos` 
INNER JOIN eventos 
ON eventos.id_eventos = fotos_eventos.ref_id_eventos
WHERE eventos.ref_id_artistas = ?;";

                                                    if (mysqli_stmt_prepare($stmt, $query)) {
                                                        mysqli_stmt_bind_param($stmt, "i", $id_artista);
                                                        mysqli_stmt_execute($stmt);

                                                        mysqli_stmt_bind_result($stmt, $foto);

                                                        while (mysqli_stmt_fetch($stmt)) {
                                                            $array_fotos[] = $foto;
                                                        }

                                                        if (isset($array_fotos)) {
                                                            echo $array_fotos[array_rand($array_fotos)];
                                                        }

                                                    } else {
                                                        echo "Error: " . mysqli_error($link);
                                                    }
                                                    ?>" class="fotoperfilartista">
                                                </div>
                                                <div class="col-auto fw-700">
                                                    <?= htmlspecialchars($artista) ?>
                                                    <svg width="14" height="14" viewBox="0 0 16 16"
                                                         xmlns="http://www.w3.org/2000/svg"
                                                         xmlns:svg="http://www.w3.org/2000/svg"
                                                         class="bi bi-check-circle">
                                                        <g>
                                                            <title>Layer 1</title>
                                                            <circle id="svg_5" r="7.52393" cy="8" cx="8"
                                                                    stroke-dasharray="null"
                                                                    stroke-width="null" fill="#007fff"/>
                                                            <path fill="#ffffff" id="svg_1"
                                                                  d="m8,15a7,7 0 1 1 0,-14a7,7 0 0 1 0,14zm0,1a8,8 0 1 0 0,-16a8,8 0 0 0 0,16z"/>
                                                            <path fill="#ffffff" id="svg_2"
                                                                  d="m10.97,4.97a0.235,0.235 0 0 0 -0.02,0.022l-3.473,4.425l-2.093,-2.094a0.75,0.75 0 0 0 -1.06,1.06l2.646,2.647a0.75,0.75 0 0 0 1.079,-0.02l3.992,-4.99a0.75,0.75 0 0 0 -1.071,-1.05z"/>
                                                            <circle id="svg_7" r="0.02376" cy="2.6257" cx="-1.22298"
                                                                    stroke-dasharray="null" stroke-width="null"
                                                                    fill="black"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-3">
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
                                <div class="ano">
                                    <div class="text-center text-uppercase">
                                        <small>Estreou</small>
                                    </div>
                                    <h3 class="text-center mb-0"><?= htmlspecialchars($data_str) ?></h3>
                                </div>
                            </div>
                            <div class="container-fluid py-3 px-4">
                                <h3>Sobre</h3>
                                <p class="ficha"><?= htmlspecialchars($desc) ?></p>
                            </div>
                            <?php


                            $query = "SELECT foto FROM `fotos_eventos` 
INNER JOIN eventos 
ON eventos.id_eventos = fotos_eventos.ref_id_eventos
WHERE id_eventos = ?;";

                            if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, "i", $memoriaid);
                                mysqli_stmt_execute($stmt);

                                mysqli_stmt_bind_result($stmt, $foto);

                                mysqli_stmt_store_result($stmt);

                                if (mysqli_stmt_num_rows($stmt) > 1) {
                                    ?>
                                    <div class="swiper-container mySwiper py-3">
                                        <div class="swiper-wrapper">
                                            <?php
                                            while (mysqli_stmt_fetch($stmt)) {
                                                ?>
                                                <div class="swiper-slide fotos-artita-eventos"><img
                                                            src="img/eventos/<?= htmlspecialchars($foto) ?>"
                                                            class="fotos-artista-fluid">
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Error: " . mysqli_error($link);
                            }

                            ?>
                            <div class="container-fluid pt-4 px-4">
                                <h3>Ficha Técnica</h3>
                                <p class="ficha"><?= htmlspecialchars($f_tecnica) ?></p>
                                <div class="row justify-content-center align-items-center py-3">
                                    <div class="col-auto row align-items-center">
                                        <div class="col-auto pe-1 ps-3">
                                            <i class="bi bi-clock icon-evento"></i>
                                        </div>
                                        <div class="col-auto ps-1 pe-3">
                                            <h6 class="mb-0 small">Duração</h6>
                                            <h3 class="mb-0"><?= htmlspecialchars($duracao) ?> <small>MIN</small></h3>
                                        </div>
                                    </div>
                                    <div class="col-auto row align-items-center">
                                        <div class="col-auto pe-1 ps-3">
                                            <i class="bi bi-people icon-evento"></i>
                                        </div>
                                        <div class="col-auto ps-1 pe-3">
                                            <h6 class="mb-0 small">Classificação etária</h6>
                                            <h3 class="mb-0">M/<?= htmlspecialchars($c_etaria) ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <section class="container-fluid px-4 mt-4 mb-6">
                                <h5 class="text-center">conta-nos as tuas memórias</h5>
                                <button class="btn btn-grande w-100">Publicar</button>
                            </section>

                        </section>
                    </section>
                </div>

                <?php

            } else {
                //não existe ou o seu vendedor está desativado
                header("Location: memorias.php");
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
        header("Location: memorias.php");
    }

endif;
































