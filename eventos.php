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

    var concertos = new Swiper(".concertos", {
        slidesPerView: "auto",
        centeredSlides: true,
        spaceBetween: 15,
        pagination: {
            el: ".swiper-scrollbar",
            clickable: true,
        },
    });


    document.getElementById("search-bar").onkeyup = function () {

        if (this.value == "") {
            document.getElementById("resultados").innerHTML = ""
            document.getElementById("pesquisa-bg").style.backgroundColor = "";
            document.getElementById("pesquisa-bg").style.position = "";
            document.getElementById("pesquisa-bg").style.inset = "";
            document.getElementById("pesquisa-bg").style.zIndex = "";
            document.getElementById("search-bar").onfocus = false;
            document.getElementById("resultados").style.height = "";


        } else {


            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != "nenhum") {

                        document.getElementById("resultados").innerHTML = this.responseText

                    } else {
                        document.getElementById("resultados").innerHTML = "<div class='col-12 py-3 text-pesquisa h1 m-0 text-white'>Sem Resultados.</div>"
                    }
                }
            };
            xmlhttp.open("GET", "scripts/sc_pesquisa_eventos.php?string=" + this.value, true);
            xmlhttp.send();


            document.getElementById("resultados").style.display = "block";
            document.getElementById("pesquisa-bg").style.backgroundColor = "#111111";
            document.getElementById("pesquisa-bg").style.position = "fixed";
            document.getElementById("pesquisa-bg").style.inset = "0";
            document.getElementById("pesquisa-bg").style.zIndex = "9999";
            document.getElementById("resultados").style.height = "90vh";
            document.getElementById("resultados").style.overflow = "auto";
            document.getElementById("search-bar").onfocus = true;
            document.getElementById("textopub").focus();
        }
    }

</script>
</body>
</html>
