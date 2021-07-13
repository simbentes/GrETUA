<?php
// Verificação de credenciais de acesso à área de administração
session_start();
if (isset($_SESSION["cargo"]) && $_SESSION["cargo"] == 1):
    require_once "../connections/connection.php";

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT COUNT(id_utilizadores) FROM `utilizadores` WHERE DAYOFWEEK(utilizadores.timestamp) = ? AND UNIX_TIMESTAMP(utilizadores.timestamp) > (UNIX_TIMESTAMP(NOW()) - 604800);";

    $diadasemana = date("w");
    // o dayoftheweek no mysql vai de 1 a 7, ao contrario do php e js que é de 0 a 6
    $x = $diadasemana + 1;
    for ($i = 0; $i < 7; $i++) {
        $x++;
        //fazer push dos dias da semana

        if (mysqli_stmt_prepare($stmt, $query)) {

            mysqli_stmt_bind_param($stmt, "i", $x);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $nUsers);

            if (mysqli_stmt_fetch($stmt)) {
                $arrayUsers[] = $nUsers;
            }
        } else {
            echo "Error: " . mysqli_error($link);
        }

        if ($x == 7) {
            $x = 0;
        }
    }

    die(json_encode($arrayUsers));

    mysqli_stmt_close($stmt);
    mysqli_close($link);

else:
    header("Location: ../index.php");
endif;