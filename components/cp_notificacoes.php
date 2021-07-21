<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:
    ?>
    <section class="container-fluid pt-3 pb-2 px-3 topindexmenu">
        <div class="row gx-0 align-items-center">
            <div class="col-auto">
                <a href="gretua.php" class="text-white"><i class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
            </div>
            <div class="col-auto ps-3">
                <h3 class="mb-0">Notificações</h3>
            </div>
        </div>
    </section>
    <section id="info_notificacoes" class="py-4 container-fluid px-3 menu_perfil">
        <h6 class="notdias pt-2">Novo</h6>
        <div class="row">
            <div class="col-12">
                <div class="row align-items-center justify-content-between">
                    <?php

                    require_once("connections/connection.php");

                    $link = new_db_connection();
                    $stmt = mysqli_stmt_init($link);

                    $query = "SELECT quemgostou.id_utilizadores, CONCAT(quemgostou.nome, ' ', quemgostou.apelido), quemgostou.foto_perfil, publicacoes.titulo, gostos.timestamp
FROM publicacoes
INNER JOIN gostos
ON gostos.ref_id_publicacoes = id_publicacoes
INNER JOIN utilizadores AS quempublica
ON quempublica.id_utilizadores = publicacoes.ref_id_utilizadores
INNER JOIN utilizadores AS quemgostou
ON quemgostou.id_utilizadores = gostos.ref_id_utilizadores
WHERE quempublica.id_utilizadores = " . $_SESSION["id_user"] . " AND quemgostou.id_utilizadores != " . $_SESSION["id_user"];

                    if (mysqli_stmt_prepare($stmt, $query)) {

                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $id_quemgostou, $nome_quemgostou, $fperfil_quemgostou, $titulo, $dia);
                        mysqli_stmt_store_result($stmt);

                        if (mysqli_stmt_num_rows($stmt) == 0) {
                            echo "<div class='text-center center-pagina'><h1 class='mb-50px'>Não tens notificações.</h1></div>";
                        } else {
                            while (mysqli_stmt_fetch($stmt)) {


                                ?>

                                <div class="col-12 py-2">
                                    <div class="row">
                                        <div class="col-auto pe-1">
                                            <a>
                                                <img src="img/users/<?= htmlspecialchars($fperfil_quemgostou) ?>" class="userbubble me-2">
                                            </a>
                                        </div>
                                        <div class="col ps-1 noti-text">
                                            <strong><?= htmlspecialchars($nome_quemgostou) ?></strong> gostou da tua publicação
                                            <strong><?= htmlspecialchars($titulo) ?></strong>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }

                    mysqli_stmt_close($stmt);
                    mysqli_close($link);

                    ?>

                </div>
            </div>
        </div>
    </section>
<?php
endif;