<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 1:
                $message = "Evento esgotado.";
                $class = "alert-danger";
                break;
            default:
                $msg_show = false;
        }

        if ($msg_show) {
            echo '<div class="container-fluid caixaalert"><div class="row justify-content-center"><div class="col-auto"><div id="aviso" class="alert ' . $class . ' alert-dismissible fade show" role="alert">' . $message . '</div></div></div></div>';
            echo "<script>
            setTimeout(function () {
                var myAlert = document.getElementById('aviso')
                var bsAlert = new bootstrap.Alert(myAlert)
                bsAlert.close()
            }, 3000)
        </script>";
        }
    }

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    ?>

    <section id="pesquisa-bg" class="container py-3">
        <form action="eventos.php" autocomplete="off" style="position: relative; z-index: 9999;" autocomplete="off">
            <input type="text" id="search-bar" name="pesquisa"
                   class="form-control forminfo barrapesquisa"
                   placeholder="Pesquisar">
        </form>
        <div id="resultados" class="row py-3" style="display: none"></div>
    </section>
    <section class="container px-3">
        <div class="botaomultiplo">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio0" autocomplete="off" checked>
                <label class="btn btn-multiplo-primary" for="btnradio0">Todos</label>

                <input type="radio" class="btn-check d-none" name="btnradio" id="btnradio1" autocomplete="off">
                <label class="btn btn-multiplo-primary" for="btnradio1">Guardados</label>
            </div>
        </div>
    </section>
    <div class="pb-3 pt-3 mb-5">
        <section>
            <div class="container pt-2">
                <h4 class="mb-0">Próximos eventos</h4>
            </div>
            <!-- Swiper -->
            <div class="swiper-container proximoseventos py-4">
                <div class="swiper-wrapper">

                    <?php
                    $query = "SELECT eventos.id_eventos, eventos.nome, fotos_eventos.foto, tipo_eventos.nome FROM eventos
                INNER JOIN data_eventos
                ON data_eventos.ref_id_eventos = eventos.id_eventos
                LEFT JOIN fotos_eventos
                ON fotos_eventos.ref_id_eventos = eventos.id_eventos
                INNER JOIN tipo_eventos
                ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
                WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND (data_eventos.data) IN (SELECT
                MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY
                data_eventos.ref_id_eventos)
                ORDER BY data_eventos.data;";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $foto, $tipo);

                        mysqli_stmt_store_result($stmt);

                        while (mysqli_stmt_fetch($stmt)) {
                            if (!isset($foto)) {
                                $foto = "evento_default.webp";
                            }

                            ?>

                            <div class="evento swiper-slide">
                                <a href="evento.php?evento=<?= htmlspecialchars($id_evento) ?>">
                                    <div class="evento-card-degrade"></div>
                                    <img class="img-fluid img-evento" src="img/eventos/<?= htmlspecialchars($foto) ?>">
                                    <div class="desc-evento container-fluid">
                                        <h6 class="top-right"><?= htmlspecialchars($nome_evento) ?></h6>
                                        <div class="row">
                                            <div class="col-auto text-cinza">
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link);
                                                $query = "SELECT DATE_FORMAT(MIN(DATE(data)), '%d-%m'), DATE_FORMAT(MIN(DATE(data)), '%Y'), DATE_FORMAT(MAX(DATE(data)), '%d-%m'), DATE_FORMAT(MAX(DATE(data)), '%Y')  FROM `data_eventos` WHERE ref_id_eventos = ? AND data > NOW();";
                                                if (mysqli_stmt_prepare($stmt2, $query)) {
                                                    mysqli_stmt_bind_param($stmt2, "i", $id_evento);
                                                    mysqli_stmt_execute($stmt2);
                                                    mysqli_stmt_bind_result($stmt2, $min_data, $min_ano, $max_data, $max_ano);

                                                    if (mysqli_stmt_fetch($stmt2)) {
                                                        $meses = array("-01", "-02", "-03", "-04", "-05", "-06", "-07", "-08", "-09", "-10", "-11", "-12");
                                                        $str_meses = array(" JAN", " FEV", " MAR", " ABR", " MAI", " JUN", " JUL", " AGO", " SET", " OUT", " NOV", " DEZ");

                                                        $min_data_str = str_replace($meses, $str_meses, $min_data);
                                                        $max_data_str = str_replace($meses, $str_meses, $max_data);

                                                        if ($min_data == $max_data && $min_ano == $max_ano) {
                                                            echo $min_data_str;
                                                        } else {
                                                            if ($min_ano == $max_ano) {
                                                                echo "<small>DE</small> " . htmlspecialchars($min_data_str) . " <small>A</small>  " . htmlspecialchars($max_data_str);
                                                            } else {
                                                                echo "<small>DE</small> " . htmlspecialchars($min_data_str) . " " . htmlspecialchars($min_ano) . " <small>A</small>  " . htmlspecialchars($max_data_str) . " " . htmlspecialchars($max_ano);

                                                            }
                                                        }
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                }
                                                mysqli_stmt_close($stmt2);
                                                ?>
                                            </div>
                                            <div class="col text-cinza text-end"><?= htmlspecialchars($tipo) ?></div>
                                        </div>
                                    </div>

                                </a>
                            </div>

                            <?php
                        }

                    } else {
                        echo "Error: " . mysqli_error($link);
                    }

                    ?>
                </div>
            </div>
        </section>
        <section>
            <div class="container pt-2">
                <h4 class="mb-0">Concertos</h4>
            </div>
            <div class="swiper-container concertos py-4">
                <div class="swiper-wrapper">
                    <?php


                    $query = "SELECT eventos.id_eventos, eventos.nome, fotos_eventos.foto, tipo_eventos.nome FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND id_tipo_eventos = 1 AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY data_eventos.ref_id_eventos)
