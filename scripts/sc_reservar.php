<?php
session_start();
require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

$query = "SELECT eventos.lotacao, SUM(reservas.quantidade)
FROM `reservas`
INNER JOIN data_eventos
ON id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $lotacao, $ocupacao_reservas);

    if (!mysqli_stmt_fetch($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);
    } else {
        $query = "SELECT SUM(compras.quantidade)
FROM `compras`
INNER JOIN data_eventos
ON id_data_eventos = compras.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ocupacao_compras);

            if (!mysqli_stmt_fetch($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            } else {
                if (isset($ocupacao_reservas) || isset($ocupacao_compras)) {
                    $ocupacao = 1 - ($lotacao - ($ocupacao_reservas + $ocupacao_compras)) / $lotacao;
                } else {
                    $ocupacao = 0;
                }
            }
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
} else {
    echo "Error: " . mysqli_error($link);
}

if ($ocupacao < 1) {

    if (!empty($_POST['numreservas']) && !empty($_POST['data_evento']) && isset($_SESSION["id_user"])) {

        $n_reservas = $_POST['numreservas'];
        $id_data_evento = $_POST['data_evento'];

        $query = "INSERT INTO reservas (ref_id_utilizadores, ref_id_data_eventos, quantidade) VALUES (?,?,?)";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'iii', $_SESSION["id_user"], $id_data_evento, $n_reservas);

            // reservar
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            } else {
                header("Location: ../reservar-success.php?dataevento=" . $id_data_evento);
            }

        } else {
            // Acção de erro
            echo "Error:" . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        header("Location: ../eventos.php");
    }

} else {
    header("Location: ../eventos.php?msg=1");
}