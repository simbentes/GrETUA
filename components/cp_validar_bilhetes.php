<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
elseif (isset($_SESSION["cargo"]) && $_SESSION["cargo"] == 2): ?>
    <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
    <canvas id="canvas" hidden></canvas>
    <div id="output" hidden>
    </div>
    <div class="fixed-bottom p-4 caixavalidar">
        <div class="mb-4">
            <h1 class="text-center mb-0">Validar Bilhetes</h1>
            <div class="small text-center mb-3">Aponte a câmara para o código QR.</div>
        </div>
        <div id="resposta-validacao" class="h2 mb-0 resposta-val">

        </div>
    </div>
<?php
endif;