ORDER BY data_eventos.data;";

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        /* execute the prepared statement */
                        mysqli_stmt_execute($stmt);

                        /* bind result variables */
                        mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $foto, $tipo);

                        mysqli_stmt_store_result($stmt);


                        while (mysqli_stmt_fetch($stmt)) {
                            if (!isset($foto)) {
                                $foto = "evento_default.webp";
                            }

                            ?>

                            <div class="evento swiper-slide">
                                <a href="evento.php?evento=<?= htmlspecialchars($id_evento) ?>">
                                    <div class="evento-card-degrade"></div>
                                    <img class="img-fluid img-evento" src="img/eventos/<?= htmlspecialchars($foto) ?>">
                                    <div class="desc-evento container-fluid">
                                        <h6 class="top-right"><?= htmlspecialchars($nome_evento) ?></h6>
                                        <div class="row">
                                            <div class="col-auto text-cinza">
                                                <?php
                                                $stmt2 = mysqli_stmt_init($link);
                                                $query = "SELECT DATE_FORMAT(MIN(DATE(data)), '%d-%m'), DATE_FORMAT(MIN(DATE(data)), '%Y'), DATE_FORMAT(MAX(DATE(data)), '%d-%m'), DATE_FORMAT(MAX(DATE(data)), '%Y')  FROM `data_eventos` WHERE ref_id_eventos = ? AND data > NOW();";
                                                if (mysqli_stmt_prepare($stmt2, $query)) {
                                                    mysqli_stmt_bind_param($stmt2, "i", $id_evento);
                                                    mysqli_stmt_execute($stmt2);
                                                    mysqli_stmt_bind_result($stmt2, $min_data, $min_ano, $max_data, $max_ano);

                                                    if (mysqli_stmt_fetch($stmt2)) {
                                                        $meses = array("-01", "-02", "-03", "-04", "-05", "-06", "-07", "-08", "-09", "-10", "-11", "-12");
                                                        $str_meses = array(" JAN", "FEV", " MAR", " ABR", " MAI", " JUN", " JUL", " AGO", " SET", " OUT", " NOV", " DEZ");

                                                        $min_data_str = str_replace($meses, $str_meses, $min_data);
                                                        $max_data_str = str_replace($meses, $str_meses, $max_data);

                                                        if ($min_data == $max_data) {
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
                                                mysqli_stmt_close($stmt2);
                                                ?>
                                            </div>
                                            <div class="col text-cinza text-end"><?= htmlspecialchars($tipo) ?></div>
                                        </div>
                                    </div>

                                </a>
                            </div>

                            <?php
                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }

                    ?>
                </div>
            </div>
        </section>

    </div>
    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($link);

endif;



















