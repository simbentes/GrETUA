//botoes desaparecem apos algum scroll

window.onscroll = function() {
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