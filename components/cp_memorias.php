<div>
    <div class="memoria-container">
        <div dir="rtl" class="swiper-container mySwiper">
            <div class="swiper-wrapper position-relative">


                <?php

                require_once("connections/connection.php");

                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $query = "SELECT eventos.id_eventos, DATE(data_eventos.data), eventos.nome, fotos_eventos.foto, eventos.descricao_curta FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND data_eventos.data < NOW() AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)
ORDER BY data_eventos.data DESC;";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    /* execute the prepared statement */
                    mysqli_stmt_execute($stmt);

                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $id_evento, $data_evento, $nome_evento, $foto, $desc_curta);

                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<div class='col-12 py-5 mb-5'><h1>Não tens eventos guardados.</h1></div>";
                    } else {
                        while (mysqli_stmt_fetch($stmt)) {

                            if(!isset($foto)){
                                $foto = "evento_default.png";
                            }
                            ?>

                            <div class="memoria swiper-slide">
                                <a href="memoria.php?memoria=<?= $id_evento ?>">

                                    <img class="img-memoria" src="img/<?= $foto ?>">
                                    <div class="desc-memoria container-fluid">
                                        <h3 class="top-right"><?= $nome_evento ?></h3>
                                        <div class="row">
                                            <p class="text-cinza desc-curta"><?= $desc_curta ?></p>
                                        </div>
                                    </div>
                                    <div class="bola">
                                        <svg height="26" width="26" viewBox="0 0 100 100">
                                            <circle cx="50" cy="50" r="40" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="ano">
                                        <h1 class="text-center mb-0">
                                            <?= $data_evento ?>
                                        </h1>
                                    </div>

                                </a>
                            </div>

                            <?php
                        }
                    }
                } else {
                    echo "Error: " . mysqli_error($link);
                }

                mysqli_stmt_close($stmt);
                mysqli_close($link);

                ?>

            </div>
            <div class="linha-memorias">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.12 27.37">
                    <defs>
                        <style>.cls-1 {
                                fill: none;
                                stroke-width: 4px;
                            }

                            .cls-1 {
                                stroke: #fff;
                                stroke-miterlimit: 10;
                            }

                            .cls-2 {
                                fill: #fff;
                            }</style>
                    </defs>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="Layer_1-2" data-name="Layer 1">
                            <line class="cls-1" y1="13.69" x2="483.12" y2="13.69"/>
                            <line class="cls-2" y1="13.69" x2="483.12" y2="13.69"/>
                        </g>
                    </g>
                </svg>
            </div>
        </div>

    </div>
</div>
