<?php
session_start();
require_once "../connections/connection.php";


if (isset($_SESSION["id_user"]) && isset($_GET["seguir"]) && isset($_GET["user"])) {

    $id_user = $_GET["user"];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    //se a checkbox estiver cheked, o user quer guardar um albun
    if ($_GET["seguir"] == "true") {
        $query = "INSERT INTO seguidores (ref_id_utilizadores, ref_id_utilizadores_seguir) VALUES (?,?);";
    } else {
        //se não estiver, o user quer deixar de seguir
        $query = "DELETE FROM seguidores WHERE ref_id_utilizadores = ? AND ref_id_utilizadores_seguir = ?";
    }

    if (mysqli_stmt_prepare($stmt, $query)) {


        mysqli_stmt_bind_param($stmt, 'ii', $_SESSION["id_user"], $id_user);


        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

