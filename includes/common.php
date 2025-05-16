<?php
    $con = mysqli_connect(
        getenv('DB_HOST'),
        getenv('DB_USER'),
        getenv('DB_PASS'),
        getenv('DB_NAME'),
        getenv('DB_PORT')
    ) or die(mysqli_error($con));

    if (!isset($_SESSION)) {
        session_start();
    }
?>
