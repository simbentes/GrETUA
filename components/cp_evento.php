<?php
require_once "connections/connection.php";


if (isset($_GET["evento"])) {
    $eventoid = $_GET["evento"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT DATE(data_eventos.data), DATE_FORMAT(TIME(data_eventos.data), '%H:%i'),eventos.nome, fotos_eventos.foto, eventos.descricao_curta, eventos.descricao, lotacao, preco_reserva, preco_porta, tipo_eventos.nome, artistas.nome, guardados_vou.guardados, guardados_vou.vou
FROM eventos
LEFT JOIN guardados_vou
ON guardados_vou.ref_id_eventos = eventos.id_eventos AND ref_id_utilizadores = " . $_SESSION["id_user"] . "
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
INNER JOIN artistas
ON artistas.id_artistas = eventos.ref_id_artistas
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() AND id_eventos = ?
GROUP BY data_eventos.ref_id_eventos)
ORDER BY guardados_vou.timestamp_guardados DESC;";

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
                    <div class="framefotoevento" style="background-image: url('img/eventos/<?= $foto ?>')">
                        <div class="degrade-imagem"></div>
                        <a id="voltar" href="eventos.php" class="voltar"><i class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                        <div id="share" class="share" onclick="partilharLink()"><i
                                    class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                        </div>
                    </div>
                    <script>
                        function partilharLink() {
                            if (navigator.share) {
                                navigator.share({
                                    title: '<?= $nome_evento ?>',
                                    text: 'Vamos a um evento juntos? <?= $nome_evento ?>',
                                    url: window.location.href,
                                })
                                    .then(() => console.log('Successful share'))
                                    .catch((error) => console.log('Error sharing', error));
                            }
                        }
                    </script>
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
                                    <strong>Preço: <?php if($preco_reserva > 0){echo $preco_reserva .'€';}else{echo "Grátis";} ?>  <?php if($preco_porta>0){echo '|'. $preco_porta . '€';}  ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <p><?= $desc_curta ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pe-1 pb-1 text-center">
                            <a href="reservar.php?evento=<?= $eventoid ?>" class="btn btn-pequeno w-100"><i
                                        class="bi bi-pen d-block"></i><span
                                        class="d-block">Reservar</span></a>
                        </div>
                        <div class="col px-1 pb-1 text-center">
                            <input id="vou" value="<?= $eventoid ?>" class="btn-vou"
                                   type="checkbox"
                                   onclick="vouEvento(this.checked,this.value)" <?php if ($vou == 1) echo "checked" ?>>
                            <label class="btn btn-pequeno w-100 label-btn-vou" for="vou"><i
                                        id="iconbtnvou" class="bi bi-star d-block"></i><span id="textbtnvou"
                                                                                             class="d-block">Vou</span></label>
                        </div>
                        <div class="col ps-1 pb-1 text-center">
                            <input id="guardado" value="<?= $eventoid ?>" class="btn-guardado"
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
                    <div class="container-fluid pt-5 pb-3">
                        <h3>Disponiblidade</h3>
                        <div class="col-lg-5">
                            <div class="row justify-content-between">
                                <div class="col-auto">
                                    <h6>Estado</h6>
                                </div>
                                <div class="col-auto">
                                    <h6><?= $lotacao ?></h6>
                                </div>
                            </div>
                            <?php
                            switch ($lotacao) {
                                case 1:
                                    $cor_barra = "bg-barra-1";
                                    $size = "100";
                                    break;
                                case 2:
                                    $cor_barra = "bg-barra-2";
                                    $size = "75";
                                    break;
                                case 3:
                                    $cor_barra = "bg-barra-3";
                                    $size = "50";
                                    break;
                                case 4:
                                    $cor_barra = "bg-barra-4";
                                    $size = "25";
                                    break;
                                default:
                                    $cor_barra = "bg-barra-5";
                                    $size = "10";
                            }

                            echo "<div class='progress'>
                                    <div class='progress-bar progress-bar $cor_barra' role='progressbar'
                                         style='width: $size%' aria-valuenow='$size' aria-valuemin='0'
                                         aria-valuemax='$size'></div>
                                </div>"
                            ?>
                        </div>
                    </div>
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

