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
    <!-- Swiper -->
    <div class="swiper-container proximoseventos py-4">
        <div class="swiper-wrapper">
            <?php

            require_once("connections/connection.php");

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT eventos.id_eventos, DATE(MIN(data_eventos.data)), DATE_FORMAT(TIME(MIN(data_eventos.data)), '%H:%i'), eventos.nome, fotos_eventos.foto, tipo_eventos.nome FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN guardados_vou
ON eventos.id_eventos = guardados_vou.ref_id_eventos
INNER JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE guardados_vou.ref_id_utilizadores = 1 AND fotos_eventos.capa = 1 AND data_eventos.data > NOW()
ORDER BY data_eventos.data;";

            if (mysqli_stmt_prepare($stmt, $query)) {

                /* execute the prepared statement */
                mysqli_stmt_execute($stmt);

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $id_evento, $data_evento, $hora_evento, $nome_evento, $foto, $tipo);

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<div class='col-12 py-5 mb-5'><h1>Não tens eventos guardados.</h1></div>";
                } else {
                    while (mysqli_stmt_fetch($stmt)) {

                        $hora_h_evento = str_replace(":", "h", $hora_evento);

                        ?>

                        <div class="evento swiper-slide">
                            <a href="evento.php?evento=<?= $id_evento ?>">
                                <img class="img-fluid img-evento" src="img/<?= $foto ?>">
                                <div class="desc-evento container-fluid">
                                    <h6 class="top-right"><?= $nome_evento ?></h6>
                                    <div class="row">
                                        <div class="col text-cinza"><?= $data_evento ?></div>
                                        <div class="col text-cinza text-center"><?= $hora_h_evento ?></div>
                                        <div class="col text-cinza text-end"><?= $tipo ?></div>
                                    </div>
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
        <div class="swiper-scrollbar"></div>
    </div>
</section>
<section>
    <div class="container pt-4">
        <h2 class="mb-0">os meus eventos</h2>
    </div>
    <!-- Swiper -->
    <div class="swiper-container osmeuseventos py-4">
        <div class="swiper-wrapper">

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/da_chick.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Da Chick</h6>
                        <div class="row">
                            <div class="col text-cinza">4 junho</div>
                            <div class="col text-cinza text-center">21h00</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ruínas</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/palmieres.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">P A L M I E R E S</h6>
                        <div class="row">
                            <div class="col text-cinza">1 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ninguem.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ninguém, de Deeogo Oliveira</h6>
                        <div class="row">
                            <div class="col text-cinza">8 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/angelica.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Angélica Salvi - Phantone</h6>
                        <div class="row">
                            <div class="col text-cinza">25 de maio</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="swiper-scrollbar"></div>
    </div>
</section>



















