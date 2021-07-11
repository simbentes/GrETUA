<section class="container-fluid pt-3 pb-2 px-3 topindexmenu fixed-top">
    <div class="row gx-0 align-items-center">
        <div class="col-auto">
            <a href="evento.php?evento=<?= $_GET["evento"] ?>" class="text-white"><i
                        class="bi bi-chevron-left p-1 mb-0 h5"></i></a>
        </div>
        <div class="col-auto ps-3">
            <h3 class="mb-0">Reservar</h3>
        </div>
    </div>
</section>
<main>

    <form action="scripts/sc_editar_info_conta.php" method="post" class="px-0">
        <section class="py-5 container-fluid menu_perfil">
            <section class="container pt-2">

                <div class="row mb-3 g-2">
                    <div class="col">
                        <label for="nome" class="mb-1">Nome</label>
                        <input type="text" class="form-control forminfo formconta" id="nome" name="nome"
                               value="" required>
                    </div>
                    <div class="col">
                        <label for="apelido" class="mb-1">Apelido</label>
                        <input type="text" class="form-control forminfo formconta" id="apelido"
                               name="apelido"
                               value="" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="biografia" class="mb-1">Biografia</label>
                    <textarea class="form-control tainfo taconta" name="biografia" id="biografia" rows="5"
                              onkeydown="caixatexto()"></textarea>
                    <div class="text-end"><small id="nchar"></small></div>
                    <script>
                        window.onload = function () {
                            caixatexto()
                        }
                        var caixatexto = function (event) {
                            var texto = document.getElementById('biografia').value;
                            var resultado = 200 - texto.length

                            if (resultado < 0) {
                                document.getElementById('nchar').style.color = "#f13e3e";
                            } else {
                                document.getElementById('nchar').style.color = "white";
                            }
                            document.getElementById('nchar').innerHTML = resultado;
                        };
                    </script>
                </div>
                <hr class="my-3">
                <div class="mb-3">
                    <label for="instagram" class="mb-1">Instagram <small>(username)</small></label>
                    <input type="text" class="form-control forminfo formconta" id="instagram"
                           value="" name="instagram">

                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="mb-1">WhatsApp <small>(Número de telefone)</small></label>
                    <input type="text" class="form-control forminfo formconta" id="whatsapp"
                           value="" name="whatsapp">
                </div>
            </section>
        </section>
    </form>
</main>