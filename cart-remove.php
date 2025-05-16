<?php
require("includes/common.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = pg_escape_string($con, $_GET["id"]);
    $user_id = pg_escape_string($con, $_SESSION['user_id']);

    // Delete the rows from users_items table where item_id and user_id match
    $query = "DELETE FROM users_items WHERE item_id='$item_id' AND user_id='$user_id'";
    $res = pg_query($con, $query);

    if (!$res) {
        die("Error in query: " . pg_last_error($con));
    }

    header("Location: cart.php");
    exit();
}
?>
