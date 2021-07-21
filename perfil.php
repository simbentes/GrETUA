<?php
session_start();
/*if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
}*/
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>

<body>
<?php include_once "components/cp_perfil.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<?php include_once "helpers/help_js.php" ?>
<script src="js/pubs_conta_perfil.js"></script>
<script>
    window.onload = function () {
        if (document.getElementById("seguir").checked == false) {
            document.getElementById("label-seguir").innerHTML = "Seguir";
        } else {
            document.getElementById("label-seguir").innerHTML = '<i class="bi bi-check h5 mb-0"></i> A seguir';
        }
    }


    function seguirUser(estado, user) {

        if (!estado) {
            document.getElementById("label-seguir").innerHTML = "Seguir";
        } else {
            document.getElementById("label-seguir").innerHTML = '<i class="bi bi-check h5 mb-0"></i>A seguir';
        }

        //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
        var ajaxseguir = new XMLHttpRequest();
        ajaxseguir.open("GET", "scripts/sc_seguir.php?seguir=" + estado + "&user=" + user, true);
        ajaxseguir.send();

    }
</script>
</body>
</html>
