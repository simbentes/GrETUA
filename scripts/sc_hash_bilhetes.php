<?php
// Verificação de credenciais de acesso à área de administração
session_start();

require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT bilhetes.hash
FROM bilhetes
LEFT JOIN compras
ON bilhetes.ref_id_compras = id_compras
INNER JOIN data_eventos
ON data_eventos.id_data_eventos = compras.ref_id_data_eventos
LEFT JOIN utilizadores
ON id_utilizadores = compras.ref_id_utilizadores
INNER JOIN eventos
ON id_eventos = data_eventos.ref_id_eventos
WHERE data_eventos.data > NOW() AND id_utilizadores = " . $_SESSION["id_user"] . "  
ORDER BY id_bilhetes  DESC;";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $hash);

    while (mysqli_stmt_fetch($stmt)) {
        $arrayBilhetes[] = $hash;
    }
} else {
    echo "Error: " . mysqli_error($link);
}


die(json_encode($arrayBilhetes));

mysqli_stmt_close($stmt);
mysqli_close($link);
