<?php

if (!empty($_POST["nomeevento"]) && !empty($_POST["artista"]) && !empty($_POST["dataevento1"]) && !empty($_POST["curtadesc"]) && !empty($_POST["desc"]) && !empty($_POST["lotacao"]) && !empty($_POST["duracao"]) && !empty($_POST["cetaria"]) && !empty($_POST["precoreserva"]) && !empty($_POST["precoporta"]) && !empty($_POST["ndatas"])) {

    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $apagarartista = 0;
    $apagartipoevento = 0;
    $apagarevento = 0;
    $apagardatas = 0;

    if ($_POST["artista"] !== "novoartista") {
        //se for escolhido um artista que já está na base de dados, já podemos atribuir o id
        $id_artista = $_POST["artista"];
    } else {
        //vamos adicionar um novo artista à nossa bd
        if (!empty($_POST["nomeartista"]) && !empty($_POST["artistadesc"]) && !empty($_POST["paisartista"])) {


            echo "!!!!!!!!!!!" . $_POST["paisartista"] . "!!!!!!!!!!!!!";
            //se não estão preenchidos, ficam a null
            !empty($_POST["instagram"]) ? $instagram = $_POST["instagram"] : $instagram = null;
            !empty($_POST["facebook"]) ? $facebook = $_POST["facebook"] : $facebook = null;
            !empty($_POST["spotify"]) ? $spotify = $_POST["spotify"] : $spotify = null;
            !empty($_POST["youtube"]) ? $youtube = $_POST["youtube"] : $youtube = null;

            $query = "UPDATE artistas SET nome = ?, biografia = ?, ref_id_pais = ?, instagram = ?, facebook = ?, spotify = ?, youtube = ?";

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
        if (!empty($_POST["outrotipoevento"])) {

            $query = "UPDATE tipo_eventos SET nome = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 's', $_POST["outrotipoevento"]);

                if (mysqli_stmt_execute($stmt)) {
                    //o id do artista é a ultima PK inserida na base de dados. vai ser util para criar o evento
                    $id_tipoevento = mysqli_insert_id($link);
                } else {
                    $apagarartista = 1;
                    echo "Error:" . mysqli_stmt_error($stmt);
                }
            } else {
                $apagarartista = 1;
                echo "Error:" . mysqli_error($link);
            }

        } else {
            $apagarartista = 1;
            //falta tipo de evento (categoria)
            header("Location: ../novo-evento.php?msg=4");
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
    $duracao = $_POST["duracao"];
    $cetaria = $_POST["cetaria"];
    $ftecnica = $_POST["ftecnica"];


    $query = "UPDATE `eventos` SET `nome` = ?, `ref_id_artistas` = ?, `descricao` = ?, `descricao_curta` = ?, `ref_id_tipo_eventos` = ?, `lotacao` = ?, `preco_reserva` = ?, `preco_porta` = ?, duracao = ?, classificacao_etaria = ?, ficha_tecnica = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sissiiiiiis', $nomeevento, $id_artista, $desc, $curtadesc, $id_tipoevento, $lotacao, $precoreserva, $precoporta, $duracao, $cetaria, $ftecnica);
        if (mysqli_stmt_execute($stmt)) {
            //anuncio publicado, falta adicionar as datas e as fotos


            //o id do evento é a ultima PK inserida na base de dados. vai ser util para criar adicionar a data
            $id_evento = mysqli_insert_id($link);


            //ver quantos inputs de datas existem. depois repetimos o execute conforme o número de datas que existirem
            $ndatas = $_POST["ndatas"];


            $query = "UPDATE data_eventos SET data = ?, ref_id_eventos = ?";

            if (mysqli_stmt_prepare($stmt, $query)) {

                mysqli_stmt_bind_param($stmt, 'si', $data_evento, $id_evento);

                //vamos relacionar as datas ao evento
                for ($i = 1; $i <= $ndatas; $i++) {
                    $data_evento = date("Y-m-d H:i:s", strtotime($_POST["dataevento" . $i]));
                    if (!mysqli_stmt_execute($stmt)) {
                        $apagarartista = 1;
                        $apagartipoevento = 1;
                        $apagarevento = 1;
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        $id_datas[] = mysqli_insert_id($link);
                    }
                }
            } else {
                $apagarartista = 1;
                $apagartipoevento = 1;
                $apagarevento = 1;
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
                //faltam fotos
                header("Location: ../novo-evento.php?msg=2");
            }

            $fotocapa = $_POST["fotocapa"];

            $query = "UPDATE  fotos_eventos SET foto = ?, capa = ?, ref_id_eventos = ?";

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
                        $apagarartista = 1;
                        $apagartipoevento = 1;
                        $apagarevento = 1;
                        $apagardatas = 1;
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        header("Location: ../novo-evento.php?msg=3");
                    }
                    $n++;
                }
            } else {
                $apagarartista = 1;
                $apagartipoevento = 1;
                $apagarevento = 1;
                $apagardatas = 1;
                echo "Error:" . mysqli_error($link);
            }

        } else {
            $apagarartista = 1;
            $apagartipoevento = 1;
            echo "Error:" . mysqli_stmt_error($stmt);
        }
    } else {
        $apagarartista = 1;
        $apagartipoevento = 1;
        echo "Error:" . mysqli_error($link);
    }


    // se ocorreu um erro, vamos apagar informações que foram adicionadas antes desse mesmo erro

    if ($apagardatas == 1) {
        $query = "DELETE FROM data_eventos WHERE id_data_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_data);

            foreach ($id_datas as $id_data) {
                /* execute the prepared statement */
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
            }
        }
    }

    if ($apagarevento == 1) {
        $query = "DELETE FROM eventos WHERE id_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_evento);
            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
        }
    }

    if ($apagarartista == 1) {
        $query = "DELETE FROM artistas WHERE id_artistas = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_artista);
            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
        }
    }

    if ($apagartipoevento == 1) {
        $query = "DELETE FROM id_tipo_evento WHERE id_tipo_evento = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_tipoevento);
            /* execute the prepared statement */
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    //falta info do evento
    header("Location: ../novo-evento.php?msg=0");
}


