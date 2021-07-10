<?php
require_once "connections/connection.php";


if (isset($_GET["evento"])) {
    $eventoid = $_GET["evento"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT DATE(data_eventos.data), DATE_FORMAT(TIME(data_eventos.data), '%H:%i'),eventos.nome, fotos_eventos.foto, eventos.descricao_curta, eventos.descricao, lotacao, preco_reserva, preco_porta, tipo_eventos.nome, artistas.nome, guardados_vou.guardados, guardados_vou.vou
FROM eventos
LEFT JOIN guardados_vou
ON guardados_vou.ref_id_eventos = eventos.id_eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
INNER JOIN artistas
ON artistas.id_artistas = eventos.ref_id_artistas
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY data_eventos.ref_id_eventos) AND eventos.id_eventos = ? 
ORDER BY data_eventos.data;";

    if (mysqli_stmt_prepare($stmt, $query)) {


        mysqli_stmt_bind_param($stmt, "i", $eventoid);

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $data, $hora, $nome_evento, $foto, $desc_curta, $desc, $lotacao, $preco_reserva, $preco_porta, $tipo_evento, $artista, $guardado, $vou);

        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            /* fetch values */
            mysqli_stmt_fetch($stmt);
            if (!isset($foto)) {
                $foto = "evento_default.png";
            }
            $hora_h = str_replace(":", "h", $hora);
            ?>

            <div class="position-relative">
                <section class="container px-0 frame-img">
                    <div class="position-relative">
                        <img class="img-fluid framefotoevento" src="img/eventos/<?= $foto ?>"/>
                        <div class="degrade-imagem"></div>
                        <a href="eventos.php" class="voltar"><i class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                    </div>
                </section>
                <section class="container evento-text">
                    <div>
                        <div class="evento-titulo px-3">
                            <h1><?= $nome_evento ?></h1>
                            <div class="row">
                                <h6 class="col text-cinza"><?= $data ?></h6>
                                <h6 class="col text-cinza text-center"><?= $hora_h ?></h6>
                                <h6 class="col text-cinza text-end"><?= $tipo_evento ?></h6>
                            </div>
                            <div class="row">
                                <div class="col text-cinza text-center py-3">
                                    <strong>Reserva: <?= $preco_reserva ?>€ | À porta: <?= $preco_porta ?>€</strong>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <p><?= $desc_curta ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pe-1 pb-1 text-center">
                            <button type="button" class="btn btn-pequeno w-100" data-bs-toggle="modal"
                                    data-bs-target="#reservarBilheteModal"><i class="bi bi-pen d-block"></i><span
                                        class="d-block">Reservar</span></button>
                        </div>
                        <div class="col px-1 pb-1 text-center">
                            <input id="vou" value="111" class="btn-vou"
                                   type="checkbox"
                                   onclick="vouEvento(this.checked,this.value)" <?php if ($vou == 1) echo "checked" ?>>
                            <label class="btn btn-pequeno w-100 label-btn-vou" for="vou"><i
                                        id="iconbtnvou" class="bi bi-star d-block"></i><span id="textbtnvou"
                                                                                             class="d-block">Vou</span></label>
                        </div>
                        <div class="col ps-1 pb-1 text-center">
                            <input id="guardado" value="111" class="btn-guardado"
                                   type="checkbox"
                                   onclick="guardarEvento(this.checked,this.value)" <?php if ($guardado == 1) echo "checked" ?>>
                            <label class="btn btn-pequeno w-100 label-btn-guardado" for="guardado"><i
                                        id="iconbtnguardado" class="bi bi-bookmark d-block"></i><span
                                        id="textbtnguardado"
                                        class="d-block">Guardar</span></label>
                        </div>
                        <div class="col-12 pt-2">
                            <button class="btn btn-grande w-100">Adquirir Bilhete</button>
                        </div>
                    </div>
                    <!-- Modal -->
                    <section class="modal fade" id="reservarBilheteModal" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
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

