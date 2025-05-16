<?php

// This code checks if the product is added to cart. 
function check_if_added_to_cart($item_id) {
    $user_id = $_SESSION['user_id']; // We'll get the user_id from the session
    require("common.php"); // Connecting to the database

    // Sanitize inputs
    $item_id = pg_escape_string($con, $item_id);
    $user_id = pg_escape_string($con, $user_id);

    // Query to check if item is already in the user's cart with status 'Added to cart'
    $query = "SELECT * FROM users_items WHERE item_id='$item_id' AND user_id='$user_id' AND status='Added to cart'";
    $result = pg_query($con, $query);

    if (!$result) {
        die("Error in query: " . pg_last_error($con));
    }

    // Return 1 if item is found, else 0
    if (pg_num_rows($result) >= 1) {
        return 1;
    } else {
        return 0;
    }
}
?>
