<?php

if (!empty($_POST["nomeevento"]) && !empty($_POST["artista"]) && !empty($_POST["dataevento1"]) && !empty($_POST["curtadesc"]) && !empty($_POST["desc"]) && !empty($_POST["lotacao"]) && !empty($_POST["precoreserva"]) && !empty($_POST["precoporta"]) && !empty($_POST["ndatas"])) {

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

            $query = "INSERT INTO artistas (nome, biografia, ref_id_pais, instagram, facebook, spotify, youtube) VALUES (?,?,?,?,?,?,?)";

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
            header("Location: ../novo-evento.php?msg=1");
            die();
        }
    }


    //se for escolhido um estlo que já está na base de dados, já podemos atribuir o id
    if (!empty($_POST["tipoevento"])) {
        $id_tipoevento = $_POST["tipoevento"];
    } else {
        $query = "INSERT INTO tipo_eventos (nome) VALUES (?)";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 's', $_POST["outrotipoevento"]);

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

    $nomeevento = $_POST["nomeevento"];
    $desc = $_POST["desc"];
    $curtadesc = $_POST["curtadesc"];
    $lotacao = $_POST["lotacao"];
    $precoreserva = $_POST["precoreserva"];
    $precoporta = $_POST["precoporta"];


    $query = "INSERT INTO `eventos` (`nome`, `ref_id_artistas`, `descricao`, `descricao_curta`, `ref_id_tipo_eventos`, `lotacao`, `preco_reserva`, `preco_porta`) VALUES (?,?,?,?,?,?,?,?)";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sissiiii', $nomeevento, $id_artista, $desc, $curtadesc, $id_tipoevento, $lotacao, $precoreserva, $precoporta);
        if (mysqli_stmt_execute($stmt)) {
            //anuncio publicado, falta adicionar as datas e as fotos


            //o id do evento é a ultima PK inserida na base de dados. vai ser util para criar adicionar a data
            $id_evento = mysqli_insert_id($link);


            //ver quantos inputs de datas existem. depois repetimos o execute conforme o número de datas que existirem
            $ndatas = $_POST["ndatas"];


            $query = "INSERT INTO data_eventos (data, ref_id_eventos) VALUES (?, ?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'si', $data_evento, $id_evento);

                //vamos relacionar as datas ao evento
                for ($i = 1; $i <= $ndatas; $i++) {
                    $data_evento = date("Y-m-d H:i:s", strtotime($_POST["dataevento" . $i]));
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        //sucesso
                        //header("Location: ../novo-evento.php?msg=3");
                    }
                }
            } else {
                echo "Error:" . mysqli_error($link);
            }


            //adicionar fotos
            $totalfotos = count($_FILES['fotos']['name']);
            include_once "sc_upload_imagens.php";

            if (!empty($_FILES["fotos"]["name"])) {
                for ($i = 0; $i < $totalfotos; $i++) {
                    $array_nome_img[] = uploadImagem($_FILES["fotos"], $i, "eventos", 1080);

                }
            } else {
                $array_nome_img = null;
                //falta info do evento
                header("Location: ../novo-evento.php?msg=2");
                die;
            }

            $fotocapa = $_POST["fotocapa"];

            $query = "INSERT INTO fotos_eventos (foto, capa, ref_id_eventos) VALUES (?,?,?)";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'ssi', $nome_img, $capa, $id_evento);
                $n = 0;
                //vamos relacionar as datas ao evento
                foreach ($array_nome_img as $nome_img) {
                    //se o nome do ficheiro for igual ao value do select de escolher a capa, definimos essa foto como capa
                    if ($_FILES['fotos']['name'][$n] == $fotocapa) {
                        $capa = 1;
                    } else {
                        $capa = 0;
                    }
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                    $n++;
                }
            } else {
                echo "Error:" . mysqli_error($link);
            }

        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    //falta info do evento
    header("Location: ../novo-evento.php?msg=0");
}


