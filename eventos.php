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

<?php include_once "components/cp_eventos.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>

<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<!-- Initialize Swiper -->
<script>
    var proximos = new Swiper(".proximoseventos", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 15,
        pagination: {
            el: ".swiper-scrollbar",
            clickable: true,
        },
    });

    var meus = new Swiper(".osmeuseventos", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 15,
        pagination: {
            el: ".swiper-scrollbar",
            clickable: true,
        },
    });
</script>
</body>
</html>
