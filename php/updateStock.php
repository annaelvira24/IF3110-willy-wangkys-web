<?php

require_once "connectDatabase.php";
    
    if(!isset($_COOKIE['tokenized'])) {
      header('Location: loginAccount.php');
    }

    $check_stat_query = mysqli_query($conn, "SELECT id_addstock, id_product, amount FROM addStock WHERE status = 'Pending'");
    while ($stat_row = mysqli_fetch_assoc($check_stat_query)){
        $client = new SoapClient("http://localhost:8080/web_service_factory/services/GetApprovalStatus?wsdl");

        $id_addstock =  $stat_row["id_addstock"];
        $id_product =  $stat_row["id_product"];
        $amount_add =  $stat_row["amount"];


        $params = array(
            "addStockId" => $id_addstock,
        );

      $res = $client->__soapCall("GetApprovalStatus", array($params));

      $status_now = (get_object_vars($res)["return"]);
      if($status_now == "Delivered"){
          mysqli_query($conn, "UPDATE addStock SET status = 'Delivered' WHERE id_addstock = $id_addstock");
          mysqli_query($conn, "UPDATE product SET stock = stock + $amount_add WHERE id_product = $id_product");
      }

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