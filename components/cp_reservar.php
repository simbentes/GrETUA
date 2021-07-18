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

                require_once "connections/connection.php";
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $eventoid = $_GET["evento"];
                $dataid = $_GET["data"];

                $query = "SELECT DATE_FORMAT(data, '%d-%m-%Y'),  TIME_FORMAT(data, '%Hh%i'), eventos.nome
FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
WHERE ref_id_eventos = ? AND id_data_eventos = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {


                    mysqli_stmt_bind_param($stmt, "is", $eventoid, $dataid);

                    /* execute the prepared statement */
                    mysqli_stmt_execute($stmt);

                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $data, $hora, $evento_nome);

                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        mysqli_stmt_fetch($stmt);
                        ?>
                        <div class="pt-6 mt-3">
                            <h3 class="mt-5"><?= $evento_nome ?></h3>
                            <p><?= $data . " " . $hora ?></p>
                        </div>
                        <form action="scripts/sc_reservar.php" method="post" class="px-0 pt-3" autocomplete="off">
                            <div class="mb-3">
                                <label for="nreservas" class="mb-1">Em nome de</label>
                                <div class="h0"><?= $_SESSION["nome"] ?></div>
                            </div>
                            <div class="row mb-4 align-items-center">
                                <div class="col mb-0 pe-1">
                                    <label for="nreservas" class="mb-1">Número de reservas</label>
                                </div>
                                <div class="col-5 ps-1">
                                    <input type="number" id="nreservas" class="form-control forminfo numberinput"
                                           name="numreservas"
                                           min="1" max="10" value="1">
                                </div>
                                <input type="hidden" name="data_evento" value="<?= $_GET["data"] ?>">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-grande w-100">Reservar</button>
                            </div>
                        </form>

                        <?php

                    } else {
                        //não existe ou o evento caducou
                        header("Location: eventos.php");
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($link);
                } else {
                    echo "Error: " . mysqli_error($link);
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

                    $query = "SELECT id_data_eventos, DATE_FORMAT(data, '%d-%m-%Y'),  TIME_FORMAT(data, '%Hh%i') FROM data_eventos WHERE ref_id_eventos = ? AND data > NOW();";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_bind_param($stmt, "i", $eventoid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_data, $data, $hora);
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
                                            <?= $data . "<span class='ps-4'>" . $hora . "</span>" ?>
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

                        mysqli_stmt_close($stmt);
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