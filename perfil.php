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

</script>
</body>
</html>
