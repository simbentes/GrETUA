<?php
// Verificação de credenciais de acesso à área de administração
if (!isset($_SESSION["cargo"]) || $_SESSION["cargo"] != 2):
    header("Location: ../index.php");
endif;
