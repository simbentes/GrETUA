<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    ?>
    <section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
        <div class="row gx-0 align-items-center">
            <div class="col-auto">
                <a href="evento.php?evento=<?= $_GET["evento"] ?>" class="text-white"><i
                            class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
            </div>
            <div class="col-auto ps-3">
                <h3 class="mb-0">Reservar</h3>
            </div>
        </div>
    </section>
    <main>
        <section class="container-fluid">
            <?php
            if (isset($_GET["evento"]) && isset($_GET["data"])) {
                $eventoid = $_GET["evento"];
                $dataid = $_GET["data"];


                require_once "connections/connection.php";


                if (isset($_GET["evento"])) {
                    $eventoid = $_GET["evento"];

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT DATE(data_eventos.data), eventos.nome
FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
WHERE ref_id_eventos = ? AND ";

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
                            ?>
                            <h1 class="ps-3 pt-6">Datas</h1>
                            <p></p>
                            <form action="scripts/sc_reservar.php" method="post" class="px-0 pt-6" autocomplete="off">
                                <div class="mb-3">
                                    <label for="instagram" class="mb-1">Instagram <small>(username)</small></label>
                                    <input type="text" class="form-control forminfo formconta" id="instagram"
                                           value="" name="instagram">
                                </div>
                            </form>

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

            } else if (isset($_GET["evento"])) {
                $eventoid = $_GET["evento"];

                ?>
                <h4 class="ps-3 pt-6">Datas</h4>
                <div class="row g-0">
                    <?php

                    require_once "connections/connection.php";
                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT id_data_eventos, data FROM data_eventos WHERE ref_id_eventos = ? AND data > NOW()";

                    if (mysqli_stmt_prepare($stmt, $query)) {


                        mysqli_stmt_bind_param($stmt, "i", $eventoid);

                        mysqli_stmt_execute($stmt);

                        mysqli_stmt_bind_result($stmt, $id_data, $data);

                        /* store result */
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            header("Location: eventos.php");
                        } elseif (mysqli_stmt_num_rows($stmt) == 1) {
                            mysqli_stmt_fetch($stmt);
                            header("Location: reservar.php?evento=" . $eventoid . "&data=" . $id_data);
                        } else {
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                <div class="col-12 text-white py-2">
                                    <div class="row justify-content-between align-items-center bg-preto">
                                        <div class="col-auto datareservar">
                                            <?= $data ?>
                                        </div>
                                        <div class="col-auto pe-0">
                                            <a href="reservar.php?evento=<?= $eventoid ?>&data=<?= $id_data ?>"
                                               class="btn btn-azul-reserva w-100"><i
                                                        class="bi bi-pen d-block"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <?php

                            }
                        }
                        /* close statement */
                        mysqli_stmt_close($stmt);

                        /* close connection */
                        mysqli_close($link);
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }

                    ?>
                </div>
                <?php

            } else {
                //não existe nenhuma query string
                header("Location: eventos.php");
            }
            ?>

        </section>
    </main>
<?php

endif;