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


    <?php include_once "components/cp_editar_info_privada.php" ?>

</main>
<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script>
    document.getElementById("btn-modal").addEventListener("click", function () {

        if (document.getElementById("passatual").value == "" ||
            document.getElementById("passnova").value == "" ||
            document.getElementById("passanova2").value == "") {
            document.getElementById("pass-confirmar").innerHTML = '<input type="password" class="form-control forminfo formconta py-2 mb-3" id="passconfimar" name="passconfimar" placeholder="Confirmar com palavra-passe">';
        }
    })
</script>
</body>
</html>