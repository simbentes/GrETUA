<?php

function new_db_connection()
{

    //$hostname = 'gretua.underneth.net';
    //$username = 'undernet_gretua';
    //$password = 'aY;QLQYCMw.k';
    //$dbname = 'undernet_gretua';

    $hostname = 'localhost';
    $username = "root";
    $password = "root";
    $dbname = "gretua";

    // Makes the connection
    $local_link = mysqli_connect($hostname, $username, $password, $dbname);

    // If it fails to connect then die and show errors
    if (!$local_link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define charset to avoid special chars errors
    mysqli_set_charset($local_link, "utf8mb4");


    // Return the link
    return $local_link;
}