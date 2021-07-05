<?php

// We need the function!
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//posso concatenar, visto que o parametro não foi colocado pelo user
$query = "SELECT utilizadores.nome, utilizadores.apelido, foto_perfil, utilizadores.descricao, conta_instagram, conta_whatsapp
FROM `utilizadores`
WHERE id_utilizadores = " . $_SESSION["id_user"];

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $nome, $apelido, $foto_perfil, $biografia, $instagram, $whatsapp);


    if (mysqli_stmt_fetch($stmt)) {
        ?>
        <section class="py-4 container-fluid px-3 menu_perfil">
            <section class="container pt-2">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12">
                        <div>
                            <?php
                            if (isset($_GET["msg"])) {
                                $msg_show = true;
                                switch ($_GET["msg"]) {
                                    case 0:
                                        $message = "Password errada";
                                        $class = "alert-danger";
                                        break;
                                    case 1:
                                        $message = "Alterações efetuadas.";
                                        $class = "alert-success";
                                        break;
                                    case 2:
                                        $message = "Morada mal preenchida.";
                                        $class = "alert-danger";
                                        break;
                                    default:
                                        $msg_show = false;
                                }

                                echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
                                if ($msg_show) {
                                    echo '<script>window.onload=function (){$(\'.alert\').alert();}</script>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <form action="scripts/sc_user_register.php" method="post" class="px-0">
                        <div class="col-auto pb-4">
                            <div class="row">
                                <div class="col text-center">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div id="upfoto" class="uploadfotoperfil position-relative">
                                                <label for="avatar" id="maquina">
                                                    <img src="img/<?= $foto_perfil ?>" class="fotoperfilinput"
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
                                           value="<?= $nome ?>" required>
                                </div>
                                <div class="col">
                                    <label for="apelido" class="mb-1">Apelido</label>
                                    <input type="text" class="form-control forminfo formconta" id="apelido"
                                           name="apelido"
                                           value="<?= $apelido ?>" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="biografia" class="mb-1">Biografia</label>
                                <textarea class="form-control tainfo taconta" id="biografia" rows="4"><?= $biografia ?></textarea>
                            </div>
                            <hr class="my-3">
                            <div class="mb-3">
                                <label for="instagram" class="mb-1">Instagram <small>(username)</small></label>
                                <input type="text" class="form-control forminfo formconta" id="instagram"
                                       value="<?= $instagram ?>" name="instagram">

                            </div>
                            <div class="mb-3">
                                <label for="whatsapp" class="mb-1">WhatsApp <small>(Número de telefone)</small></label>
                                <input type="text" class="form-control forminfo formconta" id="whatsapp"
                                       value="<?= $whatsapp ?>" name="whatsapp">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </section>


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
