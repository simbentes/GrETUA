<?php
if (isset($_GET['carregar']) && isset($_GET['data'])) {

    //buscar a ultima data, para impedir que existam repeticoes
    if (isset($_GET["data"])) {
        //se estiver empty é sinal que é o primeiro pedido ajax
        if (!empty($_GET["data"])) {
            if (is_numeric($_GET["data"])) {
                $data_query = date("Y-m-d H:i:s", round($_GET['data']));
            } else {
                $data_query = $_GET['data'];
            }
            $ultima_data = "AND data_eventos.data < ?";
        } else {
            $ultima_data = "";
        }
    } else {
        $ultima_data = "";
    }

    require_once("../connections/connection.php");

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT eventos.id_eventos, DATE_FORMAT(DATE(data_eventos.data),'%d!%m-%Y'), eventos.nome, fotos_eventos.foto, eventos.descricao_curta, data_eventos.data FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND data_eventos.data < NOW() " . $ultima_data . " AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)
ORDER BY data_eventos.data DESC
LIMIT 0, 4;";

    if (mysqli_stmt_prepare($stmt, $query)) {

        if (!empty($_GET["data"])) {
            mysqli_stmt_bind_param($stmt, "s", $data_query);
        }

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $id_evento, $data_evento, $nome_evento, $foto, $desc_curta, $data_completa);

        mysqli_stmt_store_result($stmt);

        $numrows = mysqli_stmt_num_rows($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $memorias = [];

            while (mysqli_stmt_fetch($stmt)) {

                //subtituir o mes em numérico, para escrito
                $meses = array("!01-", "!02-", "!03-", "!04-", "!05-", "!06-", "!07-", "!08-", "!09-", "!10-", "!11-", "!12-");
                $str_meses = array(" de janeiro de ", " de fevereiro de ", " de março de ", " de abril de ", " de maio de ", " de junho de ", " de julho de ", " de agosto de ", " de setembro de ", " de outubro de ", " de novembro de ", " de dezembro de ");
                $data_str = str_replace($meses, $str_meses, $data_evento);

                // enviar dados dos albuns para serem renderizados em js
                $memorias[] = ["id_evento" => htmlspecialchars($id_evento), "data_evento" => htmlspecialchars($data_completa), "data_str" => htmlspecialchars($data_str), "nome_evento" => htmlspecialchars($nome_evento), "foto" => htmlspecialchars($foto), "desc_curta" => htmlspecialchars($desc_curta), "repeticoes" => htmlspecialchars($numrows)];
            }

            die(json_encode($memorias));
        } else {
            die("fim");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        echo "Error: " . mysqli_error($link);
    }


}
