<?php
require_once "connections/connection.php";
if (isset($_GET["id"])) {
    $id_user = $_GET["id"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT CONCAT(utilizadores.nome, ' ',apelido), ativo, username, email, timestamp, id_cargo, cargo.nome
FROM `utilizadores`
LEFT JOIN cargo
ON cargo.id_cargo = utilizadores.ref_id_cargo
WHERE id_utilizadores = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $ativo, $username, $email, $data_criacao, $id_cargo, $cargo);

        if (mysqli_stmt_fetch($stmt)) {

            if ($ativo == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }

            $_SESSION["id_user_edit"] = $id_user;
            ?>
            <div class="container-fluid">
                <?php
                if (isset($_GET["msg"])) {
                    $msg_show = true;
                    switch ($_GET["msg"]) {
                        case 0:
                            $message = "Informações alteradas.";
                            $class = "alert-success";
                            break;
                        case 1:
                            $message = "Erro.";
                            $class = "alert-danger";
                            break;
                        default:
                            $msg_show = false;
                    }

                    if ($msg_show) {
                        echo "<div class=\"alert $class alert-dismissible fade show\" role=\"alert\">
" . $message . "
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>
</div>";
                    }
                }
                ?>

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
                                <form role="form" method="post" action="scripts/sc_users_update.php" autocomplete="off">
                                    <input type="hidden" name="id_users" value="{$id_users}">
                                    <div class="form-group">
                                        <label>ID do utilizador</label>
                                        <p class="form-control-static"><?= htmlspecialchars($id_user) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Data de criação</label>
                                        <p class="form-control-static"><?= htmlspecialchars($data_criacao) ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username"
                                               value="<?= htmlspecialchars($username) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" value="<?= htmlspecialchars($email) ?>">
                                    </div>
                                    <?php if ($id_user != $_SESSION["id_user"]): ?>
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="active" <?= htmlspecialchars($checked) ?>> Activo
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

                                                    mysqli_stmt_bind_result($stmt, $id_cargos, $cargo_nome);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($cargo == $cargo_nome) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "<option value='$id_cargos' $selected>$cargo_nome</option>";
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
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

            header("Location: users_edit.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {

    header("Location: users.php");
}
?>