<?php
session_start();
require_once "../connections/connection.php";


if (isset($_SESSION["id_user"]) && isset($_GET["like"]) && isset($_GET["pub"])) {
    $id_user = $_SESSION["id_user"];
    $id_pub = $_GET["pub"];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    //se a checkbox estiver cheked, o user quer guardar um albun
    if ($_GET["like"] == "true") {
        $query = "INSERT INTO gostos (ref_id_publicacoes,ref_id_utilizadores) VALUES (?,?);";
    } else {
        //se não estiver, o user quer remover
        $query = "DELETE FROM gostos WHERE ref_id_publicacoes = ? AND ref_id_utilizadores = ?";
    }

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ii', $id_pub, $id_user);


        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
}
