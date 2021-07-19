<?php
session_start();
if (!empty($_POST['numreservas']) && !empty($_POST['data_evento']) && isset($_SESSION["id_user"])) {

    $n_reservas = $_POST['numreservas'];
    $id_data_evento = $_POST['data_evento'];

    require_once "../connections/connection.php";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);


    require '../vendor/autoload.php';
    \Stripe\Stripe::setApiKey('sk_test_51JEoDKGIQtUeK0bjD6tDCohZRbPPDbWiYSSx2YpddWlr4vbEHloYO57dNZCnljB1vQWk4d1RGRxclKtDdLCtzuy500KYibLHuh');


    header('Content-Type: application/json');

    $YOUR_DOMAIN = 'http://localhost:4242/gretua';

    $checkout_session = \Stripe\Checkout\Session::create([
        'customer_email' => 'jose@asd.com',
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'unit_amount' => 2000,
                'product_data' => [
                    'name' => $id_data_evento,
                    'images' => ["https://i.imgur.com/EHyR2nP.png"],
                ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/success.html',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
    ]);

    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);


    mysqli_stmt_close($stmt);
    mysqli_close($link);

} else {
    header("Location: ../eventos.php");
}