<?php
session_start();
if (!empty($_GET['id_pub']) && isset($_SESSION["id_user"])) {

    $id_pub = $_GET['id_pub'];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


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