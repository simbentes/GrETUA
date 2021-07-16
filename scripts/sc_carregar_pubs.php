<?php
session_start();

if (isset($_GET['carregar']) && isset($_GET['data']) && isset($_GET['ordem'])) {

    $limit = $_GET['ordem'][0];

    //buscar a ultima data, para impedir que existam repeticoes
    if (isset($_GET["data"])) {
        //se estiver empty é sinal que é o primeiro pedido ajax
        if (!empty($_GET["data"])) {
            if (is_numeric($_GET["data"])) {
                $data_query = date("Y-m-d H:i:s", round($_GET['data']));
            } else {
                $data_query = $_GET['data'];
            }
            $ultima_data = "WHERE publicacoes.timestamp < ?";
        } else {
            $ultima_data = "";
        }
    } else {
        $ultima_data = "";
    }

    $query = "SELECT id_publicacoes, publicacoes.timestamp, titulo, texto, foto, ref_id_eventos, CONCAT(utilizadores.nome, ' ', apelido), utilizadores.foto_perfil, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(publicacoes.timestamp)
FROM publicacoes
INNER JOIN utilizadores
ON id_utilizadores = ref_id_utilizadores
" . $ultima_data . "
ORDER BY publicacoes.timestamp DESC
LIMIT 0,?";

    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    if (mysqli_stmt_prepare($stmt, $query)) {

        if (!empty($_GET["data"])) {
            mysqli_stmt_bind_param($stmt, "si", $data_query, $limit);
        } else {
            mysqli_stmt_bind_param($stmt, "i", $limit);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_pub, $lastdata, $titulo, $texto, $foto, $ref_id_eventos, $nome_user, $fperfil_user, $unix_data);
        mysqli_stmt_store_result($stmt);

        $numrows = mysqli_stmt_num_rows($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $pubs = [];

            while (mysqli_stmt_fetch($stmt)) {

                if (!isset($ref_id_eventos)) {
                    $ref_id_eventos = "";
                }

                if (isset($foto)) {
                    $foto_pub = ' <img src="img/pub/' . $foto . '" class="card-img-top" alt="...">';
                } else {
                    $foto_pub = "";
                }

                if (isset($like)) {
                    $guardadoChecked = "checked";
                } else {
                    $guardadoChecked = "";
                }

                // enviar dados das publicacoes para serem renderizados em js
                $pubs[] = ["tipo" => "pub", "unix_tempo" => $unix_data, "nome_user" => $nome_user, "fperfil_user" => $fperfil_user, "foto" => $foto_pub, "titulo" => $titulo, "texto" => $texto, "ref_id_eventos" => $ref_id_eventos, "fperfil_session" => $_SESSION["fperfil"], "lastdata" => $lastdata, "repeticoes" => $numrows + $_GET['ordem'][1] + $_GET['ordem'][2]];


            }

            //carregar memoria
            if ($_GET['ordem'][1] == 1) {

                $query = "SELECT eventos.id_eventos, eventos.nome,  eventos.descricao_curta, fotos_eventos.foto FROM eventos
INNER JOIN data_eventos
ON data_eventos.ref_id_eventos = eventos.id_eventos
LEFT JOIN fotos_eventos
ON fotos_eventos.ref_id_eventos = eventos.id_eventos
INNER JOIN tipo_eventos
ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND data_eventos.data < NOW() AND (data_eventos.data) IN (SELECT MIN(data_eventos.data) FROM data_eventos GROUP BY data_eventos.ref_id_eventos)
ORDER BY RAND()
LIMIT 1;";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_memoria, $nome_memoria, $desc_curta, $foto);
                    mysqli_stmt_store_result($stmt);

                    $numrows = mysqli_stmt_num_rows($stmt);
                    if (!mysqli_stmt_fetch($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        $pubs[] = ["tipo" => "memoria", "id_memoria" => $id_memoria, "nome_memoria" => $nome_memoria, "desc_curta" => $desc_curta, "foto" => $foto];
                    }

                } else {
                    echo "Error: " . mysqli_error($link);
                }

            } else if ($_GET['ordem'][2] == 1) {
                //carregar evento

                $query = "SELECT eventos.id_eventos, eventos.nome, fotos_eventos.foto, tipo_eventos.nome FROM eventos
                INNER JOIN data_eventos
                ON data_eventos.ref_id_eventos = eventos.id_eventos
                LEFT JOIN fotos_eventos
                ON fotos_eventos.ref_id_eventos = eventos.id_eventos
                INNER JOIN tipo_eventos
                ON tipo_eventos.id_tipo_eventos = eventos.ref_id_tipo_eventos
                WHERE (fotos_eventos.foto IS NUll OR fotos_eventos.capa = 1) AND (data_eventos.data) IN (SELECT
                MIN(data_eventos.data) FROM data_eventos WHERE data_eventos.data > NOW() GROUP BY
                data_eventos.ref_id_eventos)
                ORDER BY RAND()
                LIMIT 1;";

                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id_evento, $nome_evento, $foto, $tipo_evento);
                    mysqli_stmt_store_result($stmt);

                    $numrows = mysqli_stmt_num_rows($stmt);
                    if (!mysqli_stmt_fetch($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        $query = "SELECT COUNT(vou) FROM `guardados_vou` WHERE vou = 1 AND guardados_vou.ref_id_eventos =" . $id_evento;

                        if (mysqli_stmt_prepare($stmt, $query)) {

                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $n_pessoas);

                            if (mysqli_stmt_fetch($stmt)) {

                                if ($n_pessoas == 1) {
                                    $texto = "pessoa vai";
                                } else {
                                    $texto = "pessoas vão";
                                }
                                $pessoas = $n_pessoas . ' ' . $texto;

                            } else {
                                echo "Error: " . mysqli_stmt_error($stmt);
                            }
                        } else {
                            echo "Error: " . mysqli_error($link);
                        }

                        $pubs[] = ["tipo" => "evento", "id_evento" => $id_evento, "nome_evento" => $nome_evento, "foto" => $foto, "tipo_evento" => $tipo_evento, "pessoas" => $pessoas];
                    }

                } else {
                    echo "Error: " . mysqli_error($link);
                }
            }


            die(json_encode($pubs));
        } else {
            die("fim");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        echo "Error: " . mysqli_error($link);
    }


}
