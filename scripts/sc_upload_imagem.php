<?php

function uploadImagem($nome, $pasta, $px)
{
    function resizeImage($filename, $min_width, $min_height, $tipo)
    {
        list($orig_width, $orig_height) = getimagesize($filename);

        $width = $orig_width;
        $height = $orig_height;

        //se a altura for menor que a largura, a altura vai ser igual à altura minima
        if ($height < $width) {
            $width = ($min_height / $height) * $width;
            $height = $min_height;
        } else {
            $height = ($min_width / $width) * $height;
            $width = $min_width;
        }

        $image_p = imagecreatetruecolor($width, $height);

        switch ($tipo) {
            case "jpg":
            case "jpeg":
                $image = imagecreatefromjpeg($filename);
                break;
            case "png":
                $image = imagecreatefrompng($filename);
                break;
            case "gif":
                $image = imagecreatefromgif($filename);
        }


        imagecopyresampled($image_p, $image, 0, 0, 0, 0,
            $width, $height, $orig_width, $orig_height);

        return $image_p;
    }


    $target_dir = "../img/" . $pasta . "/";
    $target_file = $target_dir . basename($nome["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $check = getimagesize($nome["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }


    if (file_exists($target_file) && $uploadOk == 1) {
        //se a file já existir, é sinal que o user quer manter a foto
        $uploadOk = 0;
    }

    // Check file size
    if ($nome["size"] > 100000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }


    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        move_uploaded_file($nome["tmp_name"], $target_file);
        $pathimagem = $target_dir . $nome["name"];
        $nomefinal = md5(uniqid()) . '.webp';
        imagewebp(resizeImage($pathimagem, $px, $px, $imageFileType), $target_dir . $nomefinal, 100);
        unlink($pathimagem);
        return $nomefinal;
    }



}








