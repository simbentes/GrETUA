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
            <h3 class="mb-0">Guardados</h3>
        </div>
    </div>
</section>
<main>
    <?php include_once "components/cp_guardados.php" ?>
</main>
<?php include_once "components/cp_tab_bar.php" ?>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script>
    function guardarEvento(estado, evento) {
        //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                location.reload();
            }
        }

        xmlhttp.open("GET", "scripts/sc_guardar_vou_evento.php?guardado=" + estado + "&evento=" + evento, true);
        xmlhttp.send();

    }
</script>
</body>
</html>
