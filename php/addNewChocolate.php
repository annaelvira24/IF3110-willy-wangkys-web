<?php

require_once "connectDatabase.php";

// Check if user has loged in
if(!isset($_COOKIE['tokenized'])) {
  header('Location: loginAccount.php');
}

$content = file_get_contents("http://localhost:5000/supply");
$result  = json_decode($content);
$arrBahan = json_encode($result);

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

else{
  $success = 0;
  $message_err = "";
  $name = "";
  $price = "";
  $desc = "";
  $image = "";
  $amount = "";

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $name = trim($_POST["name"]);
      $price = trim($_POST["price"]);
      $desc = trim($_POST["description"]);
      $amount = trim($_POST["amount"]);
      
      $ingredient = array();
      $amountNeed = array();
      for($i = 0; $i < count($result); $i++){
        $for_name = "bahan" . "$i";
        if(trim($_POST[$for_name]) > 0){
          array_push($ingredient, $i);
          array_push($amountNeed, trim($_POST[$for_name]));
        }
      }


      // Get image name
      $image = $_FILES['image']['name'];
      $target_dir = "../database/photos/".basename($image);
      $target_dir_db = "database/photos/".basename($image);

      $searchProductId = "SELECT max(id_product) FROM product";
      $row = mysqli_fetch_assoc(mysqli_query($conn, $searchProductId));
      $id_product = $row['max(id_product)'];
      $id_product = intval($id_product);

        
      $client = new SoapClient("http://localhost:8080/web_service_factory/services/AddProduct?wsdl");

      $params = array(
        "productId" => $id_product + 1,
        "productName" => $name,
        "stock" => $amount,
      );

      print_r($params);

      $client->__soapCall("AddProduct", array($params));
      
      for ($i = 0; $i<count($ingredient); $i++){
        $client = new SoapClient("http://localhost:8080/web_service_factory/services/AddRecipe?wsdl");
        $params = array(
          "productId" => $id_product + 1,
          "ingredientId" => $ingredient[$i],
          "amountNeed" => $amountNeed[$i],
        );
  
        print_r($params);
  
        $client->__soapCall("AddRecipe", array($params));
      }

        $query = "INSERT INTO product(product_name, price, amount_sold, stock, description, image_path) 
        values('".$name."', '".$price."', 0, '".$amount."', '".$desc."', '".$target_dir_db."')";
        if (mysqli_query($conn, $query)) {
            $success = 1;
            move_uploaded_file($_FILES['image']['tmp_name'],$target_dir);
            header('Location: dashboard.php');
            exit();
            
        } 
        else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
  }
}

?>
<!DOCTYPE HTML>

<head>
    <title>Add New Chocolate</title>
    <link rel="stylesheet" type="text/css" href="../css/addNewChocolate.css">
    <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
</head>

<script src="../js/calculateModal.js"></script>


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
    <h3>Add New Chocolate</h3>
        <form action = "" method="POST" enctype='multipart/form-data'>
          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="name">Name</label>
            </div>
            <div class="col-80">
              <input type="text" id="name" name="name" required>
            </div>
          </div>
          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="amount" style="font-weigth:bold;">Recipe</label>
            </div>
          </div>
          <?php
            for ($i = 0; $i < count($result); $i++){
              $for_name = "bahan" . "$i";
              echo
                '<div class="row">
                <div class="col-20">
                  <label id = "form-label-recipe">'. $result[$i]->nama_bahan .'</label>
                </div>
                <div class="col-80">
                  <input class = "input-recipe" type="number" min="0" value = "0" step="0.1" name='. $for_name .' id= '. $for_name .'  required>
                </div>
              </div>';
            }
          ?>

          <div class="row">
            <div class="col-20">
              <label id = "form-label" style="font-weight:bold;">Total Modal</label>
            </div>

            <div class="col-80">
              <label class = "form-label" style="font-weight:bold;">Rp </label>
              <label class = "form-label" id = "total-modal" style="font-weight:bold;">0.00</label>
              <button id = "show-price" type="button" onclick='calcAllPrice(event, <?php echo $arrBahan ?>);'>Calculate</button>
              
            </div>
          </div>

          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="price">Price</label>
            </div>
            <div class="col-80">
              <input type="number" id="price" name="price" required>
            </div>
          </div>
          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="description">Description</label>
            </div>
            <div class="col-80">
              <textarea id="description" name="description" style="height:200px" required></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="image">Image</label>
            </div>
            <div class="col-80">
                <label class = "custom-file-upload">
                    Upload File
                    <input type="file" name="image" accept="image/*" required>
                </label>
            </div>
          </div>
          <div class="row">
            <div class="col-20">
              <label id = "form-label" for="amount">Amount</label>
            </div>
            <div class="col-80">
              <input type="number" id="amount" name="amount" required>
            </div>
          </div>

          <div class="row">
            <input type="submit" class = "button-submit" value="Add Chocolate">
          </div>
        </form>
  </div>
  

</body>

</html>