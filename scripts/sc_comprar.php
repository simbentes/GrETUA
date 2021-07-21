<?php
session_start();
require_once "../connections/connection.php";
$link = new_db_connection();
$stmt = mysqli_stmt_init($link);


$query = "SELECT eventos.lotacao, SUM(reservas.quantidade)
FROM `reservas`
INNER JOIN data_eventos
ON id_data_eventos = reservas.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

if (mysqli_stmt_prepare($stmt, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $lotacao, $ocupacao_reservas);

    if (!mysqli_stmt_fetch($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt);
    } else {
        $query = "SELECT SUM(compras.quantidade)
FROM `compras`
INNER JOIN data_eventos
ON id_data_eventos = compras.ref_id_data_eventos
INNER JOIN eventos
ON eventos.id_eventos = data_eventos.ref_id_eventos
WHERE id_data_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_data_eventos);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ocupacao_compras);

            if (!mysqli_stmt_fetch($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            } else {
                if (isset($ocupacao_reservas) || isset($ocupacao_compras)) {
                    $ocupacao = 1 - ($lotacao - ($ocupacao_reservas + $ocupacao_compras)) / $lotacao;
                } else {
                    $ocupacao = 0;
                }
            }
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
} else {
    echo "Error: " . mysqli_error($link);
}

if ($ocupacao < 1) {

    if (!empty($_POST['quantidade']) && !empty($_POST['data_evento']) && isset($_SESSION["id_user"]) && isset($_POST["nomebilhete1"])) {

        $quantidade = $_POST['quantidade'];
        $id_data_evento = $_POST['data_evento'];


        for ($i = 1; $i <= $quantidade; $i++) {
            $nomebilhetes[] = $_POST["nomebilhete" . $i];
        }


        $query = "SELECT id_eventos, eventos.nome, eventos.descricao_curta, preco_reserva, DATE_FORMAT(data, '%d-%m-%Y %Hh%i')
FROM `data_eventos`
INNER JOIN eventos
ON data_eventos.ref_id_eventos = id_eventos
WHERE data_eventos.id_data_eventos = ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_data_evento);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_eventos, $evento_nome, $descricao, $preco, $data);
            if (!mysqli_stmt_fetch($stmt)) {
                echo "Error: " . mysqli_stmt_error($stmt);
            } else {
                if ($preco == 0) {
                    $arraysessao = ["id" => $id_data_evento, "quantidade" => $quantidade, "nomebilhetes" => $nomebilhetes];
                    $_SESSION["data_evento_vendida"] = $arraysessao;
                    header("Location: sc_compra_realizada.php");
                } else {


                    $arraysessao = ["id" => $id_data_evento, "quantidade" => $quantidade, "nomebilhetes" => $nomebilhetes];
                    $_SESSION["data_evento_vendida"] = $arraysessao;

                    require '../vendor/autoload.php';
                    \Stripe\Stripe::setApiKey('sk_test_51JEoDKGIQtUeK0bjD6tDCohZRbPPDbWiYSSx2YpddWlr4vbEHloYO57dNZCnljB1vQWk4d1RGRxclKtDdLCtzuy500KYibLHuh');

                    header('Content-Type: application/json');

                    $YOUR_DOMAIN = 'https://labmm.clients.ua.pt/deca_20L4/deca_20L4_33';

                    $preco_stripe = $preco * 100;

                    $checkout_session = \Stripe\Checkout\Session::create([
                        'customer_email' => $_SESSION["email"],
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'price_data' => [
                                'currency' => 'eur',
                                'unit_amount' => $preco_stripe,
                                'product_data' => [
                                    'name' => $evento_nome,
                                    'description' => $data,

                                ],
                            ],
                            'quantity' => $quantidade,
                        ]],
                        'mode' => 'payment',
                        'success_url' => $YOUR_DOMAIN . '/scripts/sc_compra_realizada.php',
                        'cancel_url' => $YOUR_DOMAIN . '/evento.php?evento=' . $id_eventos,
                    ]);


                    header("HTTP/1.1 303 See Other");
                    header("Location: " . $checkout_session->url);

                }
            }
        } else {
            echo "Error: " . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($link);

    } else {
        header("Location: ../eventos.php");
    }

} else {
    header("Location: ../eventos.php?msg=1");
}