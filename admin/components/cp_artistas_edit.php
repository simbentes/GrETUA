<?php
require_once "connections/connection.php";
if (isset($_GET["id"])) {
    $id_artistas = $_GET["id"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT artistas.nome, artistas.biografia, artistas.ref_id_pais, artistas.instagram, artistas.facebook, artistas.spotify, artistas.youtube, paises.pais
FROM `artistas`
LEFT JOIN paises
ON artistas.ref_id_pais = paises.id_pais
WHERE id_artistas = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_artistas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $biografia, $ref_id_pais, $artistas_instagram, $artistas_facebook, $artistas_spotify, $artistas_youtube, $paises_pais);

        if (mysqli_stmt_fetch($stmt)) {



            //$_SESSION["id_user_edit"] = $id_user;
?>
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
                    $message = "Adicione uma foto ao evento";
                    $class = "alert-danger";
                    break;
                case 3:
                    $message = "<i class='far fa-check-circle pr-2'></i>Evento publicado com sucesso";
                    $class = "alert-success";
                    break;
                case 4:
                    $message = "Evento sem categoria definida";
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
                    <h1 class="h3 mb-0 text-gray-800">Gestão de artistas</h1>
                </div>


                <!-- Content Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <form role="form" method="post" action="scripts/sc_update_artistas.php?id=<?=$id_artistas?>">
                                    <div class="form-group">
                                        <label for="inputAddress">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nomeartista" placeholder="<?= $nome ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Biografia</label>
                                        <textarea class="form-control" id="biografia" rows="4" name="biografia"><?= $biografia ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="paisart">País</label>
                                        <select id="paisartista" name="paisartista" placeholder="<?= $paises_pais ?>" class="form-control">
                                            <option selected=""><?= $paises_pais ?></option>
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
                                        <?php if ($artistas_spotify ==""){
                                                $artistas_spotify ="Add Instagram account";
                                            } ?>
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" id="instagram" placeholder="<?= $artistas_instagram ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <?php if ($artistas_facebook ==""){
                                                $artistas_facebook ="Add Facebook account";
                                            } 
                                               ?> 
                                               <input type="text" class="form-control" id="facebook" placeholder="<?= $artistas_facebook ?>">
                                            
                                            
                                            </div>
                                        <div class="form-group">
                                        <?php if ($artistas_spotify ==""){
                                                $artistas_spotify ="Add Spotify account";
                                            } ?>
                                            <label for="spotify">Spotify</label>
                                            <input type="text" class="form-control text-muted" id="spotify" placeholder="<?= $artistas_spotify ?>">
                                        </div>
                                        <div class="form-group">
                                        <?php if ($artistas_youtube ==""){
                                                $artistas_youtube ="Add YouTube account";
                                            } ?>
                                            <label for="youtube">YouTube</label>
                                            <input type="text" class="form-control text-muted" id="youtube" placeholder="<?= $artistas_youtube ?>">
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
            
            header("Location: artistas_edit.php");
        }
        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }
} else {
    
    header("Location: artistas.php");
}

?>