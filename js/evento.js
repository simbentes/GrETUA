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
}






//adicionar album aos favoritos
function guardarEvento(estado, produto) {

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
    xmlhttp.open("GET", "scripts/sc_guardar_album.php?guardado=" + estado + "&produto=" + produto, true);
    xmlhttp.send();

}




