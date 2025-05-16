<?php

require("includes/common.php");

$name = $_POST['name'];
$name = pg_escape_string($con, $name);

$email = $_POST['email'];
$email = pg_escape_string($con, $email);

$message = trim($_POST['message']);
$message = pg_escape_string($con, $message);

$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

// Optional: you can validate the email format before inserting
if (!preg_match($regex_email, $email)) {
    $error = "<span class='red'>Not a valid Email Id</span>";
    header('location: contact.php?error=' . urlencode($error));
    exit();
}

$query = "INSERT INTO contact(name, email, message) VALUES('$name', '$email', '$message')";
$result = pg_query($con, $query);

if (!$result) {
    die("Error in query: " . pg_last_error($con));
}

header('location: contact.php');
exit();

?>
