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
                        <th>Nº entradas</th>
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
                    $query = "SELECT id_reservas, CONCAT(utilizadores.nome, ' ',apelido), eventos.nome, data_eventos.data, reservas.quantidade
FROM `reservas`
INNER JOIN utilizadores
ON id_utilizadores = reservas.ref_id_utilizadores
INNER JOIN data_eventos
ON id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE data_eventos.data > NOW()
ORDER BY data_eventos.data;";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_reservas, $nome_user, $nome_evento, $data_evento, $quantidade);

                        while (mysqli_stmt_fetch($stmt)) { ?>

                            <tr>
                                <td><?= htmlspecialchars($id_reservas) ?></td>
                                <td><?= htmlspecialchars($nome_user) ?></td>
                                <td><?= htmlspecialchars($quantidade) ?></td>
                                <td><?= htmlspecialchars($nome_evento) ?></td>
                                <td><?= htmlspecialchars($data_evento) ?></td>
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
