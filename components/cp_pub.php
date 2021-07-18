<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    if (isset($_GET["id"])) {
        $id_pub = $_GET["id"];

        require_once "connections/connection.php";
        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT publicacoes.timestamp, titulo, texto, foto, ref_id_eventos, id_utilizadores, CONCAT(utilizadores.nome, ' ', apelido), utilizadores.foto_perfil, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(publicacoes.timestamp), gostos.ref_id_utilizadores
FROM publicacoes
INNER JOIN utilizadores
ON id_utilizadores = ref_id_utilizadores
LEFT JOIN gostos
ON gostos.ref_id_publicacoes = id_publicacoes AND gostos.ref_id_utilizadores = " . $_SESSION["id_user"] . "
WHERE id_publicacoes = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, "i", $id_pub);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $data_pub, $titulo, $texto, $foto, $ref_id_eventos, $id_user, $nome_user, $fperfil_user, $unix_ts, $gosto);

            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                /* fetch values */
                mysqli_stmt_fetch($stmt);
                ?>
                <main>
                    <div class="pagpub">
                        <a id="voltar" href="gretua.php" class="voltar"><i
                                    class="bi bi-chevron-left p-1 mb-0 h2"></i></a>

                        <?php if (isset($foto)): ?>
                            <img src="img/pub/<?= $foto ?>"
                                 class="pub-img-top" alt="...">
                        <?php else:
                            $ps5 = "ps-5 ms-2";
                        endif;
                        ?>
                        <input id="likeinput-<?= $id_pub ?>" value="<?= $id_pub ?>" class="btn-vou"
                               type="checkbox" onclick="likePub(this.checked, this.value)" <?php if ($gosto == 1) {
                            echo "checked";
                        } ?>> <label

                                id="like24" class="btn btn-like " for="likeinput-<?= $id_pub ?>">
                            <?php if ($gosto == 1): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                </svg>
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                </svg>
                            <?php endif; ?>
                        </label>
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto <?= $ps5 ?>"><a href="perfil.php?id=22">
                                        <div class="infouser"><img
                                                    src="img/users/<?= $fperfil_user ?>"
                                                    class="userbubble"> <span
                                                    class="utilizador"><?= $nome_user ?></span></div>
                                    </a></div>
                                <div id="diferencatempo" class="col-auto infotime d-flex align-items-center"></div>
                            </div>
                        </div>
                        <div class="card-body"><h5 class="card-title"><?= $titulo ?></h5>
                            <p class="card-text"><?= $texto ?></p>
                            <div class="row">
                                <div class="col-auto pe-0"><img
                                            src="img/users/4c150d13840805f07d586f3314cd648a.webp"
                                            class="userbubble"></div>
                                <div class="col">
                                    <form method="POST" action="sc_comentar.php?id=24"><input type="text"
                                                                                              name="comentario"
                                                                                              class="form-control comentar"
                                                                                              id="comentarios-24"
                                                                                              placeholder="Comentar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid p-3 mb-5">
                        <div class="row">


                            <?php


                            $query = "SELECT id_utilizadores, CONCAT(nome, ' ', apelido), foto_perfil, comentarios.texto, DATE_FORMAT(comentarios.timestamp, '%d-%m-%Y %Hh%i')
FROM `comentarios`
INNER JOIN utilizadores
ON id_utilizadores = ref_id_utilizadores
WHERE ref_id_publicacoes = ?
ORDER BY comentarios.timestamp DESC";

                            if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $id_pub);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_user, $nome_user, $fperfil, $comentario, $data_comentario);
                            mysqli_stmt_store_result($stmt);

                            if (mysqli_stmt_num_rows($stmt) != 0) {
                            while (mysqli_stmt_fetch($stmt)) {
                            ?>
                            <div class="col-12 py-2">
                                <div class="row align-items-center">
                                    <div class="col-auto pe-1">
                                        <a href="perfil.php?id=<?= $id_user ?>">
                                            <img src="img/users/<?= $fperfil ?>"
                                                 class="userbubble me-2">
                                        </a>
                                    </div>
                                    <div class="col ps-1 noti-text">
                                        <strong class="pe-2"><?= $nome_user ?></strong><?= $comentario ?>
                                        <div class="small text-muted"><?= $data_comentario ?></div>
                                    </div>
                                </div>
                            </div>





                        <?php
                        }
                        }
                        } else {
                            echo "Error: " . mysqli_error($link);
                        }

                        ?>


                    </div>
                    </div>
                </main>
                <?php

            } else {
                //não existe ou o seu vendedor está desativado
                header("Location: memorias.php");
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
        header("Location: memorias.php");
    }

endif;
































