var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

        hash_bilhetes = JSON.parse(this.responseText);
        for (let i = 1; i <= hash_bilhetes.length; i++) {
            var qrcode = new QRCode(document.getElementById("qrcode" + i), {
                text: hash_bilhetes[i - 1],
                width: 210,
                height: 210,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H,
                useSVG: true
            });
        }

    }
};


xmlhttp.open("GET", "scripts/sc_hash_bilhetes.php", true);
xmlhttp.send();


var swiper = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 12,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
