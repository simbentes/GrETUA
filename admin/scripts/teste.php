<?php


require_once "../connections/connection.php";

$link = new_db_connection();
$stmt = mysqli_stmt_init($link);

//adicionar fotos
$totalfotos = count($_FILES['fotos']['name']);
include_once "sc_upload_imagens.php";

if (!empty($_FILES["fotos"]["name"])) {
    for ($i = 0; $i < $totalfotos; $i++) {
        $array_fotos_antigas[] = $_FILES["fotos"]["name"][$i];
        $array_nome_img[] = uploadImagem($_FILES["fotos"], $i, "users", 1080);
    }
} else {
    $array_nome_img = null;
    //faltam fotos
    header("Location: ../novo-evento.php?msg=2");
}




$query = "UPDATE fotos_eventos SET foto = ? WHERE foto = ?;";

if (mysqli_stmt_prepare($stmt, $query)) {

    mysqli_stmt_bind_param($stmt, 'ss', $nome_img, $foto_antiga);
    $n = 0;
    //vamos relacionar as datas ao evento
    foreach ($array_nome_img as $nome_img) {
        $foto_antiga = $array_fotos_antigas[$n];
        if (!mysqli_stmt_execute($stmt)) {
            echo "Error: " . mysqli_stmt_error($stmt);
        } else {
            header("Location: ../novo-evento.php?msg=3");
        }
        $n++;
    }
} else {
    echo "Error:" . mysqli_error($link);
}


echo var_dump($array_fotos_antigas);

mysqli_stmt_close($stmt);
mysqli_close($link);


