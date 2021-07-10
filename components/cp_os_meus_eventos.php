<section class="container-fluid py-5 mb-4">
    <div class="row">

        <?php

        require_once("connections/connection.php");

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT eventos.id_eventos, DATE(MIN(data_eventos.data)), DATE_FORMAT(TIME(MIN(data_eventos.data)), '%H:%i'), eventos.nome, fotos_eventos.foto FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN guardados_vou
ON eventos.id_eventos = guardados_vou.ref_id_eventos
INNER JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
WHERE guardados_vou.guardados = 0 AND guardados_vou.ref_id_utilizadores = " . $userid . " AND fotos_eventos.capa = 1;";

        if (mysqli_stmt_prepare($stmt, $query)) {

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $id_evento, $data_evento, $hora_evento, $nome_evento, $foto);

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "<div class='col-12 py-5 mb-5'><h1>Não tens eventos guardados.</h1></div>";
            } else {
                while (mysqli_stmt_fetch($stmt)) {

                    $hora_h_evento = str_replace(":", "h", $hora_evento);

                    ?>
                    <div class="col-12 py-3">
                        <a class="aevento" href="evento.php?evento=<?= $id_evento ?>">
                            <div class="eventoindex">
                                <img class="img-fluid img-evento" src="img/eventos/<?= $foto ?>">
                                <div class="desc-evento container-fluid gx-3">
                                    <h2 class="top-right mb-0"><?= $nome_evento ?></h2>
                                    <div class="row">
                                        <div class="col text-cinza"><?= $data_evento ?></div>
                                        <div class="col text-cinza text-center"><?= $hora_h_evento ?></div>
                                        <div class="col text-cinza text-end">teatro</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="row pt-3 justify-content-between align-items-center">
                            <div class="col-auto">
                                <?php

                                $query = "SELECT COUNT(vou) FROM `guardados_vou` WHERE vou = 1 AND guardados_vou.ref_id_eventos =" . $id_evento;

                                if (mysqli_stmt_prepare($stmt, $query)) {

                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $n_pessoas);

                                    if (mysqli_stmt_fetch($stmt)) {
                                        if ($n_pessoas == 1) {
                                            $texto = "pessoa vai";
                                        } else {
                                            $texto = "pessoas vão";
                                        }
                                        echo '<h3 class="mb-0 ps-2">' . $n_pessoas . ' ' . $texto . '</h3>';
                                    } else {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    }
                                } else {
                                    echo "Error: " . mysqli_error($link);
                                }
                                ?>
                            </div>
                            <div class="col-auto">
                                <a href="evento.php?evento=<?= $id_evento ?>" class="btn btn-memoriafeed">Ver Evento</a>
                            </div>
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



