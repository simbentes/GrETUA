<?php
session_start();
require "vendor/autoload.php";
if (!isset($_SESSION['id_user'])) {
    header("Location: gretua.php");
} else {
    $userid = $_SESSION['id_user'];
    ?>
    <!DOCTYPE html>
    <html lang="pt">
    <head>
        <?php include_once "helpers/help_meta.php" ?>
        <?php include_once "helpers/help_link.php" ?>
        <title>GrETUA</title>
    </head>
    <body>
    <section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
        <div class="row gx-0 align-items-center">
            <div class="col-auto">
                <a href="conta.php" class="text-white"><i class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
            </div>
            <div class="col-auto ps-3">
                <h3 class="mb-0">Bilhetes</h3>
            </div>
        </div>
    </section>
    <main>
        <?php include_once "components/cp_bilhetes.php" ?>
    </main>
    <?php include_once "components/cp_tab_bar.php" ?>
    <!-- Javascript -->
    <?php include_once "helpers/help_js.php" ?>
    </body>
    </html>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: "auto",
            centeredSlides: true,
            spaceBetween: 12,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    </body>
    </html>

    <?php
}
?>