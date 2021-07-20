<?php
session_start();

if (isset($_SESSION["data_evento_vendida"]) && isset($_SESSION["id_user"])) {

    $id_user = $_SESSION["id_user"];
    //recebe o id do produto vendido e elimina a variavel de sessão;
    $id_data_evento = $_SESSION["data_evento_vendida"]["id"];
    $quantidade = $_SESSION["data_evento_vendida"]["quantidade"];
    $nomebilhetes = $_SESSION["data_evento_vendida"]["nomebilhetes"];
    unset($_SESSION["data_evento_vendida"]);

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $query = "INSERT INTO `compras` (`ref_id_utilizadores`, `ref_id_data_eventos`, `quantidade`, `timestamp`) VALUES (?,?,?,CURRENT_TIMESTAMP)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iii', $_SESSION["id_user"], $id_data_evento, $quantidade);
        // comprar
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            $id_compra = mysqli_insert_id($link);
            $query = "INSERT INTO `bilhetes` (`nome`, `hash`, `ref_id_compras`) VALUES (?,?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'ssi', $nome, $numero_bilhete_hash, $id_compra);

                foreach ($nomebilhetes as $nome) {
                    //vamos gerar um numero para cada bilhete criado, exclusivo
                    $numero_bilhete = bin2hex(random_bytes(64));
                    $numero_bilhete_hash = password_hash($numero_bilhete, PASSWORD_DEFAULT);
                    // comprar
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        header("Location: ../bilhetes.php?msg=0");
                    }
                }

            } else {
                // Acção de erro
                echo "Error:" . mysqli_error($link);
            }
        }

    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("../index.php");
}