<?php

require_once "connectDatabase.php";
    
    if(!isset($_COOKIE['tokenized'])) {
      header('Location: loginAccount.php');
    }

    $token = $_COOKIE['tokenized'];
    $searchUser = "SELECT * FROM users WHERE token = '$token'";
    $searchUserSQL = mysqli_query($conn, $searchUser);
    $row = mysqli_fetch_assoc($searchUserSQL);
    
    $id_user = $row['id_user'];
    $id_user = intval($id_user);
    $role = $row["category"];

    if($role != "user") {
      echo "Restricted";
      header('Location: dashboard.php');
    }
    
    $product_id = mysqli_real_escape_string($conn, $_GET["id"]);
    $product_id = intval($product_id);
    $query = mysqli_query($conn, "SELECT * FROM product WHERE id_product = $product_id");
    $row = mysqli_fetch_assoc($query);
    $id = $row["id_product"];
    $name = $row["product_name"];
    $price = $row["price"];
    $sold = $row["amount_sold"];
    $amount = $row["stock"];
    $desc = $row["description"];
    $image = $row["image_path"];
?>

<!DOCTYPE HTML>
    <head>
        <title>Buy Chocolate</title>
        <link rel="stylesheet" type="text/css" href="../css/buyAddChocolate.css">
        <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
        <!-- <script src="../js/buyChocolate.js"></script> -->
        <!-- <script src="../js/chocolateUpdate.js"></script> -->

    </head>

    <body>
        <div class="details-content">
            <h4><?php echo $name ?></h4>
            <h5>Amount sold: <?php echo $sold ?></h5>
            <h5>Price: Rp <?php echo number_format($price, 2, ',', '.'); ?></h5>
            <h5 id="stock">Amount: <?php echo $amount ?></h5>
            <h5>Description: </h5>
            <p> <?php echo $desc ?> </p>
        </div>
    </body>

</html>