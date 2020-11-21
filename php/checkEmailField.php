<?php
    include "connectDatabase.php";
    
    $res = "";
    $checkEmail = $_POST['mail'];
    $queryMail = "SELECT * FROM users WHERE email = '$checkEmail'";
    $queryMailSQL = mysqli_query($conn, $queryMail);
    if(mysqli_num_rows($queryMailSQL) == 0) {
        $res = 'unique';    
    }
    
    else {
        $res = 'exist';
    }
    
    echo $res;
?>