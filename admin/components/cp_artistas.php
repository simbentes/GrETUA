<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Artistas</h1>
    </div>


    <!-- Content Row -->

    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div>
                <table id="tabelaartistas" class="table table-striped dataTable no-footer" role="grid" aria-describedby="tabelaartistas_info" >
                    <thead>
                    <tr class="rowtr">
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>País</th>
                        <th>Operações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    require_once "connections/connection.php";

                    $link = new_db_connection();

                    //prepared statement
                    $stmt = mysqli_stmt_init($link);

                    //query
                    $query = "SELECT id_artistas, artistas.nome, artistas.biografia, artistas.ref_id_pais FROM artistas";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_artistas, $nome, $bio, $pais);

                        while (mysqli_stmt_fetch($stmt)) { ?>

                            <tr>
                                <td><?= htmlspecialchars($id_artistas) ?></td>
                                <td class="font-weight-bold"><?= htmlspecialchars($nome) ?></td>
                                <td><?= htmlspecialchars($bio) ?></td>
                                <td><?= htmlspecialchars($pais) ?></td>
                                <td><a href='artistas_edit.php?id=<?= htmlspecialchars($id_artistas) ?>' <i
                                            class="fa fa-edit fa-fw"></i></a></td>
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
