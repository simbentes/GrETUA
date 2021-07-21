<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    ?>
    <section class="container-fluid py-5 mb-4">
        <div class="row">

            <?php

            require_once("connections/connection.php");

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            $query = "SELECT eventos.id_eventos, eventos.nome, fotos_eventos.foto, tipo_eventos.nome
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
INNER JOIN utilizadores
ON utilizadores.id_utilizadores = guardados_vou.ref_id_utilizadores
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY data_eventos.ref_id_eventos) AND guardados = 1 AND id_utilizadores = " . $_SESSION["id_user"] . "
ORDER BY guardados_vou.timestamp_guardados DESC;";

            if (mysqli_stmt_prepare($stmt, $query)) {

                /* execute the prepared statement */
                mysqli_stmt_execute($stmt);

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $foto, $tipo);

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<div class='text-center center-pagina'><h1 class='mb-50px'>Não tens eventos guardados.</h1></div>";
                } else {
                    while (mysqli_stmt_fetch($stmt)) {


                        ?>
                        <div class="col-12 py-3">
                            <div class="eventoperfil">

                                <a href="evento.php?evento=<?= htmlspecialchars($id_evento) ?>">
                                    <div class="evento-card-degrade"></div>
                                    <img class="img-fluid img-evento"
                                         src="img/eventos/<?= htmlspecialchars($foto) ?>">
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
                                <input id="guardadoinput-<?= htmlspecialchars($id_evento) ?>" value="<?= htmlspecialchars($id_evento) ?>"
                                       class="btn-mini-guardado" type="checkbox"
                                       onclick="guardarEvento(this.checked,this.value)"
                                       checked>
                                <label id="guardado<?= htmlspecialchars($id_evento) ?>" class="btn label-btn-mini-guardado"
                                       for="guardadoinput-<?= htmlspecialchars($id_evento) ?>">
                                    <i id="iconbtnguardado" class="bi bi-bookmark-fill d-block"></i>
                                </label>
                            </div>
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
    </section>
<?php
endif;
