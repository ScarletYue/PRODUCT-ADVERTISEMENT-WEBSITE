<?php
    session_start();
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "webtintuc";   // Khai báo database

// Kết nối database
$connect = new mysqli($server, $username, $password, $dbname);

    ob_start();
    if(isset($_SESSION['orders'])) unset($_SESSION['orders'] );
    header('Location: danhmucsp.php');
?>