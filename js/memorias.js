document.getElementById("botaomaquina").onclick = function () {
    console.log("ola")
    document.getElementById("maquinabottom").classList.toggle("animamaquina");
}


var slidesMemorias = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 28,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var slideAnterior = 0
//id do ultimo memoria
var lastdata = "";


//vamos carregar as memórias de quatro em quatro
//só carregamos mais quatro quando o user chegar ao quarto slide desde o ulitmo carregamento
slidesMemorias.on('slideChange', function () {

    if (slideAnterior < slidesMemorias.activeIndex) {
        console.log(slidesMemorias.activeIndex)
        var slideCarregar = (slidesMemorias.activeIndex + 1) % 4

        if (slideCarregar == 0) {

            carregarMemorias();
        }
    }

    slideAnterior = slidesMemorias.activeIndex
});


window.onload = function () {
    lastdata = "";
    carregarMemorias();

}

function carregarMemorias() {

    console.log("carregaaaaaaaaa  " + lastdata)
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != "fim") {
                var memorias = JSON.parse(this.responseText);

                for (let i = 0; i < memorias[0].repeticoes; i++) {
                    //guardar a data da ultima memoria carregada.
                    lastdata = memorias[i].data_evento

                    slidesMemorias.appendSlide([
                        '<div class="memoria swiper-slide"> <a href="memoria.php?memoria=' + memorias[i].id_evento + '"> <img class="img-memoria" src="img/eventos/' + memorias[i].foto + '"> <div class="desc-memoria container-fluid"> <h3 class="top-right">' + memorias[i].nome_evento + '</h3> <div class="row"> <p class="text-cinza desc-curta">' + memorias[i].desc_curta + '</p> </div> </div> <div class="bola"> <svg height="26" width="26" viewBox="0 0 100 100"> <circle cx="50" cy="50" r="40" fill="white"/> </svg> </div> <div class="ano"> <div class="text-center text-uppercase"><small>Estreou</small></div> <h3 class="text-center mb-0"> ' + memorias[i].data_str + '</h3> </div> </a> </div>'
                    ]);
                }
            }
        }
    };

    xmlhttp.open("GET", "scripts/sc_carregar_memorias.php?carregar=1&data=" + lastdata, true);
    xmlhttp.send();

}