document.getElementById("novapub").onclick = function () {
    document.getElementById("pub").classList.add("animapub");
    document.getElementById("titulopub").focus();

}

document.getElementById("btnfechar").onclick = function () {
    document.getElementById("pub").classList.remove("animapub");
}


