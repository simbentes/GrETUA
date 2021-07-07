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
<div class="botaomaquina">
    <button type="button" class="btn btn-transparente" id="botaomaquina">
        <i class="bi bi-three-dots-vertical h2"></i>
    </button>
</div>

<?php include_once "components/cp_memorias.php" ?>
<?php include_once "components/cp_maquina_tempo.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script type="text/javascript">

    document.getElementById("botaomaquina").onclick = function () {
        console.log("ola")
        document.getElementById("maquinabottom").classList.toggle("animamaquina");
    }


    var swiper = new Swiper(".mySwiper", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 28,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>
</body>
</html>
