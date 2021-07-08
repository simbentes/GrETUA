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


var selectBotaoDatas = document.getElementById("adicionardata")
var iBotao = 1
document.getElementById("adicionardata").setAttribute("data-value", iBotao);

selectBotaoDatas.onclick = function () {
    iBotao++

    document.getElementById("outrasdatas").innerHTML += "<div class='form-group' id='data" + iBotao + "'><label for=\"meeting-time" + iBotao + "\">Data</label>\n" +
        "                                    <input type=\"datetime-local\" class=\"form-control\" id=\"meeting-time" + iBotao + "\"\n" +
        "                                           name=\"data-evento" + iBotao + "\" min=\"1960-01-01T00:00\"></div>"

    document.getElementById("data" + iBotao).value = "1960-01-01T00:00";

    document.getElementById("adicionardata").setAttribute("data-value", iBotao);
    document.getElementById("removerdata").style.display = "inline-block";
    document.getElementById("removerdata").innerHTML = "Remover Data";
    document.getElementById("removerdata").classList.add("btn");
    document.getElementById("removerdata").classList.add("btn-secondary");
    document.getElementById("removerdata").classList.add("mb-3");

    console.log(iBotao)

}

document.getElementById("removerdata").onclick = function () {

    if (iBotao > 2) {
        document.getElementById("data" + iBotao).remove()
        iBotao--
    } else {
        document.getElementById("outrasdatas").innerHTML = "";
        document.getElementById("removerdata").style.display = "none";
        iBotao = 1
    }


    document.getElementById("adicionardata").setAttribute("data-value", iBotao);
}


//varias fotos
window.onload = function () {

    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.getElementById("files");

        filesInput.addEventListener("change", function (event) {

            var files = event.target.files; //FileList object
            var output = document.getElementById("imgThumbnailPreview");

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                //Only pics
                if (!file.type.match('image'))
                    continue;

                var picReader = new FileReader();

                picReader.addEventListener("load", function (event) {

                    var picSrc = event.target.result;

                    var imgThumbnailElem = "<div class='col-auto py-3 imgThumbContainer'><div class='IMGthumbnail'><img  src='" + picSrc + "'" +
                        "title='" + file.name + "'/>";

                    output.innerHTML = output.innerHTML + imgThumbnailElem;

                });

                //Read the image
                picReader.readAsDataURL(file);
            }

        });
    } else {
        alert("Your browser does not support File API");
    }
}



