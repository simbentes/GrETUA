<?php
session_start();
if (!empty($_GET['id']) && !empty($_POST['comentario']) && isset($_SESSION["id_user"])) {

    $id_pub = $_GET['id'];
    $comentario = $_POST['comentario'];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $query = "INSERT INTO `comentarios` (`ref_id_utilizadores`, `ref_id_publicacoes`, `texto`, `timestamp`) VALUES (?,?,?, CURRENT_TIMESTAMP)";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iis', $_SESSION["id_user"], $id_pub, $comentario);

        // reservar
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            header("Location: ../pub.php?id=" . $id_pub);
        }

    } else {
        // Acção de erro
        echo "Error:" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("Location: ../gretua.php");
}