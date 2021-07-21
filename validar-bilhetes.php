<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <script src="js/jsQR.js"></script>
    <title>GrETUA</title>
    <style>
        body {
            max-width: 640px;
            margin: 0 auto;
            position: relative;
        }

        #loadingMessage {
            color: white;
            text-align: center;
            padding: 40px;
            background-color: var(--pub-cor);
        }

        #canvas {
            width: 100%;
        }
    </style>
</head>

<body>
<?php include_once "components/cp_validar_bilhetes.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<script>
    var video = document.createElement("video");
    var canvasElement = document.getElementById("canvas");
    var canvas = canvasElement.getContext("2d");
    var loadingMessage = document.getElementById("loadingMessage");
    var outputContainer = document.getElementById("output");
    var outputMessage = document.getElementById("outputMessage");
    var outputData = document.getElementById("outputData");

    function drawLine(begin, end, color) {
        canvas.beginPath();
        canvas.moveTo(begin.x, begin.y);
        canvas.lineTo(end.x, end.y);
        canvas.lineWidth = 4;
        canvas.strokeStyle = color;
        canvas.stroke();
    }

    // Use facingMode: environment to attemt to get the front camera on phones
    navigator.mediaDevices.getUserMedia({video: {facingMode: "environment"}}).then(function (stream) {
        video.srcObject = stream;
        video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
        video.play();
        requestAnimationFrame(tick);
    });

    var pronto = true;
    var sucessoaudio = new Audio("js/validado.mp3");

    function tick() {
        loadingMessage.innerText = "⌛ Loading video..."
        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            loadingMessage.hidden = true;
            canvasElement.hidden = false;
            outputContainer.hidden = false;

            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
            var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
            var code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: "dontInvert",
            });
            if (code && pronto) {
                drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
                drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
                drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
                drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    pronto = false;
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "valido") {
                            sucessoaudio.load();
                            sucessoaudio.play();
                            document.getElementById("resposta-validacao").innerHTML = '<div class="text-success"><i class="bi bi-check-circle pe-2"></i>Bilhete válido</div>';
                        } else if (this.responseText == "erro") {
                            document.getElementById("resposta-validacao").innerHTML = '<div class="text-danger"><i class="bi bi-x-circle pe-2"></i>Erro.</div>';
                        } else {
                            document.getElementById("resposta-validacao").innerHTML = '<div class="text-danger"><i class="bi bi-x-circle pe-2"></i>Bilhete inválido</div>';
                        }

                        setTimeout(function () {
                            pronto = true;
                        }, 3000)

                        setTimeout(function () {
                            document.getElementById("resposta-validacao").innerHTML = "";
                        }, 6000)
                    }
                };
                xmlhttp.open("GET", "scripts/sc_validar_bilhete.php?hash=" + code.data, true);
                xmlhttp.send();
            }
        }
        requestAnimationFrame(tick);
    }


</script>
</body>
</html>
