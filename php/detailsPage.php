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

    if($_SERVER["REQUEST_METHOD"] == "GET"){
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
    }

?>

<!DOCTYPE HTML>

<head>
    <title>Chocolate Details</title>
    <link rel="stylesheet" type="text/css" href="../css/details.css">
    <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
    <script>
      var id = <?php echo $product_id;?>;
    </script>
    <script src="../js/chocolateUpdate.js"></script>
</head>

<body>
  <div class="navbar">
    <div class="navbar-wrapper">
      <a class="navbar-button" id ="regularnav-button" href="dashboard.php">
        Home
      </a>
      <?php
        if ($role === "superuser"){
          echo '<a class="navbar-button" id ="regularnav-button" href="addNewChocolate.php">
                  Add New Chocolate
                </a>';
        }

        else{
          echo '<a class="navbar-button" id ="regularnav-button" href="transactionHistory.php">
                  History
                </a>';
        }
      ?>
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
        <h2><?php echo $name?></h2>
        <img class = "detail-img" src="../<?php echo $image?>" alt="..."></img>
      </div>
      <div class="col-70">
        <div class="details-container">
          <div class="details-content" id = "details">
            <h4>Amount sold: <?php echo $sold?></h4>
            <h4>Price: Rp<?php echo number_format($price, 2, ',', '.'); ?></h4>
            <h4>Amount: <?php echo $amount?></h4>
            <h4>Description: </h4>
            <p><?php echo $desc?>
            </p>
          </div>
        </div>    
      </div>
    </div>
    <div class = "button-container">
    <?php
       if ($role === "superuser"){
        echo "<button onclick = 'location.href =  \"addStock.php?id=".$id . "\"' class = 'buy-button'>Add Stock</button>";
      }

      else{
        echo "<button onclick = 'location.href =  \"buyChocolate.php?id=".$id . "\"' class = 'buy-button'>Buy Chocolate</button>";
      }
    ?>

      
    </div>
  </div>
</body>

</html>