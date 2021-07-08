var selectEditora = document.getElementById("editora");



selectEditora.addEventListener("change", function () {
    var opcaoAlbum = selectEditora.value

    if (opcaoAlbum == "Selecionar") {
        document.getElementById("outraeditora").disabled = false;
    } else {
        document.getElementById("outraeditora").disabled = true;
    }
});

document.getElementById("outraeditora").addEventListener("keyup", function () {
    if (document.getElementById("outraeditora").value != "") {
        document.getElementById("editora").disabled = true;
    } else {
        document.getElementById("editora").disabled = false;

    }
});




