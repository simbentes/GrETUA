<?php
session_start();
require_once "../connections/connection.php";


if (!empty($_POST["nome"]) && !empty($_POST["apelido"]) && !empty($_POST["username"])) {

    $biografia = $_POST['biografia'];

    if (strlen($biografia) > 200) {
        header("Location: ../editar-perfil.php?msg=0");
    } else {

        $nome = $_POST['nome'];
        $apelido = $_POST['apelido'];
        $username = $_POST['username'];
        $instagram = $_POST['instagram'];
        $whatsapp = $_POST['whatsapp'];
        $cargo = $_POST['cargo'];


        include_once "sc_upload_imagem.php";
        //só alteramos a foto se o user colocou uma nova no input...
        if (!empty($_FILES["foto"]["name"])) {
            $nome_img = uploadImagem($_FILES["foto"], "users", 300);
        } else {
            $nome_img = $_SESSION["fperfil"];
        }

        //editar o user

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);


        $query = "SELECT email FROM utilizadores WHERE username = ? AND id_utilizadores !=" . $_SESSION["id_user"];

        if (mysqli_stmt_prepare($stmt, $query)) {

            // Bind variables by type to each parameter
            mysqli_stmt_bind_param($stmt, 's', $username);

            /* execute the prepared statement */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $email_resultados);

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) != 0) {
                //já existe uma conta com este mail ou com este username
                header("Location: ../editar-perfil.php?msg=1");
            } else {
                //vamos criar uma nova conta
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $apelido = $_POST['apelido'];

                if (strpos($username, '@') != false) {
                    header("Location: ../editar-perfil.php?msg=1");
                    die;
                } else if (strpos($username, ' ') != false) {
                    header("Location: ../editar-perfil.php?msg=1");
                    die;
                }

                $query = "UPDATE utilizadores SET nome = ?, apelido = ?, username = ?, biografia = ?, foto_perfil = ?, instagram = ?, whatsapp = ?, ref_id_cargo = ? WHERE id_utilizadores = " . $_SESSION["id_user"];


                if (mysqli_stmt_prepare($stmt, $query)) {

                    mysqli_stmt_bind_param($stmt, 'sssssssi', $nome, $apelido, $username, $biografia, $nome_img, $instagram, $whatsapp, $cargo);

                    if (mysqli_stmt_execute($stmt)) {
                        // Informação atualizada

                        //novas variaveis de sessão baseadas nas alterações do user
                        session_start();
                        $_SESSION["nome"] = $nome . " " . $apelido;
                        $_SESSION["fperfil"] = $nome_img;
                        header("Location: ../conta.php?msg=0");
                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error:" . mysqli_error($link);
                }


            }
        } else {
            echo "Error: " . mysqli_error($link);
        }


        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }
} else {
    header("Location: ../editar-perfil.php?msg=2");
}


session_start();
require_once "../connections/connection.php";


if (!empty($_POST["email"])) {
    //se o user quiser alterar a pass, não fazia sentido pedir para confirmar a pass duas vezes
    if (!empty($_POST['passatual']) || !empty($_POST['passnova']) || !empty($_POST['passnova2'])) {
        if (!empty($_POST['passatual'])) {
            $passwordatual = $_POST['passatual'];
        }
        //se alguma
        if (empty($_POST['passatual']) || empty($_POST['passnova']) || empty($_POST['passnova2'])) {
            header("Location: ../editar-info-privada.php?msg=6");
            die;
        }

    }

    //verificar se a password está correta
    $passwordconfirmar = $_POST['passconfimar'];

    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT password FROM utilizadores WHERE id_utilizadores = " . $_SESSION["id_user"];


    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $password_hash);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($passwordconfirmar, $password_hash) || password_verify($passwordatual, $password_hash)) {

                $email = $_POST['email'];
                (!empty($_POST['telefone'])) ? $telefone = $_POST['telefone'] : $telefone = null;


                if (isset($passwordatual)) {
                    if (!empty($_POST['passnova']) && !empty($_POST['passnova2'])) {
                        $password1 = $_POST['passnova'];
                        $password2 = $_POST['passnova2'];
                        if ($password1 !== $password2) {
                            header("Location: ../editar-info-privada.php?msg=0");
                            die;
                        }
                        //Se a nova password for igual á antiga.. não faz sentido alterar
                        if (!password_verify($_POST['passnova'], $password_hash)) {
                            $passwordnova = password_hash($_POST['passnova'], PASSWORD_DEFAULT);
                        } else {
                            header("Location: ../editar-info-privada.php?msg=1");
                            die;
                        }
                    } else {
                        $passwordnova = null;
                    }
                }

                //podemos ou não querer alterar a password
                $stmt = mysqli_stmt_init($link);

                if (!isset($passwordnova)) {
                    $query = "UPDATE utilizadores SET email = ?, telemovel = ? WHERE id_utilizadores = ?";
                } else {
                    $query = "UPDATE utilizadores SET email = ?, telemovel = ?, password = ? WHERE id_utilizadores = ?";
                }

                if (mysqli_stmt_prepare($stmt, $query)) {

                    if (!isset($passwordnova)) {
                        mysqli_stmt_bind_param($stmt, 'ssi', $email, $telefone, $_SESSION["id_user"]);
                        $msg = 4;
                    } else {
                        mysqli_stmt_bind_param($stmt, 'sssi', $email, $telefone, $passwordnova, $_SESSION["id_user"]);
                        $msg = 5;
                    }

                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: ../editar-info-privada.php?msg=" . $msg);
                    } else {
                        echo "Error:" . mysqli_stmt_error($stmt);
                    }
                } else {
                    echo "Error:" . mysqli_error($link);
                }

            } else {
                header("Location: ../editar-info-privada.php?msg=2");
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
    header("Location: ../editar-info-privada.php?msg=3");
}




