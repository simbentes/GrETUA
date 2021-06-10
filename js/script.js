document.getElementById("novapub").onclick = function () {
    document.getElementById("pub").classList.add("animapub");
    document.getElementById("textopub").focus();

}

document.getElementById("btnfechar").onclick = function () {
    document.getElementById("pub").classList.remove("animapub");
}





let hoje = new Date().toISOString().substr(0, 10);

document.getElementById("datahoje").value = hoje;


function readMore() {
    var dots = document.getElementById("dots");
    var moreText = document.getElementById("more");
    var btnText = document.getElementById("myBtn");
    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerHTML = "Ler mais";
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerHTML = "Ler menos";
        moreText.style.display = "inline";
    }
}

