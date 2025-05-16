<?php

require("includes/common.php");

// Getting the values from the signup page using $_POST[] and escaping them
$name = pg_escape_string($con, $_POST['name']);
$email = pg_escape_string($con, $_POST['email']);
$password = pg_escape_string($con, $_POST['password']);
$contact = pg_escape_string($con, $_POST['contact']);
$city = pg_escape_string($con, $_POST['city']);
$address = pg_escape_string($con, $_POST['address']);

$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$regex_num = "/^[0-9]{10}$/";

// Check if email already exists
$query = "SELECT * FROM users WHERE email = '$email'";
$result = pg_query($con, $query) or die(pg_last_error($con));
$num = pg_num_rows($result);

if ($num != 0) {
    $m = "<span class='red'>Email Already Exists</span>";
    header('location: signup.php?m1=' . $m);
} else if (!preg_match($regex_email, $email)) {
    $m = "<span class='red'>Not a valid Email Id</span>";
    header('location: signup.php?m1=' . $m);
} else if (!preg_match($regex_num, $contact)) {
    $m = "<span class='red'>Not a valid phone number</span>";
    header('location: signup.php?m2=' . $m);
} else {
    $query = "INSERT INTO users(name, email, password, contact, city, address)
              VALUES('$name', '$email', '$password', '$contact', '$city', '$address') 
              RETURNING id";
    
    $result = pg_query($con, $query) or die(pg_last_error($con));
    $row = pg_fetch_assoc($result);
    $user_id = $row['id'];

    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
    header('location: products.php');
}
?>
