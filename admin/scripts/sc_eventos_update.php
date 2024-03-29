<?php
session_start();
if (isset($_SESSION["id_evento_edit"])) {
    $id_evento = $_SESSION["id_evento_edit"];
    unset($_SESSION["id_evento_edit"]);
} else {
    header("Location: ../eventos.php");
    die;
}
if (!empty($_POST["nomeevento"]) && !empty($_POST["curtadesc"]) && !empty($_POST["desc"]) && !empty($_POST["lotacao"]) && !empty($_POST["duracao"]) && !empty($_POST["cetaria"]) && !empty($_POST["precoreserva"]) && !empty($_POST["precoporta"])) {


    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $apagartipoevento = 0;
    $apagarevento = 0;


    //se for escolhido um estlo que já está na base de dados, já podemos atribuir o id
    if (!empty($_POST["tipoevento"])) {
        $id_tipoevento = $_POST["tipoevento"];
    } else {
        if (!empty($_POST["outrotipoevento"])) {

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
        } else {
            //falta tipo de evento (categoria)
            header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=1");
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

    $query = "UPDATE `eventos` SET `nome` = ?, `descricao` = ?, `descricao_curta` = ?, `ref_id_tipo_eventos` = ?, `lotacao` = ?, `preco_reserva` = ?, `preco_porta` = ?, duracao = ?, classificacao_etaria = ?, ficha_tecnica = ? WHERE id_eventos = ?";
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssiiiiiisi', $nomeevento, $desc, $curtadesc, $id_tipoevento, $lotacao, $precoreserva, $precoporta, $duracao, $cetaria, $ftecnica, $id_evento);
        if (mysqli_stmt_execute($stmt)) {


            header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=0");


        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    //falta info do evento
    header("Location: ../eventos_edit.php?id=" . $id_evento . "&msg=1");
}



