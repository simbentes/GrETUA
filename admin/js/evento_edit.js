var selectCategoria = document.getElementById("categoria");


selectCategoria.addEventListener("change", function () {

    if (document.getElementById("categoria").value == "") {
        document.getElementById("outracategoria").disabled = false;
    } else {
        document.getElementById("outracategoria").disabled = true;
    }
});

document.getElementById("outracategoria").addEventListener("keyup", function () {
    if (document.getElementById("outracategoria").value != "") {
        selectCategoria.disabled = true;
    } else {
        selectCategoria.disabled = false;
    }
});


function verArtista(nome) {

    if (nome == "novoartista") {
        document.getElementById("container-artista").classList.remove("d-none")
        document.getElementById("container-evento").classList.remove("col-lg-10")
        document.getElementById("container-evento").classList.add("col-lg-8")
    } else {
        document.getElementById("container-artista").classList.add("d-none")
        document.getElementById("container-evento").classList.add("col-lg-10")
        document.getElementById("container-evento").classList.remove("col-lg-8")

    }

}


var selectBotaoDatas = document.getElementById("adicionardata")
var iBotao = document.getElementById("numdatas").value

if (iBotao > 1) {
    document.getElementById("removerdata").style.display = "inline-block";
    document.getElementById("removerdata").innerHTML = "Remover Data";
    document.getElementById("removerdata").classList.add("btn");
    document.getElementById("removerdata").classList.add("btn-secondary");
    document.getElementById("removerdata").classList.add("mb-3");

}

const d = new Date();

selectBotaoDatas.onclick = function () {
    iBotao++

    var node = document.createElement("input");

    node.type = "datetime-local"
    node.classList.add("form-control")
    node.classList.add("my-2")
    node.id = "data" + iBotao
    node.value = d.getFullYear() + "-01-01T00:00"
    node.min = "1960-01-01T00:00"
    node.name = "dataevento" + iBotao
    document.getElementById("dataevento").appendChild(node);


    document.getElementById("adicionardata").setAttribute("data-value", iBotao);
    document.getElementById("removerdata").style.display = "inline-block";
    document.getElementById("removerdata").innerHTML = "Remover Data";
    document.getElementById("removerdata").classList.add("btn");
    document.getElementById("removerdata").classList.add("btn-secondary");
    document.getElementById("removerdata").classList.add("mb-3");


    document.getElementById("numdatas").value = iBotao;

}

document.getElementById("removerdata").onclick = function () {
    if (iBotao > 2) {
        document.getElementById("data" + iBotao).remove()
        iBotao--
        document.getElementById("adicionardata").setAttribute("data-value", iBotao);
    } else {
        document.getElementById("data" + iBotao).remove()
        document.getElementById("removerdata").style.display = "none";
        iBotao = 1
        document.getElementById("labeldata").innerHTML = "Data";
    }

    document.getElementById("numdatas").value = iBotao;
}


//varias fotos
window.onload = function () {

    //Check File API support
    if (window.File && window.FileList && window.FileReader) {
        var filesInput = document.getElementById("files");


        filesInput.addEventListener("change", function (event) {


            var files = event.target.files; //FileList object
            var output = document.getElementById("imgThumbnailPreview");
            output.innerHTML = "";
            document.getElementById("fotocapa").innerHTML = "";

            for (var i = 0; i < files.length; i++) {

                var file = files[i];

                //Only pics
                if (!file.type.match('image'))
                    continue;

                var picReader = new FileReader();


                var nomeimg = this.files[i].name

                picReader.addEventListener("load", function (event) {

                    var picSrc = event.target.result;

                    var imgThumbnailElem = "<div class='col-auto py-3 imgThumbContainer'><div class='IMGthumbnail'><img  src='" + picSrc + "'/>";

                    output.innerHTML = output.innerHTML + imgThumbnailElem;

                });

                document.getElementById("fotocapa").innerHTML += "<option value='" + this.files[i].name + "'>" + (i + 1) + " — " + this.files[i].name + "</option>";


                //Read the image
                picReader.readAsDataURL(file);
            }


            document.getElementById("fotocapacontainer").style.display = "block";


        });
    } else {
        alert("Your browser does not support File API");
    }
}






