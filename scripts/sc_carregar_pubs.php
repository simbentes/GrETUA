<?php
session_start();

if (isset($_GET['carregar']) && isset($_GET['data']) && isset($_GET['ordem']) && isset($_GET['aseguir'])) {

    $limit = $_GET['ordem'][0];
    $aseguir = $_GET['aseguir'];


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


    //se o pedido vier de um perfil ou conta de um user
    if (isset($_GET["perfil"])) {

        if ($_GET["perfil"] == "undefined") {
            $id_user_pub = $_SESSION["id_user"];
        } else {
            $id_user_pub = $_GET["perfil"];
        }

        if (!empty($ultima_data)) {
            $perfil_pub = " AND id_utilizadores = " . $id_user_pub;
        } else {
            $perfil_pub = "WHERE id_utilizadores = " . $id_user_pub;
        }
    } else {
        $perfil_pub = "";
    }


    if ($aseguir == 1) {
        if (!empty($ultima_data) || !empty($perfil_pub)) {
            $aseguir_query = " AND seguidores.ref_id_utilizadores_seguir IN (SELECT ref_id_utilizadores_seguir FROM seguidores WHERE ref_id_utilizadores = " . $_SESSION["id_user"] . ")";
        } else {
            $aseguir_query = "WHERE seguidores.ref_id_utilizadores_seguir IN (SELECT ref_id_utilizadores_seguir FROM seguidores WHERE ref_id_utilizadores = " . $_SESSION["id_user"] . ")";
        }
    } else {
        $aseguir_query = "";
    }


    $query = "SELECT id_publicacoes, publicacoes.timestamp, titulo, texto, foto, ref_id_eventos, id_utilizadores, CONCAT(utilizadores.nome, ' ', apelido), utilizadores.foto_perfil, UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(publicacoes.timestamp), gostos.ref_id_utilizadores
FROM publicacoes
INNER JOIN utilizadores
ON id_utilizadores = ref_id_utilizadores
LEFT JOIN seguidores
ON seguidores.ref_id_utilizadores_seguir = id_utilizadores
LEFT JOIN gostos
ON gostos.ref_id_publicacoes = id_publicacoes AND gostos.ref_id_utilizadores = " . $_SESSION["id_user"] . "
$ultima_data $perfil_pub $aseguir_query
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
        mysqli_stmt_bind_result($stmt, $id_pub, $lastdata, $titulo, $texto, $foto, $ref_id_eventos, $id_user, $nome_user, $fperfil_user, $unix_data, $like);
        mysqli_stmt_store_result($stmt);

        $numrows = mysqli_stmt_num_rows($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $pubs = [];

            while (mysqli_stmt_fetch($stmt)) {

                if (!isset($ref_id_eventos)) {
                    $ref_id_eventos = "";
                }

                if (isset($foto)) {
                    $foto_pub = ' <img src="img/pub/' . htmlspecialchars($foto) . '" class="card-img-top" alt="...">';
                    $btn_style = "";
                } else {
                    $foto_pub = "";
                    $btn_style = "btn-like-semtxt";
                }


                if ($id_user == $_SESSION["id_user"]) {
                    $btn_delete = '<a href="scripts/sc_delete_pub.php?id=' . htmlspecialchars($id_pub) . '" class="h3 mb-0 ps-2 text-danger"><i class="bi bi-dash-circle-fill"></i></a>';
                } else {
                    $btn_delete = "";
                }

                if (isset($like)) {
                    $like = 1;
                } else {
                    $like = 0;
                }

                $n_comentarios = '';

                $stmt2 = mysqli_stmt_init($link);
                //numero de pessoas que comentaram
                $query2 = "SELECT COUNT(id_comentarios) FROM `comentarios` WHERE ref_id_publicacoes =" . $id_pub;

                if (mysqli_stmt_prepare($stmt2, $query2)) {
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_bind_result($stmt2, $n_com);
                    if (mysqli_stmt_fetch($stmt2)) {

                        if ($n_com > 0) {
                            ($n_com == 1) ? $s = "" : $s = "s";
                            $n_comentarios = '<div class="text-center pb-2 mb-1" style="font-size: 14.5px;"><a href="pub.php?id=' . htmlspecialchars($id_pub) . '" class="text-primary fw-bold">Ver ' . htmlspecialchars($n_com) . ' comentário' . $s . '</a></div>';
                        }

                    } else {
                        echo "Error: " . mysqli_stmt_error($stmt2);
                    }
                } else {
                    echo "Error: " . mysqli_error($link);
                }
                mysqli_stmt_close($stmt2);

                // enviar dados das publicacoes para serem renderizados em js
                $pubs[] = ["tipo" => "pub", "id_pub" => htmlspecialchars($id_pub), "unix_tempo" => $unix_data, "id_user" => htmlspecialchars($id_user), "nome_user" => htmlspecialchars($nome_user), "fperfil_user" => htmlspecialchars($fperfil_user), "foto" => $foto_pub, "titulo" => htmlspecialchars($titulo), "btn_style" => htmlspecialchars($btn_style), "n_comentarios" => $n_comentarios, "texto" => htmlspecialchars($texto), "delete_pub" => $btn_delete, "ref_id_eventos" => htmlspecialchars($ref_id_eventos), "fperfil_session" => htmlspecialchars($_SESSION["fperfil"]), "like" => $like, "lastdata" => htmlspecialchars($lastdata), "repeticoes" => $numrows + htmlspecialchars($_GET['ordem'][1]) + htmlspecialchars($_GET['ordem'][2])];


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
                        $pubs[] = ["tipo" => "memoria", "id_memoria" => htmlspecialchars($id_memoria), "nome_memoria" => htmlspecialchars($nome_memoria), "desc_curta" => htmlspecialchars($desc_curta), "foto" => htmlspecialchars($foto)];
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

                        //DATA escrita
                        $query = "SELECT DATE_FORMAT(MIN(DATE(data)), '%d-%m'), DATE_FORMAT(MIN(DATE(data)), '%Y'), DATE_FORMAT(MAX(DATE(data)), '%d-%m'), DATE_FORMAT(MAX(DATE(data)), '%Y')  FROM `data_eventos` WHERE ref_id_eventos = ? AND data > NOW();";
                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $id_evento);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $min_data, $min_ano, $max_data, $max_ano);

                            if (mysqli_stmt_fetch($stmt)) {
                                $meses = array("-01", "-02", "-03", "-04", "-05", "-06", "-07", "-08", "-09", "-10", "-11", "-12");
                                $str_meses = array(" JAN", "FEV", " MAR", " ABR", " MAI", " JUN", " JUL", " AGO", " SET", " OUT", " NOV", " DEZ");

                                $min_data_str = str_replace($meses, $str_meses, $min_data);
                                $max_data_str = str_replace($meses, $str_meses, $max_data);

                                if ($min_data == $max_data) {
                                    $data_str = $min_data_str;
                                } else {
                                    if ($min_ano == $max_ano) {
                                        $data_str = "<small>DE</small> " . htmlspecialchars($min_data_str) . " <small>A</small>  " . htmlspecialchars($max_data_str);
                                    } else {
                                        $data_str = "<small>DE</small> " . htmlspecialchars($min_data_str) . " " . htmlspecialchars($min_ano) . " <small>A</small>  " . htmlspecialchars($max_data_str) . " " . htmlspecialchars($max_ano);

                                    }
                                }
                            }

                            //numero de pessoas que "vão"
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
                        }

                        $pubs[] = ["tipo" => "evento", "id_evento" => htmlspecialchars($id_evento), "nome_evento" => htmlspecialchars($nome_evento), "foto" => htmlspecialchars($foto), "tipo_evento" => htmlspecialchars($tipo_evento), "data_str" => $data_str, "pessoas" => htmlspecialchars($pessoas)];

                    }
                } else {
                    echo "Error: " . mysqli_error($link);
                }
            }

            if (isset($pubs[2]["tipo"])) {
                if ($pubs[2]["tipo"] != "pub") {
                    if (rand(0, 1) > 0.5) {
                        $pubs_final[] = $pubs[0];
                        $pubs_final[] = $pubs[1];
                        $pubs_final[] = $pubs[2];
                    } else {
                        $pubs_final[] = $pubs[0];
                        $pubs_final[] = $pubs[2];
                        $pubs_final[] = $pubs[1];
                    }
                } else {
                    $pubs_final = $pubs;
                }
            } else {
                $pubs_final = $pubs;
            }

            die(json_encode($pubs_final));
        } else {
            if ($aseguir == 1 && empty($_GET["data"])) {
                die("fimaseguir");
            } else {
                die("fim");
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        echo "Error: " . mysqli_error($link);
    }


}
