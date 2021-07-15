<?php
session_start();

if (!empty($_POST["titulopub"]) && !empty($_POST["textopub"])) {

    $texto = $_POST['textopub'];
    $titulo = $_POST['titulopub'];

    if (strlen($texto) > 1000) {
        header("Location: ../gretua.php");
    } else {

        //upload foto
        include_once "sc_upload_imagem.php";
        if (!empty($_FILES["foto"]["name"])) {
            $nome_img = uploadImagem($_FILES["foto"], "pub", 1080);
        } else {
            $nome_img = null;
        }

        //editar o user
        require_once "../connections/connection.php";

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        $query = "INSERT INTO publicacoes (titulo, texto, foto, ref_id_utilizadores) VALUES (?,?,?,?)";


        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'sssi', $titulo, $texto, $nome_img, $_SESSION["id_user"]);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../gretua.php");
            } else {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error:" . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
} else {
    header("Location: ../gretua.php");
}
