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


//botoes desaparecem apos algum scroll

window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (240 > currentScrollPos) {
        document.getElementById("voltar").style.top = "25px";
        document.getElementById("share").style.top = "25px";
    } else {
        document.getElementById("voltar").style.top = "-100px";
        document.getElementById("share").style.top = "-100px";
    }
}


var proximos = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 15,
    pagination: {
        el: ".swiper-scrollbar",
        clickable: true,
    },
});




