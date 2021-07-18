<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_GET["id"])) {
    $id_reservas = $_GET["id"];
    require_once("../connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    //só quem pode eliminar é o user que tem determinada publicação..

    $query = "DELETE FROM reservas WHERE id_reservas = ? AND reservas.ref_id_utilizadores = " . $_SESSION["id_user"];

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_reservas);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            header("Location: ../reservas.php");
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("Location: ../conta.php");
}
