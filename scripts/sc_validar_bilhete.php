<?php

if (isset($_GET["hash"])) {
    $bilhete = $_GET["hash"];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT * FROM bilhetes
INNER JOIN compras
ON id_compras = bilhetes.ref_id_compras
INNER JOIN data_eventos
ON data_eventos.id_data_eventos = compras.ref_id_data_eventos
WHERE bilhetes.hash = ? AND ativo = 1 AND NOW() < DATE_ADD(data, INTERVAL 2 HOUR)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        //$email é o campo da form, o user pode colocar o mail ou o username para facilitar o login
        mysqli_stmt_bind_param($stmt, 's', $bilhete);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_fetch($stmt)) {

                $query = "UPDATE bilhetes SET ativo = 0 WHERE bilhetes.hash = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, 's', $bilhete);
                    if (mysqli_stmt_execute($stmt)) {
                        // Informação atualizada
                        //sucesso
                        die("valido");
                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                        // O bilhete é inválido
                        die("erro");
                    }
                } else {
                    echo "Error:" . mysqli_error($link);
                    // O bilhete é inválido
                    die("erro");
                }

            } else {
                // O bilhete é inválido
                die("invalido");
            }

        } else {
            // Acção de erro
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
