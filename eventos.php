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
<section class="container py-3">
    <form action="eventos.php">
        <input type="text" id="search-bar" name="pesquisa"
               class="form-control forminfo barrapesquisa"
               placeholder="Pesquisar">
    </form>
</section>

<section class="container px-3">
    <div class="botaomultiplo">

        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio0" autocomplete="off" checked>
            <label class="btn btn-multiplo-primary" for="btnradio0">Todos</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
            <label class="btn btn-multiplo-primary" for="btnradio1">Teatro</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-multiplo-primary" for="btnradio2">Música</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-multiplo-primary px-0" for="btnradio3">Workshops</label>
        </div>
    </div>
</section>
<section>
    <div class="container pt-5">
        <h2 class="mb-0">próximos eventos</h2>
    </div>
    <!-- Swiper -->
    <div class="swiper-container proximoseventos py-4">
        <div class="swiper-wrapper">

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/da_chick.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Da Chick</h6>
                        <div class="row">
                            <div class="col text-cinza">4 junho</div>
                            <div class="col text-cinza text-center">21h00</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ruínas</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/palmieres.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">P A L M I E R E S</h6>
                        <div class="row">
                            <div class="col text-cinza">1 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ninguem.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ninguém, de Deeogo Oliveira</h6>
                        <div class="row">
                            <div class="col text-cinza">8 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/angelica.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Angélica Salvi - Phantone</h6>
                        <div class="row">
                            <div class="col text-cinza">25 de maio</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="swiper-scrollbar"></div>
    </div>
</section>
<section>
    <div class="container pt-4">
        <h2 class="mb-0">os meus eventos</h2>
    </div>
    <!-- Swiper -->
    <div class="swiper-container osmeuseventos py-4">
        <div class="swiper-wrapper">

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/da_chick.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Da Chick</h6>
                        <div class="row">
                            <div class="col text-cinza">4 junho</div>
                            <div class="col text-cinza text-center">21h00</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ruinas3.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ruínas</h6>
                        <div class="row">
                            <div class="col text-cinza">28 abril</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">teatro</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/palmieres.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">P A L M I E R E S</h6>
                        <div class="row">
                            <div class="col text-cinza">1 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/ninguem.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Ninguém, de Deeogo Oliveira</h6>
                        <div class="row">
                            <div class="col text-cinza">8 junho</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="evento swiper-slide">
                <a href="evento.php">
                    <img class="img-fluid img-evento" src="img/angelica.jpg">
                    <div class="desc-evento container-fluid">
                        <h6 class="top-right">Angélica Salvi - Phantone</h6>
                        <div class="row">
                            <div class="col text-cinza">25 de maio</div>
                            <div class="col text-cinza text-center">22h30</div>
                            <div class="col text-cinza text-end">concerto</div>
                        </div>
                    </div>

                </a>
            </div>
        </div>
        <div class="swiper-scrollbar"></div>
    </div>


</section>


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
