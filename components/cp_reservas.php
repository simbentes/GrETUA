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

        $query = "SELECT eventos.id_evento, eventos.data_evento, eventos.nome FROM eventos
                            INNER JOIN reservas
                            ON eventos.id_evento = reservas.ref_id_evento
                            WHERE reservas.ref_id_utilizador = " . $userid;

        if (mysqli_stmt_prepare($stmt, $query)) {

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $id_evento, $data_evento, $nome_evento);

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 0) {
                echo "Ainda sem reservas efetuadas";
            } else {
                while (mysqli_stmt_fetch($stmt)) {
        ?>
                    <div class="col-12 py-3">
                        <a class="aevento" href="evento.php?id=<?= $id_evento ?>">
                            <div class="eventoindex">
                                <img class="img-fluid img-evento" src="img/eventos/ruinas3.jpg">
                                <div class="desc-evento container-fluid gx-3">
                                    <h2 class="top-right mb-0"><?= $nome_evento ?></h2>
                                    <div class="row">
                                        <div class="col text-cinza"><?= $data_evento ?></div>
                                        <div class="col text-cinza text-center">22h30</div>
                                        <div class="col text-cinza text-end">teatro</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="row pt-3 justify-content-between align-items-center">
                            <div class="col-auto">
                                <h3 class="mb-0 ps-2">34 pessoas vão</h3>
                            </div>
                            <div class="col-auto">
                                <a href="evento.php" class="btn btn-memoriafeed">Ver Evento</a>
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