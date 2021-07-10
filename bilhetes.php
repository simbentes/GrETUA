<?php
session_start();
require "vendor/autoload.php";
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
    <script src="js/qrcode.min.js"></script>
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
    <div id="qrcode"></div>
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: "http://github.com/simbentes",
            width: 220,
            height: 220,
            useSVG: true
        });

        var qrcode = new QRCode(document.getElementById("qrcode2"), {
            text: "ashjdbfaoshdfbajkhsdfbakjshdfbakjhsdfbkajhdsfbkajhsfdbkajhsdbfkajhsdbfkajhsdbfkajhsdbfkajshbdfkajhsdbfkjahsbdf",
            width: 220,
            height: 220,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
            useSVG: true
        });
    </script>

    </body>
    </html>
