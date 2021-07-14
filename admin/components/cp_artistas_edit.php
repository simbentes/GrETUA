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
                    <h1 class="h3 mb-0 text-gray-800">Gestão de artistas</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="post" action="scripts/sc_users_update.php">
                                    <div class="form-group">
                                        <label for="inputAddress">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nomeartista">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Biografia</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                                  rows="4" name="artistadesc"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="paisart">País</label>
                                        <select id="paisart" name="paisartista" class="form-control">
                                            <option selected="">Selecionar</option>
                                            <?php
                                            $query = "SELECT id_pais, pais FROM `paises` ORDER BY pais";

                                            if (mysqli_stmt_prepare($stmt, $query)) {

                                                mysqli_stmt_execute($stmt);

                                                mysqli_stmt_bind_result($stmt, $id_pais, $pais);

                                                while (mysqli_stmt_fetch($stmt)) {
                                                    /* fetch values */
                                                    echo '<option value="' . $id_pais . '">' . $pais . '</option>';
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($link);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="redes py-2">
                                        <h6 class="font-weight-bolder">Redes Sociais</h6>
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" id="instagram">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" id="facebook">
                                        </div>
                                        <div class="form-group">
                                            <label for="spotify">Spotify</label>
                                            <input type="text" class="form-control" id="spotify">
                                        </div>
                                        <div class="form-group">
                                            <label for="youtube">YouTube</label>
                                            <input type="text" class="form-control" id="youtube">
                                        </div>
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