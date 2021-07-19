<?php

session_start();
$id_artista = $_SESSION["id_artista_edit"];
unset($_SESSION["id_artista_edit"]);

if (!empty($_POST["nomeartista"]) && !empty($_POST["biografia"]) && !empty($_POST["paisartista"])) {


    //se não estão preenchidos, ficam a null
    !empty($_POST["instagram"]) ? $instagram = $_POST["instagram"] : $instagram = null;
    !empty($_POST["facebook"]) ? $facebook = $_POST["facebook"] : $facebook = null;
    !empty($_POST["spotify"]) ? $spotify = $_POST["spotify"] : $spotify = null;
    !empty($_POST["youtube"]) ? $youtube = $_POST["youtube"] : $youtube = null;

    require_once "../connections/connection.php";

    //editar artista
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $query = "UPDATE artistas SET nome = ?, biografia = ?, ref_id_pais = ?, instagram = ?, facebook = ?, spotify = ?, youtube = ? WHERE id_artistas = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssissssi', $_POST["nomeartista"], $_POST["biografia"], $_POST["paisartista"], $instagram, $facebook, $spotify, $youtube, $id_artista);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error:" . mysqli_stmt_error($stmt);
            // header("Location: ../artistas_edit.php?id=" . $id_artista . "&msg=1");
        } else {
            header("Location: ../artistas_edit.php?id=" . $id_artista . "&msg=0");
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    //falta info do artista
    header("Location: ../artistas_edit.php?id=" . $id_artista . "&msg=1");

}
