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

  $countSearchQuery = "SELECT COUNT(*) AS c FROM product WHERE product_name LIKE '%" .$searchq. "%'";
  $countSearchSQL = mysqli_query($conn, $countSearchQuery);
  $countSearch = mysqli_fetch_assoc($countSearchSQL);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Result</title>
	<link rel="stylesheet" type="text/css" href="../css/search-result.css">
  	<link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
	<script src="../js/searchResult.js"></script>
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
  </div>

  <div class="main">
    <div class="result-container">
		<?php
			if(isset($_GET['search-input'])) {
				$searchq = $_GET['search-input'];
		$query = mysqli_query($conn, "SELECT * FROM product WHERE product_name LIKE '%" .$searchq. "%'");
		}
		else {
         	$query = mysqli_query($conn, "SELECT * FROM product");
		}
		while($row = mysqli_fetch_assoc($query)) {
			$id = $row["id_product"];
			$name = $row["product_name"];
			$price = $row["price"];
			$sold = $row["amount_sold"];
			$remaining = $row["stock"];
			$desc = $row["description"];
			$image = $row["image_path"];
        	     
			echo "<div class=\"result-card\">";
			echo "<div class=\"img-settings\">";
			echo "<a href='detailsPage.php?id=" . $row['id_product'] . "'>";
			echo "<img src=\"../$image\" width=\"200px\" height=\"200px\">";
			echo "</div>";
			echo "<div class=result-content>";
			echo "<h1>" . $row['product_name'] . "</h1></a>";
			echo "<p>Amount sold: " . $sold . "</p>";
			echo "<p>Price: Rp ". number_format($price, 2, ',', '.') ." </p>";
			echo "<p>Amount remaining:" .$remaining. "</p>";
			echo "<p>Description</p>";
			echo "<p>" .$desc. "</p>";
			echo "</div>";
			echo "</div>";
		}
	?>

	</div>
	<script>
		  var x = <?php echo $countSearch['c'];?>;
		  var count = 0;
	</script>
	<a href="#" onclick="showPrevSearch();">Prev</a>
	<br/>
	<a href="#" onclick="showNextSearch();">Next</a>


  </div>


</body>
</html>