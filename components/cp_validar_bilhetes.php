<?php
if (!isset($_SESSION["id_user"])):
    header("Location: index.php");
elseif (isset($_SESSION["cargo"]) && $_SESSION["cargo"] == 2): ?>
    <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
    <canvas id="canvas" hidden></canvas>
    <div id="output" hidden>
        <div id="outputMessage">No QR code detected.</div>
        <div hidden><b>Data:</b> <span id="outputData"></span></div>
    </div>
<?php
endif;