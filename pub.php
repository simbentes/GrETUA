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

<?php include_once "components/cp_pub.php" ?>

<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script>
    //dar gosto numa publicação
    function likePub(estado, publicacao) {

        if (estado) {
            document.getElementById("like" + publicacao).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>';
        } else {
            document.getElementById("like" + publicacao).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>';
        }

        //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "scripts/sc_like_pub.php?like=" + estado + "&pub=" + publicacao, true);
        xmlhttp.send();

    }


    function diferencaTempo(unix_timestamp) {

        var segPorMinute = 60;
        var segPorHour = segPorMinute * 60;
        var segPorDay = segPorHour * 24;
        var segPorMonth = segPorDay * 30;
        var segPorYear = segPorDay * 365;

        if (unix_timestamp < segPorMinute) {
            return ' há ' + Math.round(unix_timestamp) + ' segundo' + (Math.round(unix_timestamp) != 1 ? 's' : '');
        } else if (unix_timestamp < segPorHour) {
            return ' há ' + Math.round(unix_timestamp / segPorMinute) + ' minuto' + (Math.round(unix_timestamp / segPorMinute) != 1 ? 's' : '');
        } else if (unix_timestamp < segPorDay) {
            return ' há ' + Math.round(unix_timestamp / segPorHour) + ' hora' + (Math.round(unix_timestamp / segPorHour) != 1 ? 's' : '');
        } else if (unix_timestamp < segPorMonth) {
            return 'há ' + Math.round(unix_timestamp / segPorDay) + ' dia' + (Math.round(unix_timestamp / segPorDay) != 1 ? 's' : '');
        } else if (unix_timestamp < segPorYear) {
            return 'há ' + Math.round(unix_timestamp / segPorMonth) + ' meses';
        } else {
            return 'há ' + Math.round(unix_timestamp / segPorYear) + ' anos ';
        }
    }

    document.getElementById("diferencatempo").innerHTML = diferencaTempo(<?= $unix_ts ?>)


    function mostrarSubmit(valor, id) {
        if (valor == "") {
            document.getElementById("submit" + id).style.display = "none";
        } else {
            document.getElementById("submit" + id).style.display = "block";
        }
    }


</script>
</body>
</html>