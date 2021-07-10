<?php
session_start();
require_once "../connections/connection.php";


if (isset($_SESSION["id_user"]) && isset($_GET["guardado"]) && isset($_GET["evento"]) || isset($_SESSION["id_user"]) && isset($_GET["vou"]) && isset($_GET["evento"])) {
    $id_user = $_SESSION["id_user"];
    $id_evento = $_GET["evento"];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    // vamos ver se já existe alguma instancia relativa a um user
    $query = "SELECT ref_id_utilizadores FROM `guardados_vou` WHERE ref_id_utilizadores = " . $id_user;

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $update = true;
        } else {
            $update = false;
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }


    if (isset($_GET["guardado"])) {
        //se a checkbox estiver cheked, o user quer guardar o evento
        ($_GET["guardado"] == "true") ? $guardado = 1 : $guardado = 0;

        if (!$update) {
            $query = "INSERT INTO guardados_vou (guardados,ref_id_utilizadores,ref_id_eventos,timestamp_guardados) VALUES (?,?,?,CURRENT_TIMESTAMP)";
        } else {
            //se não estiver, o user quer remover
            $query = "UPDATE guardados_vou SET guardados = ?,timestamp_guardados = CURRENT_TIMESTAMP WHERE ref_id_utilizadores = ?";
        }

        if (mysqli_stmt_prepare($stmt, $query)) {
            if (!$update) {
                mysqli_stmt_bind_param($stmt, 'iii', $guardado, $id_user, $id_evento);
            } else {
                mysqli_stmt_bind_param($stmt, 'ii', $guardado, $id_user);
            }
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error:" . mysqli_error($link);
        }

    } else if (isset($_GET["vou"])) {
        //se a checkbox estiver cheked, o user quer guardar o evento
        ($_GET["vou"] == "true") ? $vou = 1 : $vou = 0;

        if (!$update) {
            $query = "INSERT INTO guardados_vou (vou,ref_id_utilizadores,ref_id_eventos,timestamp_vou) VALUES (?,?,?,CURRENT_TIMESTAMP)";
        } else {
            //se não estiver, o user quer remover
            $query = "UPDATE guardados_vou SET vou = ?,timestamp_vou = CURRENT_TIMESTAMP WHERE ref_id_utilizadores = ?";
        }

        if (mysqli_stmt_prepare($stmt, $query)) {
            if (!$update) {
                mysqli_stmt_bind_param($stmt, 'iii', $vou, $id_user, $id_evento);
            } else {
                mysqli_stmt_bind_param($stmt, 'ii', $vou, $id_user);
            }
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error:" . mysqli_error($link);
        }

    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

}


