<?php
    include "connectDatabase.php";

    $res = "";
    $checkUsn = $_POST['username'];
    $queryUsername = "SELECT * FROM users WHERE username = '$checkUsn'";
    $queryUsernameSQL = mysqli_query($conn, $queryUsername);
    if(mysqli_num_rows($queryUsernameSQL) == 0) {
        $res = 'unique';    
    }
    
    else {
        $res = 'exist';
    }
    echo $res;
?>