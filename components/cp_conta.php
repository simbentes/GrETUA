<?php

if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
else:

    require_once("connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

//posso concatenar, visto que o parametro não foi colocado pelo user
    $query = "SELECT username, foto_perfil, utilizadores.biografia, instagram, whatsapp, cargo.nome, cargo.color, DATE_FORMAT(DATE(utilizadores.timestamp), '%d%m%Y')
FROM `utilizadores`
INNER JOIN cargo
ON utilizadores.ref_id_cargo = cargo.id_cargo
WHERE id_utilizadores = " . $_SESSION["id_user"];

    if (mysqli_stmt_prepare($stmt, $query)) {

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $username, $foto_perfil, $biografia, $instagram, $whatsapp, $cargo_nome, $cargo_color, $data_criacao);


        if (mysqli_stmt_fetch($stmt)) {

            if (isset($_GET["msg"])) {
                $msg_show = true;
                switch ($_GET["msg"]) {
                    case 0:
                        $message = "Alterações efetuadas.";
                        $class = "alert-success";
                        break;
                    case 1:
                        $message = "Estão efetuadas.";
                        $class = "alert-danger";
                        break;
                    case 2:
                        $message = "Descrição muito longa.";
                        $class = "alert-danger";
                        break;
                    default:
                        $msg_show = false;
                }

                if ($msg_show) {
                    echo '<div class="container-fluid caixaalert"><div class="row justify-content-center"><div class="col-auto"><div id="aviso" class="alert ' . $class . ' alert-dismissible fade show" role="alert">' . $message . '</div></div></div></div>';
                    echo "<script>
            setTimeout(function () {
                var myAlert = document.getElementById('aviso')
                var bsAlert = new bootstrap.Alert(myAlert)
                bsAlert.close()
            }, 3000)
        </script>";
                }
            }

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
            <section class="container-fluid pt-2 maisconta">
                <div class="row justify-content-between align-items-center g-0">
                    <div class="col-auto">
                        <h4 class="mb-1 username"><?= $username ?></h4>
                    </div>
                    <div class="col-auto botaoperfil">
                        <button type="button" class="btn btn-transparente" id="botaoperfil">
                            <i class="bi bi-list h1"></i>
                        </button>
                    </div>
                </div>
            </section>
            <section class="container-fluid perfiluser">
                <div class="row justify-content-center align-items-center">
                    <div class="col-auto">
                        <img class="img-fluid fotoperfil" src="img/users/<?= $_SESSION["fperfil"] ?>">
                    </div>
                    <div class="col-auto">
                        <h2 class="mb-0"><?= $_SESSION["nome"] ?></h2>
                        <span class="badge bg-<?= $cargo_color ?>"><?= $cargo_nome ?></span>
                    </div>
                </div>

                <div class="pt-3">
                    <p class="mb-0 biografia"><?= $biografia ?></p>
                </div>
                <div class="row g-1 justify-content-center align-content-center pt-3">
                    <div class="col-auto">
                        <a href="editar-perfil.php" class="btn btn-editar-perfil">Editar Perfil</a>
                    </div>
                    <?php
                    //só aparecem os icones das redes se existirem....
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
                <div class="text-center mb-0">
                    <div class="text-center text-uppercase"><small>Membro desde</small></div>
                    <h3 class="text-center mb-0"><?= $data_mes_criacao ?></h3>
                </div>
            </section>
            <div class="container-fluid pt-3">
                <h3 class="mb-0">Atividade</h3>
            </div>
            <div class="pb-5">
                <section class="container-fluid pb-4">
                    <div id="atividade" class="row">

                    </div>
                </section>
            </div>
            <section id="perfilbottom" class="perfil-bottom container">
                <div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="bilhetes.php">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto pe-2">
                                                <i class="bi bi-receipt h1"></i>
                                            </div>
                                            <div class="col-auto mb-1">
                                                Bilhetes
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-right h6"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="reservas.php">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto pe-2">
                                                <i class="bi bi-pen h1"></i>
                                            </div>
                                            <div class="col-auto mb-1">
                                                Reservas
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-right h6"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="guardados.php">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto pe-2">
                                                <i class="bi bi-bookmark h1"></i>
                                            </div>
                                            <div class="col-auto mb-1">
                                                Guardados
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-right h6"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="editar-info-privada.php">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto pe-2">
                                                <i class="bi bi-shield-lock h1"></i>
                                            </div>
                                            <div class="col-auto mb-1">
                                                Informações Privadas
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-right h6"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="scripts/sc_logout.php">
                                <div class="row g-0 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-auto pe-2">
                                                <i class="bi bi-box-arrow-right h1"></i>
                                            </div>
                                            <div class="col-auto mb-1">
                                                Terminar Sessão
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-chevron-right h6"></i>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    </ul>
                </div>
            </section>


            <?php
        } else {
            header("Location: index.php");
        }

        /* close statement */
        mysqli_stmt_close($stmt);

        /* close connection */
        mysqli_close($link);
    } else {
        echo "Error: " . mysqli_error($link);
    }

endif;
