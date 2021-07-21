<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    ?>
    <section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
        <div class="row gx-0 align-items-center">
            <div class="col-auto">
                <a href="evento.php?evento=<?= htmlspecialchars($_GET["evento"]) ?>" class="text-white"><i
                            class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
            </div>
            <div class="col-auto ps-3">
                <h3 class="mb-0">Adquirir Bilhetes</h3>
            </div>
        </div>
    </section>
    <main>
        <section class="container-fluid mb-6">
            <?php
            if (isset($_GET["evento"]) && isset($_GET["data"])) {

                require_once "connections/connection.php";
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);

                $eventoid = $_GET["evento"];
                $dataid = $_GET["data"];

                $query = "SELECT DATE_FORMAT(data, '%d-%m-%Y'),  TIME_FORMAT(data, '%Hh%i'), eventos.nome, eventos.preco_reserva
FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
WHERE ref_id_eventos = ? AND id_data_eventos = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {


                    mysqli_stmt_bind_param($stmt, "is", $eventoid, $dataid);

                    /* execute the prepared statement */
                    mysqli_stmt_execute($stmt);

                    /* bind result variables */
                    mysqli_stmt_bind_result($stmt, $data, $hora, $evento_nome, $preco_reserva);

                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        mysqli_stmt_fetch($stmt);
                        ?>
                        <div class="pt-5 mt-3">
                            <h3 class="mt-5 mb-3"><?= htmlspecialchars($evento_nome) ?></h3>
                            <div class="row justify-content-between align-items-center mb-4">
                                <div class="col-auto">
                                    <div><?= htmlspecialchars($data) . " " . htmlspecialchars($hora) ?></div>
                                </div>
                                <div class="col-auto">
                                    <h2 class="text-center fw-bold mb-0"><?php
                                        if ($preco_reserva == 0) {
                                            echo "Gratuito";
                                        } else {
                                            echo htmlspecialchars($preco_reserva) . "€";
                                        } ?></h2>
                                </div>
                            </div>

                        </div>
                        <form action="scripts/sc_comprar.php" method="POST" id="comprar-form" class="px-0 pt-3"
                              autocomplete="off">
                            <div class="mb-3">
                                <label for="nreservas" class="mb-1">Nome</label>
                                <input type="text" class="form-control forminfo formconta" id="nomebilhete1"
                                       name="nomebilhete1"
                                       value="<?= htmlspecialchars($_SESSION["nome"]) ?>" required>
                                <div id="nomebilhetes"></div>
                            </div>
                            <div>
                                <input type="hidden" name="quantidade" id="quantidade" value="1">
                                <input type="hidden" name="data_evento" value="<?= htmlspecialchars($_GET["data"]) ?>">
                                <div class="row">
                                    <div id="add-caixa" class="col-12">
                                        <div id="comprar-add" class="btn btn-grande btn-add w-100 mb-4">
                                            Adicionar
                                        </div>
                                    </div>
                                    <div id="remover-caixa" class="col ps-1 d-none">
                                        <div id="comprar-remover" class="btn btn-grande btn-add w-100 mb-4">
                                            <i class="bi bi-dash-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="comprar-btn" class="btn btn-grande w-100">
                                    Comprar
                                </button>
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
                <div class="row g-0 mb-6">
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
                            header("Location: comprar.php?evento=" . $eventoid . "&data=" . $id_data);
                        } else {
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                <div class="col-12 text-white py-2">
                                    <div class="row justify-content-between align-items-center bg-preto">
                                        <div class="col-auto datareservar">
                                            <?= htmlspecialchars($data) . "<span class='ps-4'>" . htmlspecialchars($hora) . "</span>" ?>
                                        </div>
                                        <?php
                                        $query = "SELECT eventos.lotacao, SUM(reservas.quantidade)
FROM `reservas`
RIGHT JOIN data_eventos
ON id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $lotacao, $ocupacao_reservas);

                                            if (!mysqli_stmt_fetch($stmt)) {
                                                echo "Error: " . mysqli_stmt_error($stmt);
                                            } else {
                                                $query = "SELECT SUM(compras.quantidade)
FROM `compras`
RIGHT JOIN data_eventos
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

                                                        if (isset($ocupacao_reservas) || isset($ocupacao_compras)) {
                                                            $ocupacao = 1 - ($lotacao - ($ocupacao_reservas + $ocupacao_compras)) / $lotacao;
                                                        } else {
                                                            $ocupacao = 0;
                                                        }

                                                        echo '<div class="col-auto"><div style="background-color: red; width: 32px; height: 32px;" class="rounded-circle"></div>';
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                }
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                        ?>

                                        <div class="col-auto pe-0">
                                            <a href="comprar.php?evento=<?= htmlspecialchars($eventoid) ?>&data=<?= htmlspecialchars($id_data) ?>"
                                               class="btn btn-azul-reserva w-100"><i
                                                        class="bi bi-cart d-block"></i></a>
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