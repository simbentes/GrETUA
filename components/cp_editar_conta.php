<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $id_user = $_SESSION["id_user"];

//posso concatenar, visto que o parametro não foi colocado pelo user
    $query = "SELECT utilizadores.nome, utilizadores.apelido, username, utilizadores.biografia, instagram, whatsapp, id_cargo, cargo.nome, cargo.color
FROM `utilizadores`
INNER JOIN cargo
ON utilizadores.ref_id_cargo = cargo.id_cargo
WHERE id_utilizadores = " . $_SESSION["id_user"];

    if (mysqli_stmt_prepare($stmt, $query)) {

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $nome, $apelido, $username, $biografia, $instagram, $whatsapp, $id_cargo, $cargo_nome, $cargo_color);


        if (mysqli_stmt_fetch($stmt)) {

            if (isset($_GET["msg"])) {
                $msg_show = true;
                switch ($_GET["msg"]) {
                    case 0:
                        $message = "Descrição muito longa.";
                        $class = "alert-danger";
                        break;
                    case 1:
                        $message = "Username inválido.";
                        $class = "alert-danger";
                        break;
                    case 2:
                        $message = "Faltam informações.";
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
            <form action="scripts/sc_editar_info_conta.php" method="post" enctype="multipart/form-data"
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
                                    <h3 class="mb-0">Editar Perfil</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn p-0">
                                <i class="bi bi-check2 confirmar-icon p-1 mb-0 h2"></i>
                            </button>
                        </div>

                    </div>

                </section>
                <section class="pt-4 container-fluid menu_perfil">
                    <section class="container pt-2">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-auto pb-4">
                                <div class="row">
                                    <div class="col text-center">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div id="upfoto" class="uploadfotoperfil position-relative">
                                                    <label for="avatar" id="maquina">
                                                        <img src="img/users/<?= htmlspecialchars($_SESSION["fperfil"]) ?>"
                                                             class="fotoperfilinput"
                                                             id="output"/>
                                                    </label>
                                                    <input type="file" id="avatar" name="foto" accept="image/*"
                                                           onchange="loadFile(event)">
                                                    <img class="fotoperfilinput d-none" id="output"/>
                                                    <script>
                                                        var loadFile = function (event) {
                                                            var output = document.getElementById('output');
                                                            output.src = URL.createObjectURL(event.target.files[0]);
                                                            output.onload = function () {
                                                                URL.revokeObjectURL(output.src) // free memory
                                                            }
                                                        };
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col text-center pt-2">
                                    <label for="avatar" class="labelfotoperfil">Alterar foto de perfil</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row mb-3 g-2">
                                    <div class="col">
                                        <label for="nome" class="mb-1">Nome</label>
                                        <input type="text" class="form-control forminfo formconta" id="nome" name="nome"
                                               value="<?= htmlspecialchars($nome) ?>" required>
                                    </div>
                                    <div class="col">
                                        <label for="apelido" class="mb-1">Apelido</label>
                                        <input type="text" class="form-control forminfo formconta" id="apelido"
                                               name="apelido"
                                               value="<?= htmlspecialchars($apelido) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="mb-1">Username</label>
                                    <input type="text" class="form-control forminfo formconta" id="username"
                                           value="<?= htmlspecialchars($username) ?>" name="username" required>

                                </div>
                                <div class="mb-3">
                                    <label for="biografia" class="mb-1">Biografia</label>
                                    <textarea class="form-control tainfo taconta" name="biografia" id="biografia"
                                              rows="5"
                                              onkeydown="caixatexto()"><?= htmlspecialchars($biografia) ?></textarea>
                                    <div class="text-end"><small id="nchar"></small></div>
                                    <script>
                                        window.onload = function () {
                                            caixatexto()
                                        }
                                        var caixatexto = function (event) {
                                            var texto = document.getElementById('biografia').value;
                                            var resultado = 200 - texto.length

                                            if (resultado < 0) {
                                                document.getElementById('nchar').style.color = "#f13e3e";
                                            } else {
                                                document.getElementById('nchar').style.color = "white";
                                            }
                                            document.getElementById('nchar').innerHTML = resultado;
                                        };
                                    </script>
                                </div>
                                <hr class="my-3">
                                <div class="mb-3">
                                    <label for="instagram" class="mb-1">Instagram <small>(username)</small></label>
                                    <input type="text" class="form-control forminfo formconta" id="instagram"
                                           value="<?= htmlspecialchars($instagram) ?>" name="instagram">

                                </div>
                                <div class="mb-3">
                                    <label for="whatsapp" class="mb-1">WhatsApp <small>(Número de
                                            telefone)</small></label>
                                    <input type="text" class="form-control forminfo formconta" id="whatsapp"
                                           value="<?= htmlspecialchars($whatsapp) ?>" name="whatsapp">
                                </div>


                            </div>
                            <div class="container">
                                <label>Selecionar Cargo</label>
                            </div>

                        </div>
                    </section>

                </section>

                <div class="scrollcargos mb-6">
                    <input type="radio" class="d-none btn-cargos" name="cargo"
                           id="<?= htmlspecialchars($id_cargo) ?>" autocomplete="off"
                           value="<?= htmlspecialchars($id_cargo) ?>" required checked autofocus>
                    <label class="m-1 ms-4 badge label-cargos d-inline-block bg-<?= htmlspecialchars($cargo_color) ?>"
                           for="<?= htmlspecialchars($id_cargo) ?>"><?= htmlspecialchars($cargo_nome) ?>

                    </label>

                    <?php
                    $query2 = "SELECT id_cargo, cargo.nome, color, utilizadores.ref_id_cargo FROM cargo INNER JOIN utilizadores ON id_utilizadores = $id_user WHERE id_cargo != utilizadores.ref_id_cargo AND id_cargo != 2 ORDER BY cargo.nome";
                    if (mysqli_stmt_prepare($stmt, $query2)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $cargo_id, $nome_cargo, $cor_cargo, $antigo_cargo);
                        mysqli_stmt_store_result($stmt);

                        while (mysqli_stmt_fetch($stmt)) {
                            ?>

                            <input type="radio" class="d-none btn-cargos" name="cargo"
                                   id="<?= htmlspecialchars($cargo_id) ?>" autocomplete="off"
                                   value="<?= htmlspecialchars($cargo_id) ?>" required>
                            <label class="m-1 badge label-cargos d-inline-block bg-<?= htmlspecialchars($cor_cargo) ?>"
                                   for="<?= htmlspecialchars($cargo_id) ?>"><?= htmlspecialchars($nome_cargo) ?></label>


                            <?php
                        }
                    }
                    ?>
                </div>
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
