<?php
session_start();
require_once "../connections/connection.php";


if (!empty($_POST["nome"]) && !empty($_POST["apelido"])) {

    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $biografia = $_POST['biografia'];
    $instagram = $_POST['instagram'];
    $whatsapp = $_POST['whatsapp'];


    include_once "sc_upload_imagem.php";
    //só alteramos a foto se o user colocou uma nova no input...
    if (!empty($_FILES["foto"]["name"])) {
        $nome_img = uploadImagem($_FILES["foto"], "users", 300);
    } else {
        $nome_img = $_SESSION["fperfil"];
    }


    //editar o user

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "UPDATE utilizadores SET nome = ?, apelido = ?, descricao = ?, foto_perfil = ?, conta_instagram = ?, conta_whatsapp = ? WHERE id_utilizadores = " . $_SESSION["id_user"];


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssssss', $nome, $apelido, $biografia, $nome_img, $instagram, $whatsapp);

        if (mysqli_stmt_execute($stmt)) {
            // Informação atualizada

            //novas variaveis de sessão baseadas nas alterações do user
            session_start();
            $_SESSION["nome"] = $nome . " " . $apelido;
            $_SESSION["fperfil"] = $nome_img;
            header("Location: ../conta.php");
        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    header("Location: ../editar-perfil.php?msg=3");
}