<?php
require_once "connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);
?>

<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php
        if (isset($_GET["msg"])) {
            $msg_show = true;
            switch ($_GET["msg"]) {
                case 0:
                    $message = "Faltam informações do Evento";
                    $class = "alert-danger";
                    break;
                case 1:
                    $message = "Faltam informações do Artista";
                    $class = "alert-danger";
                    break;
                case 2:
                    $message = "<i class='far fa-check-circle pr-2'></i>Evento publicado com sucesso";
                    $class = "alert-success";
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
        <h1 class="h3 mb-2 text-gray-800">Novo Evento <small>(ou Memória)</small></h1>
        <p class="mb-4">Publicar um novo Evento no plataforma. Se selecionar datas anteriores à atual, lembre-se que
            está a criar uma memórias.</p>

        <!-- DataTales Example -->
        <form action="scripts/sc_criar_evento.php" method="post" enctype="multipart/form-data">
            <div class="row justify-content-center">

                <div id="container-evento" class="col-lg-10">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Evento/Memória</h6>
                        </div>
                        <div class="card-body">
                            <div class="bg">

                                <div class="form-group">
                                    <label for="inputAddress">Nome</label>
                                    <input type="text" class="form-control" name="nomeevento">
                                </div>
                                <div class="form-group">
                                    <label for="artista">Artista</label>
                                    <select id="artista" name="artista" class="form-control"
                                            onchange="verArtista(this.value)">
                                        <option selected="">Selecionar</option>
                                        <?php
                                        $query = "SELECT id_artistas, nome FROM `artistas`";

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
                                    <input type="datetime-local" class="form-control" id="dataevento1"
                                           name="dataevento1" min="1960-01-01T00:00">

                                </div>
                                <div id="adicionardata" class="btn btn-primary mb-3">Adicionar Data</div>
                                <div id="removerdata"></div>
                                <input type="hidden" id="numdatas" name="ndatas" value="1">
                                <div class="form-group">
                                    <label for="textarea1">Descrição Curta</label>
                                    <textarea class="form-control" id="textarea1" name="curtadesc" rows="2"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="textarea1">Descrição</label>
                                    <textarea class="form-control" id="textarea1" name="desc" rows="4"></textarea>
                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-lg-6">
                                        <label for="categoria">Categoria</label>
                                        <select id="categoria" name="tipoevento" class="form-control">
                                            <option value="" selected>Selecionar</option>
                                            <?php
                                            $query = "SELECT id_tipo_eventos, nome FROM `tipo_eventos`";

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
                                        <input type="number" name="lotacao" class="form-control" id="lotacao" min="0">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-4">
                                        <label for="precoreserva">Preço com Reserva</label>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-11 col-lg-10">
                                                <input type="number" name="precoreserva" class="form-control"
                                                       id="precoreserva" min="0" step=".01">
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
                                                       id="precoporta" min="0" step=".01">
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
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Publicar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="container-artista" class="col-lg-4 d-none">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Novo Artista</h6>
                        </div>
                        <div class="card-body">
                            <div class="bg">

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
                                        $query = "SELECT id_pais, pais FROM `paises`";

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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.container-fluid -->

    </div>
</div>


<?php

mysqli_stmt_close($stmt);
mysqli_close($link);
?>
