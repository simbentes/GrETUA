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


<?php include_once "components/cp_artista.php" ?>

<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script type="text/javascript">


    const img = new Image();
    img.onload = function () {
        if (this.width > this.height) {
            document.getElementById("framefotoevento").style.backgroundSize = "auto 400px";
            document.getElementById("framefotoevento").style.backgroundPosition = "top";

        } else {
            document.getElementById("framefotoevento").style.backgroundSize = "100% auto";
            document.getElementById("framefotoevento").style.backgroundPosition = "0 -125px";
        }


    }

    re = /"([^"]*)"/;
    img.src = document.getElementById("framefotoevento").style.backgroundImage.match(re)[1];


</script>
<script src="js/artista.js"></script>
</body>
</html>