<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <title>GrETUA</title>
</head>
<body>
<?php include_once "components/cp_comprar.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script>
    document.getElementById("comprar-form").onsubmit = function () {
        document.getElementById("comprar-btn").innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>' + document.getElementById("comprar-btn").innerHTML
    }
</script>
</body>
</html>

