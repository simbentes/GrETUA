<?php
require_once "connections/connection.php";
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT CONCAT(utilizadores.nome, ' ',apelido), ativo, username, email, timestamp, cargo.nome
FROM `utilizadores`
LEFT JOIN cargo
ON cargo.id_cargo = utilizadores.ref_id_cargo
WHERE id_utilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $ativo, $username, $email, $data_criacao, $cargo);

        if (mysqli_stmt_fetch($stmt)) {

            if ($ativo == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }

            $_SESSION["id_user_edit"] = $id_user;
            ?>
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Gestão de utilizadores</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="post" action="scripts/sc_users_update.php">
                                    <input type="hidden" name="id_users" value="{$id_users}">
                                    <div class="form-group">
                                        <label>ID do utilizador</label>
                                        <p class="form-control-static"><?= $id_user ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Data de criação</label>
                                        <p class="form-control-static"><?= $data_criacao ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username"
                                               value="<?= $username ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" value="<?= $email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="active" <?= $checked ?>> Activo
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Perfil</label>
                                        <select class="form-control" name="id_cargo">
                                            <?php
                                            $query = "SELECT id_cargo,cargo.nome FROM `cargo`;";

                                            if (mysqli_stmt_prepare($stmt, $query)) {

                                                mysqli_stmt_execute($stmt);

                                                mysqli_stmt_bind_result($stmt, $id_cargo, $cargo_nome);

                                                while (mysqli_stmt_fetch($stmt)) {
                                                    if($cargo == $cargo_nome) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "<option value='$id_cargo' $selected>$cargo_nome</option>";
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($link);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Submeter alterações
                                    </button>
                                </form>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>

                </div>


            </div>
            <?php
        } else {
            //não existe ou o seu vendedor está desativado
            header("Location: catalogo.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    //não existe nenhuma query string do album
    header("Location: users.php");
}
?>