<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once "connections/connection.php";


    if (isset($_GET["evento"])) {
        $eventoid = $_GET["evento"];

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT eventos.nome, fotos_eventos.foto, eventos.descricao_curta,  eventos.descricao, ficha_tecnica, lotacao, preco_reserva, preco_porta, tipo_eventos.nome, artistas.nome, artistas.id_artistas, guardados_vou.guardados, guardados_vou.vou, duracao, classificacao_etaria
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
GROUP BY data_eventos.ref_id_eventos)";


        if (mysqli_stmt_prepare($stmt, $query)) {


            mysqli_stmt_bind_param($stmt, "i", $eventoid);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $nome_evento, $foto, $desc_curta, $desc, $ficha_tecnica, $lotacao, $preco_reserva, $preco_porta, $tipo_evento, $artista, $id_artista, $guardado, $vou, $duracao, $c_etaria);

            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                /* fetch values */
                mysqli_stmt_fetch($stmt);
                if (!isset($foto)) {
                    $foto = "evento_default.webp";
                }
                // $hora_h = str_replace(":", "h", $hora);
                ?>
                <div class="position-relative">
                    <section class="container px-0 frame-img">
                        <div id="framefotoevento" class="framefotoevento"
                             style="background-image: url('img/eventos/<?= htmlspecialchars($foto) ?>')">
                            <div class="degrade-imagem"></div>
                            <a id="voltar" href="eventos.php" class="voltar"><i
                                        class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                            <div id="share" class="share" onclick="partilharLink()"><i
                                        class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                            </div>
                        </div>
                        <script>
                            function partilharLink() {
                                if (navigator.share) {
                                    navigator.share({
                                        title: '<?= htmlspecialchars($nome_evento) ?>',
                                        text: 'Vamos a um evento juntos? <?= htmlspecialchars($nome_evento) ?>',
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
                            <div class="evento-titulo px-2">
                                <h1><?= htmlspecialchars($nome_evento) ?></h1>
                                <div class="row justify-content-between">
                                    <h6 class="col-auto text-cinza">
                                        <?php
                                        $query = "SELECT DATE_FORMAT(MIN(DATE(data)), '%d-%m'), DATE_FORMAT(MIN(DATE(data)), '%Y'), DATE_FORMAT(MAX(DATE(data)), '%d-%m'), DATE_FORMAT(MAX(DATE(data)), '%Y')  FROM `data_eventos` WHERE ref_id_eventos = ? AND data > NOW();";
                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_bind_param($stmt, "i", $eventoid);
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $min_data, $min_ano, $max_data, $max_ano);

                                            if (mysqli_stmt_fetch($stmt)) {
                                                $meses = array("-01", "-02", "-03", "-04", "-05", "-06", "-07", "-08", "-09", "-10", "-11", "-12");
                                                $str_meses = array(" JAN", "FEV", " MAR", " ABR", " MAI", " JUN", " JUL", " AGO", " SET", " OUT", " NOV", " DEZ");

                                                $min_data_str = str_replace($meses, $str_meses, $min_data);
                                                $max_data_str = str_replace($meses, $str_meses, $max_data);

                                                if ($min_data == $max_data && $min_ano == $max_ano) {
                                                    echo $min_data_str;
                                                } else {
                                                    if ($min_ano == $max_ano) {
                                                        echo "<small>DE</small> " . $min_data_str . " <small>A</small>  " . $max_data_str;
                                                    } else {
                                                        echo "<small>DE</small> " . $min_data_str . " " . $min_ano . " <small>A</small>  " . $max_data_str . " " . $max_ano;

                                                    }
                                                }
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                        ?>
                                    </h6>
                                    <h6 class="col-auto text-cinza text-end"><?= htmlspecialchars($tipo_evento) ?></h6>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center py-3">
                                <div class="col-auto">
                                    <a href="artista.php?artista=<?= htmlspecialchars($id_artista) ?>"
                                       class="artistabtn">
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
                                                     xmlns:svg="http://www.w3.org/2000/svg" class="bi bi-check-circle">
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
                            <p class="mb-2"><?= htmlspecialchars($desc_curta) ?></p>
                            <h4 class="text-center mb-3">
                                <?php
                                $query = "SELECT COUNT(vou) FROM `guardados_vou` WHERE vou = 1 AND guardados_vou.ref_id_eventos =" . $eventoid;

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $n_pessoas);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        if ($n_pessoas > 0) {
                                            if ($n_pessoas == 1) {
                                                $texto = "pessoa vai";
                                            } else {
                                                $texto = "pessoas vão";
                                            }
                                            echo htmlspecialchars($n_pessoas) . ' ' . $texto;
                                        }
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col pe-1 pb-1 text-center">
                                <a href="reservar.php?evento=<?= htmlspecialchars($eventoid) ?>"
                                   class="btn btn-pequeno w-100"><i
                                            class="bi bi-pen d-block"></i><span
                                            class="d-block">Reservar</span></a>
                            </div>
                            <div class="col px-1 pb-1 text-center">
                                <input id="vou" value="<?= htmlspecialchars($eventoid) ?>" class="btn-vou"
                                       type="checkbox"
                                       onclick="vouEvento(this.checked,this.value)" <?php if ($vou == 1) echo "checked" ?>>
                                <label class="btn btn-pequeno w-100 label-btn-vou" for="vou"><i
                                            id="iconbtnvou" class="bi bi-star d-block"></i><span id="textbtnvou"
                                                                                                 class="d-block">Vou</span></label>
                            </div>
                            <div class="col ps-1 pb-1 text-center">
                                <input id="guardado" value="<?= htmlspecialchars($eventoid) ?>" class="btn-guardado"
                                       type="checkbox"
                                       onclick="guardarEvento(this.checked,this.value)" <?php if ($guardado == 1) echo "checked" ?>>
                                <label class="btn btn-pequeno w-100 label-btn-guardado" for="guardado"><i
                                            id="iconbtnguardado" class="bi bi-bookmark d-block"></i><span
                                            id="textbtnguardado"
                                            class="d-block">Guardar</span></label>
                            </div>
                            <div class="col-12 pt-2">
                                <a href="comprar.php?evento=<?= htmlspecialchars($eventoid) ?>"
                                   class="btn btn-grande w-100">Adquirir
                                    Bilhete</a>
                            </div>
                        </div>
                        <div class="row py-3">
                            <div class="col text-cinza text-center">
                                <?php
                                if ($preco_reserva != 0 && $preco_porta != 0) {
                                    echo '<strong>Reserva: ' . $preco_reserva . '€ | À porta: ' . $preco_porta . '€</strong>';
                                } else {
                                    echo "Gratuito";
                                }; ?>

                            </div>
                        </div>

                        <?php

                        //so mostramos a lotação se existir apenas uma data
                        $query = "SELECT id_data_eventos FROM data_eventos WHERE ref_id_eventos = ? AND data_eventos.data > NOW();";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $eventoid);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_data_eventos);
                            mysqli_stmt_store_result($stmt);

                            if (mysqli_stmt_num_rows($stmt) == 1) {
                                mysqli_stmt_fetch($stmt);
                                //após verificar se existe apenas uma data, vamos desenhar uma barra de lotação

                                $query = "SELECT eventos.lotacao, SUM(reservas.quantidade)
FROM `reservas`
RIGHT JOIN data_eventos
ON id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?;";

                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $lotacao, $ocupacao_reservas);

                                    if (!mysqli_stmt_fetch($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    } else {
                                        $query = "SELECT SUM(compras.quantidade)
FROM `compras`
INNER JOIN data_eventos
ON id_data_eventos = compras.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $ocupacao_compras);

                                            if (!mysqli_stmt_fetch($stmt)) {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            } else {
                                                if (!empty($ocupacao_reservas) || !empty($ocupacao_compras) || $ocupacao_reservas == 0 || $ocupacao_compras == 0) {
                                                    $ocupacao = 1 - ($lotacao - ($ocupacao_reservas + $ocupacao_compras)) / $lotacao;
                                                } else {
                                                    $ocupacao = 0;
                                                }
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }

                                $size = 100 * $ocupacao;

                                if ($size == 0) {
                                } else {

                                    if ($size < 10) {
                                        $cor_barra = "bg-barra-1";
                                    } else if ($size < 25) {
                                        $cor_barra = "bg-barra-2";
                                    } else if ($size < 50) {
                                        $cor_barra = "bg-barra-3";
                                    } else if ($size < 75) {
                                        $cor_barra = "bg-barra-4";
                                    } else {
                                        $cor_barra = "bg-barra-5";
                                    }
                                    ?>
                                    <div class="container-fluid py-3">
                                        <h3>Lotação</h3>
                                        <div class="col-lg-5">
                                            <div class="row justify-content-end">
                                                <div class="col-auto">
                                                    <h6><?= htmlspecialchars(round($size)) ?>%</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='progress'>
                                            <div class='progress-bar progress-bar <?= htmlspecialchars($cor_barra) ?>'
                                                 role='progressbar'
                                                 style='width: <?= htmlspecialchars($size) ?>%'
                                                 aria-valuenow='<?= htmlspecialchars($size) ?>'
                                                 aria-valuemin='0'
                                                 aria-valuemax='100'></div>
                                        </div>

                                    </div>
                                    <?php
                                }
                            }
                        } else {
                            echo "Error: " . mysqli_error($link);
                        }
                        ?>

                        <div class="container-fluid py-4 mb-5">
                            <h3>Ficha Técnica</h3>
                            <p class="ficha"><?= htmlspecialchars($ficha_tecnica) ?></p>
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
                    </section>
                </div>

                <?php

            } else {
                //não existe ou o evento caducou
                header("Location: eventos.php");
            }
            /* close statement */
            mysqli_stmt_close($stmt);

            /* close connection */
            mysqli_close($link);
        } else {
            echo "Error: " . mysqli_error($link);
        }
    } else {
        //não existe nenhuma query string
        header("Location: eventos.php");
    }

endif;