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
<?php include_once "components/cp_navigation_bar.php" ?>
<?php include_once "components/cp_feed.php" ?>
<?php include_once "components/cp_novo_post.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<?php include_once "helpers/help_js.php" ?>
<script type="text/javascript">
    var loadFile = function (event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }
        document.getElementById('maquina').classList.add("d-none");
        document.getElementById('output').classList.remove("d-none");
        document.getElementById("textopub").rows = "3";

    };
</script>
<script src= "js/jquery.js"></script>
<script src="js/gretua.js"></script>
</body>
</html>