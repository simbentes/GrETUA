<?php
require_once "connections/connection.php";
if (isset($_GET["id"])) {
    $id_evento = $_GET["id"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.id_eventos, eventos.nome, eventos.ref_id_artistas, eventos.descricao, eventos.descricao_curta, eventos.ref_id_tipo_eventos,
    eventos.lotacao, eventos.preco_reserva, eventos.preco_porta, eventos.ficha_tecnica, eventos.classificacao_etaria, eventos.duracao,
    artistas.id_artistas, artistas.nome, tipo_eventos.id_tipo_eventos, tipo_eventos.nome
FROM `eventos`
INNER JOIN artistas
ON artistas.id_artistas = eventos.ref_id_artistas
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE eventos.id_eventos = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_evento);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $eventos_id_eventos, $eventos_nome, $eventos_ref_id_artistas, $eventos_descricao, $eventos_descricao_curta, $eventos_ref_id_tipo_eventos,
            $eventos_lotacao, $eventos_preco_reserva, $eventos_preco_porta, $eventos_ficha_tecnica, $eventos_classificacao_etaria, $eventos_duracao,
            $artistas_id_artistas, $artistas_nome, $tipo_eventos_id_tipo_eventos, $tipo_eventos_nome);

        if (mysqli_stmt_fetch($stmt)) {
            $_SESSION["id_evento_edit"] = $id_evento;
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
                            $message = "Faltam informações.";
                            $class = "alert-danger";
                            break;
                        case 2:
                            $message = "Evento eliminado.";
                            $class = "alert-warning";
                            break;
                        case 3:
                            $message = "Erro ao eliminar evento.";
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
                    <h1 class="h3 mb-0 text-gray-800">Gestão de Eventos/Memórias</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form action="scripts/sc_eventos_update.php" method="post" enctype="multipart/form-data"
                                      class="mb-4"
                                      autocomplete="off">


                                    <div class="form-group">
                                        <label for="inputAddress">Nome</label>
                                        <input type="text" class="form-control" name="nomeevento"
                                               value="<?= $eventos_nome ?>"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label for="artista">Artista</label>
                                        <input type="text" id="artista" class="form-control"
                                               value="<?= $artistas_nome ?>"
                                               disabled>
                                        </select>
                                    </div>
                                    <div class="form-group" id="dataevento">
                                        <label for="meeting-time" id="labeldata">Data</label>
                                        <?php
                                        $query = "SELECT DATE_FORMAT(data, '%Y-%m-%dT%H:%i:%s') FROM `data_eventos` WHERE ref_id_eventos = ?";

                                        if (mysqli_stmt_prepare($stmt, $query)) {
                                            mysqli_stmt_bind_param($stmt, "i", $id_evento);
                                            mysqli_stmt_execute($stmt);

                                            mysqli_stmt_bind_result($stmt, $data);

                                            $countdatas = 0;
                                            while (mysqli_stmt_fetch($stmt)) {
                                                $countdatas++
                                                ?>
                                                <input type="datetime-local" class="form-control my-2"
                                                       id="data<?= $countdatas ?>"
                                                       name="dataevento<?= $countdatas ?>" value="<?= $data ?>"
                                                       required>
                                                <?php
                                            }
                                        } else {
                                            echo "Error: " . mysqli_error($link);
                                        }
                                        ?>
                                    </div>
                                    <div id="adicionardata" class="btn btn-primary mb-3">Adicionar
                                        Data
                                    </div>
                                    <div id="removerdata"></div>
                                    <input type="hidden" id="numdatas" name="ndatas" value="<?= $countdatas ?>">
                                    <div class="form-group">
                                        <label for="textarea1">Descrição Curta</label>
                                        <textarea class="form-control" id="textarea1"
                                                  name="curtadesc" rows="2"
                                                  required><?= $eventos_descricao_curta ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="textarea1">Descrição</label>
                                        <textarea class="form-control" id="textarea1" name="desc"
                                                  rows="4"
                                                  required><?= $eventos_descricao ?></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="ftecnica">Ficha Técnica</label>
                                        <textarea class="form-control" id="ftecnica" name="ftecnica"
                                                  rows="4"><?= $eventos_ficha_tecnica ?></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-4">
                                            <label for="categoria">Categoria</label>
                                            <select id="categoria" name="tipoevento"
                                                    class="form-control">
                                                <option value="">Selecionar</option>
                                                <?php
                                                $query = "SELECT id_tipo_eventos, nome FROM `tipo_eventos` ORDER BY nome";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    mysqli_stmt_execute($stmt);

                                                    mysqli_stmt_bind_result($stmt, $id_tipoevento, $tipoeventonome);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        if ($id_tipoevento == $tipo_eventos_id_tipo_eventos) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        /* fetch values */
                                                        echo '<option value="' . $id_tipoevento . '" ' . $selected . '>' . $tipoeventonome . '</option>';
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="outracategoria">Outra Categoria</label>
                                            <input type="text" name="outrotipoevento"
                                                   class="form-control"
                                                   id="outracategoria" disabled>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label for="duracao">Duração (m)</label>
                                            <input type="number" name="duracao" class="form-control"
                                                   id="duracao" min="0"
                                                   max="10000" value="<?= $eventos_duracao ?>" required>
                                        </div>
                                        <div class="form-group col-lg-2">
                                            <label for="classetaria">C/ Etária</label>
                                            <input type="number" name="cetaria" class="form-control"
                                                   id="classetaria" min="0"
                                                   max="10000" value="<?= $eventos_classificacao_etaria ?>" required>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-4">
                                            <label for="lotacao">Lotação</label>
                                            <input type="number" name="lotacao" class="form-control"
                                                   id="lotacao" min="0"
                                                   max="10000" value="<?= $eventos_lotacao ?>" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-4">
                                            <label for="precoreserva">Preço com Reserva</label>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-11 col-lg-10">
                                                    <input type="number" name="precoreserva"
                                                           class="form-control"
                                                           id="precoreserva" min="0" max="999"
                                                           step=".01" value="<?= $eventos_preco_reserva ?>" required>
                                                </div>
                                                <div class="col-auto pl-2">
                                                    €
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-4">
                                            <label for="precoporta">Preço à Porta</label>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-11 col-lg-10">
                                                    <input type="number" name="precoporta"
                                                           class="form-control"
                                                           id="precoporta" value="<?= $eventos_preco_porta ?>" min="0"
                                                           max="999"
                                                           step=".01" required>
                                                </div>
                                                <div class="col-auto pl-2">
                                                    €
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-info">Submeter alterações
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <a type="submit" href="scripts/sc_evento_delete.php" class="btn btn-danger">Eliminar
                                                evento</a>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <?php
        } else {

            header("Location: eventos_edit.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {

    header("Location: eventos.php");
}
?>
