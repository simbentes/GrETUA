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
                    <div class="position-relative">
                        <section class="container px-0 frame-img">
                            <div id="framefotoevento" class="framefotopagpub"
                                 style="background-image: url('img/pub/<?= $foto ?>')">
                                <a id="voltar" href="gretua.php" class="voltar"><i
                                            class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                                <div id="share" class="share" onclick="partilharLink()"><i
                                            class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                                </div>
                            </div>
                            <script>
                                function partilharLink() {
                                    if (navigator.share) {
                                        navigator.share({
                                            title: '<?= $nome ?>',
                                            text: 'memorias... <?= $nome?>',
                                            url: window.location.href,
                                        })
                                            .then(() => console.log('Successful share'))
                                            .catch((error) => console.log('Error sharing', error));
                                    }
                                }
                            </script>
                        </section>
                        <section class="container g-0 pagpub-text">
                            <div>
                                <div class="evento-titulo px-3">
                                    <h1 class="pt-3 mt-2"><?= $titulo ?></h1>
                                    <p><?= $texto ?></p>
                                </div>
                            </div>
                        </section>
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
































