//id do ultimo pub
var lastdata = "";
var i
var proximo = true;
var arraypubs = [3, 0, 0];


$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() > $(document).height() - 10) {
        if (proximo) {
            carregarPubs(arraypubs);
            proximo = false;
        }
    }
});

window.onload = function () {
    lastdata = "";
    carregarPubs(arraypubs);
    proximo = false;
}


function diferencaTempo(unix_timestamp) {

    var segPorMinute = 60;
    var segPorHour = segPorMinute * 60;
    var segPorDay = segPorHour * 24;
    var segPorMonth = segPorDay * 30;
    var segPorYear = segPorDay * 365;

    if (unix_timestamp < segPorMinute) {
        return ' há ' + Math.round(unix_timestamp) + ' segundo' + (Math.round(unix_timestamp) != 1 ? 's' : '');
    } else if (unix_timestamp < segPorHour) {
        return ' há ' + Math.round(unix_timestamp / segPorMinute) + ' minuto' + (Math.round(unix_timestamp / segPorMinute) != 1 ? 's' : '');
    } else if (unix_timestamp < segPorDay) {
        return ' há ' + Math.round(unix_timestamp / segPorHour) + ' hora' + (Math.round(unix_timestamp / segPorHour) != 1 ? 's' : '');
    } else if (unix_timestamp < segPorMonth) {
        return 'há ' + Math.round(unix_timestamp / segPorDay) + ' dia' + (Math.round(unix_timestamp / segPorDay) != 1 ? 's' : '');
    } else if (unix_timestamp < segPorYear) {
        return 'há ' + Math.round(unix_timestamp / segPorMonth) + ' meses';
    } else {
        return 'há ' + Math.round(unix_timestamp / segPorYear) + ' anos ';
    }
}


function carregarPubs(tipo_pubs) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText != "fim") {

                var pubs = JSON.parse(this.responseText);

                for (let i = 0; i < pubs[0].repeticoes; i++) {

                    if (pubs[i].like == 1) {
                        var checked = 'checked'
                        var btn_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>';

                    } else {
                        var checked = ''
                        var btn_svg = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>';
                    }


                    var tempo_str = diferencaTempo(pubs[i].unix_tempo)


                    //desenhar o card
                    var div = document.createElement('div');
                    div.setAttribute('class', 'col-12 py-3');

                    if (pubs[i].texto.length > 170) {
                        pubs[i].texto = pubs[i].texto.substring(0, 170) + "... <a href='pub.php?id=" + pubs[i].id_pub + "' class='text-primary fw-bold'>Ler Mais</a>";
                    }
                    lastdata = pubs[i].lastdata;
                    div.innerHTML = '<div class="card pubfeed"> <div class="card-body"> <div class="row justify-content-between align-items-center"> <div class="col-auto"> <a href="perfil.php?id=' + pubs[i].id_user + '"><div class="infouser"> <img src="img/users/' + pubs[i].fperfil_user + '" class="userbubble"> <span class="utilizador">' + pubs[i].nome_user + '</span> </div> </a></div><div class="col-auto infotime">' + tempo_str + '</div> </div> </div> <a href="pub.php?id=' + pubs[i].id_pub + '">' + pubs[i].foto + '</a> <input id="likeinput-' + pubs[i].id_pub + '" value="' + pubs[i].id_pub + '" class="btn-vou" type="checkbox" onclick="likePub(this.checked, this.value)" ' + checked + '> <label id="like' + pubs[i].id_pub + '" class="btn btn-like ' + pubs[i].btn_style + '" for="likeinput-' + pubs[i].id_pub + '">' + btn_svg + '</label><div class="card-body"> <h5 class="card-title">' + pubs[i].titulo + '</h5> <p class="card-text">' + pubs[i].texto + '</p> <div class="row"> <div class="col-auto pe-0"> <img src="img/users/' + pubs[i].fperfil_session + '" class="userbubble"> </div> <div class="col"> <form method="POST" action="sc_comentar.php?id=' + pubs[i].id_pub + '"> <input type="text" name="comentario" class="form-control comentar" id="comentarios-' + pubs[i].id_pub + '" placeholder="Comentar"> </form> </div> </div> </div> </div>'
                    document.getElementById('atividade').appendChild(div);

                }
                proximo = true;

            } else {
                var div = document.createElement('div');
                div.setAttribute('class', 'col-12 py-5');
                div.innerHTML = '<h3 class="text-center">Sem publicações.</h3></button>'
                document.getElementById('atividade').appendChild(div);
            }
        }
    };

    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries())

    xmlhttp.open("GET", "scripts/sc_carregar_pubs.php?carregar=1&ordem[]=" + tipo_pubs[0] + "&ordem[]=" + tipo_pubs[1] + "&ordem[]=" + tipo_pubs[2] + "&perfil=" + params.id + "&data= " + lastdata, true);
    xmlhttp.send();

}

//adicionar pub aos favoritos
function likePub(estado, publicacao) {

    if (estado) {
        document.getElementById("like" + publicacao).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/></svg>';
    } else {
        document.getElementById("like" + publicacao).innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16"> <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/> </svg>';
    }

    //vamos enviar por ajax o produto e estado do botao(checkbox), para saber se o user "guardou" ou "removeu dos guardados"
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "scripts/sc_like_pub.php?like=" + estado + "&pub=" + publicacao, true);
    xmlhttp.send();

}

