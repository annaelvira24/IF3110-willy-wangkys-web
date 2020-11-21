<?php

  require_once "connectDatabase.php";

  if(!isset($_COOKIE['tokenized'])) {
    header('Location: loginAccount.php');
  }

  $token = $_COOKIE['tokenized'];
  $searchUser = "SELECT id_user FROM users WHERE token = '$token'";
  $searchUserSQL = mysqli_query($conn, $searchUser);
  list($id_user) = mysqli_fetch_array($searchUserSQL);
  $query = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
  $row = mysqli_fetch_assoc($query);
  $role = $row["category"];

  $countProductQuery = "SELECT COUNT(*) AS c FROM product";
  $countProductSQL = mysqli_query($conn, $countProductQuery);
  $countProduct = mysqli_fetch_assoc($countProductSQL);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
  <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
  <script src="../js/dashboard.js"></script>
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

  <div class="main">
    <div class="addition">
      <div class="hello-user">
        <?php 
          $find = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
          $find_username = mysqli_fetch_assoc($find);
          $uname = $find_username["username"];
          echo "Hello, " .$uname;
        ?>
      </div>
      <div class="view-all">
        <script>
          var x = <?php echo $countProduct['c']; ?>
        </script>
        <a href="#" onclick="showAllChocolate();">View all chocolates</a>
      </div>
    </div>

    <div class="cards-container">
      <?php 
          if($_SERVER["REQUEST_METHOD"] == "GET"){
            $query = mysqli_query($conn, "SELECT * FROM product ORDER BY amount_sold DESC");

            while($row = mysqli_fetch_assoc($query)) {
              $id = $row["id_product"];
              $name = $row["product_name"];
              $price = $row["price"];
              $sold = $row["amount_sold"];
              $image = $row["image_path"];
              
              echo "<div class=\"card\">";
              echo "<div class=\"image-settings\">";
              echo "<a href='detailsPage.php?id=" . $row['id_product'] . "'>";
              echo "<img src=\"../$image\" width=\"200px\" height=\"200px\">";
              echo "</div>";
              echo "<div class=content>";
              echo "<h1>" . $row['product_name'] . "</h1></a>";
              echo "<p>Amount sold: " . $sold . "</p>";
              echo "<p>Price: Rp ". number_format($price, 2, ',', '.') ." </p>";
              echo "</div>";
              echo "</div>";
            }
          }
      ?>
    </div>
  </div>

</body>
</html>
