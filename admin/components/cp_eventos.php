<div class="container-fluid">
    <?php
    if (isset($_GET["msg"])) {
        $msg_show = true;
        switch ($_GET["msg"]) {
            case 0:
                $message = "Evento eliminado.";
                $class = "alert-warning";
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
    <div class="d-sm-flex align-items-center justify-content-between">
        <h1 class="h3 mb-0 text-gray-800">Eventos/Memórias registados</h1>
    </div>


    <!-- Content Row -->

    <div class="panel panel-default">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div>
                <table id="tabelaeventos" class="table table-striped">
                    <thead>
                    <tr class="rowtr">
                        <th>Id</th>
                        <th>Estreia</th>
                        <th>Evento</th>
                        <th>Categoria</th>
                        <th>Data de Criação</th>
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
                    $query = "SELECT DISTINCT eventos.nome, id_eventos, data, descricao_curta, tipo_eventos.nome, timestamp  FROM `eventos` INNER JOIN data_eventos ON data_eventos.ref_id_eventos = id_eventos
INNER JOIN tipo_eventos ON tipo_eventos.id_tipo_eventos = ref_id_tipo_eventos
WHERE (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)  
ORDER BY `data_eventos`.`data`  DESC";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $nome, $id_evento, $data, $desc, $categoria, $data_criacao);

                        while (mysqli_stmt_fetch($stmt)) { ?>

                            <tr>
                                <td><?= $id_evento ?></td>
                                <td><?= $data ?></td>
                                <td><strong><?= $nome ?></strong></td>
                                <td><?= $categoria ?></td>
                                <td><?= $data_criacao ?></td>
                                <td><a href='eventos_edit.php?id=<?= $id_evento ?>' <i
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
