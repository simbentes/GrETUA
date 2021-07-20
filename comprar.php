<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php include_once "helpers/help_meta.php" ?>
    <?php include_once "helpers/help_link.php" ?>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <title>GrETUA</title>
</head>
<body>
<?php include_once "components/cp_comprar.php" ?>
<?php include_once "components/cp_tab_bar.php" ?>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
</body>
</html>
<!-- Javascript -->
<?php include_once "helpers/help_js.php" ?>
<script>
    document.getElementById("comprar-form").onsubmit = function () {
        document.getElementById("comprar-btn").innerHTML = '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Loading...</span></div>' + document.getElementById("comprar-btn").innerHTML
    }


    var selectBotaoDatas = document.getElementById("comprar-add")
    var iBotao = 1

    const d = new Date();

    selectBotaoDatas.onclick = function () {
        iBotao++

        var node = document.createElement("input");

        node.type = "name"
        node.classList.add("form-control")
        node.classList.add("forminfo")
        node.classList.add("formconta")
        node.classList.add("my-3")
        node.id = "nomebilhete" + iBotao
        node.name = "nomebilhete" + iBotao
        document.getElementById("nomebilhetes").appendChild(node);
        node.focus()
        document.getElementById("quantidade").value = iBotao;

        document.getElementById("remover-caixa").classList.remove("d-none");
        document.getElementById("add-caixa").classList.remove("col-12");
        document.getElementById("add-caixa").classList.add("col-10");
        document.getElementById("add-caixa").classList.add("pe-1");

    }

    document.getElementById("comprar-remover").onclick = function () {

        if (iBotao > 2) {
            document.getElementById("nomebilhete" + iBotao).remove()
            iBotao--
        } else {
            document.getElementById("nomebilhete" + iBotao).remove()
            document.getElementById("remover-caixa").classList.add("d-none");
            document.getElementById("add-caixa").classList.remove("col-10");
            document.getElementById("add-caixa").classList.add("col-12");
            document.getElementById("add-caixa").classList.remove("pe-1");
            iBotao = 1;
        }

        document.getElementById("quantidade").value = iBotao;
    }


</script>
</body>
</html>

