<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Reservas</h1>
    </div>


    <!-- Content Row -->

    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div>
                <table id="tabelareservas" class="table table-striped">
                    <thead>
                    <tr class="rowtr">
                        <th>Reserva nº</th>
                        <th>Reservado por</th>
                        <th>Evento</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "connections/connection.php";

                    $link = new_db_connection();

                    //prepared statement
                    $stmt = mysqli_stmt_init($link);

                    //query
                    $query = "SELECT id_utilizadores, CONCAT(utilizadores.nome, ' ',apelido), ativo, email, timestamp, cargo.nome
FROM `utilizadores`
LEFT JOIN cargo
ON cargo.id_cargo = utilizadores.ref_id_cargo;";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_users, $nome, $ativo, $email, $data_criacao, $cargo);

                        while (mysqli_stmt_fetch($stmt)) { ?>

                            <tr>
                                <td><?= $id_users ?></td>
                                <td><?= $nome; ?></td>
                                <td><?= $email ?></td>
                                <td><?= $data_criacao ?></td>
                            </tr>
                            <?php
                        }
                        mysqli_stmt_close($stmt);
                    }
                    mysqli_close($link);

                    ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->


</div>
