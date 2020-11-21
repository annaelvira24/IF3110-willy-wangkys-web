<?php
    include "connectDatabase.php";

    $token = $_COOKIE['tokenized'];
    
    $logout = "UPDATE users SET token = NULL WHERE token = '$token'";
    $logoutSQL = mysqli_query($conn, $logout);

    setcookie('tokenized', "", time()-600);

    header('Location: loginAccount.php');
?>