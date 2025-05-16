<?php

require("includes/common.php");

$email = $_POST['email'];
$email = pg_escape_string($con, $email);

$password = $_POST['password'];
$password = pg_escape_string($con, $password);

// Query checks if the email and password are present in the database.
$query = "SELECT id, email FROM users WHERE email='$email' AND password='$password'";
$result = pg_query($con, $query);

if (!$result) {
    die("Database query failed: " . pg_last_error($con));
}

$num = pg_num_rows($result);

// If the email and password are not present in the database
if ($num == 0) {
    $error = "<span class='red'>Enter Correct E-mail and Password Combination</span>";
    header('location: login.php?error=' . urlencode($error));
    exit();
} else {
    $row = pg_fetch_assoc($result);
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    header('location: products.php');
    exit();
}
?>
