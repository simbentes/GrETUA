<?php

if (!empty($_POST['nome']) && !empty($_POST['apelido']) && !empty($_POST['password']) && !empty($_POST['password2'])) {

    require_once "../connections/connection.php";

    $fotoperfil = "default.webp";
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Create a new DB connection
    $link = new_db_connection();

    /* create a prepared statement */
    $stmt = mysqli_stmt_init($link);

    $query = "SELECT email FROM utilizadores WHERE email = ? OR username = ?";

    if (mysqli_stmt_prepare($stmt, $query)) {

        // Bind variables by type to each parameter
        mysqli_stmt_bind_param($stmt, 'ss', $email, $username);

        /* execute the prepared statement */
        mysqli_stmt_execute($stmt);

        /* bind result variables */
        mysqli_stmt_bind_result($stmt, $email_resultados);

        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) != 0) {
            //já existe uma conta com este mail ou com este username
            header("Location: ../index.php?msg=1");
        } else {
            //vamos criar uma nova conta
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $apelido = $_POST['apelido'];

            if ($_POST['password'] !== $_POST['password2']) {
                header("Location: ../criarconta.php?msg=1");
                die;
            } else if (strpos($username, '@') != false) {
                header("Location: ../criarconta.php?msg=2");
                die;
            } else if (strlen($_POST['password']) < 8) {
                header("Location: ../criarconta.php?msg=3");
                die;
            }

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $query = "INSERT INTO utilizadores (nome, apelido,username, email, password, foto_perfil) VALUES (?,?,?,?,?,'default.webp')";

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, 'sssss', $nome, $apelido, $username, $email, $password);


                // Devemos validar também o resultado do execute!
                if (mysqli_stmt_execute($stmt)) {
                    // Registo feito
                    //enviar email de boas vindas

                    //ao criar a conta iniciamos automaticamente sessão
                    session_start();
                    //pesquisa o último id inserido, ou seja, o do novo user
                    $_SESSION["id_user"] = mysqli_insert_id($link);
                    $_SESSION["nomeproprio"] = $nome;
                    $_SESSION["nome"] = $nome . " " . $apelido;
                    $_SESSION["email"] = $email;
                    $_SESSION["fperfil"] = "default.webp";
                    header("Location: ../gretua.php");
                } else {
                    echo $nome . "; " . $apelido . "; " . $email . "; " . $password;
                }


            } else {
                // Acção de erro
                echo "Error:" . mysqli_error($link);
            }
        }
    } else {
        echo "Error: " . mysqli_error($link);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("Location: ../criarconta.php?msg=0");
}