<?php
    include "connectDatabase.php";

    if(!isset($_COOKIE['tokenized'])) {
        header('Location: loginAccount.php');
      }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Transaction History</title>
        <link rel="stylesheet" type="text/css" href="../css/transactionHistory.css">
        <link rel="stylesheet" type="text/css" href="../css/pageTemplate.css">
    </head>

    <body>
        <div class="navbar">
            <div class="navbar-wrapper">
                <a class="navbar-button" id ="regularnav-button" href="dashboard.php">
                    Home
                </a>
                <a class="navbar-button" id="regularnav-button" href="transactionHistory.php">
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
                    <a class="navbar-button" id="logout-button" href="logoutAccount.php">
                        Logout
                    </a>
            </div>
    </div>

        <div class="main">
            <h3>Transaction History</h3>

            <div class="table-container">
            <?php
                $token = $_COOKIE['tokenized'];
                $searchUser = "SELECT id_user FROM users WHERE token = '$token'";
                $searchUserSQL = mysqli_query($conn, $searchUser);
                list($id_user) = mysqli_fetch_array($searchUserSQL);

                $history = "SELECT id_product, product_name, amount_purchased, total_price, date_purchased, address FROM transaction NATURAL JOIN product WHERE id_user = '$id_user' ORDER BY date_purchased DESC";
                $historySQL = mysqli_query($conn,$history);

                if(mysqli_num_rows($historySQL) == 0) {
                    echo "<h4>No history</h4>";
                }
                else {
                    echo 
                    "<table>
                    <thead>
                    <th>Chocolate Name</th>
                    <th>Amount</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Address</th>
                    </thead>
                    <tbody>";

                    while($row = mysqli_fetch_assoc($historySQL)) {
                        // split date and time
                        $timestamp = $row['date_purchased'];
                        list($date, $time) = explode(' ', $timestamp);
                        // format date
                        $createDate = date_create($date);
                        $formattedDate = date_format($createDate, 'd F Y');
                        echo "<tr>";
                        echo "<td> <a href='detailsPage.php?id=" . $row['id_product'] . "'>" . $row['product_name'] . "</a></td>";
                        echo "<td>" . $row['amount_purchased'] . "</td>";
                        echo "<td> Rp" . number_format($row['total_price'], 2, ',', '.') . "</td>";
                        echo "<td>" . $formattedDate . "</td>";
                        echo "<td>" . $time . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                }
            ?>
            </table>

            </div>
        </div>
    </body>
    
</html>