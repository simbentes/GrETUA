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

            $query = "SELECT id_eventos, id_reservas, DATE_FORMAT(data, '%d-%m-%Y'),  TIME_FORMAT(data, '%Hh%i'), eventos.nome, fotos_eventos.foto, reservas.quantidade, reservas.timestamp
FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN reservas
ON reservas.ref_id_data_eventos = data_eventos.id_data_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
INNER JOIN artistas
ON artistas.id_artistas = eventos.ref_id_artistas
INNER JOIN utilizadores
ON utilizadores.id_utilizadores = reservas.ref_id_utilizadores
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND id_utilizadores = " . $_SESSION["id_user"] . " AND data_eventos.data > NOW()
ORDER BY reservas.timestamp DESC";

            if (mysqli_stmt_prepare($stmt, $query)) {

                /* execute the prepared statement */
                mysqli_stmt_execute($stmt);

                /* bind result variables */
                mysqli_stmt_bind_result($stmt, $evento_id, $reservas_id, $data_evento, $hora_evento, $nome_evento, $foto, $quantidade, $timestamp);

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 0) {
                    echo "<div class='col-12 py-5 mb-5'><h1>Não tens eventos guardados.</h1></div>";
                } else {
                    while (mysqli_stmt_fetch($stmt)) {

                        ?>
                        <div class="col-12 py-3">
                            <div class="card memoriafeed">
                                <div class="card-body pb-0 pt-3">
                                    <div class="row justify-content-between align-items-end">
                                        <div class="col-auto">
                                            <div class="text-uppercase mb-2"><small class="fw-bold">Reserva
                                                    nº</small> <?= $reservas_id ?>
                                            </div>
                                            <h3 class="card-title mb-0"><?= $nome_evento ?></h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row justify-content-between align-items-end">
                                        <div class="col-auto">
                                            <small>DATA</small>
                                            <h3 class="pb-2"><?= $data_evento . " <small>" . $hora_evento . "</small>" ?></h3>
                                        </div>
                                        <div class="col-auto text-end">
                                            <small>Nº ENTRADAS</small>
                                            <h3 class="pb-2"><?= $quantidade ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-2 g-0">
                                    <div class="col-6">
                                        <a href="evento.php?evento=<?= $evento_id ?>"
                                           class="btn btn-memoriafeed" style="border-radius: 0 0 0 8px">Ver Evento</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="scripts/sc_delete_reserva.php?id=<?= $reservas_id ?>"
                                           class="btn btn-memoriafeed text-danger" style="border-radius: 0 0 8px 0"><i
                                                    class="bi bi-dash-circle-fill pe-2"></i>Cancelar</a>
                                    </div>
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
<?php
endif;
