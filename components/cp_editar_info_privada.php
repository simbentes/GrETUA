<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $id_user = $_SESSION["id_user"];

    $query = "SELECT utilizadores.email, utilizadores.telemovel
FROM `utilizadores`
WHERE id_utilizadores = " . $_SESSION["id_user"];

    if (mysqli_stmt_prepare($stmt, $query)) {

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $email, $telefone);


        if (mysqli_stmt_fetch($stmt)) {

            if (isset($_GET["msg"])) {
                $msg_show = true;
                switch ($_GET["msg"]) {
                    case 0:
                        $message = "Palavra-passe diferentes.";
                        $class = "alert-danger";
                        break;
                    case 1:
                        $message = "Palavra-passe igual à anterior.";
                        $class = "alert-danger";
                        break;
                    case 2:
                        $message = "Palavra-passe errada.";
                        $class = "alert-danger";
                        break;
                    case 3:
                        $message = "Email em falta.";
                        $class = "alert-danger";
                        break;
                    case 4:
                        $message = "Alterações efetuadas.";
                        $class = "alert-success";
                        break;
                    case 5:
                        $message = "Alterações efetuadas e palavra-passe alterada.";
                        $class = "alert-success";
                        break;
                    case 6:
                        $message = "Campos de alteração de password incompletos.";
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

            ?>
            <form action="scripts/sc_editar_info_privada.php" method="post" enctype="multipart/form-data"
                  class="px-0 mb-5" autocomplete="off">

                <section class="container-fluid pt-3 pb-2 px-3 topindexmenu">
                    <div class="row align-content-center justify-content-between">
                        <div class="col-auto">
                            <div class="row gx-0 align-items-center">
                                <div class="col-auto">
                                    <a href="conta.php" class="text-white"><i
                                                class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
                                </div>
                                <div class="col-auto ps-3">
                                    <h3 class="mb-0">Privacidade</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#reservarBilheteModal" id="btn-modal">
                                <i class="bi bi-check2 confirmar-icon p-1 mb-0 h2"></i>
                            </button>
                        </div>

                    </div>
                    <!-- Modal -->
                    <section class="modal fade" id="reservarBilheteModal" tabindex="-1"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content p-0">
                                <div class="modal-body text-center">
                                    <h5 class="mt-3">Confirma as alterações?</h5>
                                    <i class="bi bi-exclamation-octagon h0 text-danger"></i>
                                    <div id="pass-confirmar"></div>
                                    <p class="py-2 m-0">Esta ação é irreversível.</p>
                                </div>
                                <div class="modal-footer p-0">
                                    <button type="submit" class="btn botaomodal py-3 m-0 w-100">CONFIRMAR</button>
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
                <section class="pt-4 container-fluid menu_perfil">
                    <section class="container pt-2">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12">


                                <div class="mb-3">
                                    <label for="email" class="mb-1">Email</label>
                                    <input type="email" class="form-control forminfo formconta" id="email"
                                           value="<?= $email ?>" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telefone" class="mb-1">Número de
                                        telefone</label>
                                    <input type="tel" class="form-control forminfo formconta" id="telefone"
                                           value="<?= $telefone ?>" name="telefone">
                                </div>


                            </div>
                            <hr class="my-3">
                            <h6 class="fw-bold mb-3">Alterar Palavra-passe</h6>
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="password" class="form-control forminfo formconta" id="passatual"
                                           name="passatual" minlength="8" placeholder="Palavra-passe atual">

                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control forminfo formconta" id="passnova"
                                           name="passnova" minlength="8" placeholder="Palavra-passe nova">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control forminfo formconta" id="passnova2"
                                           name="passnova2" minlength="8" placeholder="Repetir a palavra-passe nova">
                                </div>
                            </div>
                        </div>
                    </section>

                </section>
            </form>
            <?php
        } else {
            header("Location: index.php");
        }

        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }

endif;
