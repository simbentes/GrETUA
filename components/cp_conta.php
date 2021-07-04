<?php

// We need the function!
require_once("connections/connection.php");

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//posso concatenar, visto que o parametro não foi colocado pelo user
$query = "SELECT foto_perfil, utilizadores.descricao, conta_instagram, conta_whatsapp
FROM `utilizadores`
WHERE id_utilizadores = " . $_SESSION["id_user"];

if (mysqli_stmt_prepare($stmt, $query)) {

    /* execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /* bind result variables */
    mysqli_stmt_bind_result($stmt, $foto_perfil, $biografia, $instagram, $whatsapp);


    if (mysqli_stmt_fetch($stmt)) {
        ?>
        <div class="botaoperfil">
            <button type="button" class="btn btn-transparente" id="botaoperfil">
                <i class="bi bi-list h1"></i>
            </button>
        </div>

        <section class="container pt-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-auto">
                    <img class="img-fluid fotoperfil" src="img/<?= $_SESSION["fperfil"] ?>">
                </div>
                <div class="col-auto">
                    <h2 class="mb-0"><?= $_SESSION["nome"] ?></h2>
                    <span class="badge bg-success">ENCENADORA</span>
                </div>
            </div>
        </section>
        <section class="container-fluid">
            <div class="pt-3">
                <p class="mb-0"><?= $biografia ?></p>
            </div>
            <a href="editar-perfil.php" type="button" class="btn btn-outline-light w-100 editar-perfil">
                Editar perfil
            </a>
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
            <h5 class="pt-1 text-center mb-0">17 abril 2021</h5>
        </section>

        <section class="container-fluid pb-3">
            <ul class="list-group list-group-flush">
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
                    <a href="osmeuseventos.php">
                        <div class="row g-0 align-items-center justify-content-between">
                            <div class="col-auto">
                                <div class="row g-0 align-items-center">
                                    <div class="col-auto pe-2">
                                        <i class="bi bi-calendar-check h1"></i>
                                    </div>
                                    <div class="col-auto mb-1">
                                        Os meus eventos
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
        </section>



        <section class="container-fluid py-4 mb-5 contactos px-5">
            <h2 class="text-center">Contactos</h2>
            <a href="https://instagram.com/<?= $instagram ?>" target="_blank">
                <div class="row g-0 justify-content-center py-3 pb-2">
                    <div class="col-auto">
                        <i class="bi bi-instagram h3"></i>
                    </div>
                    <div class="col-auto ps-2">
                        Instagram
                    </div>
                </div>
            </a>
            <a href="https://wa.me/00351<?= $whatsapp ?>" target="_blank">
                <div class="row g-0 justify-content-center py-2">
                    <div class="col-auto">
                        <i class="bi bi-whatsapp h3"></i>
                    </div>
                    <div class="col-auto ps-2">
                        WhatsApp
                    </div>
                </div>
            </a>
            <a href="mailto:joana@gmail.com">
                <div class="row g-0 justify-content-center py-2">
                    <div class="col-auto ps-2">
                        joana@gmail.com
                    </div>
                </div>
            </a>
        </section>


        <section id="perfilbottom" class="perfil-bottom container">
            <div class="pb-4">
                <ul class="list-group list-group-flush">
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
