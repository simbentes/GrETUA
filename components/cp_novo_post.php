<div class="position-relative">
    <section id="pub" class="py-4 container-fluid px-4 pub">

        <div class="text-end">
            <button id="btnfechar" class="btn btn-transparente btn-fechar">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 28 28">
                    <path d="M22.7,22.7c-4.8,4.8-12.5,4.8-17.3,0s-4.8-12.5,0-17.3s12.5-4.8,17.3,0S27.4,17.9,22.7,22.7z M23.9,23.9
               c5.5-5.5,5.5-14.3,0-19.8S9.6-1.4,4.1,4.1s-5.5,14.3,0,19.8S18.4,29.4,23.9,23.9z"/>
                    <path d="M9.1,9.1c0.3-0.3,0.9-0.3,1.2,0l3.7,3.7l3.7-3.7c0.3-0.3,0.9-0.3,1.2,0c0.3,0.3,0.3,0.9,0,1.2L15.2,14l3.7,3.7
               c0.3,0.3,0.3,0.9,0,1.2c-0.3,0.3-0.9,0.3-1.2,0L14,15.2l-3.7,3.7c-0.3,0.3-0.9,0.3-1.2,0c-0.3-0.3-0.3-0.9,0-1.2l3.7-3.7l-3.7-3.7
               C8.7,9.9,8.7,9.4,9.1,9.1z"/>
                </svg>
            </button>
        </div>
        <h2>Nova Publicação</h2>
        <hr>
        <form action="scripts/sc_publicar.php" method="post" method="post" enctype="multipart/form-data">
            <input id="titulopub" class="form-control textpubTitle" name="titulopub" aria-label="With textarea"
                   placeholder="Título" maxlength="80">
            <textarea id="textopub" class="form-control textopub" name="textopub" aria-label="With textarea"
                      placeholder="Conta-nos a tua memória..."></textarea>

            <div class="row">
                <div class="col-12">
                    <img class="fotoinput d-none" id="output"/>
                </div>
            </div>
            <div class="menu-pub">
                <div class="row align-items-center submenu g-3">
                    <div class="col-auto">
                        <div class="text-end me-2">
                            <label for="avatar" id="maquina">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-camera h1 mb-0"></i></div>
                            </label>
                        </div>
                        <input type="file" id="avatar" class="d-none" name="foto" accept="image/png, image/jpeg"
                               onchange="loadFile(event)">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-pub">Publicar</button>
                    </div>
                </div>
            </div>
        </form>

    </section>

</div>
