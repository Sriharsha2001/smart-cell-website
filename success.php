<?php
require("includes/common.php");

if (!isset($_SESSION['email'])) {
    header('location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];


$query = "UPDATE users_items SET status='Confirmed' WHERE user_id=$1 AND status='Added to cart'";
$result = pg_query_params($con, $query, array($user_id));

if (!$result) {
    die("Error updating order status: " . pg_last_error($con));
}
?>
<!DOCTYPE html>
<!--

-->
<html>
    <head>
        <title>SmartCell|Success</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/css.css" type="text/css">
    </head>
    <body>
                
        <?php
		include 'includes/header.php';
		?>

        <div class="container"><br><br><br><br><br><br>
            <div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<table class="table table-striped table-center">
					<thead>
						<tr>
							<td class="text-center"><p>Thank you for ordering from SmartCell. The order shall be delivered to you shortly.</p> </td>
						</tr>
						<tr>
							<td class="text-center"><br><p>Order some more electronic item <a href="products.php">here</a></p></td>
						</tr>
					</thead>
					</table>
				</div>
            </div>  
        </div>
        
    
        
    </body>
</html>
