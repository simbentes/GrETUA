<?php
session_start();
require_once "../connections/connection.php";


if (!empty($_POST["nome"]) && !empty($_POST["biografia"]) && !empty($_POST["paisartista"]) && isset($_GET["id_artistas"])) {
    $id_artistas = $_GET["id_artistas"];

    $nome = $_POST['nome'];
    $biografia = $_POST['biografia'];
    $paisartista = $_POST['paisartista'];

    

    //editar o artista
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE artistas SET nome = ?, biografia = ?, ref_id_pais = ? WHERE id_artistas = " . $id_artistas;

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssi', $nome, $biografia, $ref_id_pais);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../artistas_edit.php?msg=1");
        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    header("Location: ../artistas.php");
}
