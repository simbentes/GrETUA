<?php
// Verificação de credenciais de acesso à área de administração
session_start();
if (isset($_SESSION["cargo"]) && $_SESSION["cargo"] == 2):
    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    $query = "SELECT COUNT(*) FROM `publicacoes` WHERE MONTH(timestamp) = MONTH(NOW()) AND YEAR(timestamp) = YEAR(NOW());";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nPublicacoes);

        if (mysqli_stmt_fetch($stmt)) {
            $interacoes[] = $nPublicacoes;


            $query = "SELECT COUNT(*) FROM `gostos` WHERE MONTH(timestamp) = MONTH(NOW()) AND YEAR(timestamp) = YEAR(NOW());";

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $nGostos);

                if (mysqli_stmt_fetch($stmt)) {
                    $interacoes[] = $nGostos;


                    $query = "SELECT COUNT(*) FROM `comentarios` WHERE MONTH(timestamp) = MONTH(NOW()) AND YEAR(timestamp) = YEAR(NOW());";

                    if (mysqli_stmt_prepare($stmt, $query)) {
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt, $nComentarios);

                        if (mysqli_stmt_fetch($stmt)) {
                            $interacoes[] = $nComentarios;

                            die(json_encode($interacoes));

                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
                }
            } else {
                echo "Error: " . mysqli_error($link);
            }
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($link);

else:
    header("Location: ../index.php");
endif;