<?php 
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'willywangky';

    $conn = mysqli_connect($server, $username, $password, $database);

    if(!$conn) {
        die("Connection failed!");
    }
?>