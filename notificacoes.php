<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>
<body>
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
                    <div class="col-auto">
                        <div class="col-auto">
                            <img src="img/users/ruipedro.jpg" class="userbubble me-2">
                            <strong>Rui</strong> vai ao evento <strong>Da Chick</strong></div>
                    </div>
                    <div class="col-auto">
                        <div class="my-2">
                            <img src="img/eventos/da_chick.jpg" class="minpub">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h6 class="notdias pt-2">Ontem</h6>
            <ul class="list-group list-group-flush lista_perfil">
                <li class="list-group-item lista_perfil py-1 my-0">

                    <div class="my-2">
                        <img src="img/users/brigitesilva.jpg" class="userbubble me-2">
                        <b>Brigite</b> gostou do seu post.
                    </div>
                </li>
                <li class="list-group-item lista_perfil py-1 my-0">

                    <div class="my-2">
                        <img src="img/users/danielantunes.jpg" class="userbubble me-2">
                        <b>Daniel</b> gostou do seu post.
                    </div>
                </li>
            </ul>
        </div>
        <div>
            <h6 class="notdias pt-2">Esta semana</h6>
            <ul class="list-group list-group-flush lista_perfil">
                <li class="list-group-item lista_perfil py-1 my-0">

                    <div class="my-2">
                        <img src="img/users/helenasoares.jpg" class="userbubble me-2">
                        <b>Helena</b> gostou do seu post.
                    </div>
                </li>
                <li class="list-group-item lista_perfil py-1 my-0">

                    <div class="my-2">
                        <img src="img/users/josepereira.jpg" class="userbubble me-2">
                        <b>José</b> gostou do seu post.
                    </div>
                </li>
            </ul>
        </div>
</section>

<?php include_once "components/cp_tab_bar.php" ?>


<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>