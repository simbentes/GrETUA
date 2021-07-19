<?php
session_start();
if (isset($_SESSION["id_evento_edit"])) {
    $id_evento = $_SESSION["id_evento_edit"];
    unset($_SESSION["id_evento_edit"]);
} else {
    header("Location: ../eventos.php");
    die;
}

require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

// vamos apagar informações do evento
$query = "DELETE FROM fotos_eventos WHERE ref_id_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, 'i', $id_evento);
    /* execute the prepared statement */
    if (!mysqli_stmt_execute($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);
        header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=3");
    } else {
        $query = "DELETE FROM data_eventos WHERE ref_id_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $id_evento);
            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
                header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=3");
            } else {
                $query = "DELETE FROM eventos WHERE id_eventos = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'i', $id_evento);
                    /* execute the prepared statement */
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                        header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=3");
                    } else {
                        echo "olas";
                        header("Location: ../eventos.php?msg=0");
                    }
                }

            }
        }

    }
}

mysqli_stmt_close($stmt);
mysqli_close($link);



