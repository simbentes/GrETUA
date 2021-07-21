<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once "connections/connection.php";

    if (isset($_GET["artista"])) {
        $artistaid = $_GET["artista"];

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "SELECT artistas.nome, artistas.biografia, artistas.ref_id_pais, artistas.instagram, artistas.facebook, artistas.spotify, artistas.youtube FROM artistas WHERE id_artistas = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, "i", $artistaid);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $nome_artista, $bio, $pais, $insta, $fb, $spotify, $yt);

            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                /* fetch values */
                mysqli_stmt_fetch($stmt);

                ?>

                <div class="position-relative">
                    <section class="container px-0 frame-img">
                        <div id="framefotoevento" class="framefotoevento"
                             style="background-image: url('img/eventos/<?php

                             $query = "SELECT foto FROM `fotos_eventos` 
INNER JOIN eventos 
ON eventos.id_eventos = fotos_eventos.ref_id_eventos
WHERE eventos.ref_id_artistas = ?;";

                             if (mysqli_stmt_prepare($stmt, $query)) {
                                 mysqli_stmt_bind_param($stmt, "i", $artistaid);
                                 mysqli_stmt_execute($stmt);

                                 mysqli_stmt_bind_result($stmt, $foto);

                                 while (mysqli_stmt_fetch($stmt)) {
                                     $array_fotos[] = $foto;
                                 }

                                 if (isset($array_fotos)) {
                                     echo $array_fotos[array_rand($array_fotos)];
                                 }

                             } else {
                                 echo "Error: " . mysqli_error($link);
                             }
                             ?>')">
                            <div class="degrade-imagem"></div>
                            <a id="voltar" href="eventos.php" class="voltar"><i
                                        class="bi bi-chevron-left p-1 mb-0 h2"></i></a>
                            <div id="share" class="share" onclick="partilharLink()"><i
                                        class="bi bi-box-arrow-up p-1 mb-0 h2"></i>
                            </div>
                        </div>
                        <script>
                            function partilharLink() {
                                if (navigator.share) {
                                    navigator.share({
                                        title: '<?= htmlspecialchars($nome_artista) ?>',
                                        text: 'Vamos a um evento juntos? <?= htmlspecialchars($nome_artista) ?>',
                                        url: window.location.href,
                                    })
                                        .then(() => console.log('Successful share'))
                                        .catch((error) => console.log('Error sharing', error));
                                }
                            }
                        </script>
                    </section>
                    <section class="artista-info">
                        <div class="container">
                            <div class="px-1">
                                <h1 class="text-center"><?= htmlspecialchars($nome_artista) ?></h1>
                            </div>
                            <div class="row g-1 justify-content-center align-content-center pt-3 pb-4">
                                <?php
                                if (!empty($insta)) { ?>
                                    <div class="col-auto">
                                        <a href="https://www.instagram.com/<?= basename($insta) ?>" target="_blank">
                                            <div class="redessocias">
                                                <i class="bi bi-instagram iconredes"></i>
                                            </div>
                                        </a>
                                    </div>
                                <?php }
                                if (!empty($fb)) { ?>
                                    <div class="col-auto">
                                        <a href="<?= htmlspecialchars($fb) ?>" target="_blank">
                                            <div class="redessocias">
                                                <i class="bi bi-facebook iconredes"></i>
                                            </div>
                                        </a>
                                    </div>
                                <?php }
                                if (!empty($spotify)) { ?>
                                    <div class="col-auto">
                                        <a href="<?= htmlspecialchars($spotify) ?>" target="_blank">
                                            <div class="redessocias">
                                                <i class="fab fa-spotify iconredes"></i>
                                            </div>
                                        </a>
                                    </div>
                                <?php }
                                if (!empty($yt)) { ?>
                                    <div class="col-auto">
                                        <a href="<?= htmlspecialchars($yt) ?>" target="_blank">
                                            <div class="redessocias">
                                                <i class="bi bi-youtube iconredes"></i>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <p><?= htmlspecialchars($bio) ?></p>
                            <?php
                            if (!empty($spotify)) { ?>
                                <h3 class="mb-3">Repertório</h3>
                                <iframe src="https://open.spotify.com/embed/artist/<?= basename($spotify); ?>?theme=0"
                                        width="100%" height="300" frameBorder="0" allowtransparency="true"
                                        allow="encrypted-media"></iframe>
                            <?php } ?>
                            <h3 class="pt-3">Fotos no <img src="img/gretua.svg" class="pb-2" height="34"></h3>
                        </div>
                        <div class="swiper-container mySwiper pb-5 mb-5">
                            <div class="swiper-wrapper">
                                <?php
                                foreach ($array_fotos as $foto) {
                                    ?>
                                    <div class="swiper-slide fotos-artita-eventos"><img src="img/eventos/<?= htmlspecialchars($foto) ?>"
                                                                                        class="fotos-artista-fluid">
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>

                <?php

            } else {
                //não existe ou o seu vendedor está desativado
                header("Location: eventos.php");
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

endif;

