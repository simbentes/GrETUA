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
<section class="py-4 container-fluid px-3 menu_perfil">
    <section class="container pt-2">
        <div class="row justify-content-center align-items-center">
            <div class="col-auto justify-content-center">
                <div class="col text-center">
                    <div class="form-group">
                        <div id="upfoto" class="uploadfotoperfil position-relative">
                            <label for="avatar" class="botaoupfoto" id="maquina">
                                <i class="fas fa-camera iconedegrade bg-light"></i>
                            </label>
                            <input type="file" id="avatar" name="foto" accept="image/*"
                                   onchange="loadFile(event)">
                            <img src="img/capas/<?= $_SESSION["fperfil"] ?>" class="fotoperfil" id="output"/>
                            <script>
                                var loadFile = function (event) {
                                    var output = document.getElementById('output');
                                    output.src = URL.createObjectURL(event.target.files[0]);
                                    output.onload = function () {
                                        URL.revokeObjectURL(output.src) // free memory
                                    }
                                };
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <a href="#">Alterar foto de perfil</a>
                </div>
            </div>
        </div>
    </section>
</section>

<?php include_once "components/cp_tab_bar.php" ?>


<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>