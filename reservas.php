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
<section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
    <div class="row gx-0 align-items-center">
        <div class="col-auto">
            <a href="conta.php" class="text-white"><i class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
        </div>
        <div class="col-auto ps-3">
            <h3 class="mb-0">Reservas</h3>
        </div>
    </div>
</section>
<main>
    <section class="container-fluid py-5 mb-4">
        <div class="row">
            <div class="col-12 py-3">
                <a class="aevento" href="evento.php">
                    <div class="eventoindex">
                        <img class="img-fluid img-evento" src="img/eventos/ninguem.jpg">
                        <div class="desc-evento container-fluid gx-3">
                            <h2 class="top-right mb-0">Ninguém, Deeogo Oliveira</h2>
                            <div class="row">
                                <div class="col text-cinza">8 junho</div>
                                <div class="col text-cinza text-center">22h30</div>
                                <div class="col text-cinza text-end">concerto</div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="row pt-3 justify-content-between align-items-center gx-0">
                    <div class="col-auto">
                        <h6 class="mb-0 ps-2"><strong>Detalhes de Faturação</strong></h6>
                    </div>
                    <div class="col-auto">
                        <a href="Tickets_9430097.pdf" target="_blank" class="btn btn-memoriafeed">Bilhete Digital</a>
                    </div>
                </div>
            </div>

        </div>

    </section>
</main>

<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>