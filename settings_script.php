<?php
// This page updates the user password
require("includes/common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}

$old_pass = $_POST['oldpassword'];
$new_pass = $_POST['newpassword'];
$rep_pass = $_POST['renewpassword'];

// Using pg_escape_string to sanitize inputs (optional if you use pg_query_params)
$old_pass = pg_escape_string($con, $old_pass);
$new_pass = pg_escape_string($con, $new_pass);
$rep_pass = pg_escape_string($con, $rep_pass);

// Fetch current password from DB securely
$query = "SELECT email, password FROM users WHERE email = $1";
$result = pg_query_params($con, $query, array($_SESSION['email']));

if (!$result) {
    die("Error in query: " . pg_last_error($con));
}

$row = pg_fetch_assoc($result);
$orig_pass = $row['password'];

// Check if new passwords match
if ($new_pass !== $rep_pass) {
    header('location: settings.php?error=The two passwords don\'t match.');
    exit;
}

// Check old password matches DB password (you should ideally hash passwords)
if ($old_pass === $orig_pass) {
    $update_query = "UPDATE users SET password = $1 WHERE email = $2";
    $update_result = pg_query_params($con, $update_query, array($new_pass, $_SESSION['email']));
    if (!$update_result) {
        die("Error updating password: " . pg_last_error($con));
    }
    header('location: settings.php?error=Password Updated Successfully');
    exit;
} else {
    header('location: settings.php?error=Wrong Old Password.');
    exit;
}
?>
