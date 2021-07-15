<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once("connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'ano',
            'm' => 'mês',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' atrás' : 'agora';
    }

    ?>

    <main class="py-5">
        <section class="container-fluid pb-2">
            <div class="row">
                <?php
                $query = "SELECT id_publicacoes, titulo, texto, foto, ref_id_utilizadores, ref_id_eventos, publicacoes.timestamp FROM publicacoes INNER JOIN utilizadores ON id_utilizadores = ref_id_utilizadores ORDER BY publicacoes.timestamp DESC";


                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id_publicacoes, $titulo, $texto, $fotopub, $ref_id_utilizadores, $ref_id_eventos, $datapub);

                    mysqli_stmt_store_result($stmt);

                    while (mysqli_stmt_fetch($stmt)) {

                        $stmt2 = mysqli_stmt_init($link);
                        $query2 = "SELECT nome, apelido, foto_perfil FROM `utilizadores` WHERE id_utilizadores = $ref_id_utilizadores";

                        if (mysqli_stmt_prepare($stmt2, $query2)) {

                            mysqli_stmt_execute($stmt2);

                            mysqli_stmt_bind_result($stmt2, $nome, $apelido, $foto_perfil);

                            mysqli_stmt_store_result($stmt2);

                            while (mysqli_stmt_fetch($stmt2)) {
                                ?>

                                <div class="col-12 py-3">
                                    <div class="card pubfeed">
                                        <div class="card-body">
                                            <div class="row row-cols-auto justify-content-between">
                                                <div class="col">
                                                    <div class="infouser">
                                                        <img src="img/users/<?= $foto_perfil ?>" class="userbubble">
                                                        <span class="utilizador"><?php echo $nome . " " . $apelido . " " . time_elapsed_string($datapub); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($fotopub)) {
                                            ?>
                                            <img src="img/pub/<?= $fotopub ?>" class="card-img-top" alt="...">
                                            <?php
                                        }
                                        ?>
                                        <button class="btn btn-like">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor"
                                                 class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                            </svg>
                                        </button>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $titulo ?></h5>
                                            <p class="card-text"><?= $texto ?></p>
                                            <div class="row">
                                                <div class="col-auto pe-0">
                                                    <img src="img/users/<?= $_SESSION["fperfil"] ?>" class="userbubble">
                                                </div>
                                                <div class="col">
                                                    <form method="POST"
                                                          action="sc_comentar.php?id=<?= $id_publicacoes ?>">
                                                        <input type="text" name="comentario"
                                                               class="form-control comentar" id="exampleInputEmail1"
                                                               placeholder="Comentar">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                } else {
                    echo "Error: " . mysqli_error($link);
                }
                ?>
            </div>
        </section>
    </main>
    <?php
    mysqli_stmt_close($stmt);
    mysqli_close($link);

endif;