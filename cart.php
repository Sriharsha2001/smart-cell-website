<?php
require("includes/common.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>SmartCell | Cart</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/css.css" type="text/css">
</head>
<body style="padding-top: 50px;">

<!-- Header -->
<?php include 'includes/header.php'; ?>
<!-- Header end -->

<div class="container">
    <div class="row row_style2">
        <div class="col-sm-10 col-sm-offset-1">
            <table class="table table-striped">

                <?php
                $sum = 0;
                $user_id = $_SESSION['user_id'];

                $query = "SELECT items.price AS Price, items.id AS id, items.name AS Name 
                          FROM users_items 
                          JOIN items ON users_items.item_id = items.id 
                          WHERE users_items.user_id = $1 AND status = 'Added to cart'";
                
                $result = pg_query_params($con, $query, array($user_id));

                if (!$result) {
                    die("Query failed: " . pg_last_error($con));
                }

                if (pg_num_rows($result) >= 1) {
                ?>
                    <thead>
                        <tr>
                            <th>Item Number</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $id = "";

                        while ($row = pg_fetch_assoc($result)) {
                            $sum += $row["price"];
                            $id .= $row["id"] . ",";
                            echo "<tr>
                                    <td>#{$row["id"]}</td>
                                    <td>{$row["name"]}</td>
                                    <td>Rs {$row["price"]}</td>
                                    <td><a href='cart-remove.php?id={$row['id']}' class='remove_item_link'> X </a></td>
                                  </tr>";
                        }

                        $id = rtrim($id, ",");

                        echo "<tr>
                                <td></td>
                                <td>Total</td>
                                <td>Rs {$sum}</td>
                                <td><a href='success.php?itemsid={$id}' class='btn btn-primary'>Confirm Order</a></td>
                              </tr>";
                        ?>
                    </tbody>
                <?php
                } else {
                    echo "<center><h2><br>Add items to the cart first!</h2><p><a href='products.php'>Click here</a> to explore products.</p></center>";
                }
                ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>
