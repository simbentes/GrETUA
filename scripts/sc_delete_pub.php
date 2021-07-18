<?php
session_start();
if (isset($_SESSION["id_user"]) && isset($_GET["id"])) {
    $id_pub = $_GET["id"];
    require_once("../connections/connection.php");
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    //só quem pode eliminar é o user que tem determinada publicação..
    $query = "SELECT ref_id_utilizadores FROM publicacoes WHERE id_publicacoes = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_pub);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $ref_id_user);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_fetch($stmt)) {
            //só quem pode eliminar é o user de determinada publicação..
            if ($ref_id_user == $_SESSION["id_user"]) {

                //apagar likes
                $query = "DELETE FROM gostos WHERE ref_id_publicacoes = ?";

                if (mysqli_stmt_prepare($stmt, $query)) {
                    mysqli_stmt_bind_param($stmt, "i", $id_pub);

                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    } else {
                        $query = "DELETE FROM comentarios WHERE ref_id_publicacoes = ?";

                        if (mysqli_stmt_prepare($stmt, $query)) {
                            mysqli_stmt_bind_param($stmt, "i", $id_pub);

                            if (!mysqli_stmt_execute($stmt)) {
                                echo "Error: " . mysqli_stmt_error($stmt);
                            } else {
                                $query = "DELETE FROM publicacoes WHERE id_publicacoes = ?";

                                if (mysqli_stmt_prepare($stmt, $query)) {
                                    mysqli_stmt_bind_param($stmt, "i", $id_pub);

                                    if (!mysqli_stmt_execute($stmt)) {
                                        echo "Error: " . mysqli_stmt_error($stmt);
                                    } else {
                                        header("Location: ../gretua.php?msg=0");
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

            } else {
                header("Location: ../gretua.php");
            }

        }
    } else {
        echo "Error: " . mysqli_error($link);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("Location: ../gretua.php");
}
