<?php
require("includes/common.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Escape variables
    $item_id = pg_escape_string($con, $item_id);
    $user_id = pg_escape_string($con, $user_id);

    $query = "INSERT INTO users_items(user_id, item_id, status) VALUES('$user_id', '$item_id', 'Added to cart')";
    $result = pg_query($con, $query);

    if (!$result) {
        die("Error in query: " . pg_last_error($con));
    }

    header('Location: products.php');
    exit();
}
?>
