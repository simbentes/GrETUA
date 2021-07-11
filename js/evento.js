window.onload = function () {

    if (document.getElementById("guardado").checked == true) {
        document.getElementById("textbtnguardado").innerHTML = "Guardado";
        document.getElementById("iconbtnguardado").classList.remove("bi-bookmark");
        document.getElementById("iconbtnguardado").classList.add("bi-bookmark-fill");
    } else {
        document.getElementById("textbtnguardado").innerHTML = "Guardar";
        document.getElementById("iconbtnguardado").classList.add("bi-bookmark");
        document.getElementById("iconbtnguardado").classList.remove("bi-bookmark-fill");
    }

    if (document.getElementById("vou").checked == true) {
        document.getElementById("iconbtnvou").classList.remove("bi-star");
        document.getElementById("iconbtnvou").classList.add("bi-star-fill");
    } else {
        document.getElementById("iconbtnvou").classList.add("bi-star");
        document.getElementById("iconbtnvou").classList.remove("bi-star-fill");
    }
}


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


//adicionar album aos favoritos
function guardarEvento(estado, evento) {

    if (estado) {
        document.getElementById("textbtnguardado").innerHTML = "Guardado";
        document.getElementById("iconbtnguardado").classList.remove("bi-bookmark");
        document.getElementById("iconbtnguardado").classList.add("bi-bookmark-fill");
    } else {
        document.getElementById("textbtnguardado").innerHTML = "Guardar";
        document.getElementById("iconbtnguardado").classList.add("bi-bookmark");
        document.getElementById("iconbtnguardado").classList.remove("bi-bookmark-fill");
    }

    //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/sc_guardar_vou_evento.php?guardado=" + estado + "&evento=" + evento, true);
    xmlhttp.send();

}


//adicionar album aos favoritos
function vouEvento(estado, evento) {

    if (estado) {
        document.getElementById("iconbtnvou").classList.remove("bi-star");
        document.getElementById("iconbtnvou").classList.add("bi-star-fill");
    } else {
        document.getElementById("iconbtnvou").classList.add("bi-star");
        document.getElementById("iconbtnvou").classList.remove("bi-star-fill");
    }

    //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/sc_guardar_vou_evento.php?vou=" + estado + "&evento=" + evento, true);
    xmlhttp.send();

}




