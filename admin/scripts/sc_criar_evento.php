<?php


if (!empty($_POST["nomeartista"]) && !empty($_POST["artista"]) && !empty($_POST["dataevento1"]) && !empty($_POST["curtadesc"]) && !empty($_POST["desc"]) && !empty($_POST["tipoevento"]) && !empty($_POST["lotacao"]) && !empty($_POST["precoreserva"]) && !empty($_POST["precoporta"]) && !empty($_POST["ndatas"])) {

    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    if ($_POST["artista"] !== "novoartista") {
        //se for escolhido um artista que já está na base de dados, já podemos atribuir o id
        $id_artista = $_POST["artista"];
    } else {
        //vamos adicionar um novo artista à nossa bd
        if (!empty($_POST["nomeartista"]) && !empty($_POST["artistadesc"]) && !empty($_POST["paisartista"])) {

            //se não estão preenchidos, ficam a null
            !empty($_POST["instagram"]) ? $instagram = $_POST["instagram"] : $instagram = null;
            !empty($_POST["facebook"]) ? $facebook = $_POST["facebook"] : $facebook = null;
            !empty($_POST["spotify"]) ? $spotify = $_POST["spotify"] : $spotify = null;
            !empty($_POST["youtube"]) ? $youtube = $_POST["youtube"] : $youtube = null;

            $query = "INSERT INTO artistas (nome, biografia, ref_id_paises, instagram, facebook, spotify, youtube) VALUES (?,?,?,?,?,?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'ssissss', $_POST["nomeartista"], $_POST["artistadesc"], $_POST["paisartista"], $instagram, $facebook, $spotify, $youtube);

                if (mysqli_stmt_execute($stmt)) {
                    //o id do artista é a ultima PK inserida na base de dados. vai ser util para criar o evento
                    $id_artista = mysqli_insert_id($link);

                } else {
                    echo "Error:" . mysqli_stmt_error($stmt);
                }
            } else {
                echo "Error:" . mysqli_error($link);
            }
        } else {
            //falta info do artista
            header("Location: ../vender.php?msg=0");
            die();
        }
    }


    //se for escolhido um estlo que já está na base de dados, já podemos atribuir o id
    if (!empty($_POST["tipoevento"])) {
        $id_tipoevento = $_POST["tipoevento"];
    } else {
        $query = "INSERT INTO tipo_eventos (nome) VALUES (?)";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 's', $_POST["tipoevento"]);

            if (mysqli_stmt_execute($stmt)) {
                //o id do artista é a ultima PK inserida na base de dados. vai ser util para criar o evento
                $id_tipoevento = mysqli_insert_id($link);
            } else {
                echo "Error:" . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Error:" . mysqli_error($link);
        }
    }


    //artista e tipo de evento com upload feito
    //falta apenas criar o evento

    $nomeartista = $_POST["nomeartista"];
    $dataevento1 = $_POST["dataevento1"];
    $curtadesc = $_POST["curtadesc"];
    $desc = $_POST["desc"];
    $tipoevento = $_POST["tipoevento"];
    $precoreserva = $_POST["precoreserva"];
    $precoporta = $_POST["precoporta"];
    $array_fotos = $_POST["fotos[]"];


    $query = "INSERT INTO `eventos` (`nome`, `ref_id_artistas`, `descricao`, `descricao_curta`, `ref_id_tipo_eventos`, `lotacao`, `preco_reserva`, `preco_porta`) VALUES (?,?,?,?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'iiiss', $id_evento, $ref_id_vendedor, $condicao, $nome_img, $preco);
        if (mysqli_stmt_execute($stmt)) {
            //anuncio publicado
            header("Location: ../vender.php?msg=2");
        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }


    /*
        //upload imagem
        include_once "../../scripts/sc_upload_imagem.php";
        $nome_img = uploadImagem($_FILES["foto"], "capas", 400);
        if (!isset($nome_img)) {
            $nome_img = "capa_default.png";
        }*/


    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    //falta info do evento
    header("Location: ../vender.php?msg=1");
}


