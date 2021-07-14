<?php
if (isset($_GET['string'])) {

    $pesquisa = "%" . $_GET['string'] . "%";


    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.id_eventos, eventos.nome, tipo_eventos.nome FROM eventos
            INNER JOIN data_eventos
            ON data_eventos.ref_id_eventos = eventos.id_eventos
            INNER JOIN tipo_eventos
            ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
            WHERE eventos.nome LIKE ? AND (data_eventos.data) IN (SELECT
            MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY
            data_eventos.ref_id_eventos)
            ORDER BY eventos.nome;";

    if (mysqli_stmt_prepare($stmt, $query)) {


        mysqli_stmt_bind_param($stmt, "s", $pesquisa);


        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $tipo);

        mysqli_stmt_store_result($stmt);
        $resultado = "";
        $numrows = mysqli_stmt_num_rows($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {

            while (mysqli_stmt_fetch($stmt)) {
                $resultado .= "<div class='col-12 py-2'><a href='evento.php?evento=$id_evento' class='text-pesquisa h2 m-0 text-white'>$nome_evento</a><hr></div>";
            }

        } else {
            die("nenhum");
        }

        die($resultado);

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        echo "Error: " . mysqli_error($link);
    }


}

