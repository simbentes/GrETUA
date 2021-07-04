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
<main>
    
    <section class="container-fluid pt-3 pb-2 px-3 topindexmenu">
        <div class="row align-content-center justify-content-between">
            <div class="col-auto">
                <div class="row gx-0 align-items-center">
                    <div class="col-auto">
                        <a href="conta.php" class="text-white"><i class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
                    </div>
                    <div class="col-auto ps-3">
                        <h3 class="mb-0">Editar Perfil</h3>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <a href="conta.php" class="text-white"><i class="bi bi-check2 confirmar-icon p-1 mb-0 h2"></i></a>
            </div>
        </div>

    </section>
    <?php include_once "components/cp_editar_perfil.php" ?>

</main>
<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>