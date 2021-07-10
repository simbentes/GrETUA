<?php


if (isset($_GET["id"])) {

    if ($_GET["id"] != $_SESSION["id_user"]) {

        $id_perfil = $_GET["id"];
        // We need the function!
        require_once("connections/connection.php");

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        //posso concatenar, visto que o parametro não foi colocado pelo user
        $query = "SELECT utilizadores.nome, utilizadores.apelido, foto_perfil, utilizadores.biografia, instagram, whatsapp, DATE_FORMAT(DATE(utilizadores.timestamp), '%d%m%Y')
FROM `utilizadores`
WHERE id_utilizadores = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_perfil);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $nome, $apelido, $foto_perfil, $biografia, $instagram, $whatsapp, $data_criacao);


            if (mysqli_stmt_fetch($stmt)) {
                //vamos subtituir o mês de numerico para escrito
                switch (substr($data_criacao, 2, 2)) {
                    case "01":
                        $mes = " janeiro ";
                        break;
                    case "02":
                        $mes = " fevereiro ";
                        break;
                    case "03":
                        $mes = " março ";
                        break;
                    case "04":
                        $mes = " abril ";
                        break;
                    case "05":
                        $mes = " maio ";
                        break;
                    case "06":
                        $mes = " junho ";
                        break;
                    case "07":
                        $mes = " julho ";
                        break;
                    case "08":
                        $mes = " agosto ";
                        break;
                    case "09":
                        $mes = " setembro";
                        break;
                    case "10":
                        $mes = " outubro";
                        break;
                    case "11":
                        $mes = " novembro";
                        break;
                    case "12":
                        $mes = " dezembro";
                        break;
                    default:
                        $data_mes_criacao = "";
                }

                //substituir pelo  mês correspondente
                //não consegui arranjar outra forma....
                $data_mes_criacao = substr_replace($data_criacao, $mes, 2, 2);
                ?>
                <section class="container-fluid perfil">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-auto">
                            <img class="img-fluid fotoperfil" src="img/users/<?= $foto_perfil ?>">
                        </div>
                        <div class="col-auto">
                            <h2 class="mb-0"><?= $nome . " " . $apelido ?></h2>
                            <span class="badge bg-success">ENCENADORA</span>
                        </div>
                    </div>

                    <div class="pt-3">
                        <p class="mb-0 biografia"><?= $biografia ?></p>
                    </div>
                    <div class="row g-1 justify-content-center align-content-center pt-3">
                        <div class="col-auto">
                            <input type="submit" class="btn btn-seguir w-100" value="Seguir">
                        </div>
                        <?php
                        if (!empty($instagram)) { ?>
                            <div class="col-auto">
                                <a href="https://instagram.com/<?= $instagram ?>" target="_blank">
                                    <div class="redessocias">
                                        <i class="bi bi-instagram iconredes"></i>
                                    </div>
                                </a>
                            </div>
                        <?php }
                        if (!empty($whatsapp)) { ?>
                            <div class="col-auto">
                                <a href="https://wa.me/00351<?= $whatsapp ?>" target="_blank">
                                    <div class="redessocias">
                                        <i class="bi bi-whatsapp iconredes"></i>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </section>


                <section class="py-3">

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483.12 27.37">
                            <defs>
                                <style>
                                    .cls-1 {
                                        fill: none;
                                        stroke-width: 4px;
                                    }

                                    .cls-1,
                                    .cls-3 {
                                        stroke: #fff;
                                        stroke-miterlimit: 10;
                                    }

                                    .cls-2,
                                    .cls-3 {
                                        fill: #fff;
                                    }
                                </style>
                            </defs>
                            <g id="Layer_2" data-name="Layer 2">
                                <g id="Layer_1-2" data-name="Layer 1">
                                    <line class="cls-1" y1="13.69" x2="483.12" y2="13.69"/>
                                    <line class="cls-2" y1="13.69" x2="483.12" y2="13.69"/>
                                    <circle class="cls-3" cx="241.56" cy="13.69" r="13.19"/>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h5 class="pt-1 text-center mb-0"><?= $data_mes_criacao ?></h5>
                </section>
                <div class="container-fluid py-3">
                    <h3>Eventos a que fui</h3>
                </div>

                <!-- Swiper -->
                <div class="swiper-container mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="evento.php">
                                <div class="eventoperfil">
                                    <img class="img-fluid img-evento" src="img/eventos/ruinas3.jpg">
                                    <div class="desc-evento container-fluid">
                                        <h6 class="top-right">Ruínas</h6>
                                        <div class="row">
                                            <div class="col text-cinza">28 abril</div>
                                            <div class="col text-cinza text-center">22h30</div>
                                            <div class="col text-cinza text-end">teatro</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="evento.php">
                                <div class="eventoperfil">
                                    <img class="img-fluid img-evento" src="img/eventos/palmieres.jpg">
                                    <div class="desc-evento container-fluid">
                                        <h6 class="top-right">P A L M I E R E S</h6>
                                        <div class="row">
                                            <div class="col text-cinza">1 junho</div>
                                            <div class="col text-cinza text-center">22h30</div>
                                            <div class="col text-cinza text-end">concerto</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="evento.php">
                                <div class="eventoperfil">
                                    <img class="img-fluid img-evento" src="img/eventos/ninguem.jpg">
                                    <div class="desc-evento container-fluid">
                                        <h6 class="top-right">Ninguém, de Deeogo Oliveira</h6>
                                        <div class="row">
                                            <div class="col text-cinza">8 junho</div>
                                            <div class="col text-cinza text-center">22h30</div>
                                            <div class="col text-cinza text-end">concerto</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>

                <!-- Swiper JS -->
                <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

                <!-- Initialize Swiper -->
                <script>
                    var swiper = new Swiper(".mySwiper", {
                        scrollbar: {
                            el: ".swiper-scrollbar",
                            hide: true,
                        },
                    });
                </script>



                <?php
            } else {
                header("Location: gretua.php");
            }

            /* close statement */
            mysqli_stmt_close($stmt);

            /* close connection */
            mysqli_close($link);
        } else {
            echo "Error: " . mysqli_error($link);
        }

    } else {
        //se o id na query string for igual ao meu id, eu quero ir para a minha conta.. não me quero ver como "terceiros" veem
        header("Location:conta.php");
    }

} else {
    header("Location:gretua.php");
}



