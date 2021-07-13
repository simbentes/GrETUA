<?php
$user_id = $_SESSION["id_user"];
session_start();
require_once "../connections/connection.php";

if(empty($_POST['textopub']) || empty($_POST['titulopub']))
{
    header("Location: ../gretua.php");
}
else
{
    $texto = $_POST['textopub'];
    $titulo = $_POST['titulopub'];
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "INSERT INTO publicacoes  (ref_id_utilizadores, timestamp,titulo, texto) values($user_id, CURRENT_TIMESTAMP, $titulo, $texto)";

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'isss', $user_id, CURRENT_TIMESTAMP, $titulo, $texto);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../gretua.php");
            echo "success";
        } else {echo "error";}

    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
}

//não está a dar por alguma razão ?? (devo ter um erro algures ou entao nao é a forma mais inteligente)
//ainda falta ver a inserção das imagens nos posts
//vou ver a melhor estratégia para o feed
?>