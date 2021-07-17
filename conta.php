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

<?php include_once "components/cp_conta.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<?php include_once "helpers/help_js.php" ?>

<script type="text/javascript">
    document.getElementById("botaoperfil").onclick = function () {
        document.getElementById("perfilbottom").classList.toggle("animaperfil");

    }
</script>
<script src="js/pubs_conta_perfil.js"></script>
</body>

</html>




