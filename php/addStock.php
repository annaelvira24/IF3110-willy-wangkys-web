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

    if($role != "superuser") {
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
      $amount_add = trim($_POST["amount"]);
      
      $client = new SoapClient("http://localhost:8080/web_service_factory/services/ReqAddStock?wsdl");

      $params = array(
        "productId" => $product_id,
        "amount" => $amount_add,
      );

      $response = $client->__soapCall("ReqAddStock", array($params));

      $sql =
      "INSERT INTO addstock (id_product, amount, status) VALUES ('".$product_id."', '".$amount_add."', 'Pending')";
    
      if(mysqli_query($conn, $sql)){
        header('Location: detailsPage.php?id=' . $id);
        close();
      }
      else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

    }

?>

<!DOCTYPE HTML>

<head>
    <title>Add Stock</title>
    <link rel="stylesheet" type="text/css" href="../css/buyAddChocolate.css">
    <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
    <script>
      var id = <?php echo $product_id;?>;
    </script>
    <script src="../js/addStock.js"></script>
    <script src="../js/chocolateUpdate.js"></script>
</head>

<body>
  <div class="navbar">
    <div class="navbar-wrapper">
      <a class="navbar-button" id ="regularnav-button" href="dashboard.php">
        Home
      </a>
      <a class="navbar-button" id ="regularnav-button" href="addNewChocolate.php">
        Add New Chocolate
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
  
  <div class ="main">
    <div class="row">
      <div class="col-30">
        <h2>Add Stock</h2>
        <img class = "detail-img" src="../<?php echo $image ?>" alt="..."></img>
      </div>
      <div class="col-70">
        <div class="details-container">
          <div class="details-content">
            <h4><?php echo $name ?></h4>
            <h5>Amount sold: <?php echo $sold ?></h5>
            <h5>Price: Rp <?php echo number_format($price, 2, ',', '.'); ?></h5>
            <h5>Amount: <?php echo $amount ?></h5>
            <h5>Description: </h5>
            <p> <?php echo $desc ?> </p>
          </div>
          <form id="buy-form" method="post">
          <div class = "row">
            <div class = "col-50">
              <h5>Amount to Add:</h5>
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
            </div>
          </div>
        </div>    
      </div>
    </div>

    <div class = "row" id ="button-container">
      <button id = "cancel-button" class = "cancel-button" onClick="cancel(event,<?php echo $product_id?>)";>Cancel</button>
      <input type="submit" class = "button-submit" name ="action" value = "Add">
    </div>
  </form>
  </div>
  

</body>

</html>