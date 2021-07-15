<?php
require_once "connections/connection.php";
if (isset($_GET["id"])) {
    $eventos_id_eventos = $_GET["id"];

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
        mysqli_stmt_bind_param($stmt, "i", $eventos_id_eventos);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $eventos_id_eventos, $eventos_nome, $eventos_ref_id_artistas, $eventos_descricao, $eventos_descricao_curta, $eventos_ref_id_tipo_eventos,
        $eventos_lotacao, $eventos_preco_reserva, $eventos_preco_porta, $eventos_ficha_tecnica, $eventos_classificacao_etaria, $eventos_duracao,
        $artistas_id_artistas, $artistas_nome, $tipo_eventos_id_tipo_eventos, $tipo_eventos_nome);

        if (mysqli_stmt_fetch($stmt)) {

            
            ?>
            <div class="container-fluid">

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
                                <form action="scripts/sc_criar_evento.php" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="inputAddress">Nome</label>
                                        <input type="text" class="form-control" name="nomeevento" placeholder="<?= $eventos_nome?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="artista">Artista</label>
                                        <select id="artista" name="artista" class="form-control"
                                                onchange="verArtista(this.value)" required>
                                            <option selected=""><?= $artistas_nome?></option>
                                            <?php
                                            $query = "SELECT id_artistas, nome FROM `artistas` ORDER BY nome";

                                            if (mysqli_stmt_prepare($stmt, $query)) {

                                                mysqli_stmt_execute($stmt);

                                                mysqli_stmt_bind_result($stmt, $id_artistas, $nomeartistas);

                                                while (mysqli_stmt_fetch($stmt)) {
                                                    /* fetch values */
                                                    echo '<option value="' . $id_artistas . '">' . $nomeartistas . '</option>';
                                                }
                                            } else {
                                                echo "Error: " . mysqli_error($link);
                                            }
                                            ?>
                                            <option value="novoartista" class="font-weight-bolder">Novo Artista</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="dataevento">
                                        <label for="meeting-time" id="labeldata">Data</label>
                                        <input type="datetime-local" class="form-control" id="dataevento1 
                                                    name="dataevento1" min="1960-01-01T00:00" required>
                                    </div>
                                    <div id="adicionardata" class="btn btn-primary mb-3">Adicionar Data</div>
                                    <div id="removerdata"></div>
                                    <input type="hidden" id="numdatas" name="ndatas" value="1">
                                    <div class="form-group">
                                        <label for="textarea1">Descrição Curta</label>
                                        <textarea class="form-control" id="textarea1" name="curtadesc" rows="4"
                                                  required><?= $eventos_descricao_curta?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="textarea1">Descrição</label>
                                        <textarea class="form-control" id="textarea1" name="desc" rows="10"
                                                  required><?= $eventos_descricao?></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <label for="categoria">Categoria</label>
                                            <select id="categoria" name="tipoevento" class="form-control">
                                                <option value="" selected><?= $tipo_eventos_nome?></option>
                                                <?php
                                                $query = "SELECT id_tipo_eventos, nome FROM `tipo_eventos` ORDER BY nome";

                                                if (mysqli_stmt_prepare($stmt, $query)) {

                                                    mysqli_stmt_execute($stmt);

                                                    mysqli_stmt_bind_result($stmt, $id_tipoevento, $tipoeventonome);

                                                    while (mysqli_stmt_fetch($stmt)) {
                                                        /* fetch values */
                                                        echo '<option value="' . $id_tipoevento . '">' . $tipoeventonome . '</option>';
                                                    }
                                                } else {
                                                    echo "Error: " . mysqli_error($link);
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="outracategoria">Outra Categoria</label>
                                            <input type="text" name="outrotipoevento" class="form-control"
                                                   id="outracategoria">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-4">
                                            <label for="lotacao">Lotação</label>
                                            <input type="number" name="lotacao" class="form-control" id="lotacao" placeholder="<?= $eventos_lotacao?>"
                                                   min="0"
                                                   max="10000" required>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-4">
                                            <label for="precoreserva">Preço com Reserva</label>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-11 col-lg-10">
                                                    <input type="number" name="precoreserva" class="form-control"
                                                           id="precoreserva" placeholder="<?= $eventos_preco_reserva?>" min="0" max="999" step=".01" required>
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
                                                    <input type="number" name="precoporta" class="form-control"
                                                           id="precoporta" placeholder="<?= $eventos_preco_porta?>" min="0" max="999" step=".01" required>
                                                </div>
                                                <div class="col-auto pl-2">
                                                    €
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <div id="imgThumbnailPreview" class="row py-2">
                                        </div>
                                        <div class="py-2">
                                            <label for="files">Fotos do Evento: </label>
                                            <input id="files" name="fotos[]" type="file" multiple/>
                                        </div>
                                        <div id="fotocapacontainer" class="py-2" style="display: none">
                                            <label for="fotocapa">Capa</label>
                                            <select id="fotocapa" name="fotocapa" class="form-control"
                                                    required></select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary py-2 px-4">Publicar</button>
                                        </div>
                                    </div>
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
    header("Location: eventos.php");
}

?>