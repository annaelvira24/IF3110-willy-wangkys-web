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
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {      
      $message_err = "";
      $amount_buy = trim($_POST["amount"]);
      $address = trim($_POST["address"]);
      
      $client = new SoapClient("http://localhost:8080/web_service_factory/services/AddBalance?wsdl");

      $params = array(
        "add" => $amount_buy * $price,
      );

      $response = $client->__soapCall("AddBalance", array($params));

     
      $sql =
      "INSERT INTO transaction(id_product, id_user, amount_purchased, total_price, date_purchased, address)
      VALUES($product_id, $id_user, $amount_buy, $amount_buy * $price, NOW(), '". $address."');";

      $sql .=
      "UPDATE product
      SET amount_sold = amount_sold + $amount_buy, stock = stock - $amount_buy
      WHERE id_product = $product_id;";
    
      if(mysqli_multi_query($conn, $sql)){
        header('Location: transactionHistory.php');
        close();
      }
      else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

    }

?>

<!DOCTYPE HTML>

<head>
    <title>Buy Chocolate</title>
    <link rel="stylesheet" type="text/css" href="../css/buyAddChocolate.css">
    <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
    <script>
      var id = <?php echo $product_id;?>;
    </script>
    <script src="../js/buyChocolate.js"></script>
    <script src="../js/chocolateUpdate.js"></script>
</head>

<body>
  <div class="navbar">
    <div class="navbar-wrapper">
      <a class="navbar-button" id ="regularnav-button" href="dashboard.php">
        Home
      </a>
      <a class="navbar-button" id ="regularnav-button" href="transactionHistory.php">
        History
      </a>
      <div class="searchbar">
        <form action="search_result.php" method="get">

        <div class="row-search">
          <div class = "col-70-search">
            <input type="text" name="search-input" id="search-input" placeholder="Search for chocolates..."/>
          </div>

          <div class = "col-30-search">
            <input type="submit" id="button-search" value="Search">
          </div>
        </div>
        </form>
      </div>
        <a class="navbar-button" id ="logout-button" href="logoutAccount.php">
          Logout
        </a>
    </div>
  </div>
  
  <div class ="main" id="mainField">
    <div class="row">
      <div class="col-30">
        <h2>Buy Chocolate</h2>
        <img class = "detail-img" src="../<?php echo $image ?>" alt="..."></img>
      </div>
      <div class="col-70">
        <div class="details-container">
          <div class="details-content" id="details">
            <h4><?php echo $name ?></h4>
            <h5>Amount sold: <?php echo $sold ?></h5>
            <h5>Price: Rp <?php echo number_format($price, 2, ',', '.'); ?></h5>
            <h5 id="stock">Amount: <?php echo $amount ?></h5>
            <h5>Description: </h5>
            <p> <?php echo $desc ?> </p>
          </div>
        </div>
          <form id="buy-form" method="post">
          <div class = "row">
            <div class = "col-50">
              <h5>Amount to Buy:</h5>
              <div class ="amount-to-buy-container">
                <div class = "col-inc-dec">
                  <button class = "amount-buy-button" id="dec-button" onclick="decrement(event, <?php echo $price ?>);">-</button>
                </div>
                <div class ="col-amount-buy-num">
                  <input type="number" name="amount" id="amount-buy-num" value=1>
                </div>
                <div class= "col-inc-dec" style="float: right;">
                    <button class = "amount-buy-button" id="inc-button" onclick="increment(event, <?php echo $price ?>, <?php echo $amount ?>);">+</button>
                </div>
              </div>
            </div>
            <div class = "col-50">
              <h5>Total Price:</h5>
              <label id="total-price">Rp </label>
              <label id="total-price-num"><?php echo number_format($price, 2, ',', '.');?></label>

            </div>
        </div>    
      </div>
    </div>
    <div class= "row">
      <div class="col-100">
        <h3>Address</h3>
        <textarea name="address" placeholder="Insert your address" required></textarea>
      </div>
    </div>
    <div class = "row" id ="button-container">
      <button id = "cancel-button" class = "cancel-button" onClick="cancel(event,<?php echo $product_id?>)";>Cancel</button>
      <input type="submit" class="button-submit" name ="action" value = "Buy" id="buy-button" 
      <?php 
        if ($amount == 0){
          echo " disabled";
        }
        
      ?>>
    </div>
  </form>
  </div>
  

</body>

</html>