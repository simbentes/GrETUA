<?php
session_start();
require_once "../connections/connection.php";

if (!empty($_POST["username"]) && !empty($_POST["email"])) {
    $id_user = $_SESSION["id_user_edit"];
    unset($_SESSION["id_user_edit"]);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $id_cargo = $_POST['id_cargo'];

    if (!isset($_POST['active'])) {
        $ativo = 0;
    } else {
        $ativo = 1;
    }

    //editar o user
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);
    $query = "UPDATE utilizadores SET username = ?, email = ?, ativo = ?, ref_id_cargo = ? WHERE id_utilizadores = " . $id_user;

    if (mysqli_stmt_prepare($stmt, $query)) {

        mysqli_stmt_bind_param($stmt, 'ssii', $username, $email, $ativo, $id_cargo);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../users_edit.php?id=" . $id_user . "&msg=0");
        } else {
            echo "Error:" . mysqli_stmt_error($stmt);
            header("Location: ../users_edit.php?id=" . $id_user . "&msg=1");
        }
    } else {
        echo "Error:" . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    header("Location: ../users.php");
}
