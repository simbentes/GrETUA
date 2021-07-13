<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header("Location: gretua.php");
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <title>GrETUA</title>
</head>
<body>
<?php include_once "components/cp_login.php" ?>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script src="js/login.js"></script>
</body>
</html>
