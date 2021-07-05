<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: gretua.php");
} else {
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
    <script type="text/javascript">
        document.getElementById("botaoperfil").onclick = function () {
            console.log("clickads")
            document.getElementById("perfilbottom").classList.toggle("animaperfil");

        }
    </script>
    </body>

    </html>
    <?php
}
?>