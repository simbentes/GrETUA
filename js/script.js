document.getElementById("novapub").onclick = function () {
    document.getElementById("pub").classList.add("animapub");
    document.getElementById("textopub").focus();

}

document.getElementById("btnfechar").onclick = function () {
    document.getElementById("pub").classList.remove("animapub");
}





let hoje = new Date().toISOString().substr(0, 10);

document.getElementById("datahoje").value = hoje;